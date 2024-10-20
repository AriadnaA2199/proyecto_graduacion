<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $table = 'programs';

    // Definir program_id como la clave primaria
    protected $primaryKey = 'program_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'program_id',
        'name',
        'description',
        'country_id',
    ];

    // Relación con el modelo Country
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }

    // Generar program_id dinámicamente antes de crear el registro
    protected static function booted()
    {
        static::creating(function ($program) {
            $country = $program->country;
            if ($country) {
                // Generar el program_id basado en el nombre del país y el nombre del programa
                $countryPrefix = strtoupper(substr($country->name, 0, 2));
                $program->program_id = $countryPrefix.'-'.str_replace(' ', '', $program->name);
            }
        });
    }
}
