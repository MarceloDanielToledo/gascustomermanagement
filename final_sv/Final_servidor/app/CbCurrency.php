<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CbCurrency extends Model
{
    // Nombre de la tabla de la base de datos que definimos (Database table name).
  protected $table='cb_currency';

  /**
    Por defecto Eloquent  asume que existe una clave primaria llamada id,
    si este no es nuesto caso lo tenemos que indicar en la variable $primaryKey
  */
  protected $primaryKey = 'idcurrency';

  // Denimos los campos de la tabla directamente en la variable de tipo array $fillable
  protected $fillable =  array('currency', 'description', 'isactive', 'isocode', 'cursymbol', 'precisionstd',  'precisioncost', 'precisionprize');

  /**
    En la variable $hidden podemos indicar los campos que no queremos que nos devuelvan
    en las consultas, por ejemplo, los campos created_at y updated_at, que el ORM Eloquent
    a�ade por defecto
    */
  protected $hidden = ['created_at','updated_at'];
}
