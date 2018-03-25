@switch(Auth::user()->type)
    @case(0)
        <div class="alert alert-info">Você é aluno!</div>
        @break

    @case(1)
        <div class="alert alert-info">Você é professor!</div>
        @break

    @default
        <div class="alert alert-info">Tipo do usuário não identificado!</div>
@endswitch