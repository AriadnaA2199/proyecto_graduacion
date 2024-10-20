<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AttendanceControl extends Model
{
    protected $table = 'attendance_control';

    // Asegúrate de que 'recruit_id' y 'status' estén incluidos en fillable
    protected $fillable = ['attendance_id', 'training_id', 'recruit_id', 'date', 'status'];

    protected $primaryKey = 'attendance_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    // Evento de creación para generar 'attendance_id' si no se proporciona
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attendance_id)) {
                $model->attendance_id = Str::uuid()->toString();
            }
        });
    }
}
