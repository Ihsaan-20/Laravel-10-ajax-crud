<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index()
    {
        return view('computer.index');
    }
    public function fetchComputers()
    {
        $computers = Computer::latest()->get();
        if($computers)
        {
            return response()->json($computers);
        }else{
            return 'No data found!';
        }
    }

    public function store(Request $request)
    {
        $computer = Computer::updateOrCreate(
            [
            'id'   => $request->input('id'),
            ],
            [
            'name'     => $request->input('name'),
            'model' => $request->input('model'),
            ],
        );

        if ($computer->wasRecentlyCreated) {
            return response()->json(['created' => 'Record created successfully']);
        } else {
            return response()->json(['updated' => 'Record updated successfully']);
        }
    }


    public function edit(Request $request)
    {
        // dd($id);
        $record = Computer::findOrFail($request->id);
        if($record)
        {
            return response()->json($record);
        }else{
            return 'record not found!';
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->all();

        try {
            $flattenedIds = Arr::flatten($ids);
            Computer::whereIn('id', $flattenedIds)->delete();
            return response()->json(['message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting records', 'message' => $e->getMessage()], 500);
        }
    }

}
