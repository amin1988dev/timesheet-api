<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;

Route::get('/timesheets', [TimesheetController::class, 'index']);
Route::post('/timesheets', [TimesheetController::class, 'store']);
Route::put('/timesheets/{id}', [TimesheetController::class, 'update']); 

