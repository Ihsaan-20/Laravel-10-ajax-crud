<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs =  Program::get();
        dd($programs[1]['details'], json_decode($programs[1]['details']));
        // $decode = [];
        // foreach ($programs as $key => $program)
        // {
        //     $decode = json_decode($program->details);
        // }
        // dd($decode);
        return view('file.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->workouts;

        $program = new Program();
        
        if ($request->hasFile('program_file')) {
            $file = $request->file('program_file');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('program_files', $fileName);
            $program->program_file = $path;
        }
        
        $program->program_name = $request->input('program_name', null);
        
        $workouts = [];

        // Process workouts if provided
        foreach ($data as $workoutData) {
            $workout = [];
            
            // Store workout file if provided
            if (isset($workoutData['file']) && $workoutData['file'] instanceof \Illuminate\Http\UploadedFile) {
                $file = $workoutData['file'];
                $fileName = $file->getClientOriginalName();
                $path = $file->storeAs('workouts_files', $fileName);
                $workout['file'] = $path; // Fixed
            }

            $workout['name'] = $workoutData['name'];
            $workout['sets'] = [];

            foreach($workoutData['sets'] as $setData)
            {
                $set = [];
                if (isset($setData['file']) && $setData['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $setData['file'];
                    $fileName = $file->getClientOriginalName();
                    $path = $file->storeAs('sets_files', $fileName);
                    $set['file'] = $path; // Fixed
                }

                $set['name'] = $setData['name'];
                $set['exercises'] = [];

                foreach($setData['exercises'] as $exerciseData)
                {
                    $exercise = [];
                    if (isset($exerciseData['file']) && $exerciseData['file'] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $exerciseData['file'];
                        $fileName = $file->getClientOriginalName();
                        $path = $file->storeAs('exercises_files', $fileName);
                        $exercise['file'] = $path; // Fixed
                    }
                    $exercise['name'] = $exerciseData['name'];
                    $set['exercises'][] = $exercise; // Changed to append to array
                }
                $workout['sets'][] = $set; // Changed to append to array
            }
            $workouts[] = $workout; // Changed to append to array
        }
        
        $program->details = json_encode(['workouts' => $workouts]);
        $program->save();
        return response()->json(['message' => 'Program uploaded successfully']);
    }

//     $data = [];
//     $data = $request->all();
    
//     // dd($data['workouts'][0]['file']); // workouts video files path;
//     // dd($data['workouts'][0]['sets'][0]['file']); // workouts > sets files path;
//     // dd($data['workouts'][0]['sets'][0]['exercises'][0]['file']); // workouts > sets > exercises files path;
//     dd($data);




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        return $program;
        // return view('file.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->workouts;
        $program = Program::findOrFail($id);
        
        if ($request->hasFile('program_file')) {
            $program->program_file = $request->file('program_file')->store('program_files');
        }
        
        $program->program_name = $request->input('program_name', null);
        
        $workouts = [];

        foreach ($data as $workoutData) {
            $workout = [];
            
            if (isset($workoutData['file']) && $workoutData['file'] instanceof \Illuminate\Http\UploadedFile) {
                $workout['file'] = $workoutData['file']->store('workouts_files');
            }

            $workout['name'] = $workoutData['name'];
            $workout['sets'] = [];

            foreach($workoutData['sets'] as $setData)
            {
                $set = [];
                if (isset($setData['file']) && $setData['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $set['file'] = $setData['file']->store('sets_files');
                }

                $set['name'] = $setData['name'];
                $set['exercises'] = [];

                foreach($setData['exercises'] as $exerciseData)
                {
                    $exercise = [];
                    if (isset($exerciseData['file']) && $exerciseData['file'] instanceof \Illuminate\Http\UploadedFile) {
                        $exercise['file'] = $exerciseData['file']->store('exercises_files');
                    }
                    $exercise['name'] = $exerciseData['name'];
                    $set['exercises'][] = $exercise;
                }
                $workout['sets'][] = $set;
            }
            $workouts[] = $workout;
        }
        
        $program->details = json_encode(['workouts' => $workouts]);
        $program->save();
        return response()->json(['message' => 'Program updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
