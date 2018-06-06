@extends('layouts.app')
@section('content')
<div class="row home vertical-center">
    <div class="col-md-6 order-md-2">
        <img src="/images/icon.png" class="img-fluid logo" alt="">
    </div>
    
    <div class="col-md-6 order-md-1">
        <h1>Caderno Digital</h1>
        <h3>O web-app que facilita a sua vida acadêmica!</h3>
        @if (Auth::guest())
        <p>Para participar, você deve fazer login. Utilize um dos botões abaixo:</p>
        <a href="/login" class="btn btn-primary btn-lg">Logar</a>
        <a href="/register" class="btn btn-secondary-c btn-lg">Registrar</a>
        @endif
    </div>
</div>
@endsection