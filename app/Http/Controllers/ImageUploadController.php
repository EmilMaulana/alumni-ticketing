<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Ambil file gambar dari request
            $file = $request->file('upload');

            // Buat nama unik untuk gambar yang di-upload
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Resize gambar menggunakan Intervention Image (optional)
            $image = Image::make($file)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Simpan gambar ke direktori public/uploads/images/
            $image->save(public_path('uploads/images/' . $filename));

            // URL gambar yang di-upload
            $url = asset('uploads/images/' . $filename);

            // Mengembalikan respons JSON untuk CKEditor
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url,
            ]);
        }

        // Jika gagal, kembalikan error
        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'File upload gagal!',
            ],
        ]);
    }
}
