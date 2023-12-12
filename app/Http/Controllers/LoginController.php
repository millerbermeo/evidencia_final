<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return view('/');
        }
    
        $user = Auth::user();
    
        $token = $user->createToken('token')->plainTextToken;
    
        $response = [
            'id' => $user->id,
            'email' => $user->email,
            'token' => $token,
            'rol' => $user->rol
        ];
        

        if ($user->rol == 'administrador') {
            return redirect()->route('home')->with('response', $response);
        } elseif ($user->rol == 'profesor') {
            return redirect()->route('profesor')->with('response', json_encode($response));
        } else {
            return redirect()->route('estudiante')->with('response', json_encode($response));
        }
    }
    

    public function logout(Request $request)

    {
        try {
            $user = $request->user();

        $user -> currentAccessToken()->delete();

        return response()->json([
            'mensaje' => 'cierre de sesión correcto'
        ], 200);
        } catch (\Exception $e) {
            
        return response()->json([
            'mensaje' => 'información no procesada'
        ], 200);
        }
    }
}