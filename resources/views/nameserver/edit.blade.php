@extends('layouts.admin')

@section('title', 'Изменить NS запись ' . $nameserver->nameserver)

@section('content')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('nameserver.index', ['domain' => $nameserver->domain_name]) }}" title="Назад">
                <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                </button>
            </a>
            <br/>
            <br/>

            <form method="POST" action="{{ route('nameserver.update', ['nameserver' => $nameserver->id]) }}" accept-charset="UTF-8"
                  class="form-horizontal">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                @include ('nameserver.form')

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Обновить">
                </div>
            </form>

        </div>
    </div>
@endsection
