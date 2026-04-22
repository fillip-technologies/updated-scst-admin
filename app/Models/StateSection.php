<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateSection extends Model
{
protected $table = "state_sections";
protected $fillable = ['state_section'];
protected $primaryKey = 'id';

protected $casts = ['state_section'=>'array'];
}
