<?php

namespace App\Http\Controllers\Sala;

use App\Http\Controllers\Controller;
use App\Models\Salas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalasController extends Controller
{
    public function index()
    {
        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->get();

        /*  $salas_personal =  DB::table('personals')

            ->crossJoin('salas')
            ->select('salas.personals_id', 'personals.id','personals.nombres')
            ->where('personals.id', '=', DB::raw('salas.personals_id'))
            ->get(); */

        // $salas_personal = DB::table('salas')
        // ->leftJoin('personals', 'salas.id', '=', 'personals.id')
        // ->select('salas.id', 'salas.nombre', 'personals.nombres', 'salas.personals_id')
        // ->get()
        // ->groupBy('sala.id'); // Agrupar por ID de la sala

        $salas = DB::table('salas')
            ->select('*')->get();

        return view('salas.salas', compact('salas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'numero_equipos' => 'required',
            'tipo_sala' => 'required',
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Sala creado con éxito!');
        } else {
            Salas::create([
                'nombre'       => $request->input('nombre'),
                'numero_equipos'   => $request->input('numero_equipos'),
                'tipo_sala'   => $request->input('tipo_sala'),
            ]);

            return redirect()->back()->with('success', '¡Sala creado con éxito!');
        }
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $salas = Salas::findOrFail($id);
        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->get();

        return view('salas.edit', compact('salas'));
    }

    public function update(Request $request, string $id)
    {
        $salas = Salas::findOrFail($id);
        $salas->nombre = $request->nombre;
        $salas->tipo_sala = $request->tipo_sala;
        $salas->estado = $request->estado;
        $salas->save();

        $salas = DB::table('salas')
            ->select('*')->get();

        return view('salas.salas', compact('salas'));
    }
    public function destroy(string $id)
    {
        //
    }
}
