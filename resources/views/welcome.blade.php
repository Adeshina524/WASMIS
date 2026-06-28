<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Academic Stress Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:    #0d1f3c;
            --teal:    #1a7f74;
            --teal2:   #15928a;
            --teal3:   #25b8a8;
            --teal-lt: #e6f5f3;
            --teal-md: #9fd8d2;
            --sand:    #f5f2ed;
            --text:    #1a2236;
            --muted:   #5c6b82;
            --border:  #dde3ea;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; font-family: 'DM Sans', sans-serif; background: var(--sand); overflow-x: hidden; }

        /* ── NAVBAR ── */
        .navbar { background: var(--navy); height: 60px; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; position: sticky; top: 0; z-index: 100; }
        .nav-brand { display: flex; align-items: center; gap: 9px; text-decoration: none; min-width: 0; }
        .nav-logo  { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; white-space: nowrap; }
        .nav-sub   { color: #7a96b0; font-size: 9.5px; text-transform: uppercase; letter-spacing: .09em; white-space: nowrap; }
        .nav-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .btn-nav-primary   { background: var(--teal); color: #fff; border: none; padding: 8px 20px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; white-space: nowrap; }
        .btn-nav-secondary { background: transparent; color: #8fa3bf; border: 1px solid rgba(255,255,255,0.15); padding: 7px 18px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; white-space: nowrap; }

        /* ── HERO ── */
        .hero { background: linear-gradient(145deg, #0a1828, #0d1f3c 40%, #0f3330); padding: 5rem 2rem 4rem; text-align: center; position: relative; overflow: hidden; }
        .hero-glow-1 { position: absolute; top: -80px; right: -80px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(26,127,116,.18), transparent 70%); pointer-events: none; }
        .hero-glow-2 { position: absolute; bottom: -100px; left: -60px; width: 350px; height: 350px; border-radius: 50%; background: radial-gradient(circle, rgba(232,160,39,.1), transparent 70%); pointer-events: none; }
        .hero-inner { position: relative; z-index: 2; max-width: 720px; margin: 0 auto; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(26,127,116,.18); border: 1px solid rgba(159,216,210,.25); color: var(--teal-md); font-size: 11px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; padding: 5px 14px; border-radius: 20px; margin-bottom: 1.5rem; }
        .hero-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-md); display: inline-block; flex-shrink: 0; }
        .hero-title { font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 5vw, 3.2rem); color: #fff; line-height: 1.18; margin-bottom: 1rem; word-wrap: break-word; }
        .hero-title em { font-style: italic; color: var(--teal-md); }
        .hero-sub { font-size: 15px; color: #7a96b0; max-width: 520px; margin: 0 auto 2.5rem; line-height: 1.8; }
        .hero-cta-row { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn-hero-primary   { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--teal), var(--teal2)); color: #fff; text-decoration: none; padding: 14px 32px; border-radius: 12px; font-size: 15px; font-weight: 600; box-shadow: 0 4px 24px rgba(26,127,116,.35); }
        .btn-hero-secondary { display: inline-flex; align-items: center; background: transparent; color: var(--teal-md); border: 1px solid rgba(159,216,210,.3); text-decoration: none; padding: 14px 28px; border-radius: 12px; font-size: 15px; font-weight: 500; }

        /* ── HERO STATS ── */
        .hero-stats { display: flex; justify-content: center; margin-top: 3.5rem; flex-wrap: wrap; }
        .hero-stat { text-align: center; padding: 0 1.35rem; min-width: 0; }
        .hero-stat:not(:last-child) { border-right: 1px solid rgba(255,255,255,.07); }
        .hero-stat-value { font-family: 'DM Serif Display', serif; font-size: 2rem; color: #fff; }
        .hero-stat-label { font-size: 11px; color: #4e6a80; text-transform: uppercase; letter-spacing: .08em; margin-top: 4px; }

        /* ── SHARED SECTION HEADERS ── */
        .section-eyebrow { text-align: center; font-size: 11px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--teal); margin-bottom: .75rem; }
        .section-eyebrow.light { color: var(--teal-md); }
        .section-title { text-align: center; font-family: 'DM Serif Display', serif; font-size: clamp(1.5rem, 3vw, 2.1rem); color: var(--navy); margin-bottom: .75rem; }
        .section-title.light { color: #fff; }
        .section-sub { text-align: center; font-size: 14px; color: var(--muted); max-width: 480px; margin: 0 auto 3rem; line-height: 1.7; }
        .section-sub.light { color: #7a96b0; }

        /* ── FEATURES ── */
        .features-section { padding: 5rem 2rem; max-width: 1000px; margin: 0 auto; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        .feature-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; transition: all .22s; min-width: 0; }
        .feature-icon { width: 44px; height: 44px; background: var(--teal-lt); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
        .feature-title { font-size: 14px; font-weight: 600; color: var(--navy); margin-bottom: .5rem; }
        .feature-desc  { font-size: 13px; color: var(--muted); line-height: 1.65; }

        /* ── HOW IT WORKS ── */
        .how-section { background: var(--navy); padding: 5rem 2rem; }
        .how-inner { max-width: 900px; margin: 0 auto; }
        .how-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
        .how-step { text-align: center; padding: 1.5rem 1rem; min-width: 0; }
        .how-step-num   { width: 56px; height: 56px; border-radius: 50%; background: rgba(26,127,116,.15); border: 1px solid rgba(159,216,210,.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--teal-md); }
        .how-step-title { font-size: 13.5px; font-weight: 600; color: #c8dbe8; margin-bottom: .4rem; }
        .how-step-desc  { font-size: 12px; color: #4e6a80; line-height: 1.6; }

        /* ── CTA ── */
        .cta-section { background: linear-gradient(135deg, var(--teal), #0d6b62); padding: 4rem 2rem; text-align: center; }
        .cta-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.4rem, 3vw, 2rem); color: #fff; margin-bottom: .75rem; }
        .cta-sub   { font-size: 14px; color: rgba(255,255,255,.7); margin-bottom: 1.75rem; }
        .btn-cta   { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: var(--teal); text-decoration: none; padding: 13px 32px; border-radius: 11px; font-size: 15px; font-weight: 600; box-shadow: 0 4px 16px rgba(0,0,0,.15); }

        /* ── FOOTER ── */
        .footer { background: #080f1c; padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .footer-copy  { font-size: 12px; color: #2e4155; }
        .footer-copy span { color: var(--teal-md); }
        .footer-links { display: flex; gap: 1.25rem; }
        .footer-links a { font-size: 12px; color: #2e4155; text-decoration: none; }

        /* ══════════════════════ RESPONSIVE ══════════════════════ */

        @media (max-width: 900px) {
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .how-grid      { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .navbar  { padding: 0 1.25rem; }
            .nav-sub { display: none; }

            .hero { padding: 3.5rem 1.25rem 3rem; }
            .hero-sub { font-size: 14px; }

            .features-section { padding: 3.5rem 1.25rem; }
            .how-section       { padding: 3.5rem 1.25rem; }
        }

        @media (max-width: 640px) {
            .hero-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.75rem .5rem; margin-top: 2.5rem; }
            .hero-stat  { padding: 0; }
            .hero-stat:not(:last-child) { border-right: none; }
        }

        @media (max-width: 600px) {
            .features-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .how-grid { grid-template-columns: 1fr; }

            .nav-actions       { gap: 6px; }
            .btn-nav-secondary { padding: 7px 12px; font-size: 12px; }
            .btn-nav-primary   { padding: 7px 14px; font-size: 12px; }

            .hero-cta-row { flex-direction: column; width: 100%; }
            .btn-hero-primary, .btn-hero-secondary { width: 100%; justify-content: center; }

            .footer { flex-direction: column; text-align: center; justify-content: center; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <a href="{{ url('/') }}" class="nav-brand">
            <div class="nav-logo">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3Z"/></svg>
            </div>
            <div>
                <div class="nav-title">WASMIS</div>
                <div class="nav-sub">Academic Wellness</div>
            </div>
        </a>
        <div class="nav-actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-nav-primary">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-nav-secondary">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="btn-nav-primary">
                    Sign Up Free
                </a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>
        <div class="hero-inner">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Student Wellbeing Platform
            </div>
            <h1 class="hero-title">
                Manage Academic Stress<br><em>Before It Manages You</em>
            </h1>
            <p class="hero-sub">
                WASMIS helps you identify, track, and reduce academic stress through personalised assessments, multilingual support, and data-driven wellness insights.
            </p>
            <div class="hero-cta-row">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-hero-primary">
                        Go to My Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary">
                        Already have an account? Log in
                    </a>
                @endauth
            </div>
            {{-- Stats --}}
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-value">2,400+</div>
                    <div class="hero-stat-label">Students Supported</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-value">92%</div>
                    <div class="hero-stat-label">Stress Reduction</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-value">10</div>
                    <div class="hero-stat-label">Stress Indicators</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-value">3</div>
                    <div class="hero-stat-label">Languages</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FEATURES --}}
    <div class="features-section">
        <p class="section-eyebrow">Why WASMIS</p>
        <h2 class="section-title">Everything you need to stay well academically</h2>
        <p class="section-sub">Built with students in mind — assess, express, and understand your stress in a safe space.</p>
        <div class="features-grid">
            @foreach([
                ['Academic Wellness Assessment','A validated questionnaire measuring stress across ten key academic indicators.','M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z'],
                ['Multilingual Support','Express stress in Yoruba, Pidgin, English or any mix you prefer.','M20 2H4a2 2 0 00-2 2v18l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z'],
                ['Wellness Reports','Personalised feedback and trend reports for you and your counsellor.','M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z'],
                ['Period-Aware Tracking','Log your academic period so data is always interpreted in context.','M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z'],
                ['100% Confidential','Your data is fully encrypted and only shared with authorised counsellors.','M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4l5 2.18V11c0 3.5-2.33 6.79-5 7.93-2.67-1.14-5-4.43-5-7.93V7.18L12 5z'],
                ['Counsellor Connect','High-risk cases are automatically flagged and routed to your wellness team.','M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z'],
            ] as [$title, $desc, $icon])
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="#1a7f74"><path d="{{ $icon }}"/></svg>
                </div>
                <div class="feature-title">{{ $title }}</div>
                <div class="feature-desc">{{ $desc }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- HOW IT WORKS --}}
    <div class="how-section">
        <div class="how-inner">
            <p class="section-eyebrow light">How It Works</p>
            <h2 class="section-title light">Four simple steps to a calmer academic life</h2>
            <p class="section-sub light">From sign-up to personalised support in under five minutes.</p>
            <div class="how-grid">
                @foreach([
                    ['1','Create Account','Sign up with your student email in seconds.'],
                    ['2','Take Assessment','Answer questions in any language you prefer.'],
                    ['3','Get Results','Receive an instant personalised stress report.'],
                    ['4','Access Support','Connect with a counsellor or explore resources.'],
                ] as [$num, $title, $desc])
                <div class="how-step">
                    <div class="how-step-num">{{ $num }}</div>
                    <div class="how-step-title">{{ $title }}</div>
                    <div class="how-step-desc">{{ $desc }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="cta-section">
        <h2 class="cta-title">Ready to take control of your academic wellbeing?</h2>
        <p class="cta-sub">Join thousands of students already using WASMIS.</p>
        @auth
            <a href="{{ url('/dashboard') }}" class="btn-cta">
                Go to My Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-cta">
                Create Free Account
            </a>
        @endauth
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        <span class="footer-copy">&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></span>
        <div class="footer-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Contact</a>
        </div>
    </footer>

</body>
</html>