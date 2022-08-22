<?php

namespace App\Providers;

use App\Repositories\Interface\FeeInvoiceRepositoryInterface;
use App\Repositories\Interface\FeeRepositoryInterface;
use App\Repositories\Interface\ReceiptStudentRepositoryInterface;
use App\Repositories\Interface\StudentGraduatedRepositoryInterface;
use App\Repositories\Interface\StudentPepositoryInterface;
use App\Repositories\Interface\StudentPromotionRepositoryInterface;
use App\Repositories\Interface\TeacherRepositoryInterface;
use App\Repositories\Repository\FeeInvoiceRepository;
use App\Repositories\Repository\FeeRepository;
use App\Repositories\Repository\ReceiptStudentRepository;
use App\Repositories\Repository\StudentGraduatedRepository;
use App\Repositories\Repository\StudentPepository;
use App\Repositories\Repository\StudentPromotionRepository;
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

        $this->app->bind(
            StudentPromotionRepositoryInterface::class,
            StudentPromotionRepository::class
        );

        $this->app->bind(
            StudentGraduatedRepositoryInterface::class,
            StudentGraduatedRepository::class
        );

        $this->app->bind(
            FeeRepositoryInterface::class,
            FeeRepository::class
        );

        $this->app->bind(
            FeeInvoiceRepositoryInterface::class,
            FeeInvoiceRepository::class
        );

        $this->app->bind(
            ReceiptStudentRepositoryInterface::class,
            ReceiptStudentRepository::class
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