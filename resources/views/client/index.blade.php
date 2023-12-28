<x-layout>
                                        <x-slot:title>Клиенты</x-slot:title>


<table class="table">

    <thead>
    <tr>
        <th scope="col">Клиент</th>
        <th scope="col">Авто</th>
        <th scope="col">Номер</th>
    </tr>
    </thead>

    <tbody>
    @foreach($clients as $client)
    <tr>
        <td> {{$client->name}}</td>
        <td> {{$client->brand}}</td>
        <td> {{$client->plate}}</td>
    </tr>
    @endforeach

    </tbody>

</table>
    <div class="d-flex">
        {!! $clients->links() !!}
    </div>

</x-layout>
