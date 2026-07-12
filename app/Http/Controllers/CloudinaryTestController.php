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

        $uploadResult = $this->uploadToCloudinary($request->file('image'), 'testing-uploads');

        if ($uploadResult) {
            return back()
                ->with('success', 'Image uploaded successfully')
                ->with('image_url', $uploadResult['secure_url']);
        }

        return back()->with('error', 'Image could not be uploaded.');
    }

    /**
     * Required by CloudinaryUpload; this controller uploads explicitly and
     * has no model file attributes.
     */
    protected function getFileAttributes(): array
    {
        return [];
    }
}
