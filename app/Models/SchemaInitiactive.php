<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchemaInitiactive extends Model
{
    protected $table = "schema_initiactives";
  protected $fillable = ['title','description','tags'];
  protected $primaryKey = 'id';
}
