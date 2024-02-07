<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CarRepository;
use App\Models\Client;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;

class CarController extends Controller
{
    public function index()
    {
        $data ["cars"] = CarRepository::getCarsInParking();
        $data ["clients"] = Client::all();
        return $data;
    }

    public function store(CarStoreRequest $request, $client_id )
    {
        CarRepository::store($request, $client_id);
        return response()->json(['message' => 'Машина успешно добавлена']);
    }
    public function update(CarUpdateRequest $request, $id)
    {
        CarRepository::update($request, $id);
        return response()->json(['message' => 'Машина успешно отредактирована']);
    }
    public function destroy($id)
    {
        CarRepository::destroy($id);
        return response()->json(['message' => 'Машина успешно удалена']);
    }
}
