@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('inc.typeUser')
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary mb-4">Criar novo Post</a>
                    @if (count($posts) > 0)
                    <h3>Suas postagens</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Post</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                        <th><a href="/posts/{{$post->id}}"><img src="/storage/cover_images/{{$post->cover_image}}" alt="" class="img-thumbnail"></a></th>
                            <th><a class="post-title" href="/posts/{{$post->id}}">{{$post->title}}</a></th>
                            <th><a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info">Editar</a></th>
                            <th> 
                                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}
                            
                                {!!Form::close()!!}
                            </th>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
