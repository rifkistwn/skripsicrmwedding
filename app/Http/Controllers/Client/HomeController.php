<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Packet;
use App\Models\Venue;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public $data_limit = 6;
 
    public function index()
    {
      $new_packets = $this->getNewPackets();
      $favorite_venues = $this->getFavoriteVenues();
      $latest_events = $this->getLatestEvents();

      return view('client.pages.home.index', compact('new_packets', 'favorite_venues', 'latest_events'));
    }

    private function getNewPackets()
    {
      try {
        return Packet::limit($this->data_limit)->latest()->get();
      } catch(ModelNotFoundException $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }    
    }

    private function getFavoriteVenues()
    {
      try {
        return Venue::limit($this->data_limit)->latest()->get();
      } catch(ModelNotFoundException $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }

    private function getLatestEvents()
    {
      try {
        return Event::limit($this->data_limit)->latest()->get();
      } catch(ModelNotFoundException $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }
}
