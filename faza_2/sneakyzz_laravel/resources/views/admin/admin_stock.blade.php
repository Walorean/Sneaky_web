@extends('admin.admin_layout')
@push('styles')
    @vite(['resources/css/admin_stock.css'])
@endpush
@section('admin_content')
    <div class="cart_body">
        <div class="cart_container">
            <h2>Your Stock</h2>

            @if(session('success'))
                <p style="color:green">{{ session('success') }}</p>
            @endif

            <div class="card_items">
                <div class="categories_description">
                    <h3></h3>
                    <h3>Item description</h3>
                    <h3>Availability</h3>
                    <h3>Date added</h3>
                    <h3>Price</h3>
                </div>

                @forelse($products as $product)
                    <div class="cart_item_cont">
                        <div class="quantity_cont">
                            <button class="edit_item" title="Edit"> ✏️ </button>

                            {{-- ✅ delete button --}}
                            <form method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete {{$product->name}}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cancel_item" title="Delete">X</button>
                            </form>
                        </div>

                        <div class="item_discription_cont">
                            @if($product->image->isNotEmpty())
                                <img class="item_img" src="{{ asset('storage/' . $product->image->first()->filename) }}" alt="{{ $product->name }}">
                            @else
                                <img class="item_img" src="{{ Vite::asset('resources/assets/black_shoes.png') }}" alt="{{ $product->name }}">
                            @endif
                            <div class="item_text">
                                <h5>{{ $product->name }}</h5>
                                <small>{{ $product->product_code }}</small>
                            </div>
                        </div>

                        <div class="availability_cont">
                            <h5>In stock:</h5>
                            <h5>{{ $product->shoes->sum('stock_quantity') }}</h5>
                        </div>

                        <div class="date_added_cont">
                            <h5>{{ $product->created_at?->diffForHumans() ?? 'From base seeder' }}</h5>
                        </div>

                        <div class="price_cont">
                            <h5>{{ $product->price }} €</h5>
                        </div>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
