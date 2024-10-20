<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relación con Programs
    public function programs()
    {
        return $this->hasMany(Programs::class, 'country_id', 'id');
    }
}
