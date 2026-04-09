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
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/yellow_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Urban Runner X</div>
                    <div class="product-price">220.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Classic Heritage</div>
                    <div class="product-price">180.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/red_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Aero Glide</div>
                    <div class="product-price">250.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/gray_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Vanguard Low</div>
                    <div class="product-price">195.00€</div>
                </div>
            </div>
        </div>
    </section>
    <h1>FOR WOMEN</h1>
    <section id="women_main">
        <div class="products">
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/yellow_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Urban Runner X</div>
                    <div class="product-price">220.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/black_var2.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Classic Heritage</div>
                    <div class="product-price">180.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/cream_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Aero Glide</div>
                    <div class="product-price">250.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="{{ Vite::asset('resources/assets/swamp_shoes.png') }}" alt="Product Name">
                </div>
                <div class="product-info">
                    <div class="product-name">Vanguard Low</div>
                    <div class="product-price">195.00€</div>
                </div>
            </div>
        </div>
        <img id="women_main_picture" src="{{ Vite::asset('resources/assets/sneaker_men.png') }}" alt="">
    </section>
@endsection
