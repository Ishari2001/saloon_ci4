<?php

namespace App\Controllers\Admin;

use App\Models\AppointmentModel;
use App\Models\AppointmentServiceModel;
use App\Models\BarberModel;

class Dashboard extends BaseAdminController
{
    public function index()
    {
        $appointmentModel = new AppointmentModel();
        $appointmentServiceModel = new AppointmentServiceModel();
        $barberModel = new BarberModel();

        // Total appointments
        $totalAppointments = $appointmentModel->countAllResults();

        // Today bookings
        $todayBookings = $appointmentModel
            ->where('date', date('Y-m-d'))
            ->countAllResults();

        // Active barbers
        $activeBarbers = $barberModel
            ->where('status', 'active')
            ->countAllResults();

        // Total revenue (completed appointments)
        $totalRevenue = $appointmentServiceModel
            ->selectSum('services.price', 'total')
            ->join('services', 'services.id = appointment_services.service_id')
            ->join('appointments', 'appointments.id = appointment_services.appointment_id')
            ->where('appointments.status', 'completed')
            ->get()
            ->getRow()
            ->total ?? 0;

        // Weekly stats
        $weeklyBookings = [];
        $weeklyRevenue  = [];

        for($i=6; $i>=0; $i--){
            $day = date('Y-m-d', strtotime("-$i days"));

             $appointmentModel->resetQuery();

            $weeklyBookings[] = $appointmentModel
                ->where('date', $day)
                ->countAllResults();

                 $appointmentServiceModel->resetQuery();

            $dailyRevenue = $appointmentServiceModel
                ->selectSum('services.price', 'total')
                ->join('services', 'services.id = appointment_services.service_id')
                ->join('appointments', 'appointments.id = appointment_services.appointment_id')
                ->where('appointments.status', 'completed')
                ->where('appointments.date', $day)
                ->get()
                ->getRow()
                ->total ?? 0;

            $weeklyRevenue[] = $dailyRevenue;
        }

        // Pending appointments
$pendingAppointments = $appointmentModel
    ->where('status', 'pending')
    ->countAllResults();

return view('admin/dashboard', [
    'totalAppointments' => $totalAppointments,
    'todayBookings'     => $todayBookings,
    'totalRevenue'      => $totalRevenue,
    'activeBarbers'     => $activeBarbers,
    'weeklyBookings'    => json_encode($weeklyBookings),
    'weeklyRevenue'     => json_encode($weeklyRevenue),
    'pendingAppointments' => $pendingAppointments,
]);

    }
}
