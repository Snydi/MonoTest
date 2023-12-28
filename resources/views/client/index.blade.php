<x-layout>
                                        <x-slot:title>Клиенты</x-slot:title>

    <a href="/clients/create/"> <button type="button" class="btn btn-success">Добавить</button> </a>
<table class="table">

    <thead>
    <tr>
        <th scope="col">Клиент</th>
        <th scope="col">Авто</th>
        <th scope="col">Номер</th>
        <th> <button type="button" class="btn btn-primary">Редактировать</button> </th>
        <th> <button type="button" class="btn btn-danger">Удалить</button> </th>
    </tr>
    </thead>

    <tbody>
    @foreach($clients as $client)
    <tr>
        <td> {{$client->name}}</td>
        <td> {{$client->brand}}</td>
        <td> {{$client->plate}}</td>
        <td>
            <a href="/clients/edit/{{$client->id}}">
                <button type="button" class="btn btn-primary">Редактировать</button>
            </a>
        </td>
        <td>
            <form action="{{ url('clients/delete', ['id' => $client->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach

    </tbody>

</table>
    <div class="d-flex">
        {!! $clients->links() !!}
    </div>

</x-layout>
