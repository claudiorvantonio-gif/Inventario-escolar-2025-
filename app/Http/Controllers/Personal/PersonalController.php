<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Imports\PersonalImport;
use App\Models\Cargo;
use App\Models\Personal;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\select;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personales = Personal::with([
            'cargo:id,nombre', // Incluye solo el ID y el nombre del cargo
            'sala:id,nombre'   // Incluye solo el ID y el nombre de la sala
        ])->get();

        // $cargos_personal =  DB::table('personals')
        //     ->crossJoin('cargos')
        //     ->select('cargos.id', 'cargos.nombre')
        //     ->where('personals.cargos_id', '=', DB::raw('cargos.id'))
        //     ->get();

        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->simplePaginate(5);

        $cargos = DB::table('cargos')
            ->select('*')
            ->where('estado', '=', 1)->get();


        $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=', 1)->get();


        $personales = DB::table('personals')
            ->join('cargos', 'personals.cargos_id', '=', 'cargos.id')  // Join con la tabla cargos
            ->join('salas', 'personals.salas_id', '=', 'salas.id')     // Join con la tabla salas
            ->select('personals.id', 'personals.nombres', 'personals.apellidos', 'personals.estado', 'cargos.nombre as cargo_nombre', 'salas.nombre as sala_nombre')  // Seleccionamos los campos necesarios
            ->get();

        return view('personal.personal', compact('personales', 'cargos', 'salas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cargo' => 'required',
            'sala' => 'required',
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Error al crear el personal!');
        } else {
            Personal::create([
                'nombres'       => $request->input('nombres'),
                'apellidos'   => $request->input('apellidos'),
                'cargos_id' => $request->input('cargo'),
                'salas_id' => $request->input('sala')
            ]);

            return redirect()->back()->with('success', '¡personal creado con éxito!');
        }
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new PersonalImport, $file);

        return redirect('Personal');
    }

    public function edit(string $id)
    {

        $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=', 1)->get();

        $cargos = DB::table('cargos')
            ->select('*')
            ->where('estado', '=', 1)->get();

        $personal =    DB::table('personals')
            ->select('*')
            ->where('personals.id', '=', $id)
            ->get();

        return view('personal.edit', compact('personal', 'cargos', 'salas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $personal = Personal::findOrFail($id);
        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->cargos_id = $request->cargo;
        $personal->categorias_id = $request->categorias;
        $personal->estado = $request->estado;

        $personal->save();
        // Redirigir con un mensaje de éxito
        return redirect()->route('Personal')->with('success', 'Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function cargo(Request $request)
    {
        $validated = $request->validate([
            'cargo_nuevo' => 'required',
            'tipo_cargo' => 'required'
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Cargo creado con éxito!');
        } else {
            Cargo::create([
                'nombre' => $request->input('cargo_nuevo'),
                'tipo_cargo' => $request->input('tipo_cargo')
            ]);

            return redirect()->back()->with('success', '¡Cargo creado con éxito!');
        }
    }
}
