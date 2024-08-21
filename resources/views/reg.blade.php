@extends('layouts.app')
@section('title', 'Регистрация')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/registr.css') }}?v={{ time() }}">
@endsection
@section('content')
    <section class="container">
        <div class="registration">
            <h2>Регистрация</h2>
            <form class="reg_form" method="POST" id="regForm" action="{{ route('reg') }}">
                {{ csrf_field() }}
                <div class="form_data">
                    <input required id="name" name="name" class="form_input" type="text" placeholder="Логин"
                           value="{{ old('name') }}">
                    <input required id="email" name="email" class="form_input" type="email"
                           placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="form_data">
                    <input required id="firstname" name="firstname" class="form_input" type="text"
                           placeholder="Имя" value="{{ old('firstname') }}">
                    <input required id="surname" name="surname" class="form_input" type="text"
                           placeholder="Фамилия" value="{{ old('surname') }}">
                </div>
                <div class="form_data">
                    <input required id="api_key" name="api_key" class="api_input" type="text" placeholder="API key"
                           value="{{ old('api_key') }}">
                </div>
                <div class="form_data">
                    <div class="password">
                        <input required class="form_input" type="password" id="password"
                               name="password" placeholder="Пароль" autocomplete="new-password">
                        <a href="#" class="password-control"></a>
                    </div>
                    <div class="password">
                        <input required class="form_input" type="password" id="password-confirmation"
                               name="password_confirmation" placeholder="Повторите пароль"
                               autocomplete="new-password">
                        <a href="#" class="repassword-control"></a>
                    </div>
                </div>
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('api_key', '<p class="help-block">:message</p>') !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                <div class="form_btn">
                    <input type="submit" value="зарегистрироваться" class="submit_btn">
                    <p>У меня уже есть аккаунт чтобы <a href="{{ route('login') }}" class="red_link">Войти</a></p>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/registr.js') }}?v={{ time() }}"></script>
@endsection
