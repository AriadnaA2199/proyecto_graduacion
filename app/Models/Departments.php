<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['department_name', 'department_code'];

    /**
     * Relación uno a muchos con Classes
     * Un departamento puede tener muchas clases.
     */
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    /**
     * Relación a través de Classes para obtener los reclutas (empleados)
     * Un departamento tiene muchos reclutas a través de las clases.
     */
    public function recruits()
    {
        return $this->hasManyThrough(Recruit::class, Classes::class);
    }
}
