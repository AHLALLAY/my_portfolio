<?php

namespace App\Repositories;
use App\Interfaces\Project_I;
use App\Models\Project;

class Project_R implements Project_I
{
    // CRUD
    public function getProjects(){
        try{
            return Project::all();
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function getProject($id){
        try{
            return Project::findOrFail($id);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function createProject($project){}
    public function editeProject($projectId){}
    public function deleteProject($projectId){}

    // STATUS
    public function projectTotal(){}
    public function projectArchive(){}
}
