<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruits extends Model
{
    use HasFactory;

    protected $primaryKey = 'recruit_id';

    public $incrementing = false; // Deshabilitamos el autoincremento

    protected $keyType = 'string';

    protected $fillable = [
        'recruit_id',       // ID del recluta, generado automáticamente
        'roster_id',        // ID del empleado (de la tabla rosters)
        'full_name',        // Nombre completo, autopoblado
        'training_id',      // ID del entrenamiento
        'hiring_date',      // Fecha de contratación, autopoblada
    ];

    // Relación con la tabla Roster (empleados)
    public function roster()
    {
        return $this->belongsTo(Roster::class, 'roster_id', 'employee_id');
    }

    // Relación con la tabla Trainings (entrenamientos)
    public function training()
    {
        return $this->belongsTo(Trainings::class, 'training_id', 'training_id');
    }

    // Hook para generar el recruit_id automáticamente antes de guardar
    protected static function booted()
    {
        static::creating(function ($recruit) {
            // Verificamos que tenga un training_id y un roster_id
            if ($recruit->training_id && $recruit->roster_id) {
                // Generar recruit_id concatenando el training_id con el roster_id
                $recruit->recruit_id = $recruit->training_id.'-'.$recruit->roster_id;
            }
        });
    }
}
