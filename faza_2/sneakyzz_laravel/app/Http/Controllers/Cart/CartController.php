<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shoe;

class CartController extends Controller{
    private const DELIVERY_FEE = 5.00;
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
            $items = $cart->orderItems()->with([
                'shoe.images',
                'shoe.product',
                'shoe.size',
                'shoe.color'
            ])->get();
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
                $shoe = Shoe::with(['product.image', 'size', 'color'])->findOrFail($request->shoe_id);

                $cart[$key] = [
                    'shoe_id'      => $request->shoe_id,
                    'product_name' => $shoe->product->name,
                    'price'        => $shoe->product->price,
                    'size'         => $shoe->size->size,
                    'color'        => $shoe->color->name,
                    'image' => $shoe->product->image->where('color_id', $shoe->color_id)->first()?->filename,
                    'stock'        => $shoe->stock_quantity,
                    'quantity'     => (int)($request->quantity ?? 1),
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
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

    private function recalculateTotal(Order $cart)
    {
        $total = $cart->orderItems()
            ->with('shoe.product')
            ->get()
            ->sum(fn($item) => $item->shoe->product->price * $item->quantity);

        $cart->update(['total_price' => $total]);
    }

    public function mergeSessionCart(Order $cart)
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

    public function delivery()
    {
        $total = auth()->check()
            ? $this->getCart()->total_price
            : collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['quantity']);

        $deliveryFee = session('checkout.delivery') === 'delivery' ? self::DELIVERY_FEE : 0;
        $total += $deliveryFee;
        return view('cart_delivery', compact('total'));
    }

    public function saveDelivery(Request $request)
    {
        $validated = $request->validate([
            'delivery' => 'required|in:pickup,delivery',
            'payment' => 'required|in:card,cash',
            'store' => 'nullable|string'
        ]);

        session()->put('checkout.delivery', $validated['delivery']);
        session()->put('checkout.payment', $validated['payment']);
        session()->put('checkout.store', $validated['store'] ?? null);

        return redirect()->route('cart.address');
    }

    public function address()
    {
        if (auth()->check()) {
            $cart  = $this->getCart();
            $items = $cart->orderItems()->with([
                'shoe.images',
                'shoe.product',
                'shoe.size',
                'shoe.color'
            ])->get();
            $total = $cart->total_price;
        } else {
            $items = session()->get('cart', []);
            $total = collect($items)->sum(fn($i) => $i['price'] * $i['quantity']);
        }
        $deliveryFee = session('checkout.delivery') === 'delivery' ? self::DELIVERY_FEE : 0;
        $total += $deliveryFee;

        return view('cart_address', compact('items', 'total'));
    }

    public function saveAddress(Request $request)
    {
        $rules = [
            'name'    => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:50',
        ];

        if (session('checkout.delivery') === 'delivery') {
            $rules['street']        = 'required|string|max:255';
            $rules['street_number'] = 'required|string|max:50';
            $rules['city']          = 'required|string|max:255';
            $rules['zip']           = 'required|string|max:20';
        }

        $validated = $request->validate($rules);
        session()->put('checkout.address', $validated);

        return redirect()->route('cart.summary');
    }

    public function summary()
    {
        if (auth()->check()) {
            $cart  = $this->getCart();
            $items = $cart->orderItems()->with('shoe.product', 'shoe.size', 'shoe.color')->get();
            $total = $cart->total_price;
        } else {
            $cart  = null;
            $items = session()->get('cart', []);
            $total = collect($items)->sum(fn($i) => $i['price'] * $i['quantity']);
        }
        $deliveryFee = session('checkout.delivery') === 'delivery' ? self::DELIVERY_FEE : 0;
        $total += $deliveryFee;
        return view('cart_summary', [
            'cart'     => $cart,
            'items'    => $items,
            'total'    => $total,
            'deliveryFee' => $deliveryFee,
            'checkout' => session('checkout'),
        ]);
    }
    public function checkout(Request $request)
    {
        $delivery = session('checkout.delivery');
        $payment  = session('checkout.payment');
        $deliveryFee = $delivery === 'delivery' ? self::DELIVERY_FEE : 0;
        if (auth()->check()) {
            $cart = $this->getCart();
            $total = $cart->total_price + $deliveryFee;
            $cart->update([
                'status'           => 1,
                'total_price'      => $total,
                'payed_by_card'    => $payment === 'card',
                'deliver_to_store' => $delivery === 'pickup',
                'address'          => $delivery === 'delivery'
                    ? implode(', ', [
                        session('checkout.address.street'),
                        session('checkout.address.street_number'),
                        session('checkout.address.city'),
                        session('checkout.address.zip'),
                    ])
                    : session('checkout.store'),
                'user_name'        => auth()->user()->name,
                'user_surname'     => auth()->user()->surname,
                'user_phone_num'   => auth()->user()->phone_num,
                'user_email'       => auth()->user()->email,
            ]);

            foreach ($cart->orderItems as $item) {
                if ($item->shoe->stock_quantity < $item->quantity) {
                    return redirect()->back()->with('error', "Not enough stock for {$item->shoe->product->name}");
                }
                $item->shoe->decrement('stock_quantity', $item->quantity);
                if ($item->shoe->stock_quantity <= 0) {
                    $item->shoe->update(['is_available' => false]);
                }
            }

        } else {
            $guestItems = session('cart', []);

            if (empty($guestItems)) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }
            $total = collect($guestItems)->sum(fn($i) => $i['price'] * $i['quantity']) + $deliveryFee;
            $order = Order::create([
                'status'           => 1,
                'total_price'      => $total,
                'payed_by_card'    => $payment === 'card',
                'deliver_to_store' => $delivery === 'pickup',
                'address' => $delivery === 'delivery'
                    ? implode(', ', [
                        session('checkout.address.street'),
                        session('checkout.address.street_number'),
                        session('checkout.address.city'),
                        session('checkout.address.zip'),
                    ])
                    : session('checkout.store'),
                'user_id'          => null,
                'store_id'         => null,
                'user_name'        => null,
                'user_surname'     => null,
                'user_phone_num'   => null,
                'user_email'       => null,
            ]);

            foreach ($guestItems as $item) {
                $shoe = Shoe::findOrFail($item['shoe_id']);
                if ($shoe->stock_quantity < $item['quantity']) {
                    return redirect()->back()->with('error', "Not enough stock for {$shoe->product->name}");
                }
                $order->orderItems()->create([
                    'shoe_id'  => $item['shoe_id'],
                    'quantity' => $item['quantity'],
                    'price'    => $item['price'],
                ]);
                $shoe->decrement('stock_quantity', $item['quantity']);
                $shoe->refresh();
                if ($shoe->stock_quantity <= 0) {
                    $shoe->update([
                        'is_available' => false
                    ]);
                }
            }

            session()->forget('cart');
        }

        session()->forget('checkout');

        return redirect()->route('cart.finish')
            ->with('success', 'Order successfully created!');
    }
    public function finish(){
        return view('cart_confirm');
    }
}
