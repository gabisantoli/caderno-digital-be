@extends('layouts.app')
    @section('content')
    <h1 class="mt-4">Posts</h1>
    <div class="posts row">
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="col-md-6 col-lg-4">
            <a href="/posts/{{$post->id}}"><img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image"></a>
            <div class="card">
                <div class="card-body">
                <h4 class="card-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                    <div class="card-text">{{strip_tags($post->body)}} </div>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary btn-block mt-3">Ver mais</a> <br>
                    <small>Por <a href="/followers/create/{{$post->user->id}}">{{$post->user->name}}</a><br>Escrito dia {{strftime('%d/%m/%Y', strtotime($post->created_at))}}</small>
                </div>
            </div>
        </div>
        @endforeach {{$posts->links()}}
    @else
        <p>Nenhuma postagem encontrada.</p>
    @endif
    </div>
@endsection