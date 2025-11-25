<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud_compra extends Model
{
    //
    protected $table = "solictud_compras";
    protected $fillable = ['numero_solictud','motivo_solicitud', 'personals_id','equipo_solicitado','nivel_prioridad'];
    protected $hidden = ['id'];

    //Minimo un cargo le pertenece a un personal
    public function personal()
    {
        return $this->hasMany(Personal::class);
    }
}
