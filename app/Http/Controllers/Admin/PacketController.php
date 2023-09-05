<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Packet\PacketEditRequest;
use App\Http\Requests\Admin\Packet\PacketRequest;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class PacketController extends Controller
{
    public $model;

    public function __construct(Packet $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.packet.index');
    }

    public function create()
    {
        return $this->form(new Packet);
    }

    public function edit(Packet $packet)
    {
        return $this->form($packet);
    }

    public function store(PacketRequest $request)
    {
        try {
            $data = request()->all();
            // dd($data);
            $data['image'] = $this->handleImage(request('image'));

            $this->model->create($data);
            return redirect()->route('admin.packet.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(PacketEditRequest $request, Packet $packet)
    {
        try {
            $data = request()->all();
            $data['image'] = request('image') ? $this->handleImage(request('image'), $packet) : $packet->image;
            
            $packet->update($data);
            return redirect()->route('admin.packet.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Packet $packet)
    {
        try {
            $this->deleteImage($packet);
            $packet->delete();
            return redirect()->route('admin.packet.index')
            ->with('success', 'Data berhasil dihapus.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Delete Error');
        }
    }

    protected function form(Packet $packet)
    {
        $exists = $packet->exists;
        return view('admin.packet.form', [
            'data' => $packet,
            'action' => !$exists ? route('admin.packet.store') : route('admin.packet.update', $packet),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    private function query()
    {
        return Packet::all();
    }

    private function datatables($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edits = route('admin.packet.edit', $value->id);
    	$destroy = route('admin.packet.destroy', $value->id);
    	return view('include.datatables.action_buttons', compact('edits','destroy'))->render();
    }

    private function handleImage($image, $exist = null)
    {
        if(!$exist) {
            return Storage::disk('public')->putFileAs('packet'. '/' . base64_encode(Str::random(12)) .'/' , $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
        } else {
            $this->deleteImage($exist);
            return Storage::disk('public')->putFileAs('packet'. '/' . explode("/", $exist->image)[1] .'/' , $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
        }
    }
    
    private function deleteImage($exist)
    {
       return Storage::disk('public')->delete($exist->image);
    }
}
