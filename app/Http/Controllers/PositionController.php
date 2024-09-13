<?php

namespace App\Http\Controllers;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    //create
    public function createPosition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions',
            'reports_to' => 'nullable|exists:positions,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $position = Position::create($request->all());
        return response()->json($position, 201);
    }

    //view all
    public function viewAllPosition()
    {
        $position=Position::with('position')->get();
        return response()->json($position);
    }

    //view a position
    public function viewAPosition($id)
    {
        $position=Position::with('positions')->findOrFail($id);
        return response()->json($position);
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $positions = Position::all();
        return view('home', compact('position', 'positions'));
    }

    //update a position
    public function updatePosition(Request $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions,name,' . $id,
            'reports_to' => 'nullable|exists:positions,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $position->update([
            'name' => $request->input('name'),
            'reports_to' => $request->input('reports_to'),
        ]);
    
        return redirect()->route('home')->with('success', 'Position updated successfully!');
    }

    //delete a position
    public function destroyPosition($id)
    {
        $position=Position::findOrFail($id);
        $position->delete();

        return response()->json(null,200);
    }
}
