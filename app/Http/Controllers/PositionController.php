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

        $position->update($request->all());
        return response()->json($position);
    }

    //delete a position
    public function destroyPosition($id)
    {
        $position=Position::findOrFail($id);
        $position->delete();

        return response()->json(null,0);
    }

    //search
    public function searchPosition(Request $request)
    {
        $query = Position::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $positions = $query->orderBy('name')->get();
        
        return response()->json($positions);
    }
}
