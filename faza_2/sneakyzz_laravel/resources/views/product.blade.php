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
                        @php
                            $firstImage = $product->image
                                ->where('color_id', $selectedColor)
                                ->first();
                        @endphp
                        <div class="image-slider">
                            @if($firstImage)
                                <img id="product-photo"
                                     src="
                                         {{ str_starts_with($firstImage->filename, 'shoes/')
                                            ? asset('storage/' . $firstImage->filename)
                                            : Vite::asset('resources/assets/' . $firstImage->filename)
                                         }}"

                                     alt="{{ $product->name }}">
                            @else
                                <img id="product-photo"
                                     src="{{ Vite::asset('resources/assets/black_shoes.png') }}"
                                     alt="{{ $product->name }}">
                            @endif
                            @if($product->image->where('color_id', $selectedColor)->count() > 1)
                                <button class="arrow left-arrow"
                                        onclick="changeProductSlide(-1)">
                                    <
                                </button>
                                <button class="arrow right-arrow"
                                        onclick="changeProductSlide(1)">
                                    >
                                </button>
                                <div class="dots_pr" id="product-dots"></div>
                            @endif
                        </div>

                        <div class="product-info-right">
                            <div class="product_page_info">
                                <div class="product_header">
                                    <h2>{{ $product->name }}</h2>
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
                @foreach($related_products as $related)
                    @foreach($related->shoes->unique('color_id') as $shoe)
                        @php
                            $image = $related->image->where('color_id', $shoe->color_id)->first();
                        @endphp
                        <div class="product-card" onclick="window.location='{{ route('product.show', [$related->product_code, $shoe->color_id]) }}'">
                            <div class="product-image-box">
                                @if($image)
                                    <img
                                        src="
                                        {{ str_starts_with($image->filename, 'shoes/')
                                            ? asset('storage/' . $image->filename)
                                            : Vite::asset('resources/assets/' . $image->filename)
                                        }}"
                                        alt="{{ $shoe->color->name }}"
                                    >
                                @else
                                    <img
                                        src="{{ Vite::asset('resources/assets/black_shoes.png') }}"
                                        alt="{{ $related->name }}"
                                    >
                                @endif
                            </div>
                            <div class="product-info">
                                <div class="product-name">{{ $related->name}}, {{$shoe->color->name}}</div>
                                <div class="product-price">{{ $related->price }}€</div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>
    </section>
@endsection
@push('scripts')
    <script>
        window.productImages = [
            @foreach(App\Models\Image::where('product_code', $product->product_code)
                ->where('color_id', $selectedColor)
                ->get() as $img)

                "{{ str_starts_with($img->filename, 'shoes/')
                    ? asset('storage/' . $img->filename)
                    : Vite::asset('resources/assets/' . $img->filename)
                }}",

            @endforeach
        ];
        console.log('productImages:', window.productImages);
    </script>
    @vite(['resources/js/product_page_slides.js'])
    @vite(['resources/js/product_page.js'])
@endpush
