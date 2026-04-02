<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainNotice extends Model
{
    protected $primaryKey = 'id';
    protected $table = "main_notices";
    protected $fillable = ['title','date','notice_badge','notice_type','description'];
}
