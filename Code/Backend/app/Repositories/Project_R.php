<?php

namespace App\Repositories;
use App\Interfaces\Project_I;

class Project_R implements Project_I
{
    // CRUD
    public function getProjects(){}
    public function getProject($id){}
    public function createProject($project){}
    public function editeProject($projectId){}
    public function deleteProject($projectId){}

    // STATUS
    public function projectTotal(){}
    public function projectArchive(){}
}
