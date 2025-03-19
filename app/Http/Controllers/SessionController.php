<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return response()->json(Session::with(['schedule', 'study', 'teacher'])->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'schedule_id' => 'required|exists:grade_schedules,id',
            'study_id' => 'required|exists:studies,id',
            'teacher_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required|string'
        ]);
    
        // Cek apakah teacher_id valid
        $teacher = User::find($validatedData['teacher_id']);
        if (!$teacher) {
            return response()->json(['message' => 'Invalid teacher ID'], 404);
        }
    
        // Cek apakah schedule_id valid
        $schedule = GradeSchedule::find($validatedData['schedule_id']);
        if (!$schedule) {
            return response()->json(['message' => 'Invalid schedule ID'], 404);
        }
    
        $session = new Session();
        $session->schedule_id = $schedule;
        $session->study_id = $validatedData['study_id'];
        $session->teacher_id = $teacher;
        $session->date = $validatedData['date'];
        $session->time = $validatedData['time'];
        $session->save();
    
        return response()->json([
            'message' => 'Session added successfully',
            'data' => $session
        ], 201);
    }
    
    public function show($id)
    {
        return response()->json(Session::with(['schedule', 'study', 'teacher'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        $session->update($request->all());
        return response()->json($session);
    }

    public function destroy($id)
    {
        Session::destroy($id);
        return response()->json(['message' => 'Session deleted']);
    }
}
