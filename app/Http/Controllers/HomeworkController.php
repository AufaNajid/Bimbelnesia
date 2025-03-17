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
            $homework->sesi_id = $validatedData['nama_lokasi'];
            $homework->user_id = $validatedData['desc_lokasi'];
            $homework->title = $validatedData['title'];
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
        $homework->update($request->all());
        return response()->json($homework);
    }

    public function destroy($id)
    {
        Homework::destroy($id);
        return response()->json(['message' => 'Homework deleted']);
    }
}
