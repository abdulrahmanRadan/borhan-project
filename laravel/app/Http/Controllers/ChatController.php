<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() { 
        return view('chat');
    } 
    public function ask(Request $request) { 
        $request->validate([ 'question' => 'required|string', ]); 
        $question = $request->input('question'); 
        $response = Http::post('http://your-flask-server/predict', [ 'input' => $question, ]); 
        $answer = $response->json(); return view('chat', ['answer' => $answer]);
    }
}