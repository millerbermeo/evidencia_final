<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesore;

class ProfesoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $profesor = Profesore::all();

            return response()->json($profesor, 200);        } catch (\Exception $e) {
        }catch (\Exception $e) {
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
                'areaEspecializacion' => 'required'
            ]);


            $profesor = Profesore::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'areaEspecializacion' => $request->areaEspecializacion
            ]);

            return response()->json($profesor, 201);
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
            $profesor = Profesore::find($id);
    
            if ($profesor) {
                return response()->json($profesor, 200);
            } else {
                return response()->json(["error" => "Profesor no encontrada"], 404);
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
            $profesor = Profesore::findOrFail($id)->update($request->all());
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

            $profesor = Profesore::findOrFail($id);
            $profesor->delete();
    
            return response()->json(['mensaje' => 'Profesor eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
