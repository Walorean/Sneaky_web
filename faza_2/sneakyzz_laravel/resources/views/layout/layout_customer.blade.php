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
<header class="header">
    <a href="{{route('home')}}"><h1>SNEAKYZZ</h1></a>
    <form method="GET" action="{{ route('product.search') }}">
        <input type="text" id="search" name="query" placeholder="Search product..." value="{{ request('query') }}">
        <button type="submit" id="search_button">🔍</button>
    </form>
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
        <button onclick="window.location='{{ route('category', 'men') }}'"><strong>MEN</strong></button>
        <button onclick="window.location='{{ route('category', 'women') }}'"><strong>WOMEN</strong></button>
        <button onclick="window.location='{{ route('category', 'sport') }}'"><strong>SPORT</strong></button>
        <button onclick="window.location='{{ route('category', 'new') }}'"><strong>NEW</strong></button>
    </div>
</nav>
<main class="main_container">
    @yield('content')
</main>
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
</body>
</html>
