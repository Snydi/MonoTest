<x-layout>
    <x-slot:title>Редактирование клиента</x-slot:title>
                                    <h1>Клиент</h1>
    <a href="/clients/"> <button type="button" class="btn btn-success">Назад</button> </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{url('/clients/update', ['id' => $client[0]->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">ФИО</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="ФИО:" value="{{$client[0]->name}}"
                   required>
        </div>

        <select name="sex" class="custom-select" required>
            <option>Укажите ваш пол:</option>
            <option value="1" {{$client[0]->sex === 1 ? 'selected' : ''}}>Мужчина</option>
            <option value="2" {{$client[0]->sex === 2 ? 'selected' : ''}}>Женщина</option>
            <option value="0" {{$client[0]->sex === 0 ? 'selected' : ''}}>Предпочитаю не указывать</option>
        </select>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input name="phone" type="tel" class="form-control" id="phone" placeholder="Телефон:" value="{{$client[0]->phone}}"
                   required>
        </div>

        <div class="form-group">
            <label for="address">Адрес</label>
            <input name="address" type="text" class="form-control" id="address" placeholder="Адрес:" value="{{$client[0]->address}}"
                   required>
        </div>

         <button type="submit" class="btn btn-primary">Редактировать</button>

    </form>
        <h1>Машины</h1>
    @foreach($cars as $car)
        <form action="{{url('/cars/update', ['id' => $car->id])}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="brand">Марка</label>
                <input name="brand" type="text" class="form-control" id="brand" placeholder="Марка:" value="{{$car->brand}}"
                       required>
            </div>

            <div class="form-group">
                <label for="model">Модель</label>
                <input name="model" type="text" class="form-control" id="model" placeholder="Марка:" value="{{$car->model}}"
                       required>
            </div>

            <div class="form-group">
                <label for="color">Цвет</label>
                <input name="color" type="text" class="form-control" id="color" placeholder="Цвет:" value="{{$car->color}}"
                       required>
            </div>

            <div class="form-group">
                <label for="plate">Гос номер РФ</label>
                <input name="plate" type="text" class="form-control" id="plate" placeholder="Гос номер РФ::" value="{{$car->plate}}"
                       required>
            </div>
            <div class="form-group">
                <label for="in_parking">На парковке</label>
                <input name="in_parking" type="checkbox" class="form-check" id="in_parking"
                       value="{{$car->in_parking}}">
            </div>

            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>

        <form action="{{ url('cars/delete', ['id' => $car->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Удалить</button>
        </form>

    @endforeach
    <h1>Добавить машину</h1>
    <form action="{{url('/cars/store',  ['client_id' => $client[0]->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="brand">Марка</label>
            <input name="brand" type="text" class="form-control" id="brand" placeholder="Марка:"
                   required>
        </div>

        <div class="form-group">
            <label for="model">Модель</label>
            <input name="model" type="text" class="form-control" id="model" placeholder="Марка:"
                   required>
        </div>

        <div class="form-group">
            <label for="color">Цвет</label>
            <input name="color" type="text" class="form-control" id="color" placeholder="Цвет:"
                   required>
        </div>

        <div class="form-group">
            <label for="plate">Гос номер РФ</label>
            <input name="plate" type="text" class="form-control" id="plate" placeholder="Гос номер РФ::"
                   required>
        </div>
        <div class="form-group">
            <label for="in_parking">На парковке</label>
            <input name="in_parking" type="checkbox" class="form-check" id="in_parking" value="1">
        </div>

        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
</x-layout>
