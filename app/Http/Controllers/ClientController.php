<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::getClientsWithCars();
        return view('client.index',['clients'=>$clients]);
    }
    public function create()
    {
        return view('client.create');
    }
    public function store(Request $request)
    {
        Client::createClient($request);
        return redirect('/clients');
    }
    public function edit($id)
    {
        $client = Client::getClientById($id);
        $cars = Car::getCarsByClientId($id);
        return view('client.edit', ['client' => $client, 'cars' => $cars]);
    }
    public function update(CarUpdateRequest $request, $id)
    {
        $clientUpdateRequest = new ClientUpdateRequest($id);
        $request->validate($clientUpdateRequest->rules());
        Client::updateClient($request, $id);
        return redirect('/clients');
    }
    public function destroy($id)
    {
       Client::deleteClient($id);
       return redirect('/clients');
    }
}


