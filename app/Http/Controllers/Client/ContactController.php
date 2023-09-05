<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
      return view('client.pages.contact.index');
    }

    public function guide()
    {
      return view('client.pages.contact.guide');
    }
    public function storeQuestion(Request $request)
    {
      try {
          $validated = $request->validate([
            'question' => 'required',
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
          ]);
          
          if($validated['phone'][0] == '0') {
            $validated['phone'] = str_replace($validated['phone'][0], 62, $validated['phone']);
          }
          Question::create($validated);

          return redirect()->back()->with('success', 'Berhasil mengirim pertanyaan! Harap tunggu balasan dari kami ke nomor telepon atau email yang Anda masukkan');
        } catch(Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
