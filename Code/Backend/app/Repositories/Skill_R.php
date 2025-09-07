<?php

namespace App\Repositories;
use App\Interfaces\Skill_I;
use App\Models\Skill;

class Skill_R implements Skill_I
{
    // CRUD
    public function getSkills(){
        try{
            return Skill::all();
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function getSkill($skillId){
        try{
            return Skill::findOrFail($skillId);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function createSkill($skill){
        try{
            return Skill::create($skill);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function editeSkill($skillId, $new_skill){}
    public function deleteSkill($skillId){
        try{
            $skill = Skill::findOrFail($skillId);
            if($skill){
                return $skill->delete();
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    // STATS
    public function skillTotal(){
        try{
            return Skill::all()->count();
        }catch(\Exception $e){
            throw $e;
        }
    }
}
