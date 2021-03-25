<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function register()
    {
        return view('pages.register');
    }

    public function questions()
    {
        return view('pages.questions');
    }

    public function viewQuestion($code)
    {
        $question = Question::where('code', $code)->with('polls')->first();
        if($question->status != 'archived') {
            return view('pages.view_question', [
                'question' => $question
            ]);
        }else {
            abort(404);
        }
    }
}
