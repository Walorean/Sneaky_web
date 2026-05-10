@extends('layout.layout_customer')

@push('styles')
    @vite(['resources/css/shopping_cart.css'])
    @vite(['resources/css/shopping_cart_addr.css'])
@endpush

@section('content')
    <section>
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        <div class="navigation">
            <div class="step">
                <div class="circle">1</div>
                <p>Cart</p>
            </div>

            <div class="dots_step"><span></span><span></span><span></span></div>

            <div class="step">
                <div class="circle">2</div>
                <p>Delivery</p>
            </div>

            <div class="dots_step"><span></span><span></span><span></span></div>

            <div class="step active">
                <div class="circle">3</div>
                <p>Address</p>
            </div>

            <div class="dots_step"><span></span><span></span><span></span></div>

            <div class="step">
                <div class="circle">4</div>
                <p>Summary</p>
            </div>
        </div>
        <div class="addr_body">
            <div class="address_container">
                <form action="{{ route('cart.address.save') }}" method="POST" style="width:100%;">
                    @csrf
                    @if(session('checkout.delivery') === 'delivery')
                        <div class="input_part">
                            <div class="card">
                                <div class="a_box">
                                    <label>Name</label>
                                    <input type="text" name="name" class="a_inp"
                                           value="{{ old('name', session('checkout.address.name', auth()->user()->name ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Email</label>
                                    <input type="email" name="email" class="a_inp"
                                           value="{{ old('email', session('checkout.address.email', auth()->user()->email ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Street</label>
                                    <input type="text" name="street" class="a_inp"
                                           value="{{ old('street', session('checkout.address.street', '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>City</label>
                                    <input type="text" name="city" class="a_inp"
                                           value="{{ old('city', session('checkout.address.city', '')) }}" required>
                                </div>
                            </div>
                            <div class="card">
                                <div class="a_box">
                                    <label>Surname</label>
                                    <input type="text" name="surname" class="a_inp"
                                           value="{{ old('surname', session('checkout.address.surname', auth()->user()->surname ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="a_inp"
                                           value="{{ old('phone', session('checkout.address.phone', auth()->user()->phone_num ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Street number</label>
                                    <input type="text" name="street_number" class="a_inp"
                                           value="{{ old('street_number', session('checkout.address.street_number', '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>ZIP code</label>
                                    <input type="text" name="zip" class="a_inp"
                                           value="{{ old('zip', session('checkout.address.zip', '')) }}" required>
                                </div>
                            </div>
                        </div>

                    @else
                        {{-- Pickup -- opýtaj sa len na osobné údaje --}}
                        <div class="input_part">
                            <div class="card">
                                <div class="a_box">
                                    <label>Name</label>
                                    <input type="text" name="name" class="a_inp"
                                           value="{{ old('name', session('checkout.address.name', auth()->user()->name ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Email</label>
                                    <input type="email" name="email" class="a_inp"
                                           value="{{ old('email', session('checkout.address.email', auth()->user()->email ?? '')) }}" required>
                                </div>
                            </div>
                            <div class="card">
                                <div class="a_box">
                                    <label>Surname</label>
                                    <input type="text" name="surname" class="a_inp"
                                           value="{{ old('surname', session('checkout.address.surname', auth()->user()->surname ?? '')) }}" required>
                                </div>
                                <div class="a_box">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="a_inp"
                                           value="{{ old('phone', session('checkout.address.phone', auth()->user()->phone_num ?? '')) }}" required>
                                </div>
                            </div>
                        </div>

                        @if(session('checkout.store'))
                            <div class="card" style="padding: 1rem; margin-top: 1rem;">
                                <p>Pickup location: <strong>{{ session('checkout.store') }}</strong></p>
                            </div>
                        @endif
                    @endif
                    <div class="subtotal_cont">
                        <div class="total_text_cont">
                            <h3>Subtotal:</h3>
                            <h4>{{ $total ?? 0 }} €</h4>
                        </div>
                        <div class="step_container">
                            <button type="button" class="next_step"
                                    onclick="window.location='{{ route('cart.delivery') }}'">
                                Previous step
                            </button>
                            <button type="submit" class="next_step">
                                Next step
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection
