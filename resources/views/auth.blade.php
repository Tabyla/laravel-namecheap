@extends('layouts.app')
@section('title', 'Авторизация')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}?v={{ time() }}">
@endsection
@section('content')
    <section class="container">
        <div class="registration">
            <h2>Авторизация</h2>
            <form class="reg_form" method="POST" id="regForm" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form_data">
                    <input required id="name" name="name" class="form_input" type="text" placeholder="Логин"
                           value="{{ old('name') }}">
                </div>
                <div class="form_data">
                    <div class="password">
                        <input required class="form_input" type="password" id="password"
                               name="password" placeholder="Пароль" autocomplete="new-password">
                        <a href="#" class="password-control"></a>
                    </div>
                </div>
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                <input type="submit" value="Авторизоваться" class="submit_btn">
                <p>У Вас нет аккаунта? - <a class="red_link" href="{{ route('reg') }}">Зарегистрироваться</a></p>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/registr.js') }}?v={{ time() }}"></script>
@endsection
