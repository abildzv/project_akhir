<?php

namespace App\Providers;

use App\Interfaces\DokumenStorageInterface;
use App\Interfaces\PengajuanInterface;
use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use App\Repositories\PengajuanRepository;
use App\Services\LocalDokumenStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(PengajuanInterface::class, PengajuanRepository::class);
        $this->app->bind(DokumenStorageInterface::class, LocalDokumenStorage::class);
    }

    public function boot(): void
    {
        //
    }
}