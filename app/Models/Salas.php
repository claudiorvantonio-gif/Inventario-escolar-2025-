<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    protected $table = "salas";
    protected $fillable = ['nombre', 'numero_equipos', 'tipo_sala', 'estado'];
    protected $hidden = ['id'];

    public function Equipos()
    {
        return $this->belongsTo(Equipos::class); // La clave foránea en la tabla 'personal' es 'sala_id'
    }
}
