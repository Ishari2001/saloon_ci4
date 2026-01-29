<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Services extends BaseController
{
    protected ServiceModel $service;

    public function __construct()
    {
        $this->service = new ServiceModel();
    }

    public function index()
    {
        return view('admin/services/index', [
            'services' => $this->service->findAll()
        ]);
    }

    public function store()
{
    
 $file = $this->request->getFile('image');

$imageName = null;
if ($file && $file->isValid() && !$file->hasMoved()) {
    $imageName = $file->getRandomName();
    // MOVE TO public folder
    $file->move(ROOTPATH . 'public/uploads/services/', $imageName);
}

   $this->service->insert([
    'name'             => $this->request->getPost('name'),
    'duration_minutes' => $this->request->getPost('duration_minutes'),
    'price'            => $this->request->getPost('price'),
    'description'      => $this->request->getPost('description'),
    'seat_count'       => $this->request->getPost('seat_count'), // NEW
    'image'            => $imageName,
    'status'           => 'active',
]);


    return redirect()->back()->with('success', 'Service added');
}


    public function delete($id)
    {
        $this->service->delete($id);
        return redirect()->back()->with('success', 'Service deleted');
    }


    public function toggle($id)
{
    $service = $this->service->find($id);

    if ($service) {
        $newStatus = $service['status'] === 'active' ? 'inactive' : 'active';
        $this->service->update($id, ['status' => $newStatus]);
    }

    return redirect()->back()->with('success', 'Service status updated');
}

public function update($id)
{
    // Fetch the service
    $service = $this->service->find($id);
    if (!$service) {
        return redirect()->back()->with('error', 'Service not found');
    }

    // Collect form data
    $data = [
        'name'             => $this->request->getPost('name'),
        'duration_minutes' => $this->request->getPost('duration_minutes'),
        'price'            => $this->request->getPost('price'),
        'description'      => $this->request->getPost('description'),
        'seat_count'       => $this->request->getPost('seat_count'),
        'status'           => $this->request->getPost('status')
    ];

    // Handle image upload
    $file = $this->request->getFile('image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newImageName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/services/', $newImageName);

        // Delete old image if exists
        if ($service['image'] && file_exists(ROOTPATH . 'public/uploads/services/' . $service['image'])) {
            unlink(ROOTPATH . 'public/uploads/services/' . $service['image']);
        }

        // Update data array with new image name
        $data['image'] = $newImageName;
    }

    // Update service in DB
    $this->service->update($id, $data);

    return redirect()->back()->with('success', 'Service updated successfully');
}



}
