<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarberModel;
use App\Models\ServiceModel;
use App\Models\BarberServiceModel;
use App\Models\BarberLeaveModel;

class Barbers extends BaseController
{
    protected BarberModel $barber;
    protected ServiceModel $service;
    protected BarberServiceModel $barberService;
    protected BarberLeaveModel $leave;
    

    public function __construct()
    {
        $this->barber = new BarberModel();
        $this->service = new ServiceModel();
        $this->barberService = new BarberServiceModel();
        $this->leave         = new BarberLeaveModel();
    }

    // Show barbers with assigned services
    public function index()
    {
        $barbers = $this->barber->findAll();
        $services = $this->service->where('status', 'active')->findAll();

        // Fetch assigned services for each barber
        foreach ($barbers as &$b) {
            $b['services'] = $this->barberService
                ->select('services.*')
                ->join('services', 'services.id = barber_services.service_id')
                ->where('barber_id', $b['id'])
                ->findAll();
        }
          $leaves = $this->leave
            ->select('barber_leaves.*, barbers.name as barber_name')
            ->join('barbers', 'barbers.id = barber_leaves.barber_id')
            ->orderBy('start_date', 'DESC')
            ->findAll();

        return view('admin/barbers/index', [
            'barbers' => $barbers,
            'services' => $services,
            'leaves'   => $leaves 
        ]);
    }

    // Add new barber + assign services
    public function store()
    {
        $barberId = $this->barber->insert([
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'status' => $this->request->getPost('status') ?? 'active'
        ]);

        $serviceIds = $this->request->getPost('services');
        if ($serviceIds) {
            foreach ($serviceIds as $sid) {
                $this->barberService->insert([
                    'barber_id' => $barberId,
                    'service_id' => $sid
                ]);
            }
        }

        return redirect()->back()->with('success', 'Barber added successfully.');
    }

    // Update barber info + assigned services
// Show edit form
public function edit($id)
{
    $barber = $this->barber->find($id);
    if (!$barber) return redirect()->back()->with('error', 'Barber not found.');

    $services = $this->service->where('status', 'active')->findAll();
    $assignedServices = $this->barberService->where('barber_id', $id)->findAll();
    $assignedIds = array_column($assignedServices, 'service_id');

    return view('admin/barbers/edit', [
        'barber' => $barber,
        'services' => $services,
        'assignedIds' => $assignedIds
    ]);
}

// Process update
public function update($id)
{
    $barber = $this->barber->find($id);
    if (!$barber) return redirect()->back()->with('error', 'Barber not found.');

    $this->barber->update($id, [
        'name' => $this->request->getPost('name'),
        'phone' => $this->request->getPost('phone'),
        'status' => $this->request->getPost('status')
    ]);

    $this->barberService->where('barber_id', $id)->delete();
    $serviceIds = $this->request->getPost('services');
    if ($serviceIds) {
        foreach ($serviceIds as $sid) {
            $this->barberService->insert([
                'barber_id' => $id,
                'service_id' => $sid
            ]);
        }
    }

    return redirect()->back()->with('success', 'Barber updated successfully.');
}


    // Delete barber + assigned services
    public function delete($id)
    {
        $this->barberService->where('barber_id', $id)->delete();
        $this->barber->delete($id);

        return redirect()->back()->with('success', 'Barber deleted successfully.');
    }

     public function addLeave()
    {
        $this->leave->insert([
            'barber_id'  => $this->request->getPost('barber_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date'   => $this->request->getPost('end_date'),
            'reason'     => $this->request->getPost('reason')
        ]);

        return redirect()->back()->with('success', 'Leave added successfully');
    }

    
}
