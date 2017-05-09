<div class="form-group">
    {!! Form::label('title', 'Название') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('content', 'Новость') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    @if ($errors->has('content'))
        <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
</div>