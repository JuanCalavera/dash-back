@if ($type == 'client')
    @component('mail::message')
        <h1>O cliente {{$name}} fez uma requisição de uma publicidade</h1>
        <p>Título: {{ $title }}</p>
        <p>Descrição: {{ $description }}</p>
        <p>Data Prazo: {{ $deliverDate }}</p>
        <p>Tamanho: {{ $size }}</p>
    @endcomponent
@elseif($type == 'agency')
    @component('mail::message')
        <h1>A agência {{$name}} inseriu novas artes para {{ $title }}</h1>
        <p>Título: {{ $title }}</p>
        <p>Descrição: {{ $description }}</p>
        <p>Data Prazo: {{ $deliverDate }}</p>
        <p>Tamanho: {{ $size }}</p>
        @component('mail::button', ['url' => 'https://www.notion.so/Dash-ce76457fc4d0431093c453f045c3b70d'])
        Ver Requisição
    @endcomponent
@endif
