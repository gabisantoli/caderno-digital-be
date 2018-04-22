@extends('layouts.app')
@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-block bg-faded p-3 mb-2">
                <a class="post-title" href="/posts/{{$post->id}}">
                    <div class="row">
                        <div class="col-4">
                            <img style="width:100%; max-height: 180px;"
                                 src="/storage/cover_images/{{$post->cover_image}}" alt="">
                        </div>
                        <div class="col-8">
                            <h3>{{$post->title}}</h3>
                            <small>Escrito dia {{strftime('%d/%m/%Y', strtotime($post->created_at))}}
                                por {{$post->user->name}}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach {{$posts->links()}}
    @else
        <p>Nenhuma postagem encontrada.</p>
    @endif
@endsection