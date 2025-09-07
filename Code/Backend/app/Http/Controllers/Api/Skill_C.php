<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Services\Skill_S;
use Illuminate\Validation\ValidationException;

class Skill_C extends Controller
{
    protected $skill_S;
    public function __construct(Skill_S $skill_S){ $this->skill_S = $skill_S; }

    // CRUD
    public function getSkills(){
        try{
            $skills = $this->skill_S->getSkills();
            if ($skills){
                return response()->json([
                    'message' => 'Skills Found',
                    'skills' => $skills,
                    'status' => 'success'
                ],200);
            }else{
                return response()->json([
                    'message' => 'Skills Found',
                    'Skills' => 'no data found',
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
    public function getSkill($skillId){
        try{ 
            $skill = $this->skill_S->getSkill($skillId);
            if($skill){
                return response()->json([
                    'message' => 'Skill found',
                    'skill' => $skill,
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
    public function createSkill(SkillRequest $skill){
        try{
            $created_skill =  $this->skill_S->createSkill($skill->validated());
            if($created_skill){
                return response()->json([
                    'message' => 'Skill created with succive',
                    'skill' => $created_skill,
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
    public function editeSkill($skillId){
        try{ 
            $skill = $this->skill_S->editeSkill($skillId);
            if($skill){
                return response()->json([
                    'message' => 'Skill Modified',
                    'skill' => $skill,
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
    public function deleteSkill($skillId){
        try{
            $skill = $this->skill_S->deleteSkill($skillId);
            if($skill){
                return response()->json([
                    'message' => 'Skill deleted',
                    'skill' => $skill,
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

    // STATS
    public function skillTotal(){
        try{
            $total = $this->skill_S->skillTotal();
            return response()->json([
                'message' => 'Skills Total Counted',
                'skill total' => $total,
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
