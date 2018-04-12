@extends('layouts.app')

@section('content')
    <h1>Criar Resposta</h1>
    {!! Form::open(['action' => 'AnswersController@store', 'method' => 'POST']) !!}

    {{ Form::hidden('post_id', $post_id) }}

    <div class="form-group">
        {{Form::label('text', 'Insira o texto:')}}
        {{Form::textarea('text', '',  ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Insira sua resposta'])}}
    </div>
    {{Form::submit('Enviar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection