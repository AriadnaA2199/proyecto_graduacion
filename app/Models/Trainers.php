<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    use HasFactory;

    protected $primaryKey = 'trainer_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'trainers';

    protected $fillable = [
        'trainer_id',
        'name',
        'program_id',  // Asegúrate de que aquí uses program_id
        'created_at',
        'updated_at',
    ];

    // Relación con el modelo Programs
    public function program()
    {
        return $this->belongsTo(Programs::class, 'program_id', 'program_id');
    }
}

// Si el `trainer_id` no es un campo autoincremental (lo cual es probable en este caso):
