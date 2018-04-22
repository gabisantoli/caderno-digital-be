@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="my-5">Seguir {{$user->name}}</h1>
        <h4>{{$followers}} seguidores</h4>
        {!! Form::open(['action' => $action, 'method' => 'POST']) !!}

        {{ Form::hidden('follower_id', auth()->user()->id) }}
        {{ Form::hidden('user_id', $user->id) }}

        @if ($user->id != auth()->user()->id)
        {{ Form::submit($label, ['class' => 'btn btn-primary my-3']) }}
        @endif
        {!! Form::close() !!}
    </div>
@endsection