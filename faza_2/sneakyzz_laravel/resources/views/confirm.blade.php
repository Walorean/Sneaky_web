@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/confirmed.css'])
    @vite(['resources/css/shopping_cart.css'])
@endpush
@section('content')
<section>
    <div class="confirm_body">
        <h1 class="main_title">ORDER IS CONFIRMED! THANK YOU FOR USING OUR SERVICES!</h1>
        <div class="check">✓</div>
        <div class="button_box">
            <form action="{{ route('home') }}" method="GET">
                @csrf
                <button type="submit" class="next_step" >RETURN TO HOME SCREEN</button>
            </form>
        </div>
    </div>
</section>
@endsection
