<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $user = Auth::user();

            if ($user->rol == 'estudiante') {
                return response()->json([
                    'mensaje' => 'usuario no autorizado"'
                ], 401);
            }


            $matriculas = Matricula::join('estudiantes', 'matriculas.idEstudiante', '=', 'estudiantes.idEstudiante')
            ->join('cursos', 'matriculas.idCurso', '=', 'cursos.idCurso')
            ->select('matriculas.*', 'estudiantes.nombre as nombreEstudiante', 'cursos.nombreCurso')
            ->get();

        return view('home', ['matriculas' => $matriculas]);
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
                'idEstudiante'=> 'required',
                'idCurso' => 'required',
                'fechaMatriculacion' => 'required',
                'calificacion' => 'required'
            ]);


            $matricula = Matricula::create([
                'idEstudiante' => $request->idEstudiante,
                'idCurso' => $request->idCurso,
                'fechaMatriculacion' => $request->fechaMatriculacion,
                'calificacion' => $request->calificacion
            ]);

            return response()->json($matricula, 201);
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
            $matricula = Matricula::join('estudiantes', 'matriculas.idEstudiante', '=', 'estudiantes.idEstudiante')
                ->join('cursos', 'matriculas.idCurso', '=', 'cursos.idCurso')
                ->select('matriculas.*', 'estudiantes.nombre as nombreEstudiante', 'cursos.nombreCurso')
                ->where('matriculas.idMatricula', '=', $id)
                ->first();
    
            if ($matricula) {
                return response()->json($matricula, 200);
            } else {
                return response()->json(["error" => "Matrícula no encontrada"], 404);
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
            $matricula = Matricula::findOrFail($id)->update($request->all());
            return response()->json(["mensaje" => "actualizado"], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idMatricula)
    {
        try {
            // Lógica para eliminar el registro con $idMatricula
            $matricula = Matricula::findOrFail($idMatricula);
            $matricula->delete();
    
            return response()->json(['mensaje' => 'Matrícula eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
    
}
