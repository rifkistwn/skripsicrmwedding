<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        $data['user'] = User::whereHas('roles', function($q) { 
                            $q->where('name', 'Client'); 
                        })->count();
        $data['transaction'] = Transaction::count();
        $data['pending'] = Transaction::whereStatus(Transaction::PENDING)->count();
        $data['paid'] = Transaction::whereStatus(Transaction::PAID)->count();
        $data['rejected'] = Transaction::whereStatus(Transaction::REJECTED)->count();
        $data['packet'] = Packet::count();

        return view('admin.dashboard.index', compact('data'));
    }
}
