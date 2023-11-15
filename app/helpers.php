<?php

// app/helpers.php

if (!function_exists('getQuarters')) {
    function getQuarters($date) {
        $date = \Carbon\Carbon::parse($date); // Convert the date to a Carbon object
        $year = $date->year;

        // Define the start and end dates of each quarter
        $quarters = [
            'q1' => [
                'start' => "$year-01-01",
                'end' => "$year-03-31",
            ],
            'q2' => [
                'start' => "$year-04-01",
                'end' => "$year-06-30",
            ],
            'q3' => [
                'start' => "$year-07-01",
                'end' => "$year-09-30",
            ],
            'q4' => [
                'start' => "$year-10-01",
                'end' => "$year-12-31",
            ],
        ];

        return $quarters;
    }
}
