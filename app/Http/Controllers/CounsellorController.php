<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StressRecord;

class CounsellorController extends Controller
{
    public function dashboard()
    {
        // Students whose LATEST assessment is Severe (urgent tier)
        $urgentStudents = User::where('role', 'student')
            ->with(['stressRecords' => fn($q) => $q->latest()->with('assignedCounselor')])
            ->get()
            ->filter(function ($student) {
                $latest = $student->stressRecords->first();
                return $latest && $latest->stress_level === 'Severe';
            })
            ->sortByDesc(fn($student) => $student->stressRecords->first()->stress_score)
            ->values();

        // Students whose LATEST assessment is High (monitor tier)
        $monitorStudents = User::where('role', 'student')
            ->with(['stressRecords' => fn($q) => $q->latest()->with('assignedCounselor')])
            ->get()
            ->filter(function ($student) {
                $latest = $student->stressRecords->first();
                return $latest && $latest->stress_level === 'High';
            })
            ->sortByDesc(fn($student) => $student->stressRecords->first()->stress_score)
            ->values();

        $flaggedCount     = $urgentStudents->count() + $monitorStudents->count();
        $urgentCount      = $urgentStudents->count();
        $monitorCount     = $monitorStudents->count();
        $totalStudents    = User::where('role', 'student')->count();
        $totalAssessments = StressRecord::count();
        $avgScore         = round(StressRecord::avg('stress_score'), 1);
        $allRecords       = StressRecord::with('user')->latest()->get();

        return view('counselor.dashboard', compact(
            'urgentStudents', 'monitorStudents',
            'flaggedCount', 'urgentCount', 'monitorCount',
            'totalStudents', 'totalAssessments',
            'avgScore', 'allRecords'
        ));
    }

    public function claimCase(StressRecord $record)
    {
        // Prevent claiming an already-claimed case
        if ($record->assigned_counselor_id && $record->assigned_counselor_id !== auth()->id()) {
            return redirect()
                ->route('counselor.dashboard')
                ->with('error', 'This case has already been claimed by another counsellor.');
        }

        $record->update([
            'assigned_counselor_id' => auth()->id(),
            'assigned_at'           => now(),
        ]);

        return redirect()
            ->route('counselor.dashboard')
            ->with('success', 'You are now handling this case.');
    }
}