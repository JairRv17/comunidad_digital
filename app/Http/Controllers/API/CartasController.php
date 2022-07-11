<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartasController extends Controller
{
    public function show($id)
    {
        $tipo = Carta::findOrFail($id);
        return response($tipo, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'coleccion_id' => 'required|exists:colecciones,id',
            'descripcion' => 'required|string|max:255',
            'condicion' => 'required|string|max:1',
            'cantidad' => 'required|numeric',
            'numeracion' => 'required|string'
        ]);
        $tipo = Carta::create([
            'coleccion_id' => $request->input('coleccion_id'),
            'descripcion' => $request->input('descripcion'),
            'condicion' => $request->input('condicion'),
            'cantidad' => $request->input('cantidad'),
            'numeracion' => $request->input('numeracion')
        ]);

        return response($tipo, 201);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'coleccion_id' => 'required|exists:colecciones,id',
            'descripcion' => 'required|string|max:255',
            'condicion' => 'required|string|max:1',
            'cantidad' => 'required|numeric',
            'numeracion' => 'required|string'
        ]);
        $tipo = Carta::findOrFail($id);
        $tipo->update([
            'descripcion' => $request->input('descripcion'),
            'condicion' => $request->input('condicion'),
            'cantidad' => $request->input('cantidad'),
            'numeracion' => $request->input('numeracion'),
            'updated_at' => (new Carbon())->now()
        ]);

        return response($tipo, 201);
    }
    public function destroy($id)
    {
        $tipo = Carta::findOrFail($id);
        $tipo->delete();
        return response(['message' => 'Carta eliminada'], 200);
    }
}
