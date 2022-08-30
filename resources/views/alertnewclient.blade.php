@component('mail::message')
    <h1>{{ $name }} Você possui um novo cliente</h1>
    <p>Nome: {{$nameClient}}</p>
    <p>Email: {{$emailClient}}</p>
@endcomponent