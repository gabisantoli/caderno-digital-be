@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-block btn-primary ">Voltar</a>
    <hr>
    <h1>{{$post->title}}</h1>
    <div class="m-3 text-center">
        <img class="img-fluid" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    </div>
    <div>{!!$post->body!!}</div>
    <hr>
    <small>Escrito em {{ strftime('%d/%m/%Y', strtotime($post->created_at))}} por: {{$post->user->name}}</small>
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

    <br><br><br>

    @if(count($answers) > 0)
        @foreach($answers as $answer)
            {{$answer->user->name}}: {{$answer->text}}<br>
            <div class="row">
                <small>{{$answer->created_at}}</small>
                @if ($actionButton['edit'])
                    <div class="ml-4">
                        <a href="" class="btn btn-primary">Editar</a>
                    </div>
                @endif
                @if ($actionButton['delete'])
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

@endsection