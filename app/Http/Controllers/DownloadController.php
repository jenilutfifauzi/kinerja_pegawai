<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($id)
    {
        $file = Pekerjaan::find($id)->file;
        if (!$file) {
            return back()->with('error', 'File not found');
        }

        return response()->download(storage_path("app/public/$file"));
    }
}
