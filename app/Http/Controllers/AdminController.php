<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StressRecord;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents  = User::where('role', 'student')->count();
        $highRisk       = StressRecord::where('stress_level', 'High')->count();
        $moderate       = StressRecord::where('stress_level', 'Moderate')->count();
        $low            = StressRecord::where('stress_level', 'Low')->count();
        $recentRecords  = StressRecord::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'highRisk', 'moderate', 'low', 'recentRecords'
        ));
    }

    public function users()
    {
        $users = User::where('role', 'student')
                    ->with('stressRecords')
                    ->latest()
                    ->get();
        return view('admin.users', compact('users'));
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }
}