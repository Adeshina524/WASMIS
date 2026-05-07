<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StressRecord;

class ManagementController extends Controller
{
    public function dashboard()
    {
        $totalStudents    = User::where('role', 'student')->count();
        $totalAssessments = StressRecord::count();
        $highRisk         = StressRecord::where('stress_level', 'High')->count();
        $moderate         = StressRecord::where('stress_level', 'Moderate')->count();
        $low              = StressRecord::where('stress_level', 'Low')->count();
        $avgScore         = round(StressRecord::avg('stress_score'), 1);

        // Stress by faculty
        $stressByFaculty = User::where('role', 'student')
            ->whereNotNull('faculty')
            ->with('stressRecords')
            ->get()
            ->groupBy('faculty')
            ->map(fn($students) => [
                'total'    => $students->count(),
                'high'     => $students->filter(fn($s) => $s->stressRecords->where('stress_level','High')->count() > 0)->count(),
                'avg'      => round($students->flatMap->stressRecords->avg('stress_score'), 1),
            ]);

        // Stress by level
        $stressByLevel = User::where('role', 'student')
            ->whereNotNull('level')
            ->with('stressRecords')
            ->get()
            ->groupBy('level')
            ->map(fn($students) => [
                'total' => $students->count(),
                'high'  => $students->filter(fn($s) => $s->stressRecords->where('stress_level','High')->count() > 0)->count(),
                'avg'   => round($students->flatMap->stressRecords->avg('stress_score'), 1),
            ]);

        // stress by department
        $stressByDepartment = User::where('role', 'student')
            ->whereNotNull('department')
            ->with('stressRecords')
            ->get()
            ->groupBy('department')
            ->map(fn($students) => [
                'total' => $students->count(),
                'high'  => $students->filter(fn($s) => $s->stressRecords->where('stress_level','High')->count() > 0)->count(),
                'avg'   => round($students->flatMap->stressRecords->avg('stress_score'), 1),
            ]);

        // Stress by academic period
        $stressByPeriod = StressRecord::selectRaw('academic_period, COUNT(*) as total, AVG(stress_score) as avg_score')
            ->whereNotNull('academic_period')
            ->groupBy('academic_period')
            ->get();

        // Monthly trend — last 6 months
        $monthlyTrend = StressRecord::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total, AVG(stress_score) as avg_score')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return view('management.dashboard', compact(
            'totalStudents', 'totalAssessments', 'highRisk',
            'moderate', 'low', 'avgScore',
            'stressByFaculty', 'stressByLevel', 'stressByDepartment',
            'stressByPeriod', 'monthlyTrend'
        ));
    }
}