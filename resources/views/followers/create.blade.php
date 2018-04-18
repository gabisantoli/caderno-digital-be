@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="my-5">Seguir {{$user->name}}</h1>
        {!! Form::open(['action' => 'FollowersController@store', 'method' => 'POST']) !!}

        {{ Form::hidden('follower_id', auth()->user()->id) }}
        {{ Form::hidden('user_id', $user->id) }}

        {{ Form::submit($label, ['class' => 'btn btn-primary my-3']) }}
        {!! Form::close() !!}
    </div>
@endsection