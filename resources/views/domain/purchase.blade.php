@extends('layouts.app')
@section('title', 'Домены')

@section('additional_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.6/css/flag-icon.min.css" rel="stylesheet">
    <style>
        .flag-icon {
            margin-right: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1>Купить домен: {{ $domainName }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('domain.purchase') }}" method="POST">
            {{@csrf_field()}}
            <input type="hidden" id="domain" name="domain" value="{{ $domainName }}">

            <div class="mb-3">
                <label for="firstname" class="form-label">Имя</label>
                <input type="text" class="form-control" id="firstname" name="firstname"
                       value="{{ old('firstname', $user->profile->firstname) }}" required>
                {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="surname" name="surname"
                       value="{{ old('firstname', $user->profile->surname) }}" required>
                {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" name="address" required>
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">Штат/Регион</label>
                <input type="text" class="form-control" id="state" name="state" required>
                {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Почтовый индекс</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                {!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Страна</label>
                <select id="country" name="country" class="form-select" required>
                    <option>Выберите страну...</option>
                    <option value="RU" data-flag="ru">🇷🇺 Russia</option>
                    <option value="US" data-flag="us">🇺🇸 United States</option>
                    <option value="DE" data-flag="de">🇩🇪 Germany</option>
                    <option value="FR" data-flag="fr">🇫🇷 France</option>
                    <option value="CN" data-flag="cn">🇨🇳 China</option>
                    <option value="GB" data-flag="gb">🇬🇧 United Kingdom</option>
                    <option value="IN" data-flag="in">🇮🇳 India</option>
                    <option value="JP" data-flag="jp">🇯🇵 Japan</option>
                    <option value="CA" data-flag="ca">🇨🇦 Canada</option>
                    <option value="AU" data-flag="au">🇦🇺 Australia</option>
                    <option value="BR" data-flag="br">🇧🇷 Brazil</option>
                    <option value="ZA" data-flag="za">🇿🇦 South Africa</option>
                    <option value="IT" data-flag="it">🇮🇹 Italy</option>
                    <option value="ES" data-flag="es">🇪🇸 Spain</option>
                    <option value="MX" data-flag="mx">🇲🇽 Mexico</option>
                </select>
                {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('firstname', $user->email) }}" required>
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Город</label>
                <input type="text" class="form-control" id="city" name="city" required>
                {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
            </div>

            <button type="submit" class="btn btn-success">Купить домен</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Добавляем флаги в выпадающий список
            $('#country-select option').each(function () {
                const flag = $(this).data('flag');
                $(this).html(` <span class="flag-icon flag-icon-${flag}"></span> ` + $(this).text());
            });
        });
    </script>
@endsection
