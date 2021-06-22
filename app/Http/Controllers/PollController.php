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

        $poll_search = Poll::where('user_id', $request->get('user_id'))->first();

        if (empty($poll_search)) {
            $poll = Poll::create($validator->validated());
            return response()->json([
                'mensaje' => 'Encuesta creada correctamente',
                'encuesta' => $poll
            ]);
        } else {
            $poll_search->question_1 = $request->get('question_1');
            $poll_search->question_2 = $request->get('question_2');
            $poll_search->question_3 = $request->get('question_3');
            $poll_search->question_4 = $request->get('question_4');
            $poll_search->question_5 = $request->get('question_5');
            $poll_search->average = $request->get('average');
            $poll_search->save();

            return response()->json([
                'mensaje' => 'Usted a actualizado sus respuestas'
            ]);
        }
    }

    public function obtenerEncuesta () {

        $poll = Poll::with(['user'])->get();
        return response()->json($poll);
    }

}
