@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"><h1>{{ $news->title }}</h1></div>
            <div class="col-md-1"><a class="btn btn-warning" href="{{ route('news.edit', $news->slug) }}">Edit</a></div>
            <div class="col-md-1">
                {!! Form::open(['route' => ['news.destroy', $news->slug], 'method' => 'DELETE']) !!}
                <button class="btn btn-danger">Del</button>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Автор {{ $user->name }} . Добавлена {{ $news->created_at->diffForHumans() }}</div>
                <div class="panel-body">
                    <div class="row">
                        <p>{!! $news->markdownContent !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pager">
            <li class="previous">
                <a href="{{ route('news.index') }}">&larr; Назад</a>
            </li>
        </ul>
    </div>


@endsection