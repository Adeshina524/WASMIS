<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StressRecord;
use Illuminate\Support\Facades\DB;

class CounsellorController extends Controller
{
    public function dashboard()
    {
        $flaggedStudents  = User::where('role', 'student')
                                ->whereHas('stressRecords', fn($q) => $q->where('stress_level', 'High'))
                                ->with(['stressRecords' => fn($q) => $q->latest()])
                                ->get();

        $flaggedCount     = $flaggedStudents->count();
        $totalStudents    = User::where('role', 'student')->count();
        $totalAssessments = StressRecord::count();
        $avgScore         = round(StressRecord::avg('stress_score'), 1);
        $allRecords       = StressRecord::with('user')->latest()->get();

        return view('counselor.dashboard', compact(
            'flaggedStudents', 'flaggedCount',
            'totalStudents', 'totalAssessments',
            'avgScore', 'allRecords'
        ));
    }
}
