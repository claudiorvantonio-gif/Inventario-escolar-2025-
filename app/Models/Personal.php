<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{

    protected $table = "personals";
    protected $fillable = ['nombres', 'apellidos', 'cargos_id','salas_id', 'estado'];
    protected $hidden = ['id'];

    //Muchos personales tienen un cargo
    public function sala()
    {
        return $this->belongsTo(Salas::class); // La clave foránea en la tabla 'personal' es 'sala_id'
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class); // La clave foránea en la tabla 'personal' es 'cargo_id'
    }
}
