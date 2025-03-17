<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Gradeschedule::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,grade_id',
            'repeat_at' => 'required|date',
        ]);

        $schedule = GradeSchedule::create($request->all());
        return response()->json($schedule, 201);
    }

    public function show($id)
    {
        return response()->json(Gradeschedule::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $schedule = Gradeschedule::findOrFail($id);
        $schedule->update($request->all());

        return response()->json($schedule);
    }

    public function destroy($id)
    {
        Gradeschedule::destroy($id);
        return response()->json(['message' => 'Grade schedule deleted']);
    }
}
