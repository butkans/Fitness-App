<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::all();
        return view('workouts.index', compact('workouts'));
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'muscle_group' => 'required|string',
            'rating' => 'required|integer',
            'description' => 'required|string',
        ]);

        $workout = new Workout();
        $workout->date = $request->date;
        $workout->author_id = Auth::id();
        $workout->muscle_group = $request->muscle_group;
        $workout->rating = $request->rating;
        $workout->description = $request->description;
        $workout->save();

        return redirect()->route('workouts.index')->with('success', 'Workout created successfully.');
    }

    public function edit(Workout $workout)
    {
        return view('workouts.edit', compact('workout'));
    }

    public function update(Request $request, Workout $workout)
    {
        $request->validate([
            'date' => 'required|date',
            'muscle_group' => 'required|string',
            'rating' => 'required|integer',
            'description' => 'required|string',
        ]);

        $workout->date = $request->date;
        $workout->muscle_group = $request->muscle_group;
        $workout->rating = $request->rating;
        $workout->description = $request->description;
        $workout->save();

        return redirect()->route('workouts.index')->with('success', 'Workout updated successfully.');
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index')->with('success', 'Workout deleted successfully.');
    }
}
