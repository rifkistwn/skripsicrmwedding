<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
      $transactions = $this->getReviews();

      return view('client.pages.review.index', compact('transactions'));
    }

    public function create(Transaction $transaction)
    {
      return view('client.pages.review.create', compact('transaction'));
    }

    public function store(Request $request)
    {
      $validated = $request->validate([
        'transaction_id' => 'required|exists:transaction_details,id',
        'review' => 'required',
        'name' => 'required'
      ]);

      $review = $this->storeReview($validated['review']);

      $this->addReviewToTransaction($review, $validated['transaction_id']);

      return redirect()->back()->with('success', 'Berhasil mengirim ulasan!');
    }

    private function storeReview($message)
    {
      try {
        return Review::create([
          'review' => $message,
        ]);
      } catch(Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }

    private function addReviewToTransaction($review, $trx_id)
    {
      try {
        $transaction = TransactionDetail::find($trx_id);

        return $transaction->update([
          'review_id' => $review->id
        ]);
      } catch(Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }
    private function getReviews()
    {
      try {
        return TransactionDetail::with('review')->whereNotNull('review_id')->get();
      } catch(ModelNotFoundException $e) {
        return redirect()->back()->with('error', $e->getMessage());
      }
    }
}
