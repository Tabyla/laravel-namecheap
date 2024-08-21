@extends('layouts.app')
@section('title', 'Панель управления')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
@section('content')
    <section>
        <h1>Панель управления</h1>
        <div class="profile">
            <div class="profile-links">
                <button data-num="1" type="button" id="btn" class="btn1">
                    <div class="img"><img src="{{asset('images/profile.png')}}" alt="profile"></div>
                    <div class="active-img"><img src="{{asset('images/active-profile-icon.png')}}" alt="profile">
                    </div>
                    <h2>Личная информация</h2>
                </button>
                <button data-num="2" type="button" id="btn" class="btn2">
                    <div class="img"><img src="{{asset('images/order-history.png')}}" alt="list"></div>
                    <div class="active-img"><img src="{{asset('images/active-order-history.png')}}" alt="list"></div>
                    <h2>Домены</h2>
                </button>
                <button data-num="3" type="button" id="btn" class="btn3">
                    <div class="img"><img src="{{asset('images/password-icon.png')}}" alt="password"></div>
                    <div class="active-img"><img src="{{asset('images/active-password-icon.png')}}" alt="password">
                    </div>
                    <h2>Изменить пароль</h2>
                </button>
                <form action="{{route('logout')}}" method="POST">
                    {{csrf_field()}}
                    <button href="{{route('logout')}}">
                        <div class="img"><img src="{{asset('images/logout-icon.png')}}" alt="logout"></div>
                        <h2>Выйти</h2>
                    </button>
                </form>
            </div>
            <div class="profile-content">
                <div class="profile-block text info" id="block1">
                    <div class="first_column">
                        <p>{{$profile->firstname}}</p>
                        <p>{{$profile->surname}}</p>
                        <p>{{$profile->api_key}}</p>
                    </div>
                    <div class="second_column">
                        <p>{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                    </div>
                </div>
                <div class="list-block info" id="block2">
                    @if($domains && count($domains) > 0)
                        <div class="products-list-block" id="product-list-block">
                            <h3 class="mb-4 domains-title">Мои домены</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Название домена</th>
                                        <th>Дата покупки</th>
                                        <th>Дата окончания</th>
                                        <th>Стоимость</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($domains as $domain)
                                        <tr>
                                            <td>{{ $domain['name'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($domain['created'])->format('d.m.Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($domain['expires'])->format('d.m.Y') }}</td>
                                            <td>{{ $domain['price'] }} $</td>
                                            <td><a href="#"
                                                   class="btn btn-outline-primary" title="Просмотреть информацию">
                                                    <i class="fas fa-eye"></i>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="default-list-block text">
                            <h3>У вас нет купленных доменов</h3>
                            <button class="submit_btn"><a href="{{route('domain')}}">купить домен</a></button>
                        </div>
                    @endif
                </div>
                <div class="password-block text info" id="block3">
                    <form action="{{route('profile.change-password')}}" class="password_form" method="post">
                        {{ csrf_field() }}
                        <div class="password-form-content">
                            <input id="current_password" name="current_password" type="password"
                                   placeholder="Старый пароль" required>
                            {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
                            <input id="new_password" name="new_password" type="password" placeholder="Новый пароль"
                                   required>
                            {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                                   required placeholder="Повторите пароль">
                            {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                        <input type="submit" class="submit_btn" value="сохранить">
                    </form>
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
            </div>
        </div>
    </section>
    <script src="{{ asset('js/dashboard.js') }}?v={{ time() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
