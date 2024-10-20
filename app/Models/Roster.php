<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    public $incrementing = false; // Desactivar incremento automático

    protected $fillable = [
        'employee_id',
        'full_name',
        'profile',
        'program',
        'hiring_date',
        'status',
        'termination_date',
    ];

    // Relaciones
    public function recruits()
    {
        return $this->hasMany(Recruits::class, 'roster_id', 'employee_id');
    }

    public function program()
    {
        return $this->belongsTo(Programs::class, 'program', 'program_id');
    }

    // Hook de creación y actualización
    protected static function booted()
    {
        // Lógica cuando se crea un registro en el roster
        static::creating(function ($roster) {
            $lastEmployee = Roster::orderBy('employee_id', 'desc')->first();
            $nextNumber = $lastEmployee ? (int) str_replace('CW-', '', $lastEmployee->employee_id) + 1 : 1;
            $roster->employee_id = 'CW-'.str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        });

        // Lógica para agregar o eliminar un supervisor dependiendo del perfil
        static::saved(function ($roster) {
            // Verificar si el perfil es "supervisor" y no está marcado como "Terminated"
            if ($roster->profile === 'supervisor' && $roster->status !== 'Terminated') {
                // Agregar a la tabla de supervisores si no existe
                Supervisors::updateOrCreate(
                    ['roster_id' => $roster->employee_id],
                    ['name' => $roster->full_name]
                );
            } else {
                // Si cambia de perfil o es "Terminated", eliminar de la tabla de supervisores
                Supervisors::where('roster_id', $roster->employee_id)->delete();
            }
        });
    }
}
