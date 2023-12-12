<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $estudiantes = Estudiante::all();
    
            // Pass the data to the view using an associative array
            return view('estudiante', ['estudiantes' => $estudiantes]);
    
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'nombre'=> 'required',
                'apellido' => 'required',
                'email' => 'required',
                'fechaNacimiento' => 'required'
            ]);


            $estudiante = Estudiante::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'fechaNacimiento' => $request->fechaNacimiento
            ]);

            return response()->json($estudiante, 201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
            try {
                $estudiante = Estudiante::find($id);
        
                if ($estudiante) {
                    return response()->json($estudiante, 200);
                } else {
                    return response()->json(["error" => "Estudiante no encontrada"], 404);
                }
            } catch (\Exception $e) {
                return response()->json(["error" => $e->getMessage()], 500);
            }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $estudiante = Estudiante::findOrFail($id)->update($request->all());
            return response()->json(["mensaje" => "actualizado"], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $estudiante = Estudiante::findOrFail($id);
            $estudiante->delete();
    
            return response()->json(['mensaje' => 'Estudiante eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
