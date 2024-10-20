<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show()
    {
        // Consulta para obtener los estados de los reclutas y la cantidad de reclutas en cada estado
        $statuses = DB::table('recruits')
            ->join('rosters', 'recruits.roster_id', '=', 'rosters.employee_id') // Relación entre recruits y rosters
            ->select('rosters.status', DB::raw('count(*) as total')) // Seleccionar el estado y contar el total
            ->groupBy('rosters.status') // Agrupar por estado
            ->get();

        // Extraemos etiquetas (los nombres de los estados) y los datos (la cantidad de reclutas por estado)
        $labels = $statuses->pluck('status')->toArray(); // Convertimos la columna 'status' a un array
        $data = $statuses->pluck('total')->toArray(); // Convertimos la columna 'total' a un array

        // Retornar los datos a la vista recruit-status-chart.blade.php
        return view('recruit-status-chart', [
            'labels' => $labels, // Las etiquetas del gráfico
            'data' => $data, // Los datos del gráfico
        ]);
    }
}
