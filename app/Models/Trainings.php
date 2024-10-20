<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trainings extends Model
{
    use HasFactory;

    protected $primaryKey = 'training_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'start_training_date',
        'end_training_date',
        'start_transition_date',
        'end_transition_date',
        'start_production_date',
        'program',  // Usamos 'program' ya que así está en la tabla
        'trainer_name',
        'class_type',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id', 'department_code');
    }

    // Hook que se dispara antes de crear un registro
    protected static function booted()
    {
        static::creating(function ($training) {
            $department = $training->department_id;
            $program = $training->program; // Usamos 'program' aquí
            $year = date('Y'); // Obtener el año actual

            $incrementalNumber = DB::table('trainings')
                ->whereYear('created_at', $year)
                ->count() + 1;

            $training->training_id = "{$department}-{$program}-{$year}-".str_pad($incrementalNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
