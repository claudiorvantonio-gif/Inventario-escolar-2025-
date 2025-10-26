<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestaciones extends Model
{
    use HasFactory;
    protected $table = "prestacions";
    protected $fillable = ['title', 'start', 'end', 'color', 'observacion', 'equipos_id', 'personals_id', 'estado'];
    protected $hidden = ['id'];

    public function Equipo(): HasMany
    {
        return $this->hasMany(Equipos::class);
    }
    public function Personal(): HasMany
    {
        return $this->hasMany(Equipos::class);
    }
}
