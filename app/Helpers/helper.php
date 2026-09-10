<?php

use App\Models\AddClasses;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (! function_exists('districts')) {

    function districts()
    {
        return [
            'Araria',
            'Arwal',
            'Aurangabad',
            'Banka',
            'Begusarai',
            'Bhagalpur',
            'Bhojpur',
            'Buxar',
            'Darbhanga',
            'East Champaran',
            'Gaya',
            'Gopalganj',
            'Jamui',
            'Jehanabad',
            'Kaimur',
            'Katihar',
            'Khagaria',
            'Kishanganj',
            'Lakhisarai',
            'Madhepura',
            'Madhubani',
            'Munger',
            'Muzaffarpur',
            'Nalanda',
            'Nawada',
            'Patna',
            'Purnia',
            'Rohtas',
            'Saharsa',
            'Samastipur',
            'Saran',
            'Sheikhpura',
            'Sheohar',
            'Sitamarhi',
            'Siwan',
            'Supaul',
            'Vaishali',
            'West Champaran',
        ];
    }
}

if (! function_exists('category')) {
    function category()
    {
        return ['Boys', 'Girls', 'Co-educational'];
    }
}

if (! function_exists('roll_number')) {
    function roll_number($student_name)
    {
        $letters = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y', 'Z',
        ];

        $getnamesub = strtoupper(substr($student_name, 0, 2));
        $random_number = random_int(10000, 90000);
        $randomKey = array_rand($letters);
        $randomLetter = $letters[$randomKey];

        return $getnamesub.$random_number.$randomLetter;
    }

}

if (! function_exists('getClass')) {
    function getClass()
    {
        $classes = AddClasses::where('school_id', SchoolLogin()->id ?? TeacherLog()->school_id)->get();

        return $classes;
    }
}

if (! function_exists('academicType')) {
    function academicType()
    {
        return [
            'Student Attendance',
            'Student Marks',
            'Teacher Attendance',
            'Meal Attendance',
        ];
    }
}

if (! function_exists('AttendanceType')) {
    function AttendanceType()
    {
        return [
            'Student Attendance',
            'Student Marks',
            'Teacher Attendance',
            'Meal Attendance',
        ];
    }
}

if (! function_exists('infrastructureType')) {
    function infrastructureType()
    {
        return [
            'Electricity',
            'Toilets',
            'Drinking Water',
            'Building Safety',
            'Network',

        ];
    }
}

if (! function_exists('checkCandition')) {
    function checkCandition()
    {
        return ['Yes', 'No'];
    }
}

if (! function_exists('gender')) {
    function gender()
    {
        return [
            'male',
            'female',
            'other',
        ];
    }
}

if (! function_exists('leaveType')) {
    function leaveType()
    {
        return
        [
            'Sick Leave',
            'Casual Leave',
            'Unpaid Leave',
        ];
    }
}

if (! function_exists('getDisc')) {
    function getDisc()
    {
        $disdata = School::select('district')
            ->groupBy('district')
            ->get();

        return $disdata;
    }
}

if (! function_exists('dateRange')) {
    function dateRange()
    {
        return [
            '1' => 'Last 7 Days',
            '2' => 'Last 30 Days',
            '3' => 'This Month',

        ];
    }
}

if (! function_exists('ExamType')) {

    function ExamType()
    {
        return [
            'half' => 'Half Yearly',
            'third' => 'Third Terminal',
            'final' => 'Final',
        ];
    }

}

if (! function_exists('RecipientGroup')) {
    function RecipientGroup()
    {
        return [
            'All Schools',
            'Principals Only',
            'District Coordinators',
            'Specific District',
        ];
    }
}

if (! function_exists('getPrincipale')) {
    function getPrincipale()
    {
        $principale = School::select('id', 'principle_name', 'official_email')->get();
        if (! empty($principale)) {
            return $principale;
        } else {
            echo 'No data found';
        }
    }
}

if (! function_exists('getPrincipale')) {
    function getPrincipale()
    {
        $principale = School::select('id', 'principle_name', 'official_email')->get();
        if (! empty($principale)) {
            return $principale;
        } else {
            echo 'No data found';
        }
    }
}

