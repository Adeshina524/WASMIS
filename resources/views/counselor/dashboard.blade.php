<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Counsellor Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:     #0d1f3c;
            --teal:     #1a7f74;
            --teal2:    #15928a;
            --teal3:    #25b8a8;
            --teal-lt:  #e6f5f3;
            --teal-md:  #9fd8d2;
            --sand:     #f5f2ed;
            --white:    #ffffff;
            --text:     #1a2236;
            --muted:    #5c6b82;
            --border:   #dde3ea;
            --amber:    #e8a027;
            --amber-lt: #fef7e9;
            --danger:   #c0392b;
            --danger-lt:#fff0f0;
            --green:    #27ae60;
            --green-lt: #e8f9f0;
        }

        html, body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); min-height: 100vh; }

        /* ── NAVBAR ── */
        .navbar { background: var(--navy); height: 64px; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 200; box-shadow: 0 1px 0 rgba(255,255,255,.04); }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo  { width: 38px; height: 38px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .nav-logo svg { width: 20px; height: 20px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 10px; text-transform: uppercase; letter-spacing: .09em; }
        .nav-right { display: flex; align-items: center; gap: 10px; }
        .nav-avatar { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: #fff; }
        .nav-name  { color: #8fa3bf; font-size: 13px; }
        .nav-logout { background: transparent; color: #8fa3bf; border: 1px solid rgba(255,255,255,.15); padding: 7px 16px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; cursor: pointer; text-decoration: none; transition: all .18s; }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        /* ── PAGE HEADER ── */
        .page-header { background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%); padding: 2.5rem 2rem; position: relative; overflow: hidden; }
        .page-header::before { content: ''; position: absolute; top: -60px; right: -80px; width: 280px; height: 280px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .page-header::after  { content: ''; position: absolute; bottom: -60px; left: -40px; width: 200px; height: 200px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .page-header-inner { position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; }
        .page-header-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--teal-md); margin-bottom: .4rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.5rem, 3vw, 2rem); color: #fff; line-height: 1.2; margin-bottom: .3rem; }
        .page-header-title em { font-style: italic; color: var(--teal-md); }
        .page-header-sub { font-size: 13.5px; color: #8fa3bf; }

        /* ── CONFIDENTIAL BANNER ── */
        .confidential-banner {
            background: rgba(232,160,39,.15);
            border: 1px solid rgba(232,160,39,.3);
            border-radius: 10px;
            padding: .75rem 1.1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1.25rem;
            font-size: 13px;
            color: #e8c27a;
        }
        .confidential-banner svg { width: 16px; height: 16px; fill: #e8c27a; flex-shrink: 0; }

        /* ── MAIN ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); transition: all .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.09); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 22px; height: 22px; }
        .si-teal  { background: var(--teal-lt); }  .si-teal svg  { fill: var(--teal); }
        .si-red   { background: var(--danger-lt); } .si-red svg  { fill: var(--danger); }
        .si-amber { background: var(--amber-lt); }  .si-amber svg { fill: var(--amber); }
        .si-green { background: var(--green-lt); }  .si-green svg { fill: var(--green); }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); margin-bottom: 1.5rem; }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .card-header-left { display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-icon.red { background: var(--danger); }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }
        .card-body { padding: 1.4rem; }

        /* ── FLAGGED STUDENT CARDS ── */
        .flagged-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }

        .student-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(13,31,60,.05);
            transition: all .2s;
        }
        .student-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.1); }
        .student-card.high-risk { border-left: 4px solid var(--danger); }

        .student-card-top {
            background: linear-gradient(90deg, var(--danger-lt), #fff8f8);
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid #f5c0b8;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: var(--danger);
            display: flex; align-items: center; justify-content: center;
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem; color: #fff;
            flex-shrink: 0;
            border: 2px solid #f5c0b8;
        }

        .student-name  { font-size: 14.5px; font-weight: 600; color: var(--navy); }
        .student-matric { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .high-risk-tag {
            margin-left: auto;
            display: inline-flex; align-items: center; gap: 5px;
            background: var(--danger); color: #fff;
            font-size: 11px; font-weight: 600;
            padding: 4px 10px; border-radius: 20px;
            flex-shrink: 0;
        }
        .high-risk-tag svg { width: 10px; height: 10px; fill: #fff; }

        .student-card-body { padding: 1.1rem 1.25rem; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .6rem; margin-bottom: 1rem; }
        .info-item {}
        .info-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: #c0cad5; margin-bottom: 2px; }
        .info-value { font-size: 13px; color: var(--text); font-weight: 500; }

        .stress-input-box {
            background: var(--sand);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: .85rem 1rem;
            margin-bottom: 1rem;
        }
        .stress-input-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 5px; }
        .stress-input-text  { font-size: 13px; color: var(--text); line-height: 1.6; font-style: italic; }

        .score-row { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; }
        .score-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
        .score-badge.high     { background: var(--danger-lt); color: var(--danger); }
        .score-badge.moderate { background: var(--amber-lt);  color: #b07000; }
        .score-badge.low      { background: var(--green-lt);  color: var(--green); }
        .score-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
        .score-num { font-size: 12px; color: var(--muted); }

        .btn-contact {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, var(--teal), var(--teal2));
            color: #fff; text-decoration: none;
            padding: 9px 18px; border-radius: 9px;
            font-size: 13px; font-weight: 500;
            border: none; cursor: pointer;
            transition: all .18s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-contact:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(26,127,116,.3); }
        .btn-contact svg { width: 14px; height: 14px; fill: #fff; }

        /* ── HISTORY TABLE ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .7rem 1rem; border-bottom: 2px solid var(--border); text-align: left; background: #fafffe; }
        .data-table td { font-size: 13px; color: var(--text); padding: .9rem 1rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafffe; }

        .level-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .level-badge.low      { background: var(--green-lt);  color: var(--green); }
        .level-badge.moderate { background: var(--amber-lt);  color: #b07000; }
        .level-badge.high     { background: var(--danger-lt); color: var(--danger); }
        .level-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--muted); font-size: 13px; }
        .empty-state svg { width: 40px; height: 40px; fill: #c0cad5; display: block; margin: 0 auto .75rem; }
        .empty-state h3 { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: var(--navy); margin-bottom: .4rem; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 900px) { .flagged-grid { grid-template-columns: 1fr; } .stat-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 480px) { .stat-grid { grid-template-columns: 1fr; } }
        @media (max-width: 420px) {
            .navbar { padding: 0 1.25rem; }
            .nav-sub  { display: none; }
            .nav-name { display: none; }
        }

        @media (max-width: 760px) {
            /* All Student Assessments table → stacked cards */
            .data-table-wrap { overflow-x: visible; }
            .data-table { min-width: 0; }
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tbody { padding: .9rem; display: flex; flex-direction: column; gap: .75rem; }
            .data-table tr {
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: .15rem .9rem;
                box-shadow: 0 1px 6px rgba(13,31,60,.04);
            }
            .data-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
                white-space: normal;
                text-align: right;
                padding: .6rem 0;
                border-bottom: 1px solid #f0f2f5;
            }
            .data-table td:last-child { border-bottom: none; }
            .data-table td::before {
                content: attr(data-label);
                font-size: 10.5px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .06em;
                color: var(--muted);
                flex-shrink: 0;
                text-align: left;
            }
            .data-table td[data-label="#"] { display: none; }
            .data-table td[data-label="Expression"] { text-align: right; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-logo">
            <svg viewBox="0 0 24 24"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3ZM11 14H9V12H11V14ZM15 14H13V12H15V14Z"/></svg>
        </div>
        <div>
            <div class="nav-title">WASMIS</div>
            <div class="nav-sub">Counsellor Panel</div>
        </div>
    </a>

    <div class="nav-right">
        <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <span class="nav-name">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="nav-logout">Log Out</button>
        </form>
    </div>
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <p class="page-header-eyebrow">Counsellor Dashboard</p>
        <h1 class="page-header-title">Flagged <em>Student Cases</em></h1>
        <p class="page-header-sub">Students with high stress levels requiring your attention and support.</p>

        <div class="confidential-banner">
            <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4l5 2.18V11c0 3.5-2.33 6.79-5 7.93-2.67-1.14-5-4.43-5-7.93V7.18L12 5z"/></svg>
            <strong>Confidential:</strong>&nbsp;Student information on this page is strictly confidential. Do not share or reproduce outside of official counselling records.
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon si-red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $flaggedCount }}</div>
                <div class="stat-label">Flagged Students</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-amber">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-teal">
                <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $totalAssessments }}</div>
                <div class="stat-label">Total Assessments</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-green">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $avgScore > 0 ? $avgScore : '—' }}</div>
                <div class="stat-label">Avg Stress Score</div>
            </div>
        </div>
    </div>

    {{-- FLAGGED STUDENTS --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon red">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                </div>
                <div>
                    <div class="card-title">High-Risk Students</div>
                    <div class="card-subtitle">Full details visible to counsellors only</div>
                </div>
            </div>
            @if($flaggedCount > 0)
            <span style="display:inline-flex;align-items:center;gap:5px;background:var(--danger-lt);color:var(--danger);font-size:11.5px;font-weight:600;padding:4px 12px;border-radius:20px;">
                ⚠ {{ $flaggedCount }} case{{ $flaggedCount > 1 ? 's' : '' }} need attention
            </span>
            @endif
        </div>
        <div class="card-body">
            @if($flaggedStudents->count() > 0)
            <div class="flagged-grid">
                @foreach($flaggedStudents as $student)
                @php
                    $latestRecord = $student->stressRecords->sortByDesc('created_at')->first();
                @endphp
                <div class="student-card high-risk">
                    <div class="student-card-top">
                        <div class="student-avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                        <div>
                            <div class="student-name">{{ $student->name }}</div>
                            <div class="student-matric">{{ $student->matric_no ?? 'N/A' }}</div>
                        </div>
                        <div class="high-risk-tag">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            High Risk
                        </div>
                    </div>
                    <div class="student-card-body">

                        {{-- Student Info Grid --}}
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value" style="font-size:12.5px;">{{ $student->email }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Phone</div>
                                <div class="info-value">{{ $student->phone ?? 'N/A' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Faculty</div>
                                <div class="info-value">{{ $student->faculty ?? 'N/A' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Department</div>
                                <div class="info-value">{{ $student->department ?? 'N/A' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Level</div>
                                <div class="info-value">{{ $student->level ? $student->level . ' Level' : 'N/A' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Assessments</div>
                                <div class="info-value">{{ $student->stressRecords->count() }} taken</div>
                            </div>
                        </div>

                        {{-- Stress Expression --}}
                        @if($latestRecord && $latestRecord->text_input)
                        <div class="stress-input-box">
                            <div class="stress-input-label">Student's Expression</div>
                            <div class="stress-input-text">"{{ $latestRecord->text_input }}"</div>
                        </div>
                        @endif

                        {{-- Score --}}
                        @if($latestRecord)
                        <div class="score-row">
                            <span class="score-badge {{ strtolower($latestRecord->stress_level) }}">
                                <span class="score-dot"></span>
                                {{ $latestRecord->stress_level }}
                            </span>
                            <span class="score-num">Score: {{ $latestRecord->stress_score }}/50</span>
                            <span class="score-num" style="margin-left:auto;">{{ $latestRecord->created_at->format('d M Y') }}</span>
                        </div>
                        @endif

                        {{-- Contact Button --}}
                        <a href="mailto:{{ $student->email }}" class="btn-contact">
                            <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            Contact Student
                        </a>

                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                <h3>No High-Risk Cases</h3>
                <p>There are currently no students flagged as high risk. Check back regularly.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- ALL ASSESSMENTS TABLE --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/></svg>
                </div>
                <div>
                    <div class="card-title">All Student Assessments</div>
                    <div class="card-subtitle">Full assessment history with student details</div>
                </div>
            </div>
        </div>
        <div class="data-table-wrap" style="overflow-x:auto;">
            @if($allRecords->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Matric No</th>
                        <th>Department</th>
                        <th>Level</th>
                        <th>Score</th>
                        <th>Level</th>
                        <th>Expression</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allRecords as $i => $record)
                    <tr>
                        <td data-label="#" style="color:var(--muted);font-size:12px;">{{ $i + 1 }}</td>
                        <td data-label="Student Name">
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div style="width:30px;height:30px;border-radius:50%;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:var(--teal);flex-shrink:0;">
                                    {{ strtoupper(substr($record->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span style="font-weight:500;">{{ $record->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td data-label="Matric No" style="font-size:12.5px;color:var(--muted);">{{ $record->user->matric_no ?? '—' }}</td>
                        <td data-label="Department" style="font-size:12.5px;color:var(--muted);">{{ $record->user->department ?? '—' }}</td>
                        <td data-label="Level" style="font-size:12.5px;color:var(--muted);">{{ $record->user->level ? $record->user->level . 'L' : '—' }}</td>
                        <td data-label="Score"><strong>{{ $record->stress_score }}</strong><span style="color:var(--muted);font-size:12px;">/50</span></td>
                        <td data-label="Stress Level">
                            <span class="level-badge {{ strtolower($record->stress_level) }}">
                                <span class="level-dot"></span>
                                {{ $record->stress_level }}
                            </span>
                        </td>
                        <td data-label="Expression" style="font-size:12px;color:var(--muted);max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $record->text_input ? '"' . Str::limit($record->text_input, 40) . '"' : '—' }}
                        </td>
                        <td data-label="Date" style="font-size:12px;color:var(--muted);white-space:nowrap;">{{ $record->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
                No assessments submitted yet.
            </div>
            @endif
        </div>
    </div>

</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

</body>
</html>