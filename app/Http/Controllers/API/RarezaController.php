<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rareza;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RarezaController extends Controller
{
    public function show($id)
    {
        $tipo = Rareza::findOrFail($id);
        return response($tipo, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);
        $tipo = Rareza::create([
            'descripcion' => $request->input('descripcion')
        ]);

        return response($tipo, 201);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);
        $tipo = Rareza::findOrFail($id);
        $tipo->update([
            'descripcion' => $request->input('descripcion'),
            'updated_at' => (new Carbon())->now()
        ]);

        return response($tipo, 201);
    }
    public function destroy($id)
    {
        $tipo = Rareza::findOrFail($id);
        $tipo->delete();
        return response(['message' => 'Rareza eliminada'], 200);
    }
}
