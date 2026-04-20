@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/category.css'])
@endpush
@section('content')
    <section class="filters">
        <div class="filters-ad"></div>
        <form method="GET" action="{{ request('query') ? route('product.search') : route('category', $name) }}">
            @if(request('query'))
                <input type="hidden" name="query" value="{{ request('query') }}">
            @endif
            <div class="filter-bar">
                <div class="filter-field">
                    <div class="filter-price">
                        <input class="filter-price-input" type="number" name="min_price"
                               placeholder="{{$min_filter_price}}" min="{{$min_filter_price}}" max = {{$max_filter_price - 1}}
                               value="{{ request('min_price') }}">
                        <span class="seperator">-</span>
                        <input class="filter-price-input" type="number" name="max_price"
                               placeholder="{{$max_filter_price}}" min="{{$min_filter_price + 1}}" max = "{{$max_filter_price + 1}}"
                               value="{{ request('max_price') }}">
                       <span class="currency">€</span>
                    </div>
                    <span class="divider">|</span>
                    <div class="filter-size">
                        <input class="filter-size-input" type="number" name="min_size"
                               placeholder="40" max="44" min="40"
                               value="{{ request('min_size') }}">
                        <span class="seperator">-</span>
                        <input class="filter-size-input" type="number" name="max_size"
                               placeholder="45" min="41" max="45"
                               value="{{ request('max_size') }}">
                        <span class="currency">size</span>
                    </div>
                    <span class="divider">|</span>
                    <select class="brand-select" name="brand">
                        <option value="" disabled {{ !request('brand') ? 'selected' : '' }}>-- choose brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}"
                                {{ request('brand') == $brand->brand_id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="divider">|</span>
                    <select class="sort-select" name="sort">
                        <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>-- sort by --</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <button type="submit" class="filter-btn">Filter</button>
                </div>
            </div>
        </form>
    </section>

    <section class="catalogue_products">
        <h1>{{ strtoupper($name) }}</h1>

        @if($products->isEmpty())
            <p>No products found in this category.</p>
        @else
            <div class="products_category">
                @foreach($products as $product)
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
        @endif
    </section>

    <div class="pagination">
        @if ($products->onFirstPage())
            <button class="page_range"><<</button>
        @else
            <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" class="page"><<</a>
        @endif

        @for ($i = 1; $i <= $products->lastPage(); $i++)
            @if ($i == $products->currentPage())
                <button class="page_active">{{ $i }}</button>
            @elseif ($i == 1 || $i == $products->lastPage() || abs($i - $products->currentPage()) <= 2)
                <a href="{{ $products->appends(request()->query())->url($i) }}" class="page">{{ $i }}</a>
            @elseif ($i == 2 || $i == $products->lastPage() - 1)
                <button class="page_range">...</button>
            @endif
        @endfor

        @if ($products->hasMorePages())
            <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" class="page">>></a>
        @else
            <button class="page_range">>></button>
        @endif
    </div>
@endsection
