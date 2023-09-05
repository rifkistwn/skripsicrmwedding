<?php

namespace App\Http\Controllers\Admin\Venue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VenueRequest;
use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.venue.index');
    }
    public function create()
    {
        return $this->form(new Venue);
    }

    public function edit(Venue $venue)
    {
        return $this->form($venue);
    }

    public function store(VenueRequest $request)
    {
        try {
            $data = request()->all();
            $data['slug'] = Str::slug($data['name'], '-');

            Venue::create($data);
            return redirect()->route('admin.venue.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(VenueRequest $request, Venue $venue)
    {
        try {            
            $venue->update(request()->all());
            return redirect()->route('admin.venue.index')
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Venue $venue)
    {
        try {
            $venue->delete();
            return redirect()->route('admin.venue.index')
            ->with('success', 'Data berhasil dihapus.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function form(Venue $venue)
    {
        $exists = $venue->exists;
        return view('admin.venue.form', [
            'data' => $venue,
            'action' => !$exists ? route('admin.venue.store') : route('admin.venue.update', $venue),
            'method' => !$exists ? 'POST' : 'PUT',
        ]);
    }

    public function image($venue_id)
    {
        $action['upload'] = route('admin.venue.uploadImage');
        $action['delete'] = route('admin.venue.deleteImage');
        return view('admin.venue.image', [
            'action' => $action,
            'venue_id'   => $venue_id,
            'method' => 'POST',
            'data' => VenueImage::whereVenueId($venue_id)->get()
        ]);
    }

    private function query()
    {
        return Venue::all();
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
    	$edits = route('admin.venue.edit', $value->id);
    	$destroy = route('admin.venue.destroy', $value->id);
        $image = route('admin.venue.image', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edits','destroy','image'))->render();
    }
}
