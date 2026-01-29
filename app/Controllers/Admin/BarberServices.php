<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarberServiceModel;

class BarberServices extends BaseController
{
    protected $barberService;

    public function __construct()
    {
        $this->barberService = new BarberServiceModel();
    }

    // Assign services to a barber
    public function assign($barberId)
    {
        $serviceIds = $this->request->getPost('services'); // array of service ids

        if ($serviceIds) {
            // Remove old services
            $this->barberService->where('barber_id', $barberId)->delete();

            // Insert new services
            foreach ($serviceIds as $sid) {
                $this->barberService->insert([
                    'barber_id' => $barberId,
                    'service_id' => $sid
                ]);
            }
        }

        return redirect()->back()->with('success', 'Services updated for barber.');
    }

    // Remove a specific service from a barber
    public function remove($barberId, $serviceId)
    {
        $this->barberService
            ->where('barber_id', $barberId)
            ->where('service_id', $serviceId)
            ->delete();

        return redirect()->back()->with('success', 'Service removed from barber.');
    }
}
