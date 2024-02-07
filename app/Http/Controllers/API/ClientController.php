<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{

    public function index()
    {
        return ClientRepository::getClientsWithCars();
    }
    public function store(ClientStoreRequest $request)
    {
        $client = ClientRepository::store($request);
        return response()->json(['message' => 'Клиент успешно добавлен', 'clientId' => $client->id]);
    }
    public function edit($id)
    {
       return ClientRepository::edit($id);
    }
    public function update(ClientUpdateRequest $request, $id)
    {
        ClientRepository::update($request, $id);
        return response()->json(['message' => 'Клиент успешно отредактирован']);
    }
    public function destroy($id)
    {
        ClientRepository::destroy($id);
        return response()->json(['message' => 'Клиент успешно удален']);
    }
}


