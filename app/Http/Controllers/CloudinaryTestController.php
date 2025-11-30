<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CloudinaryUpload;

class CloudinaryTestController extends Controller
{
    use CloudinaryUpload;

    public function showUploadForm()
    {
        return view('upload_form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedFileUrl = $this->uploadToCloudinary($request->file('image'), 'testing-uploads');
        $file = $request->file('image');
        $folder = 'testing-uploads';

        // Example for a standard upload
        // $uploadedFileUrl = $this->uploadToCloudinary($file, $folder);

        // Example for a proof of payment with compression
        $options = [
            'transformation' => [
                ['quality' => 'auto:low']
            ]
        ];
        $uploadedFileUrl = $this->uploadToCloudinary($file, $folder, $options);

        if ($uploadedFileUrl) {
            return back()
                ->with('success', 'Image uploaded successfully')
                ->with('image_url', $uploadedFileUrl);
        }

        return back()->with('error', 'Image could not be uploaded.');
    }
}
