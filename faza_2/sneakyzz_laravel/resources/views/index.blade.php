@extends('layout.layout_customer')
@section('content')
    <div class="hero-ad" id="hero-ad">
        <div class="banner">
            <button class="arrows left-arrow" onclick="changeSlide(-1)"><</button>
            <button class="arrows right-arrow" onclick="changeSlide(1)">></button>
            <div class="dots" id="dots-container">
                <span class="dot active_dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
    <h1>FOR MEN</h1>
    <section id="men_main">
        <img id="men_main_picture" src="{{ asset('storage/shoes/sneaker_men.png') }}" alt="">
        <div class="products">
            @foreach($men_products as $product)
                @php
                    $shoe = $product->shoes->first();
                    $image = $shoe ? $product->image->where('color_id', $shoe->color_id)->first() : null;
                @endphp
                <div class="product-card" onclick="window.location='{{ route('product.show', [$product->product_code, $shoe?->color_id]) }}'">
                    <div class="product-image-box">
                        @if($image)
                            <img src="{{ asset('storage/' . $image->filename) }}" alt="{{ $product->name }}">
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
                @php
                    $shoe = $product->shoes->first();
                    $image = $shoe ? $product->image->where('color_id', $shoe->color_id)->first() : null;
                @endphp
                <div class="product-card" onclick="window.location='{{ route('product.show', [$product->product_code, $shoe?->color_id]) }}'">
                    <div class="product-image-box">
                        @if($image)
                            <img src="{{ asset('storage/' . $image->filename) }}" alt="{{ $product->name }}">
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
        <img id="women_main_picture" src="{{ asset('storage/shoes/sneaker_men.png') }}" alt="">
    </section>
@endsection
@push('scripts')
    <script>
        window.sliderImages = [
            "{{ asset('storage/shoes/sneaker_men.png') }}",
            "{{ asset('storage/shoes/yellow_shoes.png') }}",
            "{{ asset('storage/shoes/black_shoes.png') }}",
        ];
    </script>
    @vite(['resources/js/slides.js'])
@endpush
