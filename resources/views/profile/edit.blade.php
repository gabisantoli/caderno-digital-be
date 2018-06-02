@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['ProfileController@update',$user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="card mt-4">
                <div class="card-header">Editar Perfil</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        
                        <div class="row">
                            <tr>
                                <td  class="mx-3" > 
                                     Nome
                                </td>
                                <td class="mx-3" >
                                        {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                                </td>
                            </tr>
                        </div>

                        <div class="row">
                            <tr>
                                <td  class="mx-3" > 
                                    Email
                                </td>
                                <td class="mx-3" >
                                {{Form::email('email', $user->email, ['class' => 'form-control'])}}
                                </td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr style="cursor: pointer;">
                                <td colspan="2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" > 
                                    Mudar Senha
                                </td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <td colspan="2">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                {{Form::password('currentpass', ['class' => 'form-control', 'placeholder' => 'Senha Atual'])}}
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 ">
                                                    {{Form::password('newpass', ['class' => 'form-control', 'placeholder' => 'Nova Senha'])}}
                                                </div>
                                                <div class="col-md-6">
                                                    {{Form::password('confirmpass', ['class' => 'form-control', 'placeholder' => 'Confirmação da Senha'])}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </div>

                    </table>
                </div>
            </div>
    {{Form::submit('Enviar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection

