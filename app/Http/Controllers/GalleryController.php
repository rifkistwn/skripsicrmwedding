<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->query();
        if ($request->wantsJson()) {
            return $this->datatables($query);
        }
        return view('admin.gallery.index');
    }
    public function create()
    {
        return $this->form(new Gallery);
    }

    public function edit(Gallery $gallery)
    {
        return $this->form($gallery);
    }

    public function store(GalleryRequest $request)
    {
        try {
            $data = request()->all();
            $gallery = Gallery::create($data);
            $data['image'] ? (new GalleryImageController)->store($gallery->id) : null;
            return redirect()->route('admin.gallery.index')
            ->with('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        try {        
            $data = request()->all();
            $gallery->update($data);
            $data['image'] ? (new GalleryImageController)->store($gallery->id) : null;

            return redirect()->route('admin.gallery.edit', $gallery)
            ->with('success', 'Data berhasil diupdate.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Gallery $gallery)
    {
        try {
            $gallery->delete();
            return redirect()->route('admin.gallery.index')
            ->with('success', 'Data berhasil dihapus.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function form(Gallery $gallery)
    {
        $exists = $gallery->exists;
        $additional['event'] = Event::select('id','title')->get();
        $additional['choosen'] = Gallery::select('event_id')->get();

        // image
        $additional['images'] = $exists ? GalleryImage::whereGalleryId($gallery->id)->get() : [];
        $actionImage['delete'] = route('admin.gallery.deleteImage');

        return view('admin.gallery.form', [
            'data' => $gallery,
            'action' => !$exists ? route('admin.gallery.store') : route('admin.gallery.update', $gallery),
            'method' => !$exists ? 'POST' : 'PUT',
            'additional' => $additional,
            'actionImage' => $actionImage,
            'methodImage' => 'POST'
        ]);
    }

    public function image($gallery)
    {
        $action['delete'] = route('admin.gallery.deleteImage');
        return view('admin.gallery.image', [
            'action' => $action,
            'gall$gallery'   => $gallery,
            'method' => 'POST',
            'data' => GalleryImage::whereGalleryId($gallery)->get()
        ]);
    }

    private function query()
    {
        return Gallery::select('galleries.*')->with('event')->orderByDesc('created_at');
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
    	$edits = route('admin.gallery.edit', $value->id);
    	$destroy = route('admin.gallery.destroy', $value->id);
        
    	return view('include.datatables.action_buttons', compact('edits','destroy'))->render();
    }
}
