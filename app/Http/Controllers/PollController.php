<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PollController extends Controller
{
    //

    public function realizarEncuesta (Request $request) {

        $validator = Validator::make($request->all(), [
            'question_1' => 'required',
            'question_2' => 'required',
            'question_3' => 'required',
            'question_4' => 'required',
            'question_5' => 'required',
            'average' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error, no se pudo realizar la encuesta'
            ]);
        }

        $poll = Poll::create($validator->validated());

        return response()->json([
            'mensaje' => 'Encuesta creada correctamente',
            'encuesta' => $poll
        ]);

    }

    public function obtenerEncuesta () {

        $poll = Poll::with(['user'])->get();
        return response()->json($poll);
    }

}
