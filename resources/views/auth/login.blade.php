<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Log In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:    #0d1f3c;
            --navy2:   #1e3a5f;
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
            --danger:  #c0392b;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--sand);
            color: var(--text);
        }

        /* ── PAGE LAYOUT ── */
        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: linear-gradient(155deg, #071422 0%, var(--navy) 35%, #0f3330 100%);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
        }

        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(26,127,116,.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(26,127,116,.07) 1px, transparent 1px);
            background-size: 44px 44px;
            pointer-events: none;
        }

        .orb { position: absolute; border-radius: 50%; pointer-events: none; }
        .orb-1 { width:320px; height:320px; top:-60px; right:-80px;  background: radial-gradient(circle, rgba(26,127,116,.22) 0%, transparent 70%); }
        .orb-2 { width:260px; height:260px; bottom:-60px; left:-60px; background: radial-gradient(circle, rgba(232,160,39,.12) 0%, transparent 70%); }
        .orb-3 { width:180px; height:180px; top:42%; left:30%;        background: radial-gradient(circle, rgba(26,127,116,.1) 0%, transparent 70%); }

        .left-top { position: relative; z-index: 2; }
        .left-mid  { position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; justify-content: center; }
        .left-bot  { position: relative; z-index: 2; }

        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-logo {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--teal), var(--teal3));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-logo svg { width: 20px; height: 20px; fill: #ffffff; }
        .brand-name { font-size: 16px; font-weight: 600; color: #ffffff; }
        .brand-sub  { font-size: 10px; color: #7a96b0; text-transform: uppercase; letter-spacing: .09em; }

        .left-headline {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.9rem, 3vw, 2.6rem);
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .left-headline em { font-style: italic; color: var(--teal-md); }

        .left-desc {
            font-size: 14px; color: #7a96b0; line-height: 1.75;
            max-width: 340px; margin-bottom: 2rem;
        }

        .pill-list { display: flex; flex-direction: column; gap: 10px; }
        .pill {
            display: inline-flex; align-items: center; gap: 10px;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(159,216,210,.15);
            border-radius: 10px; padding: 10px 14px; max-width: 340px;
        }
        .pill-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--teal-md); flex-shrink: 0; }
        .pill span { font-size: 13px; color: #9fb8cc; }

        .stat-strip { display: flex; gap: 2rem; border-top: 1px solid rgba(255,255,255,.07); padding-top: 1.5rem; }
        .stat-strip-num   { font-family: 'DM Serif Display', serif; font-size: 1.4rem; color: #ffffff; }
        .stat-strip-label { font-size: 11px; color: #3d5568; text-transform: uppercase; letter-spacing: .07em; margin-top: 2px; }

        /* ── RIGHT PANEL ── */
        .right-panel {
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
            min-height: 100vh;
        }

        .right-panel::before {
            content: '';
            position: absolute; top: 0; right: 0;
            width: 120px; height: 120px;
            background: var(--teal-lt);
            border-radius: 0 0 0 100%;
            opacity: .5;
            pointer-events: none;
        }

        .form-box {
            width: 100%; max-width: 420px;
            position: relative; z-index: 1;
            animation: fadeUp .55s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-eyebrow {
            font-size: 11px; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--teal); margin-bottom: .5rem;
        }

        .form-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem; color: var(--navy);
            line-height: 1.2; margin-bottom: .4rem;
        }

        .form-sub {
            font-size: 13.5px; color: var(--muted);
            margin-bottom: 2rem; line-height: 1.6;
        }

        /* session status */
        .session-status {
            background: var(--teal-lt);
            border: 1px solid #b5ddd9;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px; color: var(--teal2);
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        .session-status svg { width: 15px; height: 15px; fill: var(--teal2); flex-shrink: 0; }

        /* fields */
        .field { margin-bottom: 1.1rem; }

        .field label {
            display: block;
            font-size: 11.5px; font-weight: 600;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: .07em; margin-bottom: 7px;
        }

        .field input[type="email"],
        .field input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #dde3ea;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #1a2236;
            background: #f5f2ed;
            outline: none;
            transition: border-color .18s, background .18s;
        }

        .field input:focus {
            border-color: var(--teal);
            background: #fafffe;
            color: #1a2236;
        }

        .field input::placeholder { color: #9aabbc; }

        /* password wrapper */
        .pw-wrap { position: relative; }
        .pw-wrap input { padding-right: 44px; }
        .pw-eye {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; padding: 2px; display: flex;
            color: #9aabbc; transition: color .18s;
        }
        .pw-eye:hover { color: var(--teal); }
        .pw-eye svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; }

        /* error */
        .field-error {
            font-size: 12px; color: var(--danger);
            margin-top: 5px;
            display: flex; align-items: center; gap: 5px;
        }
        .field-error svg { width: 13px; height: 13px; stroke: var(--danger); fill: none; stroke-width: 2; stroke-linecap: round; flex-shrink: 0; }

        /* remember row */
        .remember-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap; gap: .5rem;
        }

        .remember-label {
            display: flex; align-items: center;
            gap: 8px; cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--teal);
            cursor: pointer;
        }

        .remember-label span { font-size: 13px; color: var(--muted); }

        .forgot-link {
            font-size: 13px; color: var(--teal);
            text-decoration: none; font-weight: 500;
            transition: opacity .18s;
        }
        .forgot-link:hover { opacity: .75; }

        /* submit */
        .btn-submit {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            background: linear-gradient(135deg, var(--teal), var(--teal2));
            color: #ffffff; border: none;
            padding: 14px; border-radius: 11px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(26,127,116,.28);
            transition: transform .2s, box-shadow .2s;
        }
        .btn-submit:hover  { transform: translateY(-1px); box-shadow: 0 7px 24px rgba(26,127,116,.38); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit svg    { width: 16px; height: 16px; fill: #ffffff; }

        /* divider */
        .or-divider {
            display: flex; align-items: center; gap: 10px;
            margin: 1.25rem 0;
        }
        .or-divider span { font-size: 12px; color: #c0cad5; white-space: nowrap; }
        .or-divider::before, .or-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* switch */
        .form-switch {
            text-align: center; margin-top: 1.25rem;
            font-size: 13px; color: var(--muted);
        }
        .form-switch a { color: var(--teal); font-weight: 500; text-decoration: none; }
        .form-switch a:hover { text-decoration: underline; }

        /* privacy */
        .privacy-note {
            display: flex; align-items: center; justify-content: center;
            gap: 5px; font-size: 11.5px; color: #c0cad5; margin-top: 1rem;
        }
        .privacy-note svg { width: 12px; height: 12px; stroke: #c0cad5; fill: none; stroke-width: 2; stroke-linecap: round; }

        /* ── RESPONSIVE ── */
        @media (max-width: 820px) {
            .auth-page   { grid-template-columns: 1fr; }
            .left-panel  { display: none; }
            .right-panel { min-height: 100vh; align-items: flex-start; padding-top: 3rem; }
        }
    </style>
</head>
<body>

<div class="auth-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="left-panel">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="left-top">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">
                    <svg viewBox="0 0 24 24"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3ZM11 14H9V12H11V14ZM15 14H13V12H15V14Z"/></svg>
                </div>
                <div>
                    <div class="brand-name">WASMIS</div>
                    <div class="brand-sub">Academic Wellness</div>
                </div>
            </a>
        </div>

        <div class="left-mid">
            <h1 class="left-headline">Your wellness<br>journey <em>starts here</em></h1>
            <p class="left-desc">Log in to access your personalised stress dashboard, track your progress, and connect with support resources.</p>
            <div class="pill-list">
                <div class="pill"><span class="pill-dot"></span><span>Confidential stress assessments</span></div>
                <div class="pill"><span class="pill-dot"></span><span>Multilingual expression support</span></div>
                <div class="pill"><span class="pill-dot"></span><span>Direct counsellor connect</span></div>
                <div class="pill"><span class="pill-dot"></span><span>Personalised wellness reports</span></div>
            </div>
        </div>

        <div class="left-bot">
            <div class="stat-strip">
                <div>
                    <div class="stat-strip-num">2,400+</div>
                    <div class="stat-strip-label">Students</div>
                </div>
                <div>
                    <div class="stat-strip-num">92%</div>
                    <div class="stat-strip-label">Satisfaction</div>
                </div>
                <div>
                    <div class="stat-strip-num">100%</div>
                    <div class="stat-strip-label">Confidential</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── RIGHT FORM PANEL ── --}}
    <div class="right-panel">
        <div class="form-box">

            <p class="form-eyebrow">Welcome Back</p>
            <h2 class="form-title">Log in to WASMIS</h2>
            <p class="form-sub">Enter your credentials to access your account.</p>

            {{-- Session Status --}}
            @if (session('status'))
            <div class="session-status">
                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label for="email">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="student@university.edu"
                        required
                        autofocus
                        autocomplete="username"
                        style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                    >
                    @error('email')
                    <p class="field-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field">
                    <label for="password">Password</label>
                    <div class="pw-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            style="width:100%;padding:12px 44px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        <button type="button" class="pw-eye" onclick="togglePw('password')" aria-label="Toggle password">
                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="field-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Remember Me + Forgot --}}
                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="btn-submit"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#ffffff;border:none;padding:14px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);"
                >
                    <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#fff;">
                        <path d="M10 17l5-5-5-5v10zm-8 5h20V2H2v20zm2-2V4h16v16H4z"/>
                    </svg>
                    Log In to WASMIS
                </button>

            </form>

            <div class="or-divider"><span>New to WASMIS?</span></div>

            <div class="form-switch">
                Don't have an account? <a href="{{ route('register') }}">Create one free →</a>
            </div>

            <div class="privacy-note">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Your data is confidential and securely encrypted.
            </div>

        </div>
    </div>

</div>

<script>
    function togglePw(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
