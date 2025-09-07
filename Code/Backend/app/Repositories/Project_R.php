<?php

namespace App\Repositories;
use App\Interfaces\Project_I;
use App\Models\Project;

class Project_R implements Project_I
{
    // CRUD
    public function getProjects(){
        try{
            return Project::with('skills')->orderBy('start_date', 'desc')->get();
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function getProject($id){
        try{
            return Project::with('skills')->findOrFail($id);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function createProject($project){
        try{
            return Project::create($project);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function editeProject($projectId, $new_data){
        try{
            $project = Project::findOrFail($projectId);
            $project->update($new_data);
            return $project->load('skills');
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function deleteProject($projectId){
        try{
            $project = Project::findOrFail($projectId);
            if($project){
                return $project->delete();
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    // RELATIONS
    public function attachSkills($projectId, $skillIds){
        try{
            $project = Project::findOrFail($projectId);
            $project->skills()->sync($skillIds);
            return $project->load('skills');
        }catch(\Exception $e){
            throw $e;
        }
    }
    
    public function detachSkill($projectId, $skillId){
        try{
            $project = Project::findOrFail($projectId);
            $project->skills()->detach($skillId);
            return $project->load('skills');
        }catch(\Exception $e){
            throw $e;
        }
    }
    
    public function getProjectSkills($projectId){
        try{
            $project = Project::findOrFail($projectId);
            return $project->skills;
        }catch(\Exception $e){
            throw $e;
        }
    }

    // STATUS
    public function projectTotal(){
        try{
            return Project::all()->count();
        }catch(\Exception $e){
            throw $e;
        }
    }
}
