<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKYZZ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
<section class="header_container">
    <header class="header">
        <a href="{{route('home')}}"><h1>SNEAKYZZ</h1></a>
        <div class = "search_box">
            <input type="text" id="search" placeholder="Search product...">
            <button id="search_button">🔍</button>
        </div>
        <div class="main_buttons">
            <button id="likes" onclick="location.href='liked_page.html'"><img src="{{ Vite::asset('resources/assets/like.png') }}" alt="LikedPageImage"></button>
            <button id="cart" onclick="location.href='shopping_cart.html'"><img src="{{ Vite::asset('resources/assets/cart.png') }}" alt="CartPageImage"></button>
            @auth
                <button id="my_profile" onclick="window.location='{{ route('my_profile') }}'"><img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="ProfilePageImage"></button>
            @endauth

            @guest
                <button id="my_profile" onclick="window.location='{{ route('login') }}'"><img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="ProfilePageImage"></button>
            @endguest
        </div>
    </header>
    <nav class="navbar">
        <div class="navbar_buttons">
            <button onclick="location.href='category_products_page.html'"><strong>NEW</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>MEN</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>WOMEN</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>SPORT</strong></button>
        </div>
    </nav>
</section>
<main class="main_container">
    @yield('content')
</main>
<section class="footer_container">
    <footer class="footer">
        <div id="about">
            <h3>ABOUT US</h3>
            <ul>
                <li><strong>Yevhen Horschar - FIIT student</strong></li>
                <li><strong>Artem Kinash - FIIT student</strong></li>
            </ul>
        </div>
        <div id="resource">
            <h3>RESOURCE</h3>
            <ul>
                <li><strong>BLOG</strong></li>
                <li><strong>NEWS</strong></li>
            </ul>
        </div>
        <div id="help">
            <h3>HELP</h3>
            <ul>
                <li><strong>xhorshchar@stuba.sk</strong></li>
                <li><strong>xkinash@stuba.sk</strong></li>
            </ul>
        </div>
        <div id="important-info">
            <h3>IMPORTANT INFORMATION</h3>
            <ul>
                <li><strong>WE CREATED OUR MAIN TITLE</strong></li>
                <li><strong>WE CREATED LOGIN, REGISTER AND MY PROFILE</strong></li>
            </ul>
        </div>
    </footer>
</section>
</body>
</html>
