<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class EmployeeCounter extends BaseWidget
{
    protected function getCards(): array
    {
        $employeeCount = DB::table('rosters')->count();
        $activeCount = DB::table('rosters')->where('status', 'active')->count();
        $terminatedCount = DB::table('rosters')->where('status', 'terminated')->count();

        return [
            Card::make('Total Employees', $employeeCount)
                ->description('Total empleados registrados')
                ->color('primary'),

            Card::make('Active Employees', $activeCount)
                ->description('Empleados actualmente activos')
                ->color('success'),

            Card::make('Terminated Employees', $terminatedCount)
                ->description('Empleados terminados')
                ->color('danger'),
        ];
    }
}
