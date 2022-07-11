<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PropiedadAdicional;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropiedadAdicionalController extends Controller
{
    public function show($id)
    {
        $propiedad = PropiedadAdicional::findOrFail($id);
        return response($propiedad, 200);
    }
    public function propiedadByColection($coleccion_id)
    {
        $propiedades = PropiedadAdicional::where('coleccion_id', $coleccion_id)->get();
        return response($propiedades, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'coleccion_id' => 'required|exists:colecciones,id'
        ]);
        $propiedad = PropiedadAdicional::create([
            'descripcion' => $request->input('descripcion'),
            'coleccion_id' => $request->input('coleccion_id')
        ]);

        return response($propiedad, 201);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'coleccion_id' => 'required|exists:colecciones,id'
        ]);
        $propiedad = PropiedadAdicional::findOrFail($id);
        $propiedad->update([
            'descripcion' => $request->input('descripcion'),
            'coleccion_id' => $request->input('coleccion_id')
        ]);

        return response($propiedad, 201);
    }
    public function destroy($id)
    {
        $propiedad = PropiedadAdicional::findOrFail($id);
        $propiedad->delete();
        return response(['message' => 'Propiedad eliminada'], 200);
    }
}
