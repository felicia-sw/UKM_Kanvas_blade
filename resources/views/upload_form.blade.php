<!DOCTYPE html>
<html>
<head>
    <title>Cloudinary Upload</title>
</head>
<body>

<h1>Upload an Image to Cloudinary</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    @if (session('image_url'))
        <p>Image URL: <a href="{{ session('image_url') }}" target="_blank">{{ session('image_url') }}</a></p>
        <img src="{{ session('image_url') }}" alt="Uploaded Image" style="max-width: 500px;">
    @endif
@endif

<form action="{{ route('upload.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <p>
        <input type="file" name="image" required>
    </p>
    <p>
        <button type="submit">Upload</button>
    </p>
</form>

</body>
</html>
