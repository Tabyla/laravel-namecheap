@extends('layouts.app')
@section('title', 'Добавление NS записи')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/nameserver.css') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('nameserver.index', ['domain' => $domain ])}}" title="Назад" class="btn btn-warning btn-sm">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
            </a>
            <br/>
            <br/>

            <form method="POST" action="{{ route('nameserver.index', ['domain' => $domain ]) }}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}

                @include ('nameserver.form')
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Добавить">
                </div>
            </form>

        </div>
    </div>
@endsection
