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

        for ($i = 1; $i <= 5; $i++)  $rules["a$i"] = 'required|integer|min:1|max:5';
        for ($i = 1; $i <= 7; $i++)  $rules["b$i"] = 'required|integer|min:1|max:5';
        for ($i = 1; $i <= 14; $i++) $rules["c$i"] = 'required|integer|min:1|max:5';

        $rules['text_input']      = 'required|string';
        $rules['time_period']     = 'nullable|string';
        $rules['academic_period'] = 'nullable|string';

        $data = $request->validate($rules);

        // ── SECTION A: General Stress (PSS-5) ──
        $general_stress_score =
            $data['a1'] + $data['a2'] + $data['a3'] +
            (6 - $data['a4']) + (6 - $data['a5']);

        // ── SECTION B: Tension Symptoms (DASS-7) ──
        $tension_score = 0;
        for ($i = 1; $i <= 7; $i++) {
            $tension_score += $data["b$i"];
        }

        // ── SECTION C: Academic Stressors (14 items) ──
        $academic_stress_score = 0;
        for ($i = 1; $i <= 13; $i++) {
            $academic_stress_score += $data["c$i"];
        }
        $academic_stress_score += (6 - $data['c14']);

        // ── BASE SCORE (questionnaire only) ──
        $base_score = $general_stress_score + $tension_score + $academic_stress_score;

        // ── TEXT/KEYWORD ANALYSIS ──
        $text_score = $this->analyzeText($data['text_input']);

        // ── TIME-PERIOD BONUS ──
        $time_bonus = match ($data['academic_period'] ?? 'normal') {
            'exam' => 2,
            'test' => 1,
            default => 0,
        };

        // ── FINAL COMBINED SCORE ──
        $stress_score = $base_score + $text_score + $time_bonus;

        // ── STRESS LEVEL CLASSIFICATION (locked thresholds) ──
        if ($stress_score <= 72) {
            $stress_level = 'Mild';
        } elseif ($stress_score <= 81) {
            $stress_level = 'Moderate';
        } elseif ($stress_score <= 90) {
            $stress_level = 'High';
        } else {
            $stress_level = 'Severe';
        }

        StressRecord::create([
            'user_id'               => auth()->id(),
            'general_stress_score'  => $general_stress_score,
            'tension_score'         => $tension_score,
            'academic_stress_score' => $academic_stress_score,
            'questionnaire_score'   => $base_score,
            'text_input'            => $data['text_input'],
            'stress_score'          => $stress_score,
            'stress_level'          => $stress_level,
            'time_period'           => $data['time_period'] ?? null,
            'academic_period'       => $data['academic_period'] ?? null,
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('result', "Stress Level: $stress_level (Score: $stress_score / 142)");
    }

    /**
     * Analyze free-text input against the multilingual stress keyword
     * dictionary. Applies diminishing-returns repetition scoring,
     * capped at 10. Falls back to a simple effort-based score if
     * no keywords match at all.
     */
    private function analyzeText(string $text): int
    {
        $text = mb_strtolower(trim($text));

        $dictionaries = config('stress_keywords');
        $allKeywords = array_merge(
            $dictionaries['english'] ?? [],
            $dictionaries['pidgin'] ?? [],
            $dictionaries['yoruba'] ?? []
        );

        $totalScore = 0;
        $matchedAny = false;

        foreach ($allKeywords as $keyword => $weight) {
            $occurrences = mb_substr_count($text, mb_strtolower($keyword));

            if ($occurrences > 0) {
                $matchedAny = true;

                // First occurrence = full weight
                $totalScore += $weight;

                // Each repeat after the first = diminishing returns (+1 per repeat)
                if ($occurrences > 1) {
                    $totalScore += ($occurrences - 1) * 1;
                }
            }
        }

        // ── FALLBACK: no dictionary keyword matched at all ──
        if (!$matchedAny && mb_strlen($text) > 0) {
            $totalScore += 1; // baseline effort score

            if (mb_strlen($text) > 100) {
                $totalScore += 1; // elaboration bonus
            }
        }

        // Cap the text/keyword contribution at 10
        return min($totalScore, 10);
    }
}