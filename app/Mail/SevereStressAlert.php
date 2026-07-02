<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\StressRecord;

class SevereStressAlert extends Mailable
{
    use Queueable, SerializesModels;

    public StressRecord $record;

    public function __construct(StressRecord $record)
    {
        $this->record = $record;
    }

    public function build()
    {
        $student = $this->record->user;

        return $this->subject('🚨 WASMIS Alert: New Severe Stress Case Flagged')
            ->view('emails.severe-stress-alert')
            ->with([
                'studentName'  => $student->name,
                'matricNo'     => $student->matric_no,
                'faculty'      => $student->faculty,
                'department'   => $student->department,
                'score'        => $this->record->stress_score,
                'submittedAt'  => $this->record->created_at->format('d M Y, h:i A'),
                'textInput'    => $this->record->text_input,
                'dashboardUrl' => route('counselor.dashboard'),
            ]);
    }
}