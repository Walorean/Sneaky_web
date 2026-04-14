<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shoe;

class CartController extends Controller{
    private function getCart()
    {
        if (auth()->check()) {
            return Order::firstOrCreate(
                ['user_id' => auth()->id(), 'status' => 0],
                [
                    'store_id'    => null,
                    'total_price' => 0,
                ]
            );
        }
        return null;
    }

    public function index()
    {
        if (auth()->check()) {
            $cart  = $this->getCart();
            $items = $cart->orderItems()->with('shoe.product', 'shoe.size', 'shoe.color')->get();
        } else {
            $items = session()->get('cart', []);
        }

        return view('cart', compact('items'));
    }

    public function add(Request $request)
    {
        if (auth()->check()) {
            $cart = $this->getCart();

            $item = OrderItem::firstOrNew([
                'order_id' => $cart->id,
                'shoe_id'  => $request->shoe_id,
            ]);
            $item->quantity = ($item->quantity ?? 0) + ($request->quantity ?? 1);
            $item->save();

            $this->recalculateTotal($cart);
        } else {
            $cart = session()->get('cart', []);
            $key  = $request->shoe_id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += ($request->quantity ?? 1);
            } else {
                $shoe =Shoe::with('product.image', 'size', 'color')->findOrFail($request->shoe_id);

                $cart[$key] = [
                    'shoe_id'      => $request->shoe_id,
                    'product_name' => $shoe->product->name,
                    'price'        => $shoe->product->price,
                    'size'         => $shoe->size->size,
                    'color'        => $shoe->color->name,
                    'image'        => $shoe->product->image->isNotEmpty()
                        ? $shoe->product->image->first()->filename
                        : null,
                    'stock'        => $shoe->stock_quantity,
                    'quantity'     => (int)($request->quantity ?? 1),
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function remove(Request $request)
    {
        if (auth()->check()) {
            $cart = $this->getCart();
            OrderItem::where('order_id', $cart->id)
                ->where('shoe_id', $request->shoe_id)
                ->delete();
            $this->recalculateTotal($cart);
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->shoe_id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function clear()
    {
        if (auth()->check()) {
            $cart = $this->getCart();
            $cart->orderItems()->delete();
            $cart->update(['total_price' => 0]);
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart');
    }

    // When user checks out → change status from 0 to 1
//    public function checkout(Request $request)
//    {
//        $cart = $this->getCart();
//
//        // Najprv merge, potom checkout
//        $this->mergeSessionCart($cart); // ← presuň hore
//
//        $cart->update([
//            'status'           => 1,
//            'payed_by_card'    => $request->payed_by_card,
//            'deliver_to_store' => $request->deliver_to_store,
//            'address'          => $request->address,
//            'user_name'        => auth()->user()->name,
//            'user_surname'     => auth()->user()->surname,
//            'user_phone_num'   => auth()->user()->phone_num,
//            'user_email'       => auth()->user()->email,
//        ]);
//
//        return redirect()->route('order.confirm', $cart->id);
//    }

    private function recalculateTotal(Order $cart)
    {
        $total = $cart->orderItems()
            ->with('shoe.product')
            ->get()
            ->sum(fn($item) => $item->shoe->product->price * $item->quantity);

        $cart->update(['total_price' => $total]);
    }

    private function mergeSessionCart(Order $cart)
    {
        $sessionCart = session()->get('cart', []);
        foreach ($sessionCart as $shoe_id => $item) {
            $orderItem = OrderItem::firstOrNew([
                'order_id' => $cart->id,
                'shoe_id'  => $shoe_id,
            ]);
            $orderItem->quantity = ($orderItem->quantity ?? 0) + $item['quantity'];
            $orderItem->save();
        }
        session()->forget('cart');
        $this->recalculateTotal($cart);
    }
    public function update(Request $request)
    {
        if (auth()->check()) {
            $cart = $this->getCart();
            OrderItem::where('order_id', $cart->id)
                ->where('shoe_id', $request->shoe_id)
                ->update(['quantity' => $request->quantity]);
            $this->recalculateTotal($cart);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->shoe_id])) {
                $cart[$request->shoe_id]['quantity'] = $request->quantity;
            }
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

}
