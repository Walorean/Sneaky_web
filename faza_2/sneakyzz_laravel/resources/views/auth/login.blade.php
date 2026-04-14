@extends('layout.layout_customer')
@section('content')
    <section class= "sign_in_container">
        <div class="sign_in_l_side">
            <h2><strong>Sign in:</strong></h2>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                @if ($errors->any())
                    <div class="errors">
                        @foreach ($errors->all() as $error)
                            <p style="color:red">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="sign_in_email_container">
                    <div class="enter_email_text">Enter email:</div>
                    <input type="email" name="email" id="email_sign" placeholder="Email...">
                </div>
                <div>
                    <div class="enter_password_text">Enter password:</div>
                    <input type="password" name="password" id="password_sign" placeholder="Password...">
                </div>

                <button type="submit" class="sign_in_button" ><strong>Sign in</strong></button>
            </form>
        </div>
        <div class="sign_in_r_side">
            <div class="sign_in_register_info_container">
                <div class= "sign_in_reg_top_container">
                    <div class="sign_in_reg_top"><strong>Register and enjoy additional benefits with us:</strong></div>
                    <div class="sign_in_reg_logo"><strong>SNEAKYZZ</strong></div>
                </div>
                <ul>
                    <li>Announcements about new products and collections</li>
                    <li>Cashback for purchases</li>
                    <li>Discount notifications</li>
                </ul>
            </div>
            <button class="sign_in_reg_button" onclick="window.location='{{ route('register') }}'"><strong>Register</strong></button>
        </div>
    </section>

@endsection

