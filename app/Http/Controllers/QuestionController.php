<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index');
    }
    public function fetch_question(Request $request)
    {
        // dd($request->all());
        $req_question = trim($request->question);
        $question = Question::where('question',$req_question)->first();
        if(!$question)
        {
            return response()->json(['status' => false, 'message' => 'Invalid Question'],404);
        }
        return response()->json(['status' => true, 'message' => 'Question found', 'question' => $question],200);
    }
}
