<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKYZZ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<section class="header_container">
    <div class="header">
        <a href="{{route('home')}}"><h1>SNEAKYZZ</h1></a>
        <div class = "search_box">
            <input type="text" id="search" placeholder="Search product...">
            <button id="search_button">🔍</button>
        </div>
        <div class="main_buttons">
            <button id="likes" onclick="location.href='liked_page.html'">❤️</button>
            <button id="cart" onclick="location.href='shopping_cart.html'">🛒</button>
            <button onclick="window.location='{{ route('login') }}'">👤</button>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar_buttons">
            <button onclick="location.href='category_products_page.html'"><strong>NEW</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>MEN</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>WOMEN</strong></button>
            <button onclick="location.href='category_products_page.html'"><strong>SPORT</strong></button>
        </div>
    </div>
</section>
<section class="main_container">
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
        <img id="men_main_picture" src="assets/sneaker_men.png">
        <div class="products">
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/red_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Urban Runner X</div>
                    <div class="product-price">220.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/black_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Classic Heritage</div>
                    <div class="product-price">180.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/blue_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Aero Glide</div>
                    <div class="product-price">250.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/yellow_shoes.png">
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
                    <img src="assets/gray_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Urban Runner X</div>
                    <div class="product-price">220.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/black_var2.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Classic Heritage</div>
                    <div class="product-price">180.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/swamp_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Aero Glide</div>
                    <div class="product-price">250.00€</div>
                </div>
            </div>
            <div class="product-card" onclick="location.href='product_page.html'">
                <div class="product-image-box">
                    <img src="assets/cream_shoes.png">
                </div>
                <div class="product-info">
                    <div class="product-name">Vanguard Low</div>
                    <div class="product-price">195.00€</div>
                </div>
            </div>
        </div>
        <img id="women_main_picture" src="assets/sneaker_men.png">
    </section>
</section>
<section class="footer_container">
    <div class="footer">
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
    </div>
</section>
</body>
</html>
