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

    public function Allclass()
    {
        $this->hasMany(AddClasses::class);
    }

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function mealreport()
    {
        return $this->hasMany(MealReport::class);
    }

    public function infrareport()
    {
        return $this->hasMany(InfraReport::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function teacherattend(){
        return $this->hasMany(TeacherAttend::class);
    }

    public function subject(){
        return $this->hasMany(SubjectAdd::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class,'recorded_by');
    }

    public function result(){
        return $this->hasMany(Result::class);
    }

     public function assingsubject()
    {
        return $this->hasMany(AssingSubject::class);
    }

    public function addsubject()
    {
        return $this->hasMany(SubjectAdd::class);
    }

    public function subjectlist()
    {
        return $this->hasMany(SubjectList::class);
    }

    public function topics()
    {
        return $this->hasMany(SubTopics::class);
    }

    public function districFinancialReport()
    {
        return $this->hasMany(DistrictFinanceReport::class);
    }

    public function missioaspire()
    {
        return $this->hasMany(MissionAspire::class);
    }

    public function parentengreport()
    {
        return $this->hasMany(ParentEngagementReport::class);
    }

    public function schoolhelreport()
    {
        return $this->hasMany(SchoolHelthReport::class);
    }

    public function schoolinfrareport()
    {
        return $this->hasMany(SchoolInfrastructureReport::class);
    }

    public function studentactivityreport()
    {
        return $this->hasMany(StudentActivityReport::class);
    }

    public function teacherstaffreport()
    {
        return $this->hasMany(TeacherStaffReport::class);
    }

    public function syllabusTrack(){
        return $this->hasMany(SyllabusTracking::class);
    }


}
