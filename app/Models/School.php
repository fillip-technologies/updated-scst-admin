<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Authenticatable
{
    use HasApiTokens , Notifiable;

    protected $table = 'schools';

    protected $primaryKey = 'id';

    protected $fillable = ['school_logo', 'school_name', 'school_code', 'establishment_year', 'district', 'block', 'full_address', 'official_email', 'school_phone', 'category', 'principle_name', 'principle_contact', 'total_classrooms', 'total_students_enrolled', 'total_teachers_sanctioned', 'hostel_capacity', 'school_admin_username', 'password', 'account_status'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function notice()
    {
        return $this->hasMany(Notices::class);
    }

    public function home()
    {
        return $this->hasMany(Home::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function infrastructure()
    {
        return $this->hasMany(Infrastructure::class);
    }
}
