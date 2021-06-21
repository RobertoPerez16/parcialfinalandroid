<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
           'nombre' => 'required|string|between:4,100',
           'identificacion' => 'required|string|max:11',
           'apellido' => 'required|string|between:4,100',
           'email' => 'sometimes|required|email|',
           'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $user = User::where('identificacion', $request->get('identificacion'))->get();

        if (sizeof($user) != 0) {
            return response()->json([
                'mensaje' => 'Este usuario ya se encuentra registrado'
            ], 400);
        }

        $user_created = User::create($validator->validated());
        return response()->json([
            'mensaje' => 'Usuario registrado correctamente',
            'usuario_creado' => $user_created
        ], 201);
    }

    public function login (Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|required|email|',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->get('email'))->first();

        if (empty($user)) {
            return response()->json([
                'mensaje' => 'Este usuario o no está registrado, o no existe, por favor regístrese'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Datos correctos!',
            'usuario_logueado' => $user
        ]);

    }

    public function completarDatos (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|required|email|',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'estado_civil' => 'required|string',
            'estrato' => 'required|string',
            'profesion' => 'required|string',
            'cargo' => 'required|string',
            'nivel_estudio' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Todos los campos son requeridos'
            ], 400);
        }

        $user = User::where('email',$request->get('email'))->first();

        if (empty($user)) {
            return response()->json([
                'mensaje' => 'Error al completar datos'
            ], 404);
        }

        $user->telefono = $request->get('telefono');
        $user->direccion = $request->get('direccion');
        $user->estado_civil = $request->get('estado_civil');
        $user->estrato = $request->get('estrato');
        $user->profesion = $request->get('profesion');
        $user->cargo = $request->get('cargo');
        $user->nivel_estudio = $request->get('nivel_estudio');

        $user->save();

        return response()->json([
            'mensaje' => 'Datos completados correctamente',
            'user' => $user
        ]);
    }

}
