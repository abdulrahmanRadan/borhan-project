<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorhanController extends Controller
{
    public function index() { 
        return view('train'); 
    }
    public function upload(Request $request) { 
        $request->validate([ 'file' => 'required|mimes:pdf|max:2048', ]); 
        $file = $request->file('file'); // عملية رفع الملف والتعامل معه 
        // إرسال الملف إلى API في Python لمعالجة النصوص وتدريب النموذج 
        return back()->with('success', 'تم رفع الملف وتدريب النموذج بنجاح');
    }
}