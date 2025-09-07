<?php

use App\Http\Controllers\Api\Project_C;
use App\Http\Controllers\Api\Skill_C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::controller(Project_C::class)->group(function(){
    // CRUD
    Route::get('/projects', 'getProjects');
    Route::get('/project/{id}', 'getProject');
    Route::post('/projects', 'createProject');
    Route::put('/project/{id}', 'editeProject');
    Route::delete('/project/{id}', 'deleteProject');
    
    // RELATIONS
    Route::post('/project/{id}/skills', 'attachSkills');
    Route::delete('/project/{id}/skills/{skillId}', 'detachSkill');
    Route::get('/project/{id}/skills', 'getProjectSkills');
    
    // STATS
    Route::get('/projects/total', 'projectTotal');
});

Route::controller(Skill_C::class)->group(function(){
    // CRUD
    Route::get('/skills', 'getSkills');
    Route::get('/skill/{id}', 'getSkill');
    Route::post('/skills', 'createSkill');
    Route::put('/skill/{id}', 'editeSkill');
    Route::delete('/skill/{id}', 'deleteSkill');
    
    // STATS
    Route::get('/skills/total', 'skillTotal');
});