if (! function_exists('SinglegetDisc')) {
    function SinglegetDisc()
    {
        return School::select('id', 'district', 'official_email')
            ->orderBy('district')
            ->get()
            ->unique('district')
            ->values();
    }
}

// if (! function_exists('checkLoginAttempt')) {

//     function checkLoginAttempt(User $user, $credentials, $redirectRoute)
//     {

//         if ($user->lock_until && Carbon::now()->lessThan($user->lock_until)) {
//             return back()->with('error', 'Account locked for 24 hours');
//         }

//         if (Auth::attempt($credentials)) {

//             $user->login_attempts = 0;
//             $user->lock_until = null;
//             $user->save();

//             return redirect()->route($redirectRoute);
//         }

//         $user->login_attempts += 1;

//         if ($user->login_attempts >= 5) {
//             $user->lock_until = Carbon::now()->addHours(24);
//         }

//         $user->save();

//         $remaining = 5 - $user->login_attempts;

//         return back()->with('error', "Invalid Credentials. $remaining attempts left");
//     }

// }
if (!function_exists('checkLoginAttempt')) {

    function checkLoginAttempt(User $user, $credentials, $redirectRoute)
    {
        if ($user->lock_until && Carbon::now()->lessThan($user->lock_until)) {
            return back()->with('error', 'Account locked for 24 hours');
        }

        $oldSessionId = $user->session_id;

        if (Auth::attempt($credentials)) {

            $loggedInUser = Auth::user();

            request()->session()->regenerate();

            // Only for Admin
            if ($loggedInUser->role === 'admin') {

                $currentSessionId = session()->getId();

                if (!empty($oldSessionId) && $oldSessionId !== $currentSessionId) {
                    DB::table('sessions')
                        ->where('id', $oldSessionId)
                        ->delete();
                }

                $loggedInUser->session_id = $currentSessionId;
            }

            $loggedInUser->login_attempts = 0;
            $loggedInUser->lock_until = null;
            $loggedInUser->save();

            return redirect()->route($redirectRoute);
        }

        $user->increment('login_attempts');

        $user->refresh();

        if ($user->login_attempts >= 5) {
            $user->update([
                'lock_until' => Carbon::now()->addHours(24),
            ]);
        }

        $remaining = max(0, 5 - $user->login_attempts);

        return back()->with(
            'error',
            "Invalid Credentials. {$remaining} attempts left"
        );
    }
}

if (! function_exists('mission_aspire')) {
    function mission_aspire()
    {
        return [
            '1' => 'Academic Excellence & Zero Dropout',
            '2' => 'Poshan & Student Health',
            '3' => 'Teacher Welfare & Capacity Building',
            '4' => 'Assured Minimum Infrastructure',
            '5' => 'Excellence & Personality Development',
            '6' => 'Parent & Community Engagements',
            '7' => 'Governance, Digital Monitoring & Finance',
        ];
    }
}
if (! function_exists('getSchools')) {
    function getSchools($district = null)
    {
        $query = School::select('id', 'school_name', 'district');

        if ($district) {
            $query->where('district', $district);
        }

        return $query->get();
    }
}


if (! function_exists('all_syllabus')) {
    function all_syllabus()
    {
        return [
            'History',
            'English',
            'Economics',
            'Civics',
            'Sanskrit',
            'Social Science',
            'Hindi',
            'Maths',
            'Science',
            'Geography',
            'EVS',
        ];
    }
}

if (! function_exists('months')) {
    function months()
    {
        return [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
    }
}

if (!function_exists('selectmonths')) {
    function selectmonths()
    {
        return [
            1  => 'January',
            2  => 'February',
            3  => 'March',
            4  => 'April',
            5  => 'May',
            6  => 'June',
            7  => 'July',
            8  => 'August',
            9  => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
    }
}

if(!function_exists('Years')){
    function Years(){
        $years = [];
        $currentYears = date('Y');

        for($i = $currentYears; $i >= $currentYears -10; $i--){
        $years[] = $i;
        }
        return $years;
    }
}

if(!function_exists('getClassSchool')){
    function getClassSchool($id){
        $data = AddClasses::select('id','class')->where('school_id',$id)->get();
        return $data;
    }
}


if(!function_exists('getSingleSchool')){
    function getSingleSchool($school_id){
        $data =School::select('id','school_name')->findOrFail($school_id);
        return $data;
    }
}
