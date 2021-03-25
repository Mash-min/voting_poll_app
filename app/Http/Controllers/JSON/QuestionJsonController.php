<?php

namespace App\Http\Controllers\JSON;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class QuestionJsonController extends Controller
{

    public function questionListJson()
    {
        $questions = Question::orderBy('created_at', 'DESC')
                             ->where('status', 'active')
                             ->with('polls')
                             ->paginate(10);
        return response()->json(['questions' => $questions]);
    }

    public function questionArchiveJson()
    {
        $questions = Question::orderBy('created_at', 'DESC')
                            ->where('status', 'archived')
                            ->with('polls')
                            ->paginate(10);
        return response()->json(['questions' => $questions]);
    }

    public function viewQuestionJSON($code)
    {
        $question = Question::where('code', $code)->with('polls.votes')->first();
        $votes = $question->polls()->withCount('votes')->get();
        $votesCount = $votes->map(function ($item, $key) {
            return $item->votes_count;
        });
        return response()->json([
            'question' => $question,
            'polls' => $question->polls()->orderBy('created_at', 'DESC')->get(),
            'votes' => $votesCount
        ]);
    }

}
