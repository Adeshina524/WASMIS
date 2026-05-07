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
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--navy);
            height: 64px;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 200;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo  { width: 38px; height: 38px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .nav-logo svg { width: 20px; height: 20px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 10px; text-transform: uppercase; letter-spacing: .09em; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-user  { color: #8fa3bf; font-size: 13px; }
        .nav-logout {
            background: transparent;
            color: #8fa3bf;
            border: 1px solid rgba(255,255,255,.15);
            padding: 7px 16px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: all .18s;
        }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%);
            padding: 3rem 2rem 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before { content: ''; position: absolute; top: -60px; right: -80px; width: 300px; height: 300px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .hero::after  { content: ''; position: absolute; bottom: -70px; left: -50px; width: 220px; height: 220px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .hero-inner { position: relative; z-index: 2; }
        .hero-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(26,127,116,.22); border: 1px solid rgba(159,216,210,.28); color: var(--teal-md); font-size: 11px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; padding: 5px 14px; border-radius: 20px; margin-bottom: 1rem; }
        .hero-badge span { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-md); }
        .hero h1 { font-family: 'DM Serif Display', serif; font-size: clamp(1.6rem, 4vw, 2.3rem); color: #fff; line-height: 1.22; margin-bottom: .75rem; }
        .hero h1 em { font-style: italic; color: var(--teal-md); }
        .hero p { color: #8fa3bf; font-size: 14px; max-width: 460px; margin: 0 auto; line-height: 1.75; }

        /* ── STEPS ── */
        .steps-bar { background: #fff; border-bottom: 1px solid var(--border); padding: .85rem 2rem; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: .25rem; }
        .step { display: flex; align-items: center; gap: 7px; font-size: 12px; font-weight: 500; color: #9aabbc; white-space: nowrap; }
        .step.active { color: var(--teal); }
        .step-dot { width: 26px; height: 26px; border-radius: 50%; background: #e8ecf1; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; color: #9aabbc; flex-shrink: 0; }
        .step.active .step-dot { background: var(--teal); color: #fff; }
        .step-line { width: 36px; height: 1px; background: var(--border); margin: 0 4px; flex-shrink: 0; }

        /* ── MAIN ── */
        .main { max-width: 780px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── RESULT BANNER ── */
        .result-banner { background: linear-gradient(90deg, #e8f9f5, #fff9ee); border: 1px solid #a8dcd4; border-radius: 14px; padding: 1.1rem 1.4rem; display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; }
        .result-icon { width: 40px; height: 40px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .result-icon svg { width: 20px; height: 20px; fill: #fff; }
        .result-banner p { font-size: 14px; color: var(--navy); line-height: 1.55; }

        /* ── CARDS ── */
        .card { background: #fff; border-radius: 20px; border: 1px solid var(--border); overflow: hidden; margin-bottom: 1.5rem; box-shadow: 0 2px 20px rgba(13,31,60,.07); }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.2rem 1.5rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; gap: 13px; }
        .card-icon { width: 40px; height: 40px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 20px; height: 20px; fill: #fff; }
        .card-title    { font-size: 15px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 2px; }
        .card-body { padding: 1.5rem; }

        /* ── LEGEND ── */
        .legend { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 1.4rem; }
        .legend-pill { font-size: 11px; font-weight: 500; padding: 4px 11px; border-radius: 20px; }
        .lp-green   { background: var(--teal-lt); color: var(--teal); }
        .lp-neutral { background: #f0f2f5; color: var(--muted); }
        .lp-amber   { background: #fef7e9; color: #b07000; }
        .lp-red     { background: #fff0f0; color: #c0392b; }

        /* ── QUESTION ROWS ── */
        .q-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .95rem 0; border-bottom: 1px solid #f0f2f5; }
        .q-row:last-child { border-bottom: none; }
        .q-left { display: flex; align-items: flex-start; gap: 9px; flex: 1; }
        .q-num  { display: inline-flex; align-items: center; justify-content: center; min-width: 24px; height: 24px; background: var(--teal-lt); color: var(--teal); border-radius: 6px; font-size: 10px; font-weight: 700; flex-shrink: 0; margin-top: 2px; }
        .q-text { font-size: 13.5px; color: var(--text); line-height: 1.5; }

        /* ── PROGRESS ── */
        .progress-track { background: #e8ecf1; border-radius: 6px; height: 6px; margin-top: 1.25rem; overflow: hidden; }
        .progress-fill  { background: var(--teal); height: 100%; width: 0%; border-radius: 6px; transition: width .35s ease; }
        .progress-label { font-size: 11.5px; color: var(--muted); margin-top: 6px; }

        /* ── TEXTAREA ── */
        .stress-textarea {
            width: 100%; padding: 13px 15px;
            border: 1.5px solid #dde3ea; border-radius: 12px;
            font-family: 'DM Sans', sans-serif; font-size: 13.5px;
            color: #1a2236; background: #f5f2ed;
            resize: vertical; min-height: 95px; line-height: 1.6;
            transition: border-color .18s, background .18s;
        }
        .stress-textarea:focus { outline: none; border-color: var(--teal); background: #fafffe; }
        .stress-textarea::placeholder { color: #9aabbc; }
        .input-hint { font-size: 12px; color: var(--muted); margin-top: 7px; font-style: italic; }

        /* ── CONTEXT GRID ── */
        .select-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.1rem; }
        .select-group label { display: block; font-size: 11.5px; font-weight: 600; color: var(--muted); margin-bottom: 7px; text-transform: uppercase; letter-spacing: .07em; }

        /* ── SUBMIT ── */
        .submit-section { text-align: center; padding-top: .5rem; }
        .privacy-note { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 12px; color: var(--muted); margin-top: .85rem; }
        .privacy-note svg { width: 13px; height: 13px; flex-shrink: 0; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 2rem; text-align: center; margin-top: .5rem; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 640px) {
            .step-line   { width: 20px; }
            .select-grid { grid-template-columns: 1fr; }
            .q-row       { flex-wrap: wrap; }
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
        <p>This short questionnaire helps us understand your academic stress levels and tailor personalised support for you.</p>
    </div>
</div>

{{-- STEP TRACKER --}}
<div class="steps-bar">
    <div class="step active"><div class="step-dot">1</div>Questionnaire</div>
    <div class="step-line"></div>
    <div class="step"><div class="step-dot">2</div>Expression</div>
    <div class="step-line"></div>
    <div class="step"><div class="step-dot">3</div>Context</div>
    <div class="step-line"></div>
    <div class="step"><div class="step-dot">4</div>Results</div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- Result Banner --}}
    @if(session('result'))
    <div class="result-banner">
        <div class="result-icon"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
        <p><strong>Assessment Complete!</strong><br>{{ session('result') }}</p>
    </div>
    @endif

    <form method="POST" action="{{ route('stress.submit') }}">
        @csrf

        {{-- CARD 1: QUESTIONNAIRE --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
                </div>
                <div>
                    <div class="card-title">Stress Indicators Questionnaire</div>
                    <div class="card-subtitle">Rate each item based on your experience in the past two weeks</div>
                </div>
            </div>
            <div class="card-body">
                <div class="legend">
                    <span class="legend-pill lp-green">1 – Not at all</span>
                    <span class="legend-pill lp-neutral">2 – Rarely</span>
                    <span class="legend-pill lp-neutral">3 – Sometimes</span>
                    <span class="legend-pill lp-amber">4 – Often</span>
                    <span class="legend-pill lp-red">5 – Always</span>
                </div>

                @php
                    $questions = [
                        "I feel overwhelmed with academic workload",
                        "I find it difficult to concentrate on my studies",
                        "I feel anxious about upcoming exams",
                        "I experience difficulty sleeping due to academic stress",
                        "I feel mentally exhausted after studying",
                        "I struggle to meet assignment deadlines",
                        "I feel pressure to perform well academically",
                        "I lose motivation to study",
                        "I feel frustrated with my academic performance",
                        "I feel emotionally drained due to school work",
                    ];
                @endphp

                <div id="wasmisQuestionnaire">
                    @foreach($questions as $index => $q)
                    <div class="q-row">
                        <div class="q-left">
                            <span class="q-num">{{ $index + 1 }}</span>
                            <span class="q-text">{{ $q }}</span>
                        </div>
                        <select
                            name="q{{ $index + 1 }}"
                            required
                            onchange="updateProgress()"
                            style="
                                font-family:'DM Sans',sans-serif;font-size:13px;
                                color:#1a2236;background-color:#f5f2ed;
                                border:1.5px solid #dde3ea;border-radius:9px;
                                padding:9px 34px 9px 12px;min-width:155px;
                                appearance:none;-webkit-appearance:none;cursor:pointer;
                                background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');
                                background-repeat:no-repeat;background-position:right 11px center;
                            "
                        >
                            <option value="" disabled selected style="color:#9aabbc;background:#fff;">Select response</option>
                            <option value="1" style="color:#1a2236;background:#fff;">1 – Not at all</option>
                            <option value="2" style="color:#1a2236;background:#fff;">2 – Rarely</option>
                            <option value="3" style="color:#1a2236;background:#fff;">3 – Sometimes</option>
                            <option value="4" style="color:#1a2236;background:#fff;">4 – Often</option>
                            <option value="5" style="color:#1a2236;background:#fff;">5 – Always</option>
                        </select>
                    </div>
                    @endforeach
                </div>

                <div class="progress-track"><div class="progress-fill" id="progressFill"></div></div>
                <p class="progress-label" id="progressLabel">0 of 10 questions answered</p>
            </div>
        </div>

        {{-- CARD 2: EXPRESSION --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 2H4a2 2 0 00-2 2v18l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
                </div>
                <div>
                    <div class="card-title">Express Your Stress</div>
                    <div class="card-subtitle">Write in any language you're comfortable with</div>
                </div>
            </div>
            <div class="card-body">
                <textarea
                    name="text_input"
                    class="stress-textarea"
                    placeholder="e.g. I don tire, ori mi n dun, I feel like I can't breathe, omo this school ehn…"
                ></textarea>
                <p class="input-hint">Any language is welcome — Yoruba, Pidgin, English, or any mix that feels natural.</p>
            </div>
        </div>

        {{-- CARD 3: CONTEXT --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg>
                </div>
                <div>
                    <div class="card-title">Stress Context</div>
                    <div class="card-subtitle">Help us understand when stress peaks for you</div>
                </div>
            </div>
            <div class="card-body">
                <div class="select-grid">
                    <div class="select-group">
                        <label>Time of Day</label>
                        <select name="time_period" style="width:100%;font-family:'DM Sans',sans-serif;font-size:13px;color:#1a2236;background-color:#f5f2ed;border:1.5px solid #dde3ea;border-radius:10px;padding:12px 40px 12px 14px;appearance:none;-webkit-appearance:none;cursor:pointer;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 14px center;">
                            <option value="morning"   style="color:#1a2236;background:#fff;">🌅 Morning</option>
                            <option value="afternoon" style="color:#1a2236;background:#fff;">☀️ Afternoon</option>
                            <option value="night"     style="color:#1a2236;background:#fff;">🌙 Night</option>
                        </select>
                    </div>
                    <div class="select-group">
                        <label>Academic Period</label>
                        <select name="academic_period" style="width:100%;font-family:'DM Sans',sans-serif;font-size:13px;color:#1a2236;background-color:#f5f2ed;border:1.5px solid #dde3ea;border-radius:10px;padding:12px 40px 12px 14px;appearance:none;-webkit-appearance:none;cursor:pointer;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 14px center;">
                            <option value="normal" style="color:#1a2236;background:#fff;">📚 Normal Period</option>
                            <option value="test"   style="color:#1a2236;background:#fff;">📝 Test Period</option>
                            <option value="exam"   style="color:#1a2236;background:#fff;">🎓 Exam Period</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="submit-section">
            <button type="submit" style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#ffffff;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;padding:15px 52px;border:none;border-radius:13px;cursor:pointer;box-shadow:0 4px 20px rgba(26,127,116,0.32);">
                <svg viewBox="0 0 24 24" style="width:17px;height:17px;fill:#ffffff;flex-shrink:0;"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                Submit Assessment
            </button>
            <div class="privacy-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="#5c6b82" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Your responses are confidential and used solely for wellness support.
            </div>
        </div>

    </form>
</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

<script>
    function updateProgress() {
        const selects = document.querySelectorAll('#wasmisQuestionnaire select');
        let answered = 0;
        selects.forEach(s => { if (s.value) answered++; });
        document.getElementById('progressFill').style.width = (answered / selects.length * 100) + '%';
        document.getElementById('progressLabel').textContent = answered + ' of ' + selects.length + ' questions answered';
    }
</script>

</body>
</html>