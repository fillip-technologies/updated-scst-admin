<?php

namespace App\Models\MCP\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'ticket_id',
        'student_name',
        'mobile',
        'school_name',
        'reason',
        'status'
    ];
}
