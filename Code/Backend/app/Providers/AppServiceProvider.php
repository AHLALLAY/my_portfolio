<?php

namespace App\Providers;

use App\Interfaces\Project_I;
use App\Interfaces\Skill_I;
use App\Repositories\Project_R;
use App\Repositories\Skill_R;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Project_I::class, Project_R::class);
        $this->app->bind(Skill_I::class, Skill_R::class);
        
    }

    public function boot(): void {}
}
