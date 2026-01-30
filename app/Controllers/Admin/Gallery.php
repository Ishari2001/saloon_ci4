<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;

class Gallery extends BaseController
{
    protected $gallery;

    public function __construct()
    {
        $this->gallery = new GalleryModel();
    }

    /**
     * Admin Gallery Page
     * URL: /admin/gallery
     */
    public function index()
    {
        $images = $this->gallery->orderBy('id','DESC')->findAll();
        return view('admin/gallery', ['images' => $images]);
    }

    /**
     * Upload Image
     * URL: /admin/gallery/upload
     */
    public function upload()
    {
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            
            // Save to public/uploads/gallery
            $file->move(FCPATH.'uploads/gallery', $name);

            // Insert record into DB
            $this->gallery->insert(['image' => $name]);

            return redirect()->back()->with('success', 'Image uploaded successfully');
        }

        return redirect()->back()->with('error', 'Failed to upload image');
    }

    /**
     * Delete Image
     * URL: /admin/gallery/delete/{id}
     */
    public function delete($id)
    {
        $img = $this->gallery->find($id);
        if ($img) {
            $path = FCPATH.'uploads/gallery/'.$img['image'];
            if (file_exists($path)) unlink($path);

            $this->gallery->delete($id);
        }

        return redirect()->back();
    }

    /**
     * Public Gallery Page
     * URL: /gallery
     */
    public function view()
    {
        $images = $this->gallery->orderBy('id','DESC')->findAll();

        // Load public gallery view
        return view('gallery_page', ['images' => $images]);
    }
}
