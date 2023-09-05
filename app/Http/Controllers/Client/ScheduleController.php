<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
      return view('client.pages.schedule.index');
    }

    public function show($date)
    {
      $event = $this->getEvent($date);

      return response()->json([
        'success' => true,
        'message' => 'Success Retrieve Data',
        'data' => $event
      ]);
    }

    private function getEvent($date)
    {
      try {
        $events = TransactionDetail::where('datetime', $date)->with('event', 'venue')->has('event')->get();

        $events = $events->map(function($event) {
          return [
            'venue' => $event->venue,
            'event' => $event->event
          ];
        });

        return $events;
      } catch (ModelNotFoundException $e) {
        return response()->json([
          'success' => false,
          'message' => $e->getMessage()
        ], 404);
      }
    }
}
