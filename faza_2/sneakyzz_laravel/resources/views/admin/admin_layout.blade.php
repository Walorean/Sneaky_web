<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKYZZ- ADMIN PANEL</title>
    @vite(['resources/css/app.css', 'resources/css/confirmed.css', 'resources/css/shopping_cart.css', 'resources/css/create_panel.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('scripts')
</head>
<body>
<section class="header_container">
    <header class="header">
        <a href="{{ route('admin.panel') }}"><h1>SNEAKYZZ - ADMIN</h1></a>
        <div id="disabled_search" class="search_box">
            <input type="text" id="search" placeholder="Search product...">
            <button id="search_button">🔍</button>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="main_buttons" type="submit" id="log_out">LOGOUT</button>
        </form>
    </header>
</section>
<section>
    <main class="confirm_body" id="admin_h">
        @yield('admin_content')
    </main>
</section>
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
