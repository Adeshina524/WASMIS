<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Academic Stress Assessment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:    #0d1f3c;
            --teal:    #1a7f74;
            --teal2:   #15928a;
            --teal3:   #25b8a8;
            --teal-lt: #e6f5f3;
            --teal-md: #9fd8d2;
            --sand:    #f5f2ed;
            --white:   #ffffff;
            --text:    #1a2236;
            --muted:   #5c6b82;
            --border:  #dde3ea;
            --amber:   #e8a027;
            --amber-lt:#fef7e9;
            --danger:  #c0392b;
            --danger-lt:#fff0f0;
            --purple:  #7b4ea0;
            --purple-lt:#f3eef8;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); }

        /* ── NAVBAR ── */
        .navbar { background: var(--navy); height: 64px; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 200; }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo  { width: 38px; height: 38px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .nav-logo svg { width: 20px; height: 20px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 10px; text-transform: uppercase; letter-spacing: .09em; }
        .nav-right { display: flex; align-items: center; gap: 10px; }
        .nav-user  { color: #8fa3bf; font-size: 13px; }
        .nav-logout { background: transparent; color: #8fa3bf; border: 1px solid rgba(255,255,255,.15); padding: 7px 16px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; cursor: pointer; text-decoration: none; transition: all .18s; }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        /* ── HERO ── */
        .hero { background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%); padding: 3rem 2rem 2.5rem; text-align: center; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: -60px; right: -80px; width: 300px; height: 300px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .hero::after  { content: ''; position: absolute; bottom: -70px; left: -50px; width: 220px; height: 220px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .hero-inner { position: relative; z-index: 2; }
        .hero-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(26,127,116,.22); border: 1px solid rgba(159,216,210,.28); color: var(--teal-md); font-size: 11px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; padding: 5px 14px; border-radius: 20px; margin-bottom: 1rem; }
        .hero-badge span { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-md); }
        .hero h1 { font-family: 'DM Serif Display', serif; font-size: clamp(1.6rem, 4vw, 2.3rem); color: #fff; line-height: 1.22; margin-bottom: .75rem; }
        .hero h1 em { font-style: italic; color: var(--teal-md); }
        .hero p { color: #8fa3bf; font-size: 14px; max-width: 480px; margin: 0 auto; line-height: 1.75; }

        /* ── STEPS ── */
        .steps-bar { background: #fff; border-bottom: 1px solid var(--border); padding: .85rem 2rem; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: .25rem; }
        .step { display: flex; align-items: center; gap: 7px; font-size: 12px; font-weight: 500; color: #9aabbc; white-space: nowrap; }
        .step.active { color: var(--teal); }
        .step-dot { width: 26px; height: 26px; border-radius: 50%; background: #e8ecf1; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; color: #9aabbc; flex-shrink: 0; }
        .step.active .step-dot { background: var(--teal); color: #fff; }
        .step-line { width: 30px; height: 1px; background: var(--border); margin: 0 4px; flex-shrink: 0; }

        /* ── MAIN ── */
        .main { max-width: 800px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── RESULT BANNER ── */
        .result-banner { background: linear-gradient(90deg, #e8f9f5, #fff9ee); border: 1px solid #a8dcd4; border-radius: 14px; padding: 1.1rem 1.4rem; display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; }
        .result-icon { width: 40px; height: 40px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .result-icon svg { width: 20px; height: 20px; fill: #fff; }
        .result-banner p { font-size: 14px; color: var(--navy); line-height: 1.55; }

        /* ── INFO BANNER ── */
        .info-banner { background: var(--teal-lt); border: 1px solid #c0e0db; border-radius: 12px; padding: .9rem 1.2rem; font-size: 13px; color: var(--teal2); line-height: 1.6; margin-bottom: 1.5rem; display: flex; gap: 10px; }
        .info-banner svg { width: 16px; height: 16px; fill: var(--teal); flex-shrink: 0; margin-top: 1px; }

        /* ── CARDS ── */
        .card { background: #fff; border-radius: 20px; border: 1px solid var(--border); overflow: hidden; margin-bottom: 1.5rem; box-shadow: 0 2px 20px rgba(13,31,60,.07); }
        .card-header { padding: 1.2rem 1.5rem; border-bottom: 1px solid; display: flex; align-items: center; gap: 13px; }
        .card-header.section-a { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); border-bottom-color: #c8e8e4; }
        .card-header.section-b { background: linear-gradient(90deg, var(--amber-lt), #fdf6e8); border-bottom-color: #f0dba8; }
        .card-header.section-c { background: linear-gradient(90deg, var(--purple-lt), #f7f2fa); border-bottom-color: #ddc8ea; }
        .card-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 20px; height: 20px; fill: #fff; }
        .ci-teal   { background: var(--teal); }
        .ci-amber  { background: var(--amber); }
        .ci-purple { background: var(--purple); }
        .card-title    { font-size: 15px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; margin-top: 2px; }
        .cs-teal   { color: var(--teal); }
        .cs-amber  { color: #b07000; }
        .cs-purple { color: var(--purple); }
        .card-body { padding: 1.5rem; }

        /* ── PROGRESS BADGE ── */
        .section-progress { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-left: auto; flex-shrink: 0; }
        .sp-teal   { background: var(--teal-lt); color: var(--teal); }
        .sp-amber  { background: var(--amber-lt); color: #b07000; }
        .sp-purple { background: var(--purple-lt); color: var(--purple); }

        /* ── LEGEND ── */
        .legend { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 1.4rem; }
        .legend-pill { font-size: 10.5px; font-weight: 500; padding: 4px 10px; border-radius: 20px; }
        .lp-1 { background: #e8f9f0; color: #27ae60; }
        .lp-2 { background: #f0f2f5; color: var(--muted); }
        .lp-3 { background: #f0f2f5; color: var(--muted); }
        .lp-4 { background: var(--amber-lt); color: #b07000; }
        .lp-5 { background: var(--danger-lt); color: var(--danger); }

        /* ── QUESTION ROWS ── */
        .q-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .9rem 0; border-bottom: 1px solid #f0f2f5; }
        .q-row:last-child { border-bottom: none; }
        .q-left { display: flex; align-items: flex-start; gap: 9px; flex: 1; }
        .q-num  { display: inline-flex; align-items: center; justify-content: center; min-width: 24px; height: 24px; border-radius: 6px; font-size: 10px; font-weight: 700; flex-shrink: 0; margin-top: 2px; }
        .qn-teal   { background: var(--teal-lt); color: var(--teal); }
        .qn-amber  { background: var(--amber-lt); color: #b07000; }
        .qn-purple { background: var(--purple-lt); color: var(--purple); }
        .q-text { font-size: 13.5px; color: var(--text); line-height: 1.5; }
        .q-reverse-tag { display: inline-block; font-size: 9px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: #c0cad5; margin-left: 6px; }

        select.q-select {
            font-family: 'DM Sans', sans-serif; font-size: 13px;
            color: #1a2236; background-color: #f5f2ed;
            border: 1.5px solid #dde3ea; border-radius: 9px;
            padding: 9px 34px 9px 12px; min-width: 160px;
            appearance: none; -webkit-appearance: none; cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' viewBox='0 0 11 7'%3E%3Cpath d='M1 1l4.5 4.5L10 1' stroke='%235c6b82' stroke-width='1.6' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 11px center;
        }
        select.q-select:focus { outline: none; border-color: var(--teal); background-color: #fafffe; }
        select.q-select option { color: #1a2236; background: #fff; }

        /* ── PROGRESS BAR (overall) ── */
        .overall-progress { background: #fff; border: 1px solid var(--border); border-radius: 14px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; position: sticky; top: 78px; z-index: 50; box-shadow: 0 2px 12px rgba(13,31,60,.06); }
        .op-label { display: flex; justify-content: space-between; font-size: 12px; color: var(--muted); margin-bottom: .5rem; }
        .op-label strong { color: var(--navy); }
        .progress-track { background: #e8ecf1; border-radius: 6px; height: 8px; overflow: hidden; }
        .progress-fill { background: linear-gradient(90deg, var(--teal), var(--teal3)); height: 100%; width: 0%; border-radius: 6px; transition: width .3s ease; }

        /* ── TEXTAREA ── */
        .stress-textarea { width: 100%; padding: 13px 15px; border: 1.5px solid #dde3ea; border-radius: 12px; font-family: 'DM Sans', sans-serif; font-size: 13.5px; color: #1a2236; background: #f5f2ed; resize: vertical; min-height: 95px; line-height: 1.6; }
        .stress-textarea:focus { outline: none; border-color: var(--teal); background: #fafffe; }
        .stress-textarea::placeholder { color: #9aabbc; }
        .input-hint { font-size: 12px; color: var(--muted); margin-top: 7px; font-style: italic; }
        .required-tag { color: var(--danger); font-weight: 600; }

        /* ── SELECT GRID ── */
        .select-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.1rem; }
        .select-group label { display: block; font-size: 11.5px; font-weight: 600; color: var(--muted); margin-bottom: 7px; text-transform: uppercase; letter-spacing: .07em; }
        .select-group select { width: 100%; }

        /* ── SUBMIT ── */
        .submit-section { text-align: center; padding-top: .5rem; }
        .privacy-note { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 12px; color: var(--muted); margin-top: .85rem; }
        .privacy-note svg { width: 13px; height: 13px; flex-shrink: 0; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 640px) {
            .select-grid { grid-template-columns: 1fr; }
            .q-row { flex-wrap: wrap; }
            select.q-select { width: 100%; min-width: 0; }
            .overall-progress { position: static; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-logo">
            <svg viewBox="0 0 24 24"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3Z"/></svg>
        </div>
        <div>
            <div class="nav-title">WASMIS</div>
            <div class="nav-sub">Academic Wellness</div>
        </div>
    </a>
    <div class="nav-right">
        <span class="nav-user">👋 {{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="nav-logout">Log Out</button>
        </form>
    </div>
</nav>

{{-- HERO --}}
<div class="hero">
    <div class="hero-inner">
        <div class="hero-badge"><span></span>Confidential &amp; Secure Assessment</div>
        <h1>Academic Stress<br><em>Assessment Tool</em></h1>
        <p>This 26-item assessment helps us understand your stress levels across multiple dimensions. Please answer honestly — there are no right or wrong answers.</p>
    </div>
</div>

{{-- STEP TRACKER --}}
<div class="steps-bar">
    <div class="step active"><div class="step-dot">A</div>General Stress</div>
    <div class="step-line"></div>
    <div class="step active"><div class="step-dot">B</div>Tension Symptoms</div>
    <div class="step-line"></div>
    <div class="step active"><div class="step-dot">C</div>Academic Stressors</div>
    <div class="step-line"></div>
    <div class="step active"><div class="step-dot">D</div>Expression</div>
</div>

<div class="main">

    @if(session('result'))
    <div class="result-banner">
        <div class="result-icon"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
        <p><strong>Assessment Complete!</strong><br>{{ session('result') }}</p>
    </div>
    @endif

    <div class="info-banner">
        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
        <span>This assessment has <strong>26 required questions</strong> across 3 sections, plus a short reflection. It takes about 5 minutes to complete.</span>
    </div>

    {{-- OVERALL PROGRESS --}}
    <div class="overall-progress">
        <div class="op-label">
            <span>Overall Progress</span>
            <strong id="overallLabel">0 of 26 answered</strong>
        </div>
        <div class="progress-track"><div class="progress-fill" id="overallFill"></div></div>
    </div>

    <form method="POST" action="{{ route('stress.submit') }}" id="assessmentForm">
        @csrf

        {{-- ══════════════ SECTION A: GENERAL STRESS ══════════════ --}}
        <div class="card">
            <div class="card-header section-a">
                <div class="card-icon ci-teal">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
                <div>
                    <div class="card-title">Section A — General Stress</div>
                    <div class="card-subtitle cs-teal">How often have you experienced the following recently?</div>
                </div>
                <span class="section-progress sp-teal" id="sectionABadge">0/5</span>
            </div>
            <div class="card-body">
                <div class="legend">
                    <span class="legend-pill lp-1">1 – Never</span>
                    <span class="legend-pill lp-2">2 – Almost Never</span>
                    <span class="legend-pill lp-3">3 – Sometimes</span>
                    <span class="legend-pill lp-4">4 – Fairly Often</span>
                    <span class="legend-pill lp-5">5 – Very Often</span>
                </div>

                @php
                    $sectionA = [
                        "How often have you felt nervous and stressed?",
                        "How often have you found that you could not cope with all the things you had to do?",
                        "How often do you feel overwhelmed?",
                        "How often have you felt confident about your ability to handle your personal problems?",
                        "How often have you felt that you were on top of things?",
                    ];
                    $reverseA = [4, 5]; // 1-indexed positions that are reverse-scored
                @endphp

                <div id="sectionAQuestions">
                    @foreach($sectionA as $index => $q)
                    @php $num = $index + 1; @endphp
                    <div class="q-row">
                        <div class="q-left">
                            <span class="q-num qn-teal">A{{ $num }}</span>
                            <span class="q-text">{{ $q }}
                                @if(in_array($num, $reverseA))
                                    <span class="q-reverse-tag">·</span>
                                @endif
                            </span>
                        </div>
                        <select name="a{{ $num }}" class="q-select section-a-select" required onchange="updateProgress()">
                            <option value="" disabled selected>Select response</option>
                            <option value="1">1 – Never</option>
                            <option value="2">2 – Almost Never</option>
                            <option value="3">3 – Sometimes</option>
                            <option value="4">4 – Fairly Often</option>
                            <option value="5">5 – Very Often</option>
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════ SECTION B: TENSION SYMPTOMS ══════════════ --}}
        <div class="card">
            <div class="card-header section-b">
                <div class="card-icon ci-amber">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                </div>
                <div>
                    <div class="card-title">Section B — Tension Symptoms</div>
                    <div class="card-subtitle cs-amber">Rate how each statement applies to you</div>
                </div>
                <span class="section-progress sp-amber" id="sectionBBadge">0/7</span>
            </div>
            <div class="card-body">
                <div class="legend">
                    <span class="legend-pill lp-1">1 – Not at all</span>
                    <span class="legend-pill lp-3">2 – Sometimes</span>
                    <span class="legend-pill lp-4">4 – Often</span>
                    <span class="legend-pill lp-5">5 – Most of the time</span>
                </div>

                @php
                    $sectionB = [
                        "I find it hard to wind down after activities.",
                        "I often over-react to situations.",
                        "I think that I am using a lot of nervous energy.",
                        "I often get impatient when delayed (e.g. traffic, waiting in queues).",
                        "I am often agitated.",
                        "I find it difficult to relax.",
                        "I can't tolerate any disturbance.",
                    ];
                @endphp

                <div id="sectionBQuestions">
                    @foreach($sectionB as $index => $q)
                    @php $num = $index + 1; @endphp
                    <div class="q-row">
                        <div class="q-left">
                            <span class="q-num qn-amber">B{{ $num }}</span>
                            <span class="q-text">{{ $q }}</span>
                        </div>
                        <select name="b{{ $num }}" class="q-select section-b-select" required onchange="updateProgress()">
                            <option value="" disabled selected>Select response</option>
                            <option value="1">1 – Not at all</option>
                            <option value="2">2 – Sometimes</option>
                            <option value="4">4 – Often</option>
                            <option value="5">5 – Most of the time</option>
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════ SECTION C: ACADEMIC STRESSORS ══════════════ --}}
        <div class="card">
            <div class="card-header section-c">
                <div class="card-icon ci-purple">
                    <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
                </div>
                <div>
                    <div class="card-title">Section C — Academic Stressors</div>
                    <div class="card-subtitle cs-purple">Rate how much each factor affects you</div>
                </div>
                <span class="section-progress sp-purple" id="sectionCBadge">0/14</span>
            </div>
            <div class="card-body">
                <div class="legend">
                    <span class="legend-pill lp-1">1 – Very Low</span>
                    <span class="legend-pill lp-2">2 – Low</span>
                    <span class="legend-pill lp-3">3 – Moderate</span>
                    <span class="legend-pill lp-4">4 – High</span>
                    <span class="legend-pill lp-5">5 – Very High</span>
                </div>

                @php
                    $sectionC = [
                        "Volume of schoolwork and assignments",
                        "Difficulty level of exams and tests",
                        "Fear of failure or poor academic grades",
                        "Financial constraints affecting academic performance",
                        "Poor internet / connectivity for online learning resources",
                        "Lack of time for rest, recreation, or personal activities",
                        "Uncertainty about future employment prospects after graduation",
                        "I find it difficult to concentrate on my studies",
                        "I feel mentally exhausted after studying",
                        "I lose motivation to study",
                        "I procrastinate on academic tasks",
                        "I feel I have no one to talk to about my academic struggles",
                        "I feel isolated from friends and family because of schoolwork",
                        "I feel I am able to manage my academic workload well",
                    ];
                    $reverseC = [14];
                @endphp

                <div id="sectionCQuestions">
                    @foreach($sectionC as $index => $q)
                    @php $num = $index + 1; @endphp
                    <div class="q-row">
                        <div class="q-left">
                            <span class="q-num qn-purple">C{{ $num }}</span>
                            <span class="q-text">{{ $q }}
                                @if(in_array($num, $reverseC))
                                    <span class="q-reverse-tag">·</span>
                                @endif
                            </span>
                        </div>
                        <select name="c{{ $num }}" class="q-select section-c-select" required onchange="updateProgress()">
                            <option value="" disabled selected>Select response</option>
                            <option value="1">1 – Very Low</option>
                            <option value="2">2 – Low</option>
                            <option value="3">3 – Moderate</option>
                            <option value="4">4 – High</option>
                            <option value="5">5 – Very High</option>
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════ SECTION D: EXPRESSION ══════════════ --}}
        <div class="card">
            <div class="card-header section-a">
                <div class="card-icon ci-teal">
                    <svg viewBox="0 0 24 24"><path d="M20 2H4a2 2 0 00-2 2v18l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
                </div>
                <div>
                    <div class="card-title">Express Your Stress <span class="required-tag">*</span></div>
                    <div class="card-subtitle cs-teal">Write in any language you're comfortable with</div>
                </div>
            </div>
            <div class="card-body">
                <textarea
                    name="text_input"
                    id="textInput"
                    class="stress-textarea"
                    placeholder="e.g. I don tire, ori mi n dun, I feel overwhelmed, omo this school ehn…"
                    required
                    onkeyup="updateProgress()"
                ></textarea>
                <p class="input-hint">Required — any language welcome: Yoruba, Pidgin, English, or any mix that feels natural.</p>
            </div>
        </div>

        {{-- CONTEXT (optional) --}}
        <div class="card">
            <div class="card-header section-a">
                <div class="card-icon ci-teal">
                    <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg>
                </div>
                <div>
                    <div class="card-title">Stress Context <span style="color:var(--muted);font-weight:400;font-size:11px;">(optional)</span></div>
                    <div class="card-subtitle cs-teal">Help us understand when stress peaks for you</div>
                </div>
            </div>
            <div class="card-body">
                <div class="select-grid">
                    <div class="select-group">
                        <label>Time of Day</label>
                        <select name="time_period" class="q-select">
                            <option value="morning">🌅 Morning</option>
                            <option value="afternoon">☀️ Afternoon</option>
                            <option value="night">🌙 Night</option>
                        </select>
                    </div>
                    <div class="select-group">
                        <label>Academic Period</label>
                        <select name="academic_period" class="q-select">
                            <option value="normal">📚 Normal Period</option>
                            <option value="test">📝 Test Period</option>
                            <option value="exam">🎓 Exam Period</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="submit-section">
            <button type="submit" id="submitBtn" style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;padding:15px 52px;border:none;border-radius:13px;cursor:pointer;box-shadow:0 4px 20px rgba(26,127,116,0.32);">
                <svg viewBox="0 0 24 24" style="width:17px;height:17px;fill:#fff;flex-shrink:0;"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                Submit Assessment
            </button>
            <div class="privacy-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="#5c6b82" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Your responses are confidential and used solely for wellness support.
            </div>
        </div>

    </form>
</div>

<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

<script>
    function updateProgress() {
        const aSelects = document.querySelectorAll('.section-a-select');
        const bSelects = document.querySelectorAll('.section-b-select');
        const cSelects = document.querySelectorAll('.section-c-select');
        const textInput = document.getElementById('textInput');

        let aCount = 0, bCount = 0, cCount = 0;
        aSelects.forEach(s => { if (s.value) aCount++; });
        bSelects.forEach(s => { if (s.value) bCount++; });
        cSelects.forEach(s => { if (s.value) cCount++; });
        const textCount = textInput.value.trim().length > 0 ? 1 : 0;

        document.getElementById('sectionABadge').textContent = aCount + '/5';
        document.getElementById('sectionBBadge').textContent = bCount + '/7';
        document.getElementById('sectionCBadge').textContent = cCount + '/14';

        const totalAnswered = aCount + bCount + cCount + textCount;
        const totalQuestions = 5 + 7 + 14 + 1;

        document.getElementById('overallLabel').textContent = totalAnswered + ' of ' + totalQuestions + ' answered';
        document.getElementById('overallFill').style.width = (totalAnswered / totalQuestions * 100) + '%';
    }

    updateProgress();
</script>

</body>
</html>