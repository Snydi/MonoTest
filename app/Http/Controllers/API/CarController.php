<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Client;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;

class CarController extends Controller
{
    public function index()
    {
        $data ["cars"] = Car::getCarsInParking();
        $data ["clients"] = Client::getAllClients();
        return $data;
    }

    public function store(CarStoreRequest $request, $client_id )
    {
       Car::createCar($request, $client_id);
       return response()->json(['message' => 'Машина успешно добавлена']);
    }
    public function update(CarUpdateRequest $request, $id)
    {
        Car::updateCar($request, $id);
        return response()->json(['message' => 'Машина успешно отредактирована']);
    }
    public function destroy($id)
    {
        Car::deleteCar($id);
    }
}
