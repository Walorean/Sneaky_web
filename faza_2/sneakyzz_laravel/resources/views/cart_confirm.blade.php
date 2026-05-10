@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/shopping_cart.css'])
    @vite(['resources/css/confirmed.css'])
@endpush
@section('content')
    <section>
        <div class="confirm_body">
            <h1 class="main_title">ORDER IS CONFIRMED! THANK YOU FOR USING OUR SERVICES!</h1>
            <div class="check">✓</div>
            <div class="button_box">
                <button class="next_step" type="button"
                        onclick="window.location.href='{{ route('home') }}'">
                    RETURN TO HOME SCREEN
                </button>
            </div>
        </div>
    </section>
@endsection
