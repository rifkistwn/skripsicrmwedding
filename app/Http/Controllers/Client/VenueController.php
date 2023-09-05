<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Throwable;

class VenueController extends Controller
{
    public function index()
    {
      $venues = $this->getVenues();

      return view('client.pages.venue.index', compact('venues'));
    }

    public function show($slug)
    {
      $venue = $this->showVenue($slug);

      return view('client.pages.venue.show', compact('venue'));
    }

    private function getVenues()
    {
      try {
        return Venue::with('images')->paginate()->map(function($venue) {
          $thumbnails = $venue->images;
          
          $venue->thumbnail = count($thumbnails) ? "storage/{$thumbnails[0]->path}" : $this->getHardcodeData()->thumbnails;
  
          return $venue;
        });
      } catch(Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function showVenue($slug)
    {
      try {
          return Venue::whereSlug($slug)->with('images')->firstOrFail();
      } catch (Throwable $th) {
          return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function getHardcodeData()
    {
      return (object) [
        'thumbnails' => 'assets/images/client/images/venue-icon-default.png'
      ];
    }
}
