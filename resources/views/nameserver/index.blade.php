@extends('layouts.app')
@section('title', 'Панель управления')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/nameserver.css') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
@section('content')
    <div class="container mt-4">
        <h3>NS записи домена - {{ $domain }}</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a class="btn btn-success btn-sm float-sm-right"
                       href="{{route('nameserver.create', ['domain' => $domain])}}">Добавить NS Запись</a>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>IP</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($nameservers)
                            @foreach($nameservers as $nameserver)
                                <tr>
                                    <td><a href="{{route('nameserver.edit', $nameserver['id'])}}">{{ $nameserver['nameserver'] }}</a></td>
                                    <td>{{ $nameserver['ip'] }}</td>
                                    <td class="action-buttons">
                                        <a href="{{route('nameserver.edit', $nameserver['id'])}}"
                                           class="btn btn-primary btn-sm"
                                           title="Отредактировать NS запись">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ url('nameserver' . '/' . $domain . '/' . $nameserver['nameserver'])}}"
                                              accept-charset="UTF-8"
                                              style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Удаление NS записи"
                                                    onclick="return confirm('Удалить NS запись?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
