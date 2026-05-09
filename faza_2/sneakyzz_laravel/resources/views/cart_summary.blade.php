@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/shopping_cart.css'])
    @vite(['resources/css/shopping_cart_summary.css'])
@endpush
@section('content')
    <section>
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        <div class="navigation">
            <div class="step">
                <div class="circle">1</div>
                <p>Cart</p>
            </div>
            <div class="dots_step">
                <span></span><span></span><span></span>
            </div>
            <div class="step">
                <div class="circle">2</div>
                <p>Delivery</p>
            </div>
            <div class="dots_step">
                <span></span><span></span><span></span>
            </div>
            <div class="step">
                <div class="circle">3</div>
                <p>Address</p>
            </div>
            <div class="dots_step">
                <span></span><span></span><span></span>
            </div>
            <div class="step active">
                <div class="circle">4</div>
                <p>Summary</p>
            </div>
        </div>
        <div class="cart_page">
            <div class="cart_body">
                <div class="cart_left">
                    <h2>Your shopping cart</h2>
                    <div class="card_items">
                        <div class="categories_description">
                            <h3>Quantity</h3>
                            <h3>Item description</h3>
                            <h3>Availability</h3>
                            <h3>Date added</h3>
                            <h3>Price</h3>
                            <h3>Total</h3>
                        </div>
                        @if(auth()->check())
                            @forelse($items as $item)
                                @php
                                    $image = $item->shoe->images->first();
                                @endphp
                                <div class="cart_item_cont">
                                    <div class="quantity_cont">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item->shoe_id }}">
                                            <input type="number" class="qty_input" name="quantity"
                                                   value="{{ $item->quantity }}" min="1" max="{{ $item->shoe->stock_quantity }}"
                                                   onchange="this.form.submit()"/>
                                        </form>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item->shoe_id }}">
                                            <button class="cancel_item" type="submit">X</button>
                                        </form>
                                    </div>

                                    <div class="item_discription_cont">
                                        @if($image)
                                            <img class="item_img" src="{{ Vite::asset('resources/assets/' . $image->filename) }}" alt="{{ $item->shoe->product->name }}">
                                        @else
                                            <img class="item_img" src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $item->shoe->product->name }}">
                                        @endif
                                        <div class="item_text">
                                            <h5>{{ $item->shoe->product->name }}</h5>
                                            <small>Size: {{ $item->shoe->size->size }} | Color: {{ $item->shoe->color->name }}</small>
                                        </div>
                                    </div>

                                    <div class="availability_cont">
                                        <h5>In stock</h5>
                                        <h5>{{ $item->shoe->stock }}</h5>
                                    </div>

                                    <div class="date_added_cont">
                                        <h5>{{ $item->created_at->diffForHumans() }}</h5>
                                    </div>

                                    <div class="price_cont">
                                        <h5>{{ $item->shoe->product->price }} €</h5>
                                    </div>

                                    <div class="total_price_cont">
                                        <h5>{{ $item->shoe->product->price * $item->quantity }} €</h5>
                                    </div>
                                </div>
                            @empty
                                <p>Your cart is empty.</p>
                            @endforelse

                        @else
                            @forelse($items as $item)
                                <div class="cart_item_cont">
                                    <div class="quantity_cont">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item['shoe_id'] }}">
                                            <input type="number" class="qty_input" name="quantity"
                                                   value="{{ $item['quantity'] }}" min="1" max="{{$item['stock'] ?? 9999 }}"
                                                   onchange="this.form.submit()"/>
                                        </form>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item['shoe_id'] }}">
                                            <button class="cancel_item" type="submit">X</button>
                                        </form>
                                    </div>

                                    <div class="item_discription_cont">
                                        @if($item['image'])
                                            <img class="item_img"  src="{{ Vite::asset('resources/assets/' . $item['image']) }}" alt="{{ $item['product_name'] }}">
                                        @else
                                            <img class="item_img" src="{{ Vite::asset('resources/assets/black_shoes.png') }}">
                                        @endif
                                        <div class="item_text">
                                            <h5>{{ $item['product_name'] }}</h5>
                                            <small>Size: {{ $item['size'] }} | Color: {{ $item['color'] }}</small>
                                        </div>
                                    </div>

                                    <div class="availability_cont">
                                        <h5>In stock</h5>
                                    </div>

                                    <div class="date_added_cont">
                                        <h5>—</h5>
                                    </div>

                                    <div class="price_cont">
                                        <h5>{{ $item['price'] }} €</h5>
                                    </div>

                                    <div class="total_price_cont">
                                        <h5>{{ $item['price'] * $item['quantity'] }} €</h5>
                                    </div>
                                </div>
                            @empty
                                <p>Your cart is empty.</p>
                            @endforelse
                        @endif
                    </div>
                </div>
                <div class="cart_right">
                    <div class="summary_box">
                        <h3>Order summary</h3>
                        <div class="summary_row">
                            <span>Delivery:</span>
                            <span id="delivery_method">{{ session('checkout.delivery') === 'pickup' ? 'Pickup at store' : 'Home delivery' }}</span>
                        </div>
                        @if(session('checkout.delivery') === 'pickup' && session('checkout.store'))
                            <div class="summary_row">
                                <span>Store:</span>
                                <span>{{ session('checkout.store') }}</span>
                            </div>
                        @endif
                        @if(session('checkout.delivery') === 'delivery' && session('checkout.address'))
                            <div class="summary_row">
                                <span>Address:</span>
                                <span>{{ session('checkout.address.street') }} {{ session('checkout.address.street_number') }},{{ session('checkout.address.city') }},{{ session('checkout.address.zip') }}</span>
                            </div>
                        @endif
                        <div class="summary_row">
                            <span>Payment:</span>
                            <span id="payment_method">{{ session('checkout.payment') === 'card' ? 'Card payment' : 'Cash payment' }}</span>
                        </div>
                        <div class="summary_row total">
                            <span>Total:</span>
                            <span id="total_price">{{ $total ?? $cart?->total_price ?? 0 }} €</span>
                        </div>
                        <div class="btn_group">
                            <a href="{{ route('cart.address') }}" class="btn_prev">Previous step</a>

                            @if(count($items) > 0)
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn_pay">Pay</button>
                                </form>
                            @else
                                <button class="btn_pay" type="button" disabled style="opacity:0.5; cursor:not-allowed;">
                                    Cart is empty
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
