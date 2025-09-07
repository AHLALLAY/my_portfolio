<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'homepage_url'];

    public function skills(){ return $this->belongsToMany(Skill::class, 'project_skills'); }
}
