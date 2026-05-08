@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/shopping_cart.css'])
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
            <div class="step active">
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
            <div class="step">
                <div class="circle">4</div>
                <p>Summary</p>
            </div>
        </div>
        <div class="cart_body">
            <div class="cart_container">
                <h2>Your shopping cart</h2>
                <div class="card_items">
                    <div class="categories_description">
                        <h3>Quantity</h3>
                        <h3>Name</h3>
                        <h3>Availability</h3>
                        <h3>Date added</h3>
                        <h3>Price</h3>
                        <h3>Total</h3>
                    </div>

                    @if(auth()->check())
                        @forelse($items as $item)
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
                                    @if($item['image'])
                                        <img class="item_img" src="{{ Vite::asset('resources/assets/' . $item['image']) }}" alt="{{ $item['product_name'] }}">
                                    @else
                                        <img class="item_img" src="{{ Vite::asset('resources/assets/black_shoes.png') }}">
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

                <div class="subtotal_cont">
                    <h3>Subtotal:</h3>
                    <h4>
                        @if(auth()->check())
                            {{ $items->sum(fn($i) => $i->shoe->product->price * $i->quantity) }} €
                        @else
                            {{ collect($items)->sum(fn($i) => $i['price'] * $i['quantity']) }} €
                        @endif
                    </h4>
                    @if(count($items) > 0)
                        <button
                            class="next_step"
                            type="button"
                            onclick="window.location='{{ route('cart.delivery') }}'"
                        >
                            Next step
                        </button>
                    @else
                        <button class="next_step" type="button" disabled>
                            Cart is empty
                        </button>
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
