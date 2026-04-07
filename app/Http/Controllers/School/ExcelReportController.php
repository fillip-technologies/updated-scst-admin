<?php

namespace App\Http\Controllers\School;

use App\Exports\Report\MealsRepoExport;
use App\Exports\Report\StdentRepoExport;
use App\Exports\Report\TeacherRepoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{
    public function RepotDownload(Request $request)
    {


        $category = $request->category ?? null;
        $range = $request->date_range ?? null;
        $class = $request->class ?? null;

        if ($category === 'attendance') {

            $startDate = now();
            $endDate = now();

            if ($range == '1') { // last 7 days
                $startDate = now()->subDays(6);
            } elseif ($range == '2') { // last 30 days
                $startDate = now()->subDays(29);
            } elseif ($range == '3') { // this month
                $startDate = now()->startOfMonth();
            }

            $date_range = [
                $startDate->format('Y-m-d'),
                $endDate->format('Y-m-d'),
            ];

            return Excel::download(
                new StdentRepoExport($date_range, $class),
                'StudentReport.xlsx'
            );
        } elseif ($category === 'teacher_attendance') {
            //   dd($request->all());
            $startDate = now();
            $endDate = now();

            if ($range == '1') { // last 7 days
                $startDate = now()->subDays(6);
            } elseif ($range == '2') { // last 30 days
                $startDate = now()->subDays(29);
            } elseif ($range == '3') { // this month
                $startDate = now()->startOfMonth();
            }

            $date_range = [
                $startDate->format('Y-m-d'),
                $endDate->format('Y-m-d'),
            ];

            return Excel::download(
                new TeacherRepoExport($date_range),
                'TeacherReport.xlsx'
            );
        } elseif ($category === 'meal') {
            $startDate = now();
            $endDate = now();

            if ($range == '1') { // last 7 days
                $startDate = now()->subDays(6);
            } elseif ($range == '2') { // last 30 days
                $startDate = now()->subDays(29);
            } elseif ($range == '3') { // this month
                $startDate = now()->startOfMonth();
            }

            $date_range = [
                $startDate->format('Y-m-d'),
                $endDate->format('Y-m-d'),
            ];

            return Excel::download(
                new MealsRepoExport($date_range),
                'MealReport.xlsx'
            );
        } else {
            return back()->with('error', 'Invalid request');
        }

    }
}
