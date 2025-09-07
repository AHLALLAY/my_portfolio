<?php

namespace App\Services;

use App\Repositories\Project_R;

class Project_S
{
    public $project_R;
    public function __construct(Project_R $project_R) { $this->project_R = $project_R; }

    // CRUD
    public function getProjects(){ return $this->project_R->getProjects(); }
    public function getProject($id){ return $this->project_R->getProject($id); }
    public function createProject($project){ return $this->project_R->createProject($project); }
    public function editeProject($projectId, $new_data){ return $this->project_R->editeProject($projectId, $new_data); }
    public function deleteProject($projectId){ return $this->project_R->deleteProject($projectId); }

    // RELATIONS
    public function attachSkills($projectId, $skillIds){ return $this->project_R->attachSkills($projectId, $skillIds); }
    public function detachSkill($projectId, $skillId){ return $this->project_R->detachSkill($projectId, $skillId); }
    public function getProjectSkills($projectId){ return $this->project_R->getProjectSkills($projectId); }

    // STATUS
    public function projectTotal(){ return $this->project_R->projectTotal(); }
    public function projectArchive(){ return $this->project_R->projectArchive(); }
}
