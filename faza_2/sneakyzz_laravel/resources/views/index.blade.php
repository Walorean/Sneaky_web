@extends('layout.layout_customer')
@section('content')
    <div class="hero-ad">
        <div class="banner">
            <button class="arrows left-arrow"><</button>
            <button class="arrows right-arrow">></button>
            <div class="dots">
                <span class="dot active_dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
    <h1>FOR MEN</h1>
    <section id="men_main">
        <img id="men_main_picture" src="{{ Vite::asset('resources/assets/sneaker_men.png') }}" alt="">
        <div class="products">
            @foreach($men_products as $product)
                <div class="product-card" onclick="window.location='{{ route('product.show', $product->product_code) }}'">
                    <div class="product-image-box">
                        @if($product->image->isNotEmpty())
                            <img src="{{ Vite::asset('resources/assets/' . $product->image->first()->filename) }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">{{ $product->price }}€</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <h1>FOR WOMEN</h1>
    <section id="women_main">
        <div class="products">
            @foreach($women_products as $product)
                <div class="product-card" onclick="window.location='{{ route('product.show', $product->product_code) }}'">
                    <div class="product-image-box">
                        @if($product->image->isNotEmpty())
                            <img src="{{ Vite::asset('resources/assets/' . $product->image->first()->filename) }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">{{ $product->price }}€</div>
                    </div>
                </div>
            @endforeach
        </div>
        <img id="women_main_picture" src="{{ Vite::asset('resources/assets/sneaker_men.png') }}" alt="">
    </section>
@endsection
