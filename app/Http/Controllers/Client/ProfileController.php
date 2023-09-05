<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
      return view('client.pages.profile.index');
    }

    public function bidoata()
    {
      return view('client.pages.profile.biodata');
    }
}
