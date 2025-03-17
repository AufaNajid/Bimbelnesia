<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        return response()->json(Score::with(['activity', 'user'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'user_id' => 'required|exists:users,id',
            'score' => 'required|integer|min:0|max:100'
        ]);

        $score = Score::create($request->all());
        return response()->json($score, 201);
    }

    public function show($id)
    {
        return response()->json(Score::with(['activity', 'user'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $score = Score::findOrFail($id);
        $score->update($request->all());
        return response()->json($score);
    }

    public function destroy($id)
    {
        Score::destroy($id);
        return response()->json(['message' => 'Score deleted']);
    }
}
