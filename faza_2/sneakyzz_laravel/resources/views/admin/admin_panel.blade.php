@extends('admin.admin_layout')
@section('admin_content')
    <h1 class="main_title">ADMIN PANEL</h1>
    <div class="button_box">
        <button class="next_step" onclick="window.location='{{ route('admin.create.product') }}'">Create a Product</button>
        <button class="next_step" onclick="window.location='{{ route('admin_stock') }}'">Update Products</button>
    </div>
@endsection

