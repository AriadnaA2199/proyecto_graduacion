<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisors extends Model
{
    use HasFactory;

    protected $primaryKey = 'supervisor_id';

    public $incrementing = false;

    protected $fillable = [
        'supervisor_id',
        'name',
        'roster_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generar automáticamente el supervisor_id al crear un registro
        static::creating(function ($model) {
            if (empty($model->supervisor_id)) {
                $model->supervisor_id = 'SUP-'.$model->roster_id; // Genera SUP-[employee_id]
            }
        });
    }
}
