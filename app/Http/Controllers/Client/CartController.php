<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
  public function index()
  {
    $user_id = auth()->user()->id;

    try {
      $shopping_carts = ShoppingCart::whereUserId($user_id)
        ->paginate()
        ->map(function ($cart) {
          if($cart->promo_id) {
            $cart->discounted_price = $this->getDiscountedPrice($cart->packet->price, $cart->promo->discount, $cart->promo->max_discount);
  
            $cart->packet->price = $cart->discounted_price;
          }

          return $cart;
        });
    } catch(ModelNotFoundException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }

    return view('client.pages.shopping-cart.index', compact('shopping_carts'));
  }

  public function store(Request $request)
  { 
    try {
      $validated = $request->validate([
        'packet_id' => 'required|exists:packets,id',
        'venue_id' => 'nullable|exists:venues,id',
        'promo_id' => 'nullable|exists:promos,id'
      ]);

      $validated['user_id'] = auth()->user()->id;

      ShoppingCart::create($validated);
      
      return redirect()->back()->with('success', 'Berhasil memasukkan paket ke dalam shopping cart!');
    } catch(Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function destroy(ShoppingCart $cart)
  {
    try {
      $cart->delete();

      return redirect()->back()->with('success', 'Berhasil menghapus cart!');
    } catch(ModelNotFoundException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  
  private function getDiscountedPrice($price_before, $discount, $max_discount)
  {
    $discount = $price_before * $discount / 100;

    if($discount > $max_discount) $discount = $max_discount;

    return $price_before - $discount;
  }
}
