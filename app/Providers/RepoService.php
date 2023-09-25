<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository');
        $this->app->bind(
            'App\Repository\StudentsRepositoryInterface',
            'App\Repository\StudentsRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
