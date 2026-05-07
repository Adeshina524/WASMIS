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
        $data = $request->validate([
            'q1'              => 'required|integer|min:1|max:5',
            'q2'              => 'required|integer|min:1|max:5',
            'q3'              => 'required|integer|min:1|max:5',
            'q4'              => 'required|integer|min:1|max:5',
            'q5'              => 'required|integer|min:1|max:5',
            'q6'              => 'required|integer|min:1|max:5',
            'q7'              => 'required|integer|min:1|max:5',
            'q8'              => 'required|integer|min:1|max:5',
            'q9'              => 'required|integer|min:1|max:5',
            'q10'             => 'required|integer|min:1|max:5',
            'text_input'      => 'nullable|string',
            'time_period'     => 'nullable|string',
            'academic_period' => 'nullable|string',
        ]);

        $questionnaire_score =
            $data['q1'] + $data['q2'] + $data['q3'] + $data['q4'] + $data['q5'] +
            $data['q6'] + $data['q7'] + $data['q8'] + $data['q9'] + $data['q10'];

        $stress_score = $questionnaire_score;

        if ($stress_score <= 20) {
            $stress_level = 'Low';
        } elseif ($stress_score <= 35) {
            $stress_level = 'Moderate';
        } else {
            $stress_level = 'High';
        }

        StressRecord::create([
            'user_id'             => auth()->id(),
            'questionnaire_score' => $questionnaire_score,
            'text_input'          => $data['text_input'] ?? null,
            'stress_score'        => $stress_score,
            'stress_level'        => $stress_level,
            'time_period'         => $data['time_period'] ?? null,
            'academic_period'     => $data['academic_period'] ?? null,
        ]);

        return redirect()
            ->route('student.submit')
            ->with('result', "Stress Level: $stress_level (Score: $stress_score)");
    }
}
