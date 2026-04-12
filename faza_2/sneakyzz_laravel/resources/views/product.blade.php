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
                            <img id="product-photo" src="{{ Vite::asset('resources/assets/' . $product->image->first()->filename) }}" alt="{{ $product->name }}">
                        @else
                            <img id="product-photo" src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">
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
                                        <button>{{ $shoe->size->size }}</button>
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
                            <input class="quantity-choose" type="number" value="1" min="1" max="{{ $totalStock }}">
                        </div>
                        <button>ADD TO CART</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="catalogue_products">
            <h1>YOU MAY ALSO LIKE:</h1>
            <div class="products_category">
                @foreach($related_products as $related)
                    <div class="product-card" onclick="window.location='{{ route('product.show', $related->product_code) }}'">
                        <div class="product-image-box">
                            @if($related->image->isNotEmpty())
                                <img id="product-photo" src="{{ Vite::asset('resources/assets/' . $related->image->first()->filename) }}" alt="{{ $related->name }}">
                            @else
                                <img id="product-photo" src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $related->name }}">
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-name">{{ $related->name }}</div>
                            <div class="product-price">{{ $related->price }}€</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>
@endsection
