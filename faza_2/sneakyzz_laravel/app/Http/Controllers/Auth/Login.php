<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Login extends Controller
{
    public function __invoke(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                $cart = Order::firstOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'status' => 0
                    ],
                    [
                        'store_id' => null,
                        'total_price' => 0,
                    ]
                );
                app(CartController::class)->mergeSessionCart($cart);

                $user = Auth::user();

                if ($user->hasRole('ADMIN')) {
                    return redirect()->route('admin.panel');
                }

                return redirect()->route('my_profile')->with('success', 'Welcome back!');
            }

            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->onlyInput('email');
        }
    }
}
