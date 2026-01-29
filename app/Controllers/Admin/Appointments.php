<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\AppointmentServiceModel;
use App\Models\ServiceModel;
use App\Models\BarberModel;

class Appointments extends BaseController
{
    public function index()
    {
        $appointmentModel = new AppointmentModel();
        $appointments = $appointmentModel
            ->orderBy('date', 'DESC')
            ->findAll();

        $appointmentServiceModel = new AppointmentServiceModel();
        $serviceModel = new ServiceModel();
        $barberModel = new BarberModel();

        foreach($appointments as &$app){
            $barber = $barberModel->find($app['barber_id']);
            $app['barber_name'] = $barber ? $barber['name'] : 'N/A';

            $serviceLinks = $appointmentServiceModel
                ->where('appointment_id', $app['id'])
                ->findAll();

            $serviceNames = [];
            foreach($serviceLinks as $link){
                $service = $serviceModel->find($link['service_id']);
                if($service) $serviceNames[] = $service['name'];
            }
            $app['services'] = $serviceNames;
        }

        return view('admin/appointments/index', ['appointments' => $appointments]);
    }

    public function updateStatus($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found');
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        $appointmentModel->update($id, ['status' => $status]);

        // ✅ Send email if status is 'confirmed'
        if ($status === 'confirmed' && !empty($appointment['email'])) {
            $this->sendConfirmedEmail([
                'customer_name'  => $appointment['customer_name'],
                'customer_email' => $appointment['email'],
                'date'           => $appointment['date'],
                'time'           => $appointment['start_time'],
            ]);
        }

        return redirect()->back()->with('success', 'Status updated');
    }

    /**
     * Send confirmation email
     */
    protected function sendConfirmedEmail($appointment)
    {
        $email = \Config\Services::email();

        $email->setTo($appointment['customer_email']);
        $email->setFrom('no-reply@yourdomain.com', 'Salon Admin');
        $email->setSubject('Appointment Confirmed');

        // Make sure you have this view: app/Views/emails/confirmed.php
        $message = view('emails/confirmed', ['appointment' => $appointment]);
        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Email sending failed: ' . $email->printDebugger(['headers']));
        }
    }
}
