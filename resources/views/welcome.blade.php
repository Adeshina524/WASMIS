<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Academic Stress Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
</head>
<body style="margin:0;font-family:'DM Sans',sans-serif;background:#f5f2ed;">

    {{-- NAVBAR --}}
    <nav style="background:#0d1f3c;height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;position:sticky;top:0;z-index:100;">
        <a href="{{ url('/') }}" style="display:flex;align-items:center;gap:9px;text-decoration:none;">
            <div style="width:34px;height:34px;background:linear-gradient(135deg,#1a7f74,#25b8a8);border-radius:9px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3Z"/></svg>
            </div>
            <div>
                <div style="color:#fff;font-size:15px;font-weight:600;">WASMIS</div>
                <div style="color:#7a96b0;font-size:9.5px;text-transform:uppercase;letter-spacing:.09em;">Academic Wellness</div>
            </div>
        </a>
        <div style="display:flex;gap:8px;">
            @auth
                <a href="{{ url('/dashboard') }}" style="background:#1a7f74;color:#fff;border:none;padding:8px 20px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" style="background:transparent;color:#8fa3bf;border:1px solid rgba(255,255,255,0.15);padding:7px 18px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;">
                    Log In
                </a>
                <a href="{{ route('register') }}" style="background:#1a7f74;color:#fff;border:none;padding:8px 20px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;">
                    Sign Up Free
                </a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <div style="background:linear-gradient(145deg,#0a1828,#0d1f3c 40%,#0f3330);padding:5rem 2rem 4rem;text-align:center;position:relative;overflow:hidden;">
        <div style="position:absolute;top:-80px;right:-80px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(26,127,116,.18),transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-100px;left:-60px;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(232,160,39,.1),transparent 70%);pointer-events:none;"></div>
        <div style="position:relative;z-index:2;max-width:720px;margin:0 auto;">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(26,127,116,.18);border:1px solid rgba(159,216,210,.25);color:#9fd8d2;font-size:11px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;padding:5px 14px;border-radius:20px;margin-bottom:1.5rem;">
                <span style="width:6px;height:6px;border-radius:50%;background:#9fd8d2;display:inline-block;"></span>
                Student Wellbeing Platform
            </div>
            <h1 style="font-family:'DM Serif Display',serif;font-size:clamp(2rem,5vw,3.2rem);color:#fff;line-height:1.18;margin-bottom:1rem;">
                Manage Academic Stress<br><em style="font-style:italic;color:#9fd8d2;">Before It Manages You</em>
            </h1>
            <p style="font-size:15px;color:#7a96b0;max-width:520px;margin:0 auto 2.5rem;line-height:1.8;">
                WASMIS helps you identify, track, and reduce academic stress through personalised assessments, multilingual support, and data-driven wellness insights.
            </p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                @auth
                    <a href="{{ url('/dashboard') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;text-decoration:none;padding:14px 32px;border-radius:12px;font-size:15px;font-weight:600;box-shadow:0 4px 24px rgba(26,127,116,.35);">
                        Go to My Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;text-decoration:none;padding:14px 32px;border-radius:12px;font-size:15px;font-weight:600;box-shadow:0 4px 24px rgba(26,127,116,.35);">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" style="display:inline-flex;align-items:center;background:transparent;color:#9fd8d2;border:1px solid rgba(159,216,210,.3);text-decoration:none;padding:14px 28px;border-radius:12px;font-size:15px;font-weight:500;">
                        Already have an account? Log in
                    </a>
                @endauth
            </div>
            {{-- Stats --}}
            <div style="display:flex;justify-content:center;margin-top:3.5rem;flex-wrap:wrap;">
                <div style="text-align:center;padding:0 2.5rem;border-right:1px solid rgba(255,255,255,.07);">
                    <div style="font-family:'DM Serif Display',serif;font-size:2rem;color:#fff;">2,400+</div>
                    <div style="font-size:11px;color:#4e6a80;text-transform:uppercase;letter-spacing:.08em;margin-top:4px;">Students Supported</div>
                </div>
                <div style="text-align:center;padding:0 2.5rem;border-right:1px solid rgba(255,255,255,.07);">
                    <div style="font-family:'DM Serif Display',serif;font-size:2rem;color:#fff;">92%</div>
                    <div style="font-size:11px;color:#4e6a80;text-transform:uppercase;letter-spacing:.08em;margin-top:4px;">Stress Reduction</div>
                </div>
                <div style="text-align:center;padding:0 2.5rem;border-right:1px solid rgba(255,255,255,.07);">
                    <div style="font-family:'DM Serif Display',serif;font-size:2rem;color:#fff;">10</div>
                    <div style="font-size:11px;color:#4e6a80;text-transform:uppercase;letter-spacing:.08em;margin-top:4px;">Stress Indicators</div>
                </div>
                <div style="text-align:center;padding:0 2.5rem;">
                    <div style="font-family:'DM Serif Display',serif;font-size:2rem;color:#fff;">3</div>
                    <div style="font-size:11px;color:#4e6a80;text-transform:uppercase;letter-spacing:.08em;margin-top:4px;">Languages</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FEATURES --}}
    <div style="padding:5rem 2rem;max-width:1000px;margin:0 auto;">
        <p style="text-align:center;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:#1a7f74;margin-bottom:.75rem;">Why WASMIS</p>
        <h2 style="text-align:center;font-family:'DM Serif Display',serif;font-size:clamp(1.5rem,3vw,2.1rem);color:#0d1f3c;margin-bottom:.75rem;">Everything you need to stay well academically</h2>
        <p style="text-align:center;font-size:14px;color:#5c6b82;max-width:480px;margin:0 auto 3rem;line-height:1.7;">Built with students in mind — assess, express, and understand your stress in a safe space.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
            @foreach([
                ['Academic Wellness Assessment','A validated questionnaire measuring stress across ten key academic indicators.','M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z'],
                ['Multilingual Support','Express stress in Yoruba, Pidgin, English or any mix you prefer.','M20 2H4a2 2 0 00-2 2v18l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z'],
                ['Wellness Reports','Personalised feedback and trend reports for you and your counsellor.','M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z'],
                ['Period-Aware Tracking','Log your academic period so data is always interpreted in context.','M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z'],
                ['100% Confidential','Your data is fully encrypted and only shared with authorised counsellors.','M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4l5 2.18V11c0 3.5-2.33 6.79-5 7.93-2.67-1.14-5-4.43-5-7.93V7.18L12 5z'],
                ['Counsellor Connect','High-risk cases are automatically flagged and routed to your wellness team.','M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z'],
            ] as [$title, $desc, $icon])
            <div style="background:#fff;border:1px solid #dde3ea;border-radius:16px;padding:1.5rem;transition:all .22s;">
                <div style="width:44px;height:44px;background:#e6f5f3;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="#1a7f74"><path d="{{ $icon }}"/></svg>
                </div>
                <div style="font-size:14px;font-weight:600;color:#0d1f3c;margin-bottom:.5rem;">{{ $title }}</div>
                <div style="font-size:13px;color:#5c6b82;line-height:1.65;">{{ $desc }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- HOW IT WORKS --}}
    <div style="background:#0d1f3c;padding:5rem 2rem;">
        <div style="max-width:900px;margin:0 auto;">
            <p style="text-align:center;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:#9fd8d2;margin-bottom:.75rem;">How It Works</p>
            <h2 style="text-align:center;font-family:'DM Serif Display',serif;font-size:clamp(1.5rem,3vw,2.1rem);color:#fff;margin-bottom:.75rem;">Four simple steps to a calmer academic life</h2>
            <p style="text-align:center;font-size:14px;color:#7a96b0;max-width:480px;margin:0 auto 3rem;line-height:1.7;">From sign-up to personalised support in under five minutes.</p>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
                @foreach([
                    ['1','Create Account','Sign up with your student email in seconds.'],
                    ['2','Take Assessment','Answer questions in any language you prefer.'],
                    ['3','Get Results','Receive an instant personalised stress report.'],
                    ['4','Access Support','Connect with a counsellor or explore resources.'],
                ] as [$num, $title, $desc])
                <div style="text-align:center;padding:1.5rem 1rem;">
                    <div style="width:56px;height:56px;border-radius:50%;background:rgba(26,127,116,.15);border:1px solid rgba(159,216,210,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-family:'DM Serif Display',serif;font-size:1.3rem;color:#9fd8d2;">{{ $num }}</div>
                    <div style="font-size:13.5px;font-weight:600;color:#c8dbe8;margin-bottom:.4rem;">{{ $title }}</div>
                    <div style="font-size:12px;color:#4e6a80;line-height:1.6;">{{ $desc }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div style="background:linear-gradient(135deg,#1a7f74,#0d6b62);padding:4rem 2rem;text-align:center;">
        <h2 style="font-family:'DM Serif Display',serif;font-size:clamp(1.4rem,3vw,2rem);color:#fff;margin-bottom:.75rem;">Ready to take control of your academic wellbeing?</h2>
        <p style="font-size:14px;color:rgba(255,255,255,.7);margin-bottom:1.75rem;">Join thousands of students already using WASMIS.</p>
        @auth
            <a href="{{ url('/dashboard') }}" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:#1a7f74;text-decoration:none;padding:13px 32px;border-radius:11px;font-size:15px;font-weight:600;box-shadow:0 4px 16px rgba(0,0,0,.15);">
                Go to My Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:#1a7f74;text-decoration:none;padding:13px 32px;border-radius:11px;font-size:15px;font-weight:600;box-shadow:0 4px 16px rgba(0,0,0,.15);">
                Create Free Account
            </a>
        @endauth
    </div>

    {{-- FOOTER --}}
    <footer style="background:#080f1c;padding:1.5rem 2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <span style="font-size:12px;color:#2e4155;">&copy; {{ date('Y') }} WASMIS &mdash; Built for <span style="color:#9fd8d2;">student wellbeing</span></span>
        <div style="display:flex;gap:1.25rem;">
            <a href="#" style="font-size:12px;color:#2e4155;text-decoration:none;">Privacy</a>
            <a href="#" style="font-size:12px;color:#2e4155;text-decoration:none;">Terms</a>
            <a href="#" style="font-size:12px;color:#2e4155;text-decoration:none;">Contact</a>
        </div>
    </footer>

</body>
</html>