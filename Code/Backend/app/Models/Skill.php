<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'type', 'start_date', 'end_date', 'is_certified', 'certification_date'];

    public function projects(){ return $this->belongsToMany(Project::class, 'project_skills'); }
}
