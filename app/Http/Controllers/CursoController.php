<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $curso = Curso::all();

            return response()->json($curso, 200);
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
                'nombreCurso'=> 'required',
                'codigoCurso' => 'required',
                'idProfesor' => 'required',
            ]);


            $curso = Curso::create([
                'nombreCurso' => $request->nombreCurso,
                'codigoCurso' => $request->codigoCurso,
                'idProfesor' => $request->idProfesor
            ]);

            return response()->json($curso, 201);
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
            $curso = Curso::find($id);
    
            if ($curso) {
                return response()->json($curso, 200);
            } else {
                return response()->json(["error" => "Curso no encontrada"], 404);
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
            $curso = Curso::findOrFail($id)->update($request->all());
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

            $curso = Curso::findOrFail($id);
            $curso->delete();
    
            return response()->json(['mensaje' => 'Curso eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
