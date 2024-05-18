@extends('layouts/app')
@section('title')
    @if($isLogin)
        Login
    @else
        Register
    @endif
@endsection
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    <script src="{{asset('js/auth.js')}}"></script>
    <br>
    <div class="tabs">
        <div class="tab" onclick="openTab('register')">Реєстрація</div>
        <div class="tab" onclick="openTab('login')">Вхід</div>
    </div>

    <div id="register" class="tab-content @if(!$isLogin) active @endif">
        <form id="registerForm" method="POST" action="{{ route('register') }}" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Ім'я:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Електронна пошта:</label>
                <input type="email" name="email" value="{{ old('email') }}"class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @if($errors->any)
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <button type="submit" class="btn btn-primary">Зареєструватися</button>
        </form>
    </div>






    <div id="login" class="tab-content @if($isLogin) active @endif">
        <form id="loginForm" method="POST" action="{{ route('login') }}" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Електронна пошта:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @if($errors->any)
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <button type="submit" class="btn btn-primary">Увійти</button>
        </form>
    </div>


    </div>
<br>
@endsection
