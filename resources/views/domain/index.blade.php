@extends('layouts.app')
@section('title', 'Домены')

@section('additional_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Поиск домена</h1>

        <form id="domainSearchForm" method="POST" action="{{ route('domains.check_price') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Введите название домена" name="domain_name"
                       required>
                <button class="btn btn-primary" type="submit">Найти домен</button>
            </div>
        </form>

        <div id="domainInfo" class="mt-5">
            @if (isset($domainInfo))
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Информация о домене</h5>
                        <p class="card-text"><strong>Название домена:</strong> {{ $domainInfo['Domain'] }}</p>
                        <p class="card-text">
                            <strong>Доступен:</strong> {{ $domainInfo['Available'] == 'true' ? 'Доступен' : 'Недоступен' }}
                        </p>
                        @if (isset($domainInfo['PremiumRegistrationPrice']))
                            <p class="card-text"><strong>Цена:</strong> ${{ $domainPrice }}</p>
                            @if($domainInfo['Available'])
                                <a href="{{ route('domain.purchase.form', ['domain' => $domainInfo['Domain']]) }}" class="btn btn-primary">Купить домен</a>
                            @endif
                        @else
                            <p class="card-text text-danger">Неверно введено имя домена.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p class="help-block">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if (session('success'))
            <div>
                <p class="success-block">{{ session('success') }}</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
