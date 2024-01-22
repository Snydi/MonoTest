<?php
namespace App\Http\Controllers;
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
        $cars = Car::getCarsInParking();
        $clients = Client::getAllClients();
        return view('car.index', ['cars'=>$cars], ['clients' => $clients]);
    }

    public function store(CarStoreRequest $request, $client_id )
    {
       Car::createCar($request, $client_id);
       return redirect('/clients');
    }
    public function update(Request $request, $id)
    {
        $carUpdateRequest = new CarUpdateRequest($id);
        $request->validate($carUpdateRequest->rules());
        Car::updateCar($request, $id);
        return redirect('/clients');
    }
    public function destroy($id)
    {
        Car::deleteCar($id);
        return back();
    }
}
