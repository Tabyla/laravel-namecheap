@extends('layouts.admin')

@section('title', 'Пользователи')

@section('content_header')
    Пользователи
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active">Пользователи</li>
    </ol>
@endsection

@section('buttons')
    <a class="btn btn-success btn-sm float-sm-right" href="{{route('user.create')}}">Создать пользователя</a>
@endsection

@section('content')
    @if (session('alert'))
        <div class="alert alert-danger alert-dismissible" style="margin-bottom: 20px">
            {{ session('alert') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{route('user.edit', $item->id)}}">{{ $item->name }}</a></td>
                            <td>{{ $item->profile->firstname }}</td>
                            <td>{{ $item->profile->surname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if(!empty($item->getRoleNames()))
                                    @foreach($item->getRoleNames() as $role)
                                        {{ $role }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{route('user.edit', $item->id)}}" class="btn btn-primary btn-sm"
                                   title="Отредактировать пользователя">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <form method="POST" action="{{ url('user' . '/' . $item->id)}}" accept-charset="UTF-8"
                                      style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Удаление пользователя"
                                            onclick="return confirm('Удалить пользователя?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $users->onEachSide(10)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
