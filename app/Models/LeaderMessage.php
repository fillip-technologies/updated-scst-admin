<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderMessage extends Model
{
    protected $fillable = ['minister','secretary','ias_officer'];
    protected $table = "leader_messages";
    protected $primaryKey = 'id';

    protected $casts = ['minister'=>'array','secretary'=>'array','ias_officer'=>'array'];
}
