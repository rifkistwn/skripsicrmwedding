<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
  public function index()
  {
    $transactions = $this->getTransactions();

    return view('client.pages.payment.index', compact('transactions'));
  }
  
  public function show(Transaction $transaction)
  {
    $total_price = $transaction->details->sum('price') + $transaction->unique_price_code;

    return view('client.pages.payment.show', compact('transaction', 'total_price'));
  }

  public function update(Transaction $transaction, Request $request)
  {
    try {
      $validated = $request->validate([
        'image' => 'required'
      ]);

      $data['image'] = $this->handleImage($validated['image'], $transaction->id, $transaction->image);

      $transaction->update($data);
  
      return redirect()->back()->with('success', 'Berhasil mengupload bukti pembayaran');
    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  private function getTransactions()
  {
    try {
      $user = auth()->user();

      return $user->transactions;
    } catch(Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  private function handleImage($image, $id, $exist = null)
  {
    if(!$exist) {
      return Storage::disk('public')->putFileAs('transaction'. '/' . base64_encode($id), $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
    } else {
      $this->deleteImage($exist);

      return Storage::disk('public')->putFileAs('transaction'. '/' . base64_encode($id), $image, Str::random(12) .'.'.$image->getClientOriginalExtension());
    }
  }

  private function deleteImage($exist)
    {
       return Storage::disk('public')->delete($exist);
    }
}
