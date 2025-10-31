<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cargo extends Model
{
    protected $table = "cargos";
    protected $fillable = ['nombre','tipo', 'estado'];
    protected $hidden = ['id'];

    //Minimo un cargo le pertenece a un personal
    public function personal()
    {
        return $this->hasMany(Personal::class);
    }
}
