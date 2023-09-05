<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Models\Venue;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PacketController extends Controller
{
    public function index()
    {
      $packets = $this->getPackets();

      return view('client.pages.packet.index', compact('packets'));
    }

    public function show($code)
    {
      $packet = $this->showPacket($code);
      $venues = $this->getVenues();

      return view('client.pages.packet.show', compact('packet', 'venues'));
    }
    
    private function getPackets()
    {
      try {
        return Packet::with('promo')->paginate();
      } catch(ModelNotFoundException $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }

    private function showPacket($code)
    {
      try {
          return Packet::whereCode($code)->firstOrFail();
      } catch (ModelNotFoundException $e) {
          return redirect()->back()->with('error', $e->getMessage());
      }
    }

    private function getVenues()
    {
      try {
        return Venue::all();
      } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Venues not found!');
      }
    }
}
