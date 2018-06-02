@extends('layouts.app')
@section('content')
<div class="posts mt-5">
    <a href="/posts" class="btn btn-primary ">Voltar</a>
    <hr>
    <h1>{{$post->title}}</h1>
    <small class="author">Escrito em {{ strftime('%d/%m/%Y', strtotime($post->created_at))}} por:
        <a href="/followers/create/{{$user->id}}"> {{$post->user->name}} </a>
    </small>
    <div class="m-3 text-center">
        <img class="img-fluid" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    </div>
    <div>{!!$post->body!!}</div>
    
    <div class="actions-author">
        @if (!Auth::guest())
            @if (Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Editar</a>
            @endif
            @if (Auth::user()->id == $post->user_id || (Auth::user()->type == 1 && ($user->type != 1 || $user->id == Auth::user()->id)))
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}} {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}} {!!Form::close()!!}
            @endif
        @endif
    </div>

    <div class="actions">
        <div class="float-left">
            <a href="/answers/create/{{$post->id}}" class="btn btn-primary">Responder</a>
        </div>

        <div class="float-right">
        {{$post->avaliacoes_positivas}}
        <a href="/ratings/store/post/{{$post->id}}/positivo/{{$post->id}}">
            <i class="fas fa-heart fa-2x"></i>
        </a>
        {{$post->avaliacoes_negativas}}
        <a href="/ratings/store/post/{{$post->id}}/negativo/{{$post->id}}">
            <i class="fas fa-thumbs-down fa-2x"></i>
        </a>
        </div>
        <div class="clearfix"></div>
    </div>

    @if(count($answers) > 0)
        @foreach($answers as $answer)
            <div class="card">
                <div class="card-header">
                    <a href="/followers/create/{{$answer->user->id}}">{{$answer->user->name}}</a>
                    (<small>{{$answer->created_at}}</small>)
                </div>
                <div class="card-body">{!!$answer->text!!}</div>
                <div class="card-footer">
                    <div class="float-left">
                        <a href="/ratings/store/answer/{{$answer->id}}/positivo/{{$post->id}}" class="card-link">
                            <i class="fas fa-heart fa-2x"></i>
                        </a>{{$answer->avaliacoes_positivas}}

                        <a href="/ratings/store/answer/{{$answer->id}}/negativo/{{$post->id}}" class="card-link">
                            <i class="fas fa-thumbs-down fa-2x"></i>
                        </a>{{$answer->avaliacoes_negativas}}

                    </div>

                    <div class="float-right">
                        @if ($answer->button['edit'])
                            <a href="/answers/edit/{{$post->id}}/{{$answer->id}}" class="btn btn-primary float-left mr-1">Editar</a>
                        @endif

                        @if ($answer->button['delete'])
                            {!!Form::open(['action' => ['AnswersController@destroy', $answer->id, $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}} {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection