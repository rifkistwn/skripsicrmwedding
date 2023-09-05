<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends Controller
{

  public function checkAvailabilityDate(Request $request)
  {
    try {
      $validated = $request->validate([
        'datetime' => 'required|date'
      ]);

      $transactions = TransactionDetail::whereDate('datetime', $validated['datetime'])->get();

      $data = true;
      if(count($transactions) >= 6) $data = false;
      
      return response()->json([
        'success' => true,
        'message' => 'Berhasil mengecek ketersediaan tanggal',
        'data' => [
          'availability' => $data
        ]
      ]);
    } catch(Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function store(Request $request)
  {
    try {
      $validated = $request->validate([
        'id.*' => 'required|exists:shopping_carts,id',
        'packet_id.*' => 'required|exists:packets,id',
        'venue_id.*' => 'nullable|exists:venues,id',
        'promo_id.*' => 'nullable|exists:promos,id',
        'price.*' => 'required',
        'datetime.*' => 'required'
      ]);

      $validated['user_id'] = auth()->user()->id;

      $transaction_details = [];

      foreach($validated['packet_id'] as $index => $data) { 
        $details = [
          'user_id' => auth()->user()->id,
          'packet_id' => $data,
          'venue_id' => $validated['venue_id'][$index],
          'datetime' => $validated['datetime'][$index],
          'price' => $validated['price'][$index]
        ];

        if($validated['promo_id']) $details['promo_id'] = $validated['promo_id'][$index];
        
        $transaction_details[] = new TransactionDetail($details);
      }

      $transaction = Transaction::create([
        'user_id' => $validated['user_id'],
        'status' => 0,
        'image' => null,
        'unique_price_code' => rand(100, 999)
      ]);

      $transaction->details()->saveMany($transaction_details);

      ShoppingCart::whereIn('id', $validated['id'])->delete();

      return redirect()->route('client.payment.show', $transaction->id);
    } catch(Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
