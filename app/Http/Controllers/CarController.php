<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
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
            'plate' => 'required|unique:cars',
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
