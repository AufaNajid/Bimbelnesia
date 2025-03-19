<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index()
    {
        return response()->json(Homework::with(['activity', 'user'])->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sesi_id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'status' => 'required|in:initialized,finished,corrected'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $homework = new Homework();
        $homework->sesi_id = $validatedData['sesi_id'];
        $homework->user_id = $user->id;
        $homework->title = $validatedData['title'];
        $homework->due_date = $validatedData['due_date'];
        $homework->status = $validatedData['status']; 
        $homework->save();  

            return response()->json(['message' => 'Homework added successfully'], 200);
    }

    public function show($id)
    {
        return response()->json(Homework::with(['activity', 'user'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $homework = Homework::findOrFail($id);

        $validatedData = $request->validate([
            'sesi_id' => 'sometimes|exists:activities,id',
            'title' => 'sometimes|string|max:255',
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|in:initialized,finished,corrected'
        ]);

        $homework->update($validatedData);

        return response()->json(['message' => 'Homework updated successfully', 'data' => $homework], 200);
    }
    public function destroy($id)
    {
        Homework::destroy($id);
        return response()->json(['message' => 'Homework deleted']);
    }
}
