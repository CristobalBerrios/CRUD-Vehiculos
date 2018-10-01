<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
  use SoftDeletes;

  protected $table = 'vehiculos';
  protected $fillable = ['marca', 'modelo', 'year', 'precio', 'id_usuario'];
  protected $dates = ['deleted_at'];
}
