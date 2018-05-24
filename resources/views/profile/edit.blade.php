@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ProfileController@update', 'method' => 'POST']) !!}

    {{ Form::hidden('user_id', $user->id) }}

    <div class="form-group">
        {{Form::label('text', 'Insira o texto:')}}
        <div class="row">
            <div class="col-md-5 mx-auto">
                {{Form::text('text', $user->email, ['class' => 'form-control', 'readonly' => 'readonly'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                {{Form::text('text', $user->name, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                {{Form::password('password', ['class' => 'form-control'])}}
            </div>
        </div>
    </div>

    
    {{Form::submit('Enviar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection

