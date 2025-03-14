<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionPresenceController extends Controller
{
    public function index()
    {
        return response()->json(SessionPresence::with(['activity', 'user'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_id' => 'required|exists:activities,id',
            'user_id' => 'required|exists:users,id',
            'is_present' => 'required|boolean'
        ]);

        $presence = SessionPresence::create($request->all());
        return response()->json($presence, 201);
    }

    public function show($id)
    {
        return response()->json(SessionPresence::with(['activity', 'user'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $presence = SessionPresence::findOrFail($id);
        $presence->update($request->all());
        return response()->json($presence);
    }

    public function destroy($id)
    {
        SessionPresence::destroy($id);
        return response()->json(['message' => 'Session Presence deleted']);
    }
}
