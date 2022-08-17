<?php

namespace App\Providers;

use App\Repositories\Interface\StudentPepositoryInterface;
use App\Repositories\Interface\TeacherRepositoryInterface;
use App\Repositories\Repository\StudentPepository;
use App\Repositories\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );

        $this->app->bind(
            StudentPepositoryInterface::class,
            StudentPepository::class
        );
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