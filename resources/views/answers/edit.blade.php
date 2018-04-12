@extends('layouts.app')

@section('content')
    <h1>Editar Resposta</h1>
    {!! Form::open(['action' => ['AnswersController@update', $answer->id], 'method' => 'POST']) !!}

    {{ Form::hidden('post_id', $post->id) }}

    <div class="form-group">
        {{Form::label('text', 'Insira o texto:')}}
        {{Form::textarea('text', $answer->text,  ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Insira sua resposta'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Enviar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection