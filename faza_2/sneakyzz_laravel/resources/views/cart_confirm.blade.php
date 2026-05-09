<?php
@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/shopping_cart.css'])
    @vite(['resources/css/confirmed.css'])
@endpush
@section('content')
    <section>
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        <div class="confirm_body">
            <h1 class="main_title">ORDER IS CONFIRMED! THANK YOU FOR USING OUR SERVICES!</h1>
            <div class="check">✓</div>
            <div class="button_box">
                <button class="next_step" onclick="location.href='index.html'">RETURN TO HOME SCREEN</button>
                <button class="next_step" onclick="location.href='my_orders.html'">TO MY ORDERS</button>
            </div>
        </div>
    </section>
@endsection
