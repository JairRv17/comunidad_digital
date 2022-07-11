<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function show($id)
    {
        $perfil = Perfil::findOrFail($id);
        return response($perfil, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'nullable|string|max:255',
            'pais' => 'nullable',
            'ciudad' => 'nullable',
            'direccion' => 'nullable|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);
        $perfilExistente = Perfil::where('id', auth()->user()->id)->first();
        if($perfilExistente != null)
            return response(['message' => 'El perfil ya existe'], 302);
        $perfil = Perfil::create([
            'id' => auth()->user()->id,
            'primer_nombre' => $request->input('primer_nombre'),
            'segundo_nombre' => $request->input('segundo_nombre'),
            'primer_apellido' => $request->input('primer_apellido'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'pais' => $request->input('pais'),
            'ciudad' => $request->input('ciudad'),
            'direccion' => $request->input('direccion'),
            'fecha_nacimiento' => (new Carbon($request->input('fecha_nacimiento')))
        ]);

        return response($perfil, 201);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'segundo_nombre' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'pais' => 'nullable',
            'ciudad' => 'nullable',
            'direccion' => 'nullable|max:255'
        ]);
        $perfil = Perfil::findOrFail($id);
        $perfil->update([
            'segundo_nombre' => $request->input('segundo_nombre'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'pais' => $request->input('pais'),
            'ciudad' => $request->input('ciudad'),
            'direccion' => $request->input('direccion')
        ]);

        return response($perfil, 201);
    }
    public function destroy($id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->delete();
        return response(['message' => 'Perfil eliminado'], 200);
    }
}
