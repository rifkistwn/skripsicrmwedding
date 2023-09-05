<?php
namespace App\Http\Middleware;
use Closure;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\View;

class Client
{
    public function handle($request, Closure $next)
    {
        $cart_count = 0;

        $user = auth()->user();

        if($user) {
            $cart_count = ShoppingCart::whereUserId($user->id)->get()->count();
        }

        View::share(['cart_count' => $cart_count]);

        return $next($request);
    }
}
