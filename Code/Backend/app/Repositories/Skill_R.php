<?php

namespace App\Repositories;
use App\Interfaces\Skill_I;

class Skill_R implements Skill_I
{
    // CRUD
    public function getSkills(){}
    public function getSkill($skillId){}
    public function createSkill($skill){}
    public function editeSkill($skillId){}
    public function deleteSkill($skillId){}

    // STATS
    public function skillTotal(){}
    public function skillArchive(){}
}
