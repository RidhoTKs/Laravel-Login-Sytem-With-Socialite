@extends('templates')

@section('content')
    <div class="hero">

        <div class="form-box">

            <div class="button-group">
                <div id="btn"></div>
                <button type="button" class="toogle-button" onclick="register()">Register</button>
                <button type="button" class="toogle-button" onclick="login()">Log In</button>
            </div>

            <div class="social-media">
                <a href="/facebook/redirect"><img src="img/fb.png" alt=""></a>
                <a href="/google/redirect"><img src="img/gp.png" alt=""></a>
                <a href="/twitter/redirect"><img src="img/tw.png" alt=""></a>

            </div>

            <form action="/register/create" method="post">
                @csrf
                <div class="form-group" id="register">
                    <input type="text" placeholder="user name" class="input-field" name="username">
                    <input type="text" placeholder="Email" class="input-field" name="email">
                    <input type="password" placeholder="password" class="input-field" name="password">
                    <button type="submit" class="btn-submit">Register</button>
                </div>

                <div class="form-group" id="login">
                    <input type="text" placeholder="email" class="input-field" name="emaillogin">
                    <input type="password" placeholder="password" class="input-field" name="passwordlogin">
                    <button type="submit" class="btn-submit">Log In</button>
                </div>
            </form>


            @if (Session::has('succes'))
                <p class="message">data berhasil ditambahkan</p>
            @endif
        </div>
    </div>
@endsection
