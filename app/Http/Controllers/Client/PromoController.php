<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PromoController extends Controller
{   
    public function index()
    {
      $promos = $this->getPromos();

      return view('client.pages.promo.index', compact('promos'));
    }

    public function show($code)
    {
      $promo = $this->showPromo($code);
      $venues = $this->getVenues();

      return view('client.pages.promo.show', compact('promo', 'venues'));
    }

    private function getPromos()
    {
      try {
        return Promo::whereDate('period_start', '<=', $this->nowDate())->whereDate('period_end', '>=', $this->nowDate())->paginate();
      } catch(ModelNotFoundException $th) {
        return redirect()->back()->with('error', $th->getMessage());
      }
    }

    private function showPromo($code)
    {
      try {
          return Promo::whereCode($code)->whereDate('period_start', '<=', $this->nowDate())->whereDate('period_end', '>=', $this->nowDate())->first();
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
    
    private function nowDate()
    {
      return Carbon::now();
    }
}
