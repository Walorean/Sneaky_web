@extends('layout.layout_customer')
@push('styles')
    @vite(['resources/css/profile.css'])
@endpush
@section('content')
    <section class="profile_container">
        <div class="profile_l_container">
            <div class="card">
                <h2>My Account</h2>
                <div class = "name_box">
                    <h4>Your name:</h4>
                    <input type="text" id="name" value="{{ Auth::user()->name }}">
                    <button class="save_change">Save change</button>
                </div>
                <div class = "name_box">
                    <h4>Your surname:</h4>
                    <input type="text" id="lname" value="{{ Auth::user()->surname }}">
                    <button class="save_change">Save change</button>
                </div>
                <div class = "email_box">
                    <h4>Your email:</h4>
                    <input type="text" id="email" value="{{ Auth::user()->email }}">
                    <button class="save_change">Save change</button>
                </div>
                <div class = "email_box">
                    <h4>Phone number:</h4>
                    <input type="text" id="phone_num" value="{{ Auth::user()->phone_num }}">
                    <button class="save_change">Save change</button>
                </div>
            </div>
        </div>
        <div class="profile_r_container">
            <div class="card">
                <h2>Change Password</h2>
                <div class="current_password_box">
                    <h4>Enter current password:</h4>
                    <input type="password" id="curr_passwd">
                </div>
                <div class="new_password_box">
                    <h4>Enter new password:</h4>
                    <input type="password" id="new_passwd">
                </div>
                <div class="check_new_password_box">
                    <h4>Confirm your new password:</h4>
                    <input type="password" id="check_passwd">

                </div>
            </div>
            <button id="password_change">Change password</button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="log_out">QUIT ACCOUNT</button>
            </form>
        </div>
    </section>
@endsection

