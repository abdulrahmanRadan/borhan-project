<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index() { 
        return view('chat');
    } 
    public function ask(Request $request) { 
        $request->validate([ 'question' => 'required|string', ]); 
        $question = $request->input('question'); 
        $response = Http::post('http://http://127.0.0.1:5000/predict', [ 'input' => $question, ]); 
        $answer = $response->json(); 
        
        return view('chat', ['answer' => $answer]);
    }
}