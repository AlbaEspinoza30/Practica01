<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Entrada::join('evento', 'entrada.evento_id', '=', 'evento.id')
            ->select(
                'entrada.id',
                'entrada.evento_id',
                'evento.nombre as evento_nombre',
                'entrada.pago',
                'entrada.dni'
            )
            ->where('entrada.dni', 'LIKE', '%' . $texto . '%')
            ->orderBy('entrada.id', 'desc')
            ->paginate(10);

        return view('entrada.index', compact(['registros', 'texto']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrada = new Entrada();
        $eventos = DB::table('evento')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return view('entrada.action', compact('entrada', 'eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:evento,id',
            'pago' => 'required|numeric',
            'dni' => 'required|string|max:20',
        ]);

        $registro = new Entrada();
        $registro->evento_id = $request->input('evento_id');
        $registro->pago = $request->input('pago');
        $registro->dni = $request->input('dni');
        $registro->save();

        return redirect()->route('entrada.index')->with('mensaje', 'Registro creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        $eventos = DB::table('evento')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return view('entrada.action', compact(['entrada', 'eventos']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $registro = Entrada::findOrFail($id);

        $request->validate([
            'evento_id' => 'exists:evento,id',
            'pago' => 'numeric',
            'dni' => 'string|max:20',
        ]);

        $registro->evento_id = $request->input('evento_id');
        $registro->pago = $request->input('pago');
        $registro->dni = $request->input('dni');
        $registro->save();

        return redirect()->route('entrada.index')->with('mensaje', 'Registro actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = Entrada::findOrFail($id);
        $registro->delete();
        return redirect()->route('entrada.index')->with('mensaje', 'Registro eliminado correctamente.');
    }
}
