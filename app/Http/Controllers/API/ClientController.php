<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarUpdateRequest;

use App\Repositories\ClientRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{
    private $clientRepository;
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
    public function index()
    {
        return $this->clientRepository->getClientsWithCars();
    }
    public function store(ClientStoreRequest $request)
    {
        $client = $this->clientRepository->store($request);
        return response()->json(['message' => 'Клиент успешно добавлен', 'clientId' => $client->id]);
    }
    public function edit($id)
    {
       return $this->clientRepository->edit($id);
    }
    public function update(ClientUpdateRequest $request, $id)
    {
        $this->clientRepository->update($request, $id);
        return response()->json(['message' => 'Клиент успешно отредактирован']);
    }
    public function destroy($id)
    {
        $this->clientRepository->destroy($id);
        return response()->json(['message' => 'Клиент успешно удален']);
    }
}


