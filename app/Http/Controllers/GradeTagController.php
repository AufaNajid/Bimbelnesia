<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeTagController extends Controller
{
    public function index()
    {
        return response()->json(GradeTag::all());
    }

    public function show($id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
