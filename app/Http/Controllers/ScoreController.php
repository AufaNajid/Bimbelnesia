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
        $validatedData = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'user_id' => 'required|exists:users,id',
            'score' => 'required|integer|min:0|max:100'
        ]);
    
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    
        $score = new Score();
        $score->activity_id = $validatedData['activity_id'];
        $score->user_id = $validatedData['user_id'];
        $score->score = $validatedData['score'];
        $score->save();
    
        return response()->json(['message' => 'Score added successfully', 'data' => $score], 201);
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
