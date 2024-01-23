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
    public function store(ClientStoreRequest $request)
    {
        Client::createClient($request);
    }
    public function edit($id)
    {
        $data ["client"] = Client::getClientById($id);
        $data ["cars"] = Car::getCarsByClientId($id);
        return $data;
    }
    public function update(ClientUpdateRequest $request, $id)
    {
        Client::updateClient($request, $id);
    }
    public function destroy($id)
    {
       Client::deleteClient($id);
    }
}


