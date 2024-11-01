<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return Timesheet::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'hours' => 'required|integer',
        ]);
    
        $existingTimesheet = Timesheet::where('date', $request->date)->first();

        if ($existingTimesheet) {
            
            $existingTimesheet->hours = $request->hours;
            $existingTimesheet->save();
            return response()->json(['message' => 'Record aggiornato con successo', 'timesheet' => $existingTimesheet], 200);
        }

        $newTimesheet = Timesheet::create($request->all()); // Crea un nuovo record se non esiste
        return response()->json(['message' => 'Record creato con successo', 'timesheet' => $newTimesheet], 201);
    }

    public function update(Request $request, $id)
    {
        $content = json_decode($request->input('content'), true);

        $request->validate([
            'date' => 'required|date',
            'hours' => 'required|integer',
        ]);

        $timesheet = Timesheet::find($id);

        if ($timesheet) {
            $timesheet->hours = $request->hours;
            $timesheet->save();
            return response()->json(['message' => 'Record aggiornato con successo', 'timesheet' => $timesheet], 200);
        }

        return response()->json(['message' => 'Record non trovato'], 404);
    }
    
}
