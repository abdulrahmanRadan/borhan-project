<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BorhanController extends Controller
{
    public function index()
    {
        return view('train');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');

        // إرسال ملف PDF إلى API في Python
        $response = Http::attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post(env('FLASK_SERVER_URL') . '/train');  // تأكد من عدم وجود "http://" في العنوان

        if ($response->successful()) {
            return back()->with('success', 'File uploaded and model trained successfully.');
        } else {
            return back()->with('error', 'Failed to train the model.');
        }
    }
}