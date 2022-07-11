<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coleccion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColeccionController extends Controller
{
    public function show($id)
    {
        $coleccion = Coleccion::findOrFail($id);
        return response($coleccion, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'tipo_coleccion_id' => 'required|exists:tipo_colecciones,id'
        ]);
        $coleccion = Coleccion::create([
            'descripcion' => $request->input('descripcion'),
            'perfil_id' => auth()->user()->id,
            'tipo_coleccion_id' => $request->input('tipo_coleccion_id')
        ]);

        return response($coleccion, 201);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'tipo_coleccion_id' => 'required|exists:tipo_colecciones,id'
        ]);
        $coleccion = Coleccion::findOrFail($id);
        $coleccion->update([
            'descripcion' => $request->input('descripcion'),
            'tipo_coleccion_id' => $request->input('tipo_coleccion_id'),
            'updated_at' => (new Carbon())->now()
        ]);

        return response($coleccion, 201);
    }
    public function destroy($id)
    {
        $coleccion = Coleccion::findOrFail($id);
        $coleccion->delete();
        return response(['message' => 'Colección eliminada'], 200);
    }
}
