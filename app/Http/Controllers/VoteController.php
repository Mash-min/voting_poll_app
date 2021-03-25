<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Question;
use App\Models\Poll;

class VoteController extends Controller
{
    public function create(Request $request)
    {
        $question = Question::where('code', $request->question_code)->first();
        if(!auth()->user()->alreadyVoteHere($question->id)) {
            $vote = auth()->user()->votes()->create($request->except('question_id') + 
                ['question_id' => $question->id]
            );
            return response()->json([
                'vote' => $vote,
                'question' => $vote->question()->first()
            ]);
        } else {
            return response()->json(['message' => 'You already vote in this Question.'],403);
        }
    }
}
