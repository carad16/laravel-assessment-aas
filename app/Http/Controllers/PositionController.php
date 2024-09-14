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
        ])->after(function ($validator) use ($request) {
            if ($request->reports_to === null && Position::whereNull('reports_to')->exists()) {
                $validator->errors()->add('reports_to', 'Only the CEO will report to nobody.');
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $position = Position::create($request->all());
        return redirect()->route('home')->with($position, 'Position created successfully!');
    }

    //view all
    public function viewAllPosition()
    {
        $position=Position::with('reportsTo')->get();
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
        ])->after(function ($validator) use ($request) {
            if ($request->reports_to === null && Position::whereNull('reports_to')->exists()) {
                $validator->errors()->add('reports_to', 'Only the CEO will report to nobody.');
            }
        });
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $position->update($request->all());
        $position->load('reportsTo');
    
        return response()->json([
            'id' => $position->id,
            'name' => $position->name,
            'reports_to' => $position->reportsTo ? $position->reportsTo->name : null, 
        ]);
    }

    //delete a position
    public function destroyPosition($id)
    {
        $position=Position::findOrFail($id);
        $position->delete();

        return redirect()->back();
    }

    public function viewOrganizationChart()
    {
        $positions = Position::all();
        $chartData = [];

        foreach ($positions as $position) {
            $supervisor = $position->reportsTo ? $position->reportsTo->name : null;
            $chartData[] = [$position->name, $supervisor];
        }

        return response()->json($chartData);
    }
}
