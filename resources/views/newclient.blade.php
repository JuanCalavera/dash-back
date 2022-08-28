@component('mail::message')
    <h1>{{ $name }} seja um novo cliente da agência X</h1>
    @component('mail::button', ['url' => 'http://127.0.0.1:8000/api/'])
        Virar cliente
    @endcomponent
@endcomponent
