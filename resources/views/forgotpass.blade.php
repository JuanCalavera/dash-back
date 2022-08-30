@component('mail::message')
    <h1>{{ $name }} segue abaixo seu código para refazer sua senha</h1>
        Código:
        <b>{{$code}}</b>
    @component('mail::button', ['url' => 'https://www.notion.so/Dash-ce76457fc4d0431093c453f045c3b70d'])
        Recuperar Senha
    @endcomponent
@endcomponent
