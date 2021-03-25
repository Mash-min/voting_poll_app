<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class QuestionController extends Controller
{
    public function create(Request $request)
    {
        $question = auth()->user()->questions()->create($request->except('code') + [
            'code' => "".rand().auth()->user()->id."".time()
        ]);
        if($request->has('poll')) {
            foreach($request->poll as $poll) {
                $poll = $question->polls()->create(['poll' => $poll]);
            }
        }
        return response()->json([
            'question' => $question,
            'polls' => $question->polls()->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());
        $question->polls()->delete();
        foreach($request->poll as $poll) {
            $poll = $question->polls()->create(['poll' => $poll]);
        }
        return response()->json([
            'question' => $question,
            'polls' => $question->polls()->get()
        ]);
    }

    public function delete($id)
    {
        $question = Question::findOrFail($id)->delete();
    }

    public function archive($id)
    {
        $question = Question::find($id)->update(['status' => 'archived']);
    }

    public function restore($id)
    {
        $question = Question::findOrFail($id)->update(['status' => 'active']);
    }

    public function find($id)
    {
        $question = Question::findOrFail($id);
        return response()->json([
            'question' => $question,
            'polls' => $question->polls()->get()
        ]);
    }
}
