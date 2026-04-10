@extends('layout.layout_customer')
    @section('content')
        <section class="main_content">
            <h1 id="main_register_text"><strong>REGISTER AN ACCOUNT</strong></h1>
            <div class="register_forms">
                <div class="register_form">
                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="errors">
                                @foreach ($errors->all() as $error)
                                    <p style="color:red">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="form_group">
                            <label for="name">ENTER YOUR FIRST NAME:</label>
                            <input type="text" id="name" name="fname" required>
                        </div>
                        <div class="form_group">
                            <label for="lname">ENTER YOUR LAST NAME:</label>
                            <input type="text" id="lname" name="lname" required>
                        </div>
                        <div class="form_group">
                            <label for="email">ENTER YOUR EMAIL:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form_group">
                            <label for="pname">ENTER YOUR PHONE NUMBER:</label>
                            <input type="text" id="pname" name="pname" required>
                        </div>
                        <div class="form_group">
                            <label for="password">ENTER YOUR PASSWORD:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit" class="register_button">CREATE ACCOUNT</button>
                    </form>
                </div>
            </div>
        </section>
    @endsection

