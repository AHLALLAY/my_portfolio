<?php

namespace App\Interfaces;

interface Skill_I
{
    // CRUD
    public function getSkills();
    public function getSkill($skillId);
    public function createSkill($skill);
    public function editeSkill($skillId, $new_skill);
    public function deleteSkill($skillId);

    // STATS
    public function skillTotal();
}
