<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Services\Project_S;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class Project_C extends Controller
{
    protected $project_S;
    public function __construct(Project_S $project_S){ $this->project_S = $project_S; }

    // CRUD
    public function getProjects(){ 
        try{
            return response()->json([
                'message' => 'Projects Found',
                'project' => $this->project_S->getProjects(),
                'status' => 'success'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }
    public function getProject($id){ 
        try{
            $project = $this->project_S->getProject($id); 
            return response()->json([
                'message' => 'Project found',
                'project' => $project,
                'status' => 'success'
            ],200);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message' => 'Project not found',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],404);            
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }
    public function createProject(ProjectRequest $project){ 
        try{
            $created_project =  $this->project_S->createProject($project->validated());
            if($created_project){
                return response()->json([
                    'message' => 'Project created with succive',
                    'project' => $created_project,
                    'status' => 'success'
                ],201);
            }
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Validation error',
                'error' => $e->errors(),
                'status' => 'failed'
            ],422);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }
    public function editeProject($projectId,ProjectRequest $new_data){ 
        try{ 
            $project = $this->project_S->editeProject($projectId,$new_data->validated());
            if($project){
                return response()->json([
                    'message' => 'Project Modified',
                    'project' => $new_data,
                    'status' => 'success'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }
    public function deleteProject($projectId){ 
        try{
            $project = $this->project_S->deleteProject($projectId);
            if($project){
                return response()->json([
                    'message' => 'Project deleted',
                    'project' => $project,
                    'status' => 'success'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }

    // STATUS
    public function projectTotal(){ 
        try{
            $total = $this->project_S->projectTotal();
            return response()->json([
                'message' => 'Projects Total counted',
                'project total' => $total,
                'status' => 'success'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ],500);
        }
    }
}
