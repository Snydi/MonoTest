<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{
    public function index()
    {
        return Client::getClientsWithCars();
    }
    public function create()
    {
        return view('client.create');
    }
    public function store(ClientStoreRequest $request)
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
    public function update(ClientUpdateRequest $request, $id)
    {
        Client::updateClient($request, $id);
        return redirect('/clients');
    }
    public function destroy($id)
    {
       Client::deleteClient($id);
       return redirect('/clients');
    }
}


