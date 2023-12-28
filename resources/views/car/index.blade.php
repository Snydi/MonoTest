<x-layout>
    <x-slot:title>Припаркованные машины</x-slot:title>

    <form action="{{url('/cars/get-by-client')}}" method="GET">
    <select name="client_id" class="custom-select" required>
       @foreach($clients as $client)
           <option value="{{$client->id}}">{{$client->name}} </option>
        @endforeach
    </select>
{{--        <button type="submit" class="btn btn-primary">Показать машины</button>--}}
    </form>

{{--    <select name="car" class="custom-select" required>--}}
{{--        @foreach($cars as $car)--}}
{{--            <option>{{$car->model}} </option>--}}
{{--        @endforeach--}}
{{--    </select>--}}

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Марка</th>
            <th scope="col">Модель</th>
            <th scope="col">Цвет кузова</th>
            <th scope="col">Гос номер РФ</th>
        </tr>
        </thead>

        <tbody>
        @foreach($cars as $car)
            <tr>
                <td> {{$car->brand}}</td>
                <td> {{$car->model}}</td>
                <td> {{$car->color}}</td>
                <td> {{$car->plate}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

</x-layout>
