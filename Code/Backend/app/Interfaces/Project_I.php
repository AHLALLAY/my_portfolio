<?php

namespace App\Interfaces;

interface Project_I
{
    // CRUD
    public function getProjects();
    public function getProject($id);
    public function createProject($project);
    public function editeProject($projectId, $new_data);
    public function deleteProject($projectId);

    // STATS
    public function projectTotal();
    public function projectArchive();
}
