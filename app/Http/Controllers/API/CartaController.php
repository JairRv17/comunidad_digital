<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carta;
use App\Models\PropiedadCartaSticker;
use App\Models\Rareza;
use App\Models\RarezaCartaSticker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartaController extends Controller
{
    public function show($id)
    {
        $carta = Carta::where('id', $id)->with(['rarezas.rarezas', 'propiedadesAdicionales'])->first();
        return response($carta, 200);
    }
    public function store(Request $request)
    {
        // formato de propiedades
        /*
        id_propiedad => valor
    */
        $request->validate([
            'coleccion_id' => 'required|exists:colecciones,id',
            'descripcion' => 'required|string|max:255',
            'condicion' => 'required|string|max:1',
            'cantidad' => 'required|numeric',
            'numeracion' => 'required|string',
            'rarezas_id' => 'array|nullable',
            'propiedades' => 'nullable'
        ]);
        $carta = Carta::create([
            'coleccion_id' => $request->input('coleccion_id'),
            'descripcion' => $request->input('descripcion'),
            'condicion' => $request->input('condicion'),
            'cantidad' => $request->input('cantidad'),
            'numeracion' => $request->input('numeracion')
        ]);
        $rarezas_id = $request->input('rarezas_id');

        $this->storeRarezas($rarezas_id, $carta->id);

        $propiedades = $request->input('propiedades');
        $this->storePropiedadesAdicionales($propiedades, $carta->id);

        return response($carta, 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'coleccion_id' => 'required|exists:colecciones,id',
            'descripcion' => 'required|string|max:255',
            'condicion' => 'required|string|max:1',
            'cantidad' => 'required|numeric',
            'numeracion' => 'required|string',
            'rarezas_id' => 'array|nullable'
        ]);
        $carta = Carta::findOrFail($id);
        $carta->update([
            'descripcion' => $request->input('descripcion'),
            'condicion' => $request->input('condicion'),
            'cantidad' => $request->input('cantidad'),
            'numeracion' => $request->input('numeracion'),
            'updated_at' => (new Carbon())->now()
        ]);
        $rarezas_id = $request->input('rarezas_id');
        $this->storeRarezas($rarezas_id, $carta->id);

        return response($carta, 201);
    }
    public function destroy($id)
    {
        $rarezas = RarezaCartaSticker::where('carta_id', $id)->delete();
        $carta = Carta::findOrFail($id);
        $carta->delete();
        return response(['message' => 'Carta eliminada'], 200);
    }
    private function storeRarezas($rarezas_id, $carta_id)
    {
        RarezaCartaSticker::where('carta_id', $carta_id)->delete();
        foreach ($rarezas_id as $rareza_id) {
            RarezaCartaSticker::create([
                'carta_id' => $carta_id,
                'rareza_id' => $rareza_id
            ]);
        }
    }
    private function storePropiedadesAdicionales($propiedades, $carta_id)
    {
        PropiedadCartaSticker::where('carta_id', $carta_id)->delete();
        $keys_propiedades = array_keys($propiedades);
        for ($i=0; $i < count($keys_propiedades); $i++) {
            PropiedadCartaSticker::create([
                'propiedades_adicionales_id' => $keys_propiedades[$i],
                'carta_id' => $carta_id,
                'value' => $propiedades[$keys_propiedades[$i]]
            ]);
        }
    }
}
