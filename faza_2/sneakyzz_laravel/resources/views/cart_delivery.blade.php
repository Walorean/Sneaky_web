@extends('layout.layout_customer')

@push('styles')
    @vite(['resources/css/shopping_cart.css'])
@endpush
@push('styles')
    @vite(['resources/css/shopping_cart_delivery.css'])
@endpush
@section('content')
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

            <div class="step active">
                <div class="circle">2</div>
                <p>Delivery</p>
            </div>
            <div class="dots_step"><span></span><span></span><span></span></div>

            <div class="step">
                <div class="circle">3</div>
                <p>Address</p>
            </div>
            <div class="dots_step"><span></span><span></span><span></span></div>

            <div class="step">
                <div class="circle">4</div>
                <p>Summary</p>
            </div>
        </div>
        <form action="{{ route('cart.delivery.save') }}" method="POST">
            @csrf
            <div class="delivery_cont">
                <div class="delivery_options_body">
                    <div class="l_part_conteiner">
                        <div class="card">
                            <h3>Choose delivery option:</h3>
                            <label class="option-card">
                                <input
                                    type="radio"
                                    name="delivery"
                                    value="pickup"
                                    {{ old('delivery', session('checkout.delivery')) == 'pickup' ? 'checked' : '' }}
                                    onclick="toggleCard(true)"
                                >
                                <div class="option-content">
                                    <div class="title">Pickup at store <span>+0€</span></div>
                                    <p>You should come to store to pickup your order</p>
                                </div>
                            </label>
                            <div id="cardForm" style="display:none;">
                                <select class="brand-select" name="store">
                                    <option value="" disabled {{ !session('checkout.store') ? 'selected' : '' }}>-- choose store --</option>
                                    <option value="Bratislava, Jankova 36" {{ session('checkout.store') === 'Bratislava, Jankova 36' ? 'selected' : '' }}>Bratislava, Jankova 36</option>
                                    <option value="Poprad, Bilava 67" {{ session('checkout.store') === 'Poprad, Bilava 67' ? 'selected' : '' }}>Poprad, Bilava 67</option>
                                    <option value="Bardejov, Partizanska 45" {{ session('checkout.store') === 'Bardejov, Partizanska 45' ? 'selected' : '' }}>Bardejov, Partizanska 45</option>
                                </select>
                            </div>
                            <label class="option-card">
                                <input
                                    type="radio"
                                    name="delivery"
                                    value="delivery"
                                    {{ old('delivery', session('checkout.delivery')) == 'delivery' ? 'checked' : '' }}
                                    onclick="toggleCard(false)"
                                >
                                <div class="option-content">
                                    <div class="title">Delivery to address <span>+5€</span></div>
                                    <p>Your order would be delivered to your address</p>
                                </div>
                            </label>
                            @error('delivery')
                            <div class="alert error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="r_part_conteiner">
                        <div class="card">
                            <h3>Choose payment type:</h3>
                            <label class="option-card">
                                <input
                                    type="radio"
                                    name="payment"
                                    value="card"
                                    {{ old('payment', session('checkout.payment')) == 'card' ? 'checked' : '' }}
                                >
                                <div class="option-content">
                                    <div class="title">Card payment</div>
                                </div>
                            </label>
                            <label class="option-card">
                                <input
                                    type="radio"
                                    name="payment"
                                    value="cash"
                                    {{ old('payment', session('checkout.payment')) == 'cash' ? 'checked' : '' }}
                                >
                                <div class="option-content">
                                    <div class="title">Cash on delivery</div>
                                </div>
                            </label>
                            @error('payment')
                            <div class="alert error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="subtotal_cont">
                    <div class="total_text_cont">
                        <h3>Subtotal:</h3>
                        <h4>{{ $total ?? 0 }} €</h4>
                    </div>
                    <div class="step_container">
                        <button type="button" class="next_step" onclick="window.location='{{ route('cart') }}'">
                            Previous step
                        </button>
                        <button type="submit" class="next_step">
                            Next step
                        </button>
                    </div>
                </div>
            </div>
        </form>
@endsection

@push('scripts')
    <script>
        function toggleCard(show) {
            document.getElementById("cardForm").style.display = show ? "block" : "none";
        }

        window.onload = function () {
            const pickupSelected = document.querySelector('input[name="delivery"][value="pickup"]')?.checked;
            toggleCard(pickupSelected);
        };
    </script>
@endpush
