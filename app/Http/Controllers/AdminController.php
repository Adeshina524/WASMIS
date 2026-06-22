<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\StressRecord;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'       => ['required', 'in:admin,counselor,management,student'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'matric_no'  => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'faculty'    => ['nullable', 'string', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'level'      => ['nullable', 'string', 'max:10'],
        ]);

        User::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'role'               => $request->role,
            'matric_no'          => $request->matric_no,
            'department'         => $request->department,
            'faculty'            => $request->faculty,
            'phone'              => $request->phone,
            'level'              => $request->level,
            'email_verified_at'  => now(),
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User account created successfully.');
    }

    public function dashboard()
    {
        $totalStudents    = User::where('role', 'student')->count();
        $totalAssessments = StressRecord::count();
        $highRisk         = StressRecord::where('stress_level', 'High')->count();
        $moderate         = StressRecord::where('stress_level', 'Moderate')->count();
        $low              = StressRecord::where('stress_level', 'Low')->count();
        $recentRecords    = StressRecord::with('user')->latest()->take(10)->get();

        // System users overview
        $totalCounsellors  = User::where('role', 'counselor')->count();
        $totalManagement   = User::where('role', 'management')->count();
        $totalAdmins       = User::where('role', 'admin')->count();

        // Assessment activity
        $todayCount        = StressRecord::whereDate('created_at', today())->count();
        $weekCount         = StressRecord::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthCount        = StressRecord::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Recent registrations
        $recentStudents    = User::where('role', 'student')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalAssessments',
            'highRisk', 'moderate', 'low',
            'recentRecords', 'recentStudents',
            'totalCounsellors', 'totalManagement', 'totalAdmins',
            'todayCount', 'weekCount', 'monthCount'
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