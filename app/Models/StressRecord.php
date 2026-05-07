<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StressRecord extends Model
{
    protected $table = 'stress_records';

    protected $fillable = [
        'user_id',
        'questionnaire_score',
        'text_input',
        'stress_score',
        'stress_level',
        'time_period',
        'academic_period',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
