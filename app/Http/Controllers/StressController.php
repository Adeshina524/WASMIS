<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StressRecord;

class StressController extends Controller
{
    public function showForm()
    {
        return view('student.submit');
    }

    public function dashboard()
    {
        $user    = auth()->user();
        $records = StressRecord::where('user_id', $user->id)->latest()->get();
        $latest  = $records->first();
        $total   = $records->count();
        $average = $total > 0 ? round($records->avg('stress_score'), 1) : 0;

        return view('student.dashboard', compact('user', 'records', 'latest', 'total', 'average'));
    }

    public function submit(Request $request)
    {
        $rules = [];

        for ($i = 1; $i <= 5; $i++) {
            $rules["a$i"] = 'required|integer|min:1|max:5';
        }
        for ($i = 1; $i <= 7; $i++) {
            $rules["b$i"] = 'required|integer|min:1|max:5';
        }
        for ($i = 1; $i <= 14; $i++) {
            $rules["c$i"] = 'required|integer|min:1|max:5';
        }

        $rules['text_input']      = 'required|string';
        $rules['time_period']     = 'nullable|string';
        $rules['academic_period'] = 'nullable|string';

        $data = $request->validate($rules);

        $general_stress_score =
            $data['a1'] + $data['a2'] + $data['a3'] +
            (6 - $data['a4']) + (6 - $data['a5']);

        $tension_score = 0;
        for ($i = 1; $i <= 7; $i++) {
            $tension_score += $data["b$i"];
        }

        $academic_stress_score = 0;
        for ($i = 1; $i <= 13; $i++) {
            $academic_stress_score += $data["c$i"];
        }
        $academic_stress_score += (6 - $data['c14']);

        $stress_score = $general_stress_score + $tension_score + $academic_stress_score;

        if ($stress_score <= 69) {
            $stress_level = 'Low';
        } elseif ($stress_score <= 78) {
            $stress_level = 'Moderate';
        } elseif ($stress_score <= 87) {
            $stress_level = 'High';
        } else {
            $stress_level = 'Very High';
        }

        StressRecord::create([
            'user_id'              => auth()->id(),
            'general_stress_score' => $general_stress_score,
            'tension_score'        => $tension_score,
            'academic_stress_score'=> $academic_stress_score,
            'questionnaire_score'  => $stress_score,
            'text_input'           => $data['text_input'],
            'stress_score'         => $stress_score,
            'stress_level'         => $stress_level,
            'time_period'          => $data['time_period'] ?? null,
            'academic_period'      => $data['academic_period'] ?? null,
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('result', "Stress Level: $stress_level (Score: $stress_score / 130)");
    }
}