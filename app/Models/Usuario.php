<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
  use SoftDeletes;

  protected $table = 'usuarios';
  protected $fillable = ['nombre', 'apellidos', 'correo'];
  protected $dates = ['deleted_at'];

  public function vehiculos() {
    return $this->hasMany('App\Models\Vehiculo');
  }
}
