<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.user.index');
    }
    public function create()
    {
        return $this->form(new User);
    }

    public function edit(User $user)
    {
        return $this->form($user);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = request()->all();

            User::create($data);
            return redirect()->route('admin.user.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(UserRequest $request, User $user)
    {
        try {            
            $user->update(request()->all());
            return redirect()->route('admin.user.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        abort(404);
    }

    // public function changePassword(PasswordRequest $request, $id)
    // {
    //     try {
    //         User::findOrFail($id)->update([
    //             'password' => Hash::make(request('password'))
    //         ]) ;        
    //         return redirect()->back()
    //         ->with('success', 'Data berhasil diupdate.');
    //     } catch (Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }

    protected function form(User $user)
    {
        $exists = $user->exists;

        return view('admin.user.form', [
            'data' => $user,
            'action' => !$exists ? route('admin.user.store') : route('admin.user.update', $user),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    private function query()
    {
        return User::whereHas('roles', function($q) { 
                    $q->where('name', 'Client'); 
                })->get();
    }

    private function datatables($query)
    {
        
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->editColumn('role_names', function($model) {
            return $model->roles->pluck('name')->all();
        })
        ->editColumn('status', function($model) {
            return $model->status == User::ACTIVE ? '<span class="text-primary">Active</span>' : '<span class="text-danger">Banned</span>';
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edit = route('admin.user.edit', $value->id);
    	$whatsapp = $value->phone;
        
    	return view('include.datatables.action_buttons', compact('edit','whatsapp'))->render();
    }
}
