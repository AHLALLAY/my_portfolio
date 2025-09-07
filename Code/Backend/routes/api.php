<?php

use App\Http\Controllers\Api\Project_C;
use App\Http\Controllers\Api\Skill_C;
use App\Http\Controllers\Api\User_C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Skill;


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

// ===== ROUTES PUBLIQUES (sans authentification) =====
// Ces routes sont accessibles à tous les visiteurs
Route::prefix('public')->group(function(){
    Route::get('/projects', [Project_C::class, 'getProjects']);
    Route::get('/project/{id}', [Project_C::class, 'getProject']);
    Route::get('/skills', [Skill_C::class, 'getSkills']);
    Route::get('/skill/{id}', [Skill_C::class, 'getSkill']);
});

// ===== ROUTES ADMIN (avec authentification) =====
// Ces routes nécessitent une authentification
Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    // Routes de gestion des projets
    Route::post('/projects', [Project_C::class, 'createProject']);
    Route::put('/project/{id}', [Project_C::class, 'editeProject']);
    Route::delete('/project/{id}', [Project_C::class, 'deleteProject']);
    Route::post('/project/{id}/skills', [Project_C::class, 'attachSkills']);
    Route::delete('/project/{id}/skills/{skillId}', [Project_C::class, 'detachSkill']);
    
    // Routes de gestion des compétences
    Route::post('/skills', [Skill_C::class, 'createSkill']);
    Route::put('/skill/{id}', [Skill_C::class, 'editeSkill']);
    Route::delete('/skill/{id}', [Skill_C::class, 'deleteSkill']);
    
    // Statistiques admin
    Route::get('/stats', function(){
        return response()->json([
            'projects_total' => Project::count(),
            'skills_total' => Skill::count(),
            'status' => 'success'
        ]);
    });
});

// ===== AUTHENTIFICATION =====
Route::prefix('auth')->group(function(){
    // Routes publiques d'authentification
    Route::post('/login', [User_C::class, 'login']);
    Route::post('/register', [User_C::class, 'register']);
    
    // Routes protégées d'authentification
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout', [User_C::class, 'logout']);
        Route::post('/refresh', [User_C::class, 'refresh']);
        Route::get('/me', [User_C::class, 'me']);
    });
});

// ===== GESTION UTILISATEURS =====
Route::prefix('users')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [User_C::class, 'getAllUsers']);
    Route::get('/{id}', [User_C::class, 'getUser']);
    Route::put('/{id}', [User_C::class, 'updateUser']);
    Route::delete('/{id}', [User_C::class, 'deleteUser']);
});

// ===== ROUTE SECRÈTE ADMIN =====
Route::post('/admin/access', function(Request $request){
    $secretCode = $request->input('secret_code');
    $adminCode = env('ADMIN_SECRET_CODE', 'portfolio2024');
    
    if ($secretCode === $adminCode) {
        return response()->json([
            'message' => 'Accès admin autorisé',
            'admin_interface' => true,
            'status' => 'success'
        ]);
    }
    
    return response()->json([
        'message' => 'Code d\'accès incorrect',
        'status' => 'failed'
    ], 401);
});