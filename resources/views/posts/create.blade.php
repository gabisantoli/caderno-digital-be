@extends('layouts.app')

@section('content')
<div class="posts mt-5">
    <h1>Criar Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Título')}}
            {{Form::text('title', '',  ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>

        <div class="form-group">
            {{Form::label('body', 'Post')}}
            {{Form::textarea('body', '',  ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Postar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection