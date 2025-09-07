<?php

namespace App\Services;

use App\Repositories\Skill_R;

class Skill_S
{
    protected $skill_R;
    public function __construct(Skill_R $skill_R) { $this->skill_R = $skill_R; }

    // CRUD
    public function getSkills(){return $this->skill_R->getSkills() ;}
    public function getSkill($skillId){return $this->skill_R->getSkill($skillId) ;}
    public function createSkill($skill){return $this->skill_R->createSkill($skill) ;}
    public function editeSkill($skillId, $new_skill){return $this->skill_R->editeSkill($skillId, $new_skill) ;}
    public function deleteSkill($skillId){return $this->skill_R->deleteSkill($skillId) ;}

    // STATS
    public function skillTotal(){return $this->skill_R->skillTotal() ;}
    public function skillArchive(){return $this->skill_R->skillArchive() ;}
}
