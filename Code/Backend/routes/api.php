<?php

use App\Http\Controllers\Api\Project_C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::controller(Project_C::class)->group(function(){
    // CRUD
    Route::get('/projects', 'getProjects');
    Route::get('/project/{id}', 'getProject');
    Route::post('/projects', 'createProject');
    Route::put('/project/{id}', 'editeProject');
    Route::delete('/project/{id}', 'deleteProjects');
    
    // STATS
    Route::get('/projects/total', 'projectTotal');
    Route::get('/projects/archive/total', 'projectArchive');
});