<?php

namespace App\Models\MCP\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
      protected $fillable = [
        'complaint_id',
        'student_name',
        'mobile',
        'school_name',
        'issue_category',
        'description',
        'status'
    ];
}
