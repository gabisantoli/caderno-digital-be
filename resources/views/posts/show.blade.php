@extends('layouts.app')

@section('content')
<div class="posts mt-5">
    <a href="/posts" class="btn btn-primary ">Voltar</a>
    <hr>
    <h1>{{$post->title}}</h1>
    <div class="m-3 text-center">
        <img class="img-fluid" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    </div>
    <div>{!!$post->body!!}</div>
    <hr>
    <small>Escrito em {{ strftime('%d/%m/%Y', strtotime($post->created_at))}} por: <a href="/followers/create/{{$user->id}}"> {{$post->user->name}} </a> </small>
    <hr>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Editar</a>
        @endif
        @if (Auth::user()->id == $post->user_id || (Auth::user()->type == 1 && ($user->type != 1 || $user->id == Auth::user()->id)))
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}

            {!!Form::close()!!}
        @endif
    @endif

    <div>
        {{$post->avaliacoes_positivas}}<a href="/ratings/store/post/{{$post->id}}/positivo/{{$post->id}}" class="btn btn-primary">Top</a>
        {{$post->avaliacoes_negativas}}<a href="/ratings/store/post/{{$post->id}}/negativo/{{$post->id}}" class="btn btn-primary">Meh</a>
    </div>

    <br><br><br>
    <a href="/answers/create/{{$post->id}}" class="btn btn-primary">Responder</a>
    <br><br><br>

    @if(count($answers) > 0)
        @foreach($answers as $answer)
            <div class="text-left"><a href="/followers/create/{{$answer->user->id}}">{{$answer->user->name}}</a>: {!!$answer->text!!}</div>
            <div class="row">
                <div class="ml-3 mb-3">
                    {{$answer->avaliacoes_positivas}}<a href="/ratings/store/answer/{{$answer->id}}/positivo/{{$post->id}}" class="btn btn-primary">Top</a>
                    {{$answer->avaliacoes_negativas}}<a href="/ratings/store/answer/{{$answer->id}}/negativo/{{$post->id}}" class="btn btn-primary">Meh</a>
                </div>
            </div>
            
            <div class="row">
                <small class="ml-3">{{$answer->created_at}}</small>
                @if ($answer->button['edit'])
                    <div class="ml-4">
                        <a href="/answers/edit/{{$post->id}}/{{$answer->id}}" class="btn btn-primary">Editar</a>
                    </div>
                @endif
                @if ($answer->button['delete'])
                    <div class="ml-4">
                        {!!Form::open(['action' => ['AnswersController@destroy', $answer->id, $post->id], 'method' => 'POST', 'class' => ''])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}
                    </div>
                @endif
            </div>
            <hr>
        @endforeach
    @endif
    </div>
@endsection