<?php

namespace App\Providers;

use App\Filament\Admin\Resources\AttendanceControlResource\Pages\CreateAttendance;
use Illuminate\Support\ServiceProvider; // Ensure Livewire is properly imported
use Livewire\Livewire; // Correct namespace for CreateAttendance

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // This method remains empty if you have no services to register
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Livewire components here
        Livewire::component('create-attendance', CreateAttendance::class);
    }
}
