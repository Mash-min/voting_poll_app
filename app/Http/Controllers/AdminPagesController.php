<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;

class AdminPagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function questionList()
    {
        $questions = Question::orderBy('created_at', 'DESC')->get();
        return view('admin.question.list', [
            'questions' => $questions
        ]);
    }

    public function questionAdd()
    {
        return view('admin.question.add');
    }

    public function questionArchive()
    {
        return view('admin.question.archive');
    }
}
