<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryTestController extends Controller
{
    public function showUploadForm()
    {
        return view('upload_form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'transformation' => [
                'width' => 500,
                'crop' => 'limit',
                'quality' => 'auto',
                'fetch_format' => 'auto'
            ]
        ])->getSecurePath();

        return back()
            ->with('success', 'Image uploaded successfully')
            ->with('image_url', $uploadedFileUrl);
    }
}
