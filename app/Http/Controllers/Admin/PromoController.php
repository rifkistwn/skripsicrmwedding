<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromoRequest;
use App\Models\Packet;
use App\Models\Promo;
use App\Models\Venue;
use Illuminate\Http\Request;
use Throwable;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.promo.index');
    }
    public function create()
    {
        return $this->form(new Promo);
    }

    public function edit(Promo $promo)
    {
        return $this->form($promo);
    }

    public function store(PromoRequest $request)
    {
        try {
            $data = request()->all();

            Promo::create($data);
            return redirect()->route('admin.promo.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(PromoRequest $request, Promo $promo)
    {
        try {            
            $promo->update(request()->all());
            return redirect()->route('admin.promo.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Promo $promo)
    {
        try {
            $promo->delete();
            return redirect()->route('admin.promo.index')
            ->with('success', 'Data berhasil dihapus.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function form(Promo $promo)
    {
        $exists = $promo->exists;
        $additional['packet'] = Packet::select('id','name')->get();
        $additional['venue'] = Venue::select('id','name')->get();
        return view('admin.promo.form', [
            'data' => $promo,
            'action' => !$exists ? route('admin.promo.store') : route('admin.promo.update', $promo),
            'method' => !$exists ? 'POST' : 'PUT',
            'additional' => $additional
        ]);
    }

    private function query()
    {
        return Promo::with('packet','venue');
    }

    private function datatables($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($model) {
            return $this->getActionButtons($model);
        })
        ->editColumn('period_start', function($query) {
            return date("d-m-Y H:i:s", strtotime($query->period_start));
        })
        ->editColumn('period_end', function($query) {
            return date("d-m-Y H:i:s", strtotime($query->period_end));
        })
        ->editColumn('discount', function($query) {
            return $query->discount . "%";
        })
        ->editColumn('venue_id', function($query) {
            return $query->venue_id ? $query->venue->name : '-';
        })
        ->editColumn('max_discount', function($query) {
            return getPriceText($query->max_discount);
        })
        ->addIndexColumn()
        ->escapeColumns([])
	    ->make(true);
    }

    private function getActionButtons($value)
    {
    	$edits = route('admin.promo.edit', $value->id);
    	$destroy = route('admin.promo.destroy', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edits','destroy'))->render();
    }
}
