<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
      return view('client.pages.register.index');
    }
    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|unique:users,email',
                'name' => 'required',
                'phone' => 'required',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
            ]);

            $user = $this->createClient($validated);

            $user->assignRole('client');

            return redirect()->route('login')->with('success', 'User berhasil didaftarkan! Harap login untuk melanjutkan');
        } catch (Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    private function createClient($request)
    {
        try {
            unset($request['password_confirmation']);
            if($request['phone'][0] == '0') {
                $request['phone'] = str_replace($request['phone'][0], 62, $request['phone']);
            }

            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'password' => bcrypt($request['password']),
                'status' => User::ACTIVE
            ]);
        } catch(Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
