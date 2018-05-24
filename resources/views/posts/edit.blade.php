@extends('layouts.app') 

@section('content')
<div class="posts mt-5">
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Título')}}
            {{Form::text('title', $post->title,  ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>

        <div class="form-group">
            {{Form::label('body', 'Post')}}
            {{Form::textarea('body', $post->body,  ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Post'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Alterar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection