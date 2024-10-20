<?php

namespace App\Http\Livewire;

use App\Models\Roster;
use Livewire\Component;

class RosterStats extends Component
{
    public $profileStats;

    public $programStats;

    public $statusStats;

    public function mount()
    {
        // Contar por perfil
        $this->profileStats = Roster::selectRaw('profile, COUNT(*) as total')
            ->groupBy('profile')
            ->pluck('total', 'profile')
            ->toArray();

        // Contar por programa
        $this->programStats = Roster::selectRaw('program, COUNT(*) as total')
            ->groupBy('program')
            ->pluck('total', 'program')
            ->toArray();

        // Contar por status (asistencia)
        $this->statusStats = Roster::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.roster-stats');
    }
}
