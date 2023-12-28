<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $cars = DB::table('cars')
            ->where('in_parking', '=', '1')
            ->select('*')
            ->get();

        $clients = DB::table('clients')
            ->select('*')
            ->get();

        return view('car.index', ['cars'=>$cars], ['clients' => $clients]);
    }

//    public function getByClient(Request $request)
//    {
//        $cars = DB::table('cars')
//            ->where('client_id', '=', $request->client_id)
//            ->select('*')
//            ->get();
//        return redirect('cars')->with($cars);
//    }

    public function store(Request $request, $client_id )
    {
        $request->validate([
            'brand' => 'alpha|required',
            'model' => 'required',
            'color' => 'required',
            'plate' => 'required|unique:cars',
            'in_parking' => '',
        ]);
        DB::table('cars')->insert([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'plate' => $request->plate,
            'in_parking' => $request->in_parking,
            'client_id' => $client_id,
        ]);
        return redirect('/clients');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'alpha|required',
            'model' => 'required',
            'color' => 'required',
            'plate' => 'required|unique:cars,plate,'.$id,
            'in_parking' => '',
        ]);
        DB::table('cars')
            ->where('id', $id)
            ->update([
                'brand' => $request->brand,
                'model' => $request->model,
                'color' => $request->color,
                'plate' => $request->plate,
                'in_parking' => $request->in_parking,
            ]);
        return redirect('/clients');
    }
    public function destroy($id)
    {
        DB::table('cars')
            ->where('id', $id)
            ->delete();
        return back();
    }
}
