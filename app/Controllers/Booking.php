<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\BarberModel;
use App\Models\BarberServiceModel;
use App\Models\BookingModel;
  use App\Models\AppointmentModel;
use App\Models\AppointmentServiceModel;
use App\Models\SiteSystemModel;

class Booking extends BaseController
{
      public function index()
    {
        // ✅ Load system name + logo
        $system = (new SiteSystemModel())->find(1);

        return view('booking/index', [
            'system' => $system
        ]);
    }
    // STEP 1: Load services
    public function services()
    {
        return $this->response->setJSON(
            (new ServiceModel())->where('status','active')->findAll()
        );
    }

    // STEP 2: Load barbers by service (FIXED)
    public function barbers($serviceId)
{
    $date = $this->request->getGet('date'); // 👈 selected date

    $builder = (new BarberServiceModel())
        ->select('barbers.id, barbers.name')
        ->join('barbers', 'barbers.id = barber_services.barber_id')
        ->where('barber_services.service_id', $serviceId)
        ->where('barbers.status', 'active');

    /* 🚫 EXCLUDE BARBERS ON LEAVE */
    if ($date) {
        $builder->whereNotIn('barbers.id', function ($sub) use ($date) {
            return $sub->select('barber_id')
                ->from('barber_leaves')
                ->where('start_date <=', $date)
                ->where('end_date >=', $date);
        });
    }

    return $this->response->setJSON($builder->findAll());
}


    // STEP 3: Load available slots (simple version)
   // STEP 3: Load available slots with seat count
public function slots()
{
    $serviceId = $this->request->getGet('service_id');
    $barberId  = $this->request->getGet('barber_id');
    $date      = $this->request->getGet('date');

    if (!$serviceId || !$barberId || !$date) {
        return $this->response->setJSON([]);
    }

    $serviceModel = new \App\Models\ServiceModel();
    $appointmentModel = new \App\Models\AppointmentModel();
    $settingModel = new \App\Models\SettingModel(); // ✅ new

    $service = $serviceModel->find($serviceId);
    if (!$service) return $this->response->setJSON([]);

    $duration = (int) $service['duration_minutes'];
    $maxSeats = (int) $service['seat_count'] ?? 1; // number of people allowed per slot

    // ✅ Get salon settings for this date
    $fullClosed = $settingModel->getValue('full_day_closed', $date);
    if ($fullClosed) {
        return $this->response->setJSON([
            'error' => 'Salon is closed on this date'
        ]);
    }

    $openTime  = $settingModel->getValue('open_time', $date)  ?? '09:00';
    $closeTime = $settingModel->getValue('close_time', $date) ?? '18:00';

    // EXISTING BOOKINGS
    $appointments = $appointmentModel
        ->where('barber_id', $barberId)
        ->where('date', $date)
        ->findAll();

    // SLOT GENERATION
$slots = [];
$start = strtotime($openTime);
$end   = strtotime($closeTime);

while ($start < $end) {
    $slotStart = date("H:i", $start);
    $slotEnd   = date("H:i", $start + ($duration * 60));

    // skip if slotEnd > closing time
    if ($slotEnd > date("H:i", $end)) break;

    $bookedCount = 0;

foreach ($appointments as $a) {
    $appointmentStart = strtotime($a['start_time']);
    $appointmentEnd   = strtotime($a['end_time']);

    $currentSlotStart = strtotime($slotStart);
    $currentSlotEnd   = strtotime($slotEnd);

    // count ONLY real overlapping bookings
    if ($currentSlotStart < $appointmentEnd && $currentSlotEnd > $appointmentStart) {
        $bookedCount++;
    }
}


    $slots[] = [
        'time'   => $slotStart,
        'booked' => $bookedCount,
        'max'    => $maxSeats
    ];

    // instead of blindly adding duration, increment by fixed interval (e.g., 2 hours)
    $start += 60 * 60 * 2; // 2 hours gap
}


    // If no slots generated, maybe salon open time < close time or fully booked
    if (empty($slots)) {
        return $this->response->setJSON([
            'error' => 'No available slots'
        ]);
    }

    return $this->response->setJSON($slots);
}




    // STEP 4: Confirm booking
 

public function confirm()
{
    $data = $this->request->getJSON(true);

    $serviceIds = $data['service_ids']; // ARRAY
    $startTime  = $data['time'];

    $serviceModel = new \App\Models\ServiceModel();
    $totalMinutes = 0;

    foreach ($serviceIds as $sid) {
        $service = $serviceModel->find($sid);
        if ($service) {
            $totalMinutes += (int)$service['duration_minutes']; // ✅ fixed
        }
    }

    $endTime = date(
        "H:i:s",
        strtotime("+{$totalMinutes} minutes", strtotime($startTime))
    );

    // Insert into appointments table
    $appointmentModel = new \App\Models\AppointmentModel();
    $appointmentId = $appointmentModel->insert([
        'customer_name' => $data['name'],
        'phone'         => $data['phone'],
        'email'         => $data['email'],
        'barber_id'     => $data['barber_id'],
        'date'          => $data['date'],
        'start_time'    => $startTime,
        'end_time'      => $endTime,
        'status'        => 'pending'
    ]);

    // Insert into appointment_services table
    $appointmentServiceModel = new \App\Models\AppointmentServiceModel();
    foreach ($serviceIds as $sid) {
        $appointmentServiceModel->insert([
            'appointment_id' => $appointmentId,
            'service_id'     => $sid
        ]);
    }

      if (!empty($data['email'])) {
            $this->sendPendingEmail([
                'customer_name'  => $data['name'],
                'customer_email' => $data['email'],
                'date'           => $data['date'],
                'time'           => $startTime,
            ]);
        }

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Appointment booked successfully'
    ]);
}

protected function sendPendingEmail($appointment)
    {
        $email = \Config\Services::email();

        $email->setTo($appointment['customer_email']);
        $email->setFrom('no-reply@yourdomain.com', 'Salon Admin');
        $email->setSubject('Appointment Received – Pending Confirmation');

        $message = view('emails/pending', ['appointment' => $appointment]);
        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Email sending failed: ' . $email->printDebugger(['headers']));
        }
    }



}
