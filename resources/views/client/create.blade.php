<x-layout>
    <x-slot:title>Добавление клиента</x-slot:title>
    <h1>Клиент</h1>

    <a href="/clients/"> <button type="button" class="btn btn-success">Назад</button> </a>

    <form action="{{url('/clients/store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">ФИО</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="ФИО:" required>
        </div>

        <select name="sex" class="custom-select" required>
            <option selected>Укажите ваш пол:</option>
            <option value="1" >Мужчина</option>
            <option value="2" >Женщина</option>
            <option value="0">Предпочитаю не указывать</option>
        </select>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input name="phone" type="tel" class="form-control" id="phone" placeholder="Телефон:" required>
        </div>

        <div class="form-group">
            <label for="address">Адрес</label>
            <input name="address" type="text" class="form-control" id="address" placeholder="Адрес:" required>
        </div>

        <button type="submit" class="btn btn-primary">Добавить</button>

    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>
