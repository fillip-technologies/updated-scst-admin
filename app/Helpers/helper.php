<?php

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
