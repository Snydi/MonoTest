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
        $data ["clients"] = Client::all();
        return $data;
    }

    public function store(CarStoreRequest $request, $client_id )
    {

        return response()->json(['message' => 'Машина успешно добавлена']);
    }
    public function update(CarUpdateRequest $request, $id)
    {
        $car = Car::find($id);
        $car->brand = $request->brand;
        $car->model  = $request->model;
        $car->color  = $request->color;
        $car->plate  = $request->plate;
        $car->in_parking  = $request->in_parking;
        $car->save();
        return response()->json(['message' => 'Машина успешно отредактирована']);
    }
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json(['message' => 'Машина успешно удалена']);
    }
}
