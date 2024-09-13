<?php

namespace App\Http\Controllers;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function createPosition(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|unique',
            'reports_to' => 'nullable|exists:positions,id',
        ]);

        $position = Position::create($request->validate);
        return response()->json($position, 201);
    }
}
