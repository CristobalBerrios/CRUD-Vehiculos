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
  protected $appends = ['nombre_completo'];

  public function vehiculos() {
    return $this->hasMany('App\Models\Vehiculo');
  }

  public function getNombreCompletoAttribute () {
    return $this->attributes['nombre']. ' '. $this->attributes['apellidos'];
  }

  protected static function boot() { 
    parent::boot(); 

    static::deleting(function($usuario) { 
     $usuario->vehiculos()->delete(); 
    }); 
} 
}
