<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
      $events = $this->getEvents();
      
      return view('client.pages.gallery.index', compact('events'));
    }

    public function show($slug)
    {
      $event = $this->getEvent($slug);

      return view('client.pages.gallery.show', compact('event'));
    }

    private function getEvent($slug)
    {
      try {
        return Event::whereSlug($slug)->with('gallery.images')->firstOrFail();
      } catch (ModelNotFoundException $th) {
          return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function getEvents()
    {
      try {
        return Event::with('gallery')->get();
      } catch (ModelNotFoundException $th) {
          return redirect()->back()->with('error', $th->getMessage());
      }
    }
}
