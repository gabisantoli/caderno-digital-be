@extends('layouts.app')

@section('content')
<div class="container dashboard">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('inc.typeUser')
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary mb-4">Criar novo Post</a>
                    @if (count($posts) > 0)
                        <h3>Suas postagens</h3>

                        @foreach ($posts as $post)
                        <div class="row post-row">
                            <div class="col-12 col-md-4">
                                <a href="/posts/{{$post->id}}">
                                    <img src="/storage/cover_images/{{$post->cover_image}}" alt="" class="img-thumbnail" />
                                </a>
                            </div>
                            <div class="col-12 col-md-4">
                                <a class="post-title" href="/posts/{{$post->id}}">{{$post->title}}</a>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="post-actions">
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info">Editar</a>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>You have no posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
