@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Новости
            <a class="btn btn-primary pull-right"  href="{{ route('news.create') }}">Добавить</a>
        </h1>
        <hr>
        @include('news.info')

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($news as $item)
                        <div class="row">
                            <div class="col-md-8"><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></div>
                            <div class="col-md-2">{{ $item->created_at }}</div>
                            <div class="col-md-1"><a class="btn btn-warning" href="{{ route('news.edit', $item->slug) }}">Edit</a></div>
                            <div class="col-md-1">
                                {!! Form::open(['route' => ['news.destroy', $item->slug], 'method' => 'DELETE']) !!}
                                <button class="btn btn-danger">Del</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
