<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\BarberModel;
use App\Models\TimeSlotModel;
use App\Models\AppointmentModel;

class Booking extends BaseController
{
    public function index()
    {
        return view('booking/index', [
            'services' => (new ServiceModel())->where('status', 'active')->findAll(),
            'barbers'  => (new BarberModel())->where('status', 'active')->findAll()
        ]);
    }

    public function availableSlots()
    {
        $barberId = $this->request->getGet('barber_id');
        $date     = $this->request->getGet('date');

        return $this->response->setJSON(
            (new TimeSlotModel())
                ->where([
                    'barber_id' => $barberId,
                    'date' => $date,
                    'is_available' => 1
                ])
                ->findAll()
        );
    }

    public function book()
    {
        (new AppointmentModel())->insert([
            'customer_id' => session()->get('user_id'),
            'barber_id'   => $this->request->getPost('barber_id'),
            'service_ids' => json_encode($this->request->getPost('services')),
            'date'        => $this->request->getPost('date'),
            'time_slot'   => $this->request->getPost('time'),
            'status'      => 'pending'
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Appointment booked successfully'
        ]);
    }
}
