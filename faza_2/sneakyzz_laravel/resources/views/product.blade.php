@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/product_page_styles.css'])
@endpush

@section('content')
    <section class="main_section">
        <section class="products_page">
            <div class="product_main_card">
                <div class="product_info_section">
                    <div class="main-product-card">
                        @if($product->image->isNotEmpty())
                            <div class="image-slider">
                                <img id="product-photo" src="{{ Vite::asset('resources/assets/' . $selectedImage->filename) }}" alt="{{ $product->name }}">

                                <button class="arrow left-arrow"><</button>
                                <button class="arrow right-arrow">></button>

                                <div class="dots_pr">
                                    <span class="dot active_dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                        @else
                            <div class="image-slider">
                                <img id="product-photo" src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">

                                <button class="arrow left-arrow"><</button>
                                <button class="arrow right-arrow">></button>

                                <div class="dots_pr">
                                    <span class="dot active_dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                        @endif

                        <div class="product-info-right">
                            <div class="product_page_info">
                                <div class="product_header">
                                    <h2>{{ $product->name }}</h2>
                                    <button id="liked-btn"></button>
                                </div>
                                <p id="basic-info"><strong>Basic information: </strong>{{ $product->basic_info }}</p>
                                <p id="material-info"><strong>Material: </strong>{{ $product->material }}</p>
                                <p id="product-code-info"><strong>Product's code: </strong>{{ $product->product_code }}</p>
                                <p id="product-origin-info"><strong>Origin: </strong>{{ $product->origin }}</p>

                                <div id="price-color">
                                    <h2>{{ $product->price }}€</h2>

                                    <div class="color-tab">
                                        <h3>Color options:</h3>
                                        <div class="colors">
                                            @foreach($colors as $color)
                                                <a href="{{ route('product.show', ['product_code' => $product->product_code, 'color_id' => $color->color_id]) }}">
                                                    <span class="color {{ $selectedColor == $color->color_id ? 'active_color' : '' }}"
                                                          style="background-color: {{ $color->value }};">
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="size-chooser">
                                <h4>SIZE OPTIONS</h4>
                                <div class="sizes">
                                    @forelse($sizes as $shoe)
                                        <button class="size-btn"
                                                data-shoe-id="{{ $shoe->id }}"
                                                data-size="{{ $shoe->size->size }}"
                                                data-stock="{{ $shoe->stock_quantity }}">
                                            {{ $shoe->size->size }}
                                        </button>
                                    @empty
                                        <p>No sizes available for this color</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-info-buttom">
                        <div class="product_quantity">
                            <h3>Choose quantity:</h3>
                            <input class="quantity-choose" type="number" value="1" min="1"
                                   max="{{ $sizes->first()?->stock_quantity ?? 1 }}">
                        </div>

                        <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shoe_id" id="selected-shoe-id" value="">
                            <input type="hidden" name="quantity" id="selected-quantity" value="1">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="color" value="{{ $selectedColor }}">
                            <input type="hidden" name="size" id="selected-size" value="">

                            <button type="submit">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="catalogue_products">
            <h1>YOU MAY ALSO LIKE:</h1>
            <div class="products_category">
                @foreach($related_products as $product)
                    @foreach($product->shoes->unique('color_id') as $shoe)
                        @php
                            $image = $product->image->where('color_id', $shoe->color_id)->first();
                        @endphp
                        <div class="product-card" onclick="window.location='{{ route('product.show', [$product->product_code, $shoe->color_id]) }}'">
                            <div class="product-image-box">
                                @if($image)
                                    <img src="{{ Vite::asset('resources/assets/' . $image->filename) }}" alt="{{ $shoe->color->name }}">
                                @else
                                    <img src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="product-info">
                                <div class="product-name">{{ $product->name}}, {{$shoe->color->name}}</div>
                                <div class="product-price">{{ $product->price }}€</div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>
    </section>
@endsection
@push('scripts')
    @vite(['resources/js/product_page.js'])
@endpush
