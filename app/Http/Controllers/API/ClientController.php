<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarUpdateRequest;

use Illuminate\Database\Eloquent\Model;
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
        return Client::with('cars')->paginate(10);
    }
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'address' => $request->address,
            ]);
        return response()->json(['message' => 'Клиент успешно добавлен', 'clientId' => $client->id]);
    }
    public function edit($id)
    {
        $data ["client"] = Client::getClientById($id);
        $data ["cars"] = Car::getCarsByClientId($id);
        return $data;
    }
    public function update(ClientUpdateRequest $request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->name;
        $client->sex = $request->sex;
        $client->phone = $request->phone;
        $client->address = $request->address;
        return response()->json(['message' => 'Клиент успешно отредактирован']);
    }
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json(['message' => 'Клиент успешно удален']);
    }
}


