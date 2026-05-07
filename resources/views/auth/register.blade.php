<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Create Account</title>
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

        html, body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); }

        /* ── PAGE LAYOUT ── */
        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: linear-gradient(155deg, #071422 0%, var(--navy) 35%, #0f3330 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
            position: sticky;
            top: 0;
            height: 100vh;
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
        .orb-1 { width:320px;height:320px;top:-60px;right:-80px;  background:radial-gradient(circle,rgba(26,127,116,.22) 0%,transparent 70%); }
        .orb-2 { width:260px;height:260px;bottom:-60px;left:-60px; background:radial-gradient(circle,rgba(232,160,39,.12) 0%,transparent 70%); }
        .orb-3 { width:180px;height:180px;top:42%;left:30%;        background:radial-gradient(circle,rgba(26,127,116,.1) 0%,transparent 70%); }

        .left-top { position:relative;z-index:2; }
        .left-mid  { position:relative;z-index:2;flex:1;display:flex;flex-direction:column;justify-content:center; }
        .left-bot  { position:relative;z-index:2; }

        .brand { display:flex;align-items:center;gap:10px;text-decoration:none; }
        .brand-logo { width:38px;height:38px;background:linear-gradient(135deg,var(--teal),var(--teal3));border-radius:10px;display:flex;align-items:center;justify-content:center; }
        .brand-logo svg { width:20px;height:20px;fill:#fff; }
        .brand-name { font-size:16px;font-weight:600;color:#fff; }
        .brand-sub  { font-size:10px;color:#7a96b0;text-transform:uppercase;letter-spacing:.09em; }

        .left-headline { font-family:'DM Serif Display',serif;font-size:clamp(1.9rem,3vw,2.6rem);color:#fff;line-height:1.2;margin-bottom:1rem; }
        .left-headline em { font-style:italic;color:var(--teal-md); }
        .left-desc { font-size:14px;color:#7a96b0;line-height:1.75;max-width:340px;margin-bottom:2rem; }

        .step-list { display:flex;flex-direction:column;gap:14px; }
        .step-item { display:flex;align-items:flex-start;gap:13px;max-width:340px; }
        .step-badge { width:28px;height:28px;border-radius:8px;background:rgba(26,127,116,.2);border:1px solid rgba(159,216,210,.2);display:flex;align-items:center;justify-content:center;font-family:'DM Serif Display',serif;font-size:.9rem;color:var(--teal-md);flex-shrink:0;margin-top:1px; }
        .step-title { font-size:13px;font-weight:600;color:#c8dbe8;margin-bottom:2px; }
        .step-desc  { font-size:12px;color:#4e6a80;line-height:1.55; }

        .stat-strip { display:flex;gap:2rem;border-top:1px solid rgba(255,255,255,.07);padding-top:1.5rem; }
        .stat-strip-num   { font-family:'DM Serif Display',serif;font-size:1.4rem;color:#fff; }
        .stat-strip-label { font-size:11px;color:#3d5568;text-transform:uppercase;letter-spacing:.07em;margin-top:2px; }

        /* ── RIGHT PANEL ── */
        .right-panel {
            background: var(--white);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
            overflow-y: auto;
            min-height: 100vh;
        }

        .right-panel::before {
            content:'';position:absolute;top:0;right:0;
            width:120px;height:120px;
            background:var(--teal-lt);border-radius:0 0 0 100%;
            opacity:.5;pointer-events:none;
        }

        .form-box {
            width:100%;max-width:480px;
            position:relative;z-index:1;
            padding:1rem 0 3rem;
            animation:fadeUp .55s ease both;
        }

        @keyframes fadeUp {
            from { opacity:0;transform:translateY(16px); }
            to   { opacity:1;transform:translateY(0); }
        }

        .form-eyebrow { font-size:11px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--teal);margin-bottom:.5rem; }
        .form-title   { font-family:'DM Serif Display',serif;font-size:2rem;color:var(--navy);line-height:1.2;margin-bottom:.4rem; }
        .form-sub     { font-size:13.5px;color:var(--muted);margin-bottom:1.75rem;line-height:1.6; }

        /* Section divider */
        .section-divider {
            display:flex;align-items:center;gap:10px;
            margin:1.25rem 0 1rem;
        }
        .section-divider span { font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#c0cad5;white-space:nowrap; }
        .section-divider::before,.section-divider::after { content:'';flex:1;height:1px;background:var(--border); }

        /* Fields */
        .field { margin-bottom:1rem; }
        .field-row { display:grid;grid-template-columns:1fr 1fr;gap:.85rem; }

        .field label {
            display:block;font-size:11.5px;font-weight:600;
            color:var(--muted);text-transform:uppercase;
            letter-spacing:.07em;margin-bottom:6px;
        }

        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field input[type="tel"],
        .field select {
            width:100%;padding:12px 15px;
            border:1.5px solid #dde3ea;border-radius:10px;
            font-family:'DM Sans',sans-serif;font-size:14px;
            color:#1a2236;background:#f5f2ed;
            outline:none;transition:border-color .18s,background .18s;
            appearance:none;-webkit-appearance:none;
        }

        .field input:focus,
        .field select:focus { border-color:var(--teal);background:#fafffe;color:#1a2236; }
        .field input::placeholder { color:#9aabbc; }

        .field select {
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' viewBox='0 0 11 7'%3E%3Cpath d='M1 1l4.5 4.5L10 1' stroke='%235c6b82' stroke-width='1.6' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat:no-repeat;
            background-position:right 12px center;
            padding-right:34px;
            cursor:pointer;
        }

        .field select option { color:#1a2236;background:#fff; }

        /* password */
        .pw-wrap { position:relative; }
        .pw-wrap input { padding-right:44px; }
        .pw-eye { position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:2px;display:flex;color:#9aabbc;transition:color .18s; }
        .pw-eye:hover { color:var(--teal); }
        .pw-eye svg { width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round; }

        /* strength */
        .strength-bar { display:flex;gap:4px;margin-top:7px; }
        .strength-seg { height:3px;flex:1;border-radius:3px;background:#e8ecf1;transition:background .3s; }

        /* error */
        .field-error { font-size:12px;color:var(--danger);margin-top:5px;display:flex;align-items:center;gap:5px; }
        .field-error svg { width:13px;height:13px;stroke:var(--danger);fill:none;stroke-width:2;stroke-linecap:round;flex-shrink:0; }

        /* terms */
        .terms-row { display:flex;align-items:flex-start;gap:9px;margin-bottom:1.25rem; }
        .terms-row input[type="checkbox"] { width:16px;height:16px;accent-color:var(--teal);cursor:pointer;flex-shrink:0;margin-top:2px; }
        .terms-row span { font-size:12.5px;color:var(--muted);line-height:1.5; }
        .terms-row a { color:var(--teal);text-decoration:none;font-weight:500; }

        /* submit */
        .btn-submit {
            width:100%;display:flex;align-items:center;justify-content:center;gap:9px;
            background:linear-gradient(135deg,var(--teal),var(--teal2));
            color:#ffffff;border:none;padding:14px;border-radius:11px;
            font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;
            cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);
            transition:transform .2s,box-shadow .2s;
        }
        .btn-submit:hover  { transform:translateY(-1px);box-shadow:0 7px 24px rgba(26,127,116,.38); }
        .btn-submit svg    { width:16px;height:16px;fill:#ffffff; }

        .form-switch { text-align:center;margin-top:1.25rem;font-size:13px;color:var(--muted); }
        .form-switch a { color:var(--teal);font-weight:500;text-decoration:none; }
        .form-switch a:hover { text-decoration:underline; }

        .privacy-note { display:flex;align-items:center;justify-content:center;gap:5px;font-size:11.5px;color:#c0cad5;margin-top:1rem; }
        .privacy-note svg { width:12px;height:12px;stroke:#c0cad5;fill:none;stroke-width:2;stroke-linecap:round; }

        @media (max-width:820px) {
            .auth-page   { grid-template-columns:1fr; }
            .left-panel  { display:none; }
            .right-panel { min-height:100vh; }
        }
        @media (max-width:480px) {
            .field-row { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<div class="auth-page">

    {{-- LEFT PANEL --}}
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
            <h1 class="left-headline">Begin your<br><em>wellness journey</em></h1>
            <p class="left-desc">Create your free account and get personalised stress support tailored to your academic life.</p>
            <div class="step-list">
                <div class="step-item">
                    <div class="step-badge">1</div>
                    <div>
                        <div class="step-title">Create your account</div>
                        <div class="step-desc">Register with your student details and contact information.</div>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-badge">2</div>
                    <div>
                        <div class="step-title">Take the assessment</div>
                        <div class="step-desc">Complete a 10-question stress survey in any language.</div>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-badge">3</div>
                    <div>
                        <div class="step-title">Get your results</div>
                        <div class="step-desc">Receive personalised recommendations and connect with support.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="left-bot">
            <div class="stat-strip">
                <div>
                    <div class="stat-strip-num">2,400+</div>
                    <div class="stat-strip-label">Students</div>
                </div>
                <div>
                    <div class="stat-strip-num">Free</div>
                    <div class="stat-strip-label">Always</div>
                </div>
                <div>
                    <div class="stat-strip-num">100%</div>
                    <div class="stat-strip-label">Confidential</div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT FORM PANEL --}}
    <div class="right-panel">
        <div class="form-box">

            <p class="form-eyebrow">Get Started</p>
            <h2 class="form-title">Create your account</h2>
            <p class="form-sub">Join WASMIS — free for all students.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- ── PERSONAL INFO ── --}}
                <div class="section-divider"><span>Personal Information</span></div>

                <div class="field-row">
                    <div class="field">
                        <label for="name">Full Name</label>
                        <input
                            id="name" type="text" name="name"
                            value="{{ old('name') }}"
                            placeholder="Ada Okonkwo"
                            required autofocus autocomplete="name"
                            style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        @error('name')
                            <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="matric_no">Matric Number</label>
                        <input
                            id="matric_no" type="text" name="matric_no"
                            value="{{ old('matric_no') }}"
                            placeholder="IFS/00/0011"
                            required
                            style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        @error('matric_no')
                            <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="email">Student Email Address</label>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="student@university.edu"
                        required autocomplete="email"
                        style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                    >
                    @error('email')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="phone">Phone Number</label>
                    <input
                        id="phone" type="tel" name="phone"
                        value="{{ old('phone') }}"
                        placeholder="e.g. 08012345678"
                        required
                        style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                    >
                    @error('phone')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- ── ACADEMIC INFO ── --}}
                <div class="section-divider"><span>Academic Information</span></div>

                <div class="field-row">
                    <div class="field">
                        <label for="faculty">Faculty</label>
                        <select id="faculty" name="faculty" required
                            style="width:100%;padding:12px 34px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;appearance:none;-webkit-appearance:none;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;cursor:pointer;">
                            <option value="" disabled {{ old('faculty') ? '' : 'selected' }}>Select faculty</option>
                            <option value="School Of Engineering And Engineering Technology (SEET)"           {{ old('faculty') == 'School Of Engineering And Engineering Technology (SEET)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Engineering And Engineering Technology (SEET)</option>
                            <option value="School Of Agriculture And Agricultural Technology (SAAT)"        {{ old('faculty') == 'School Of Agriculture And Agricultural Technology (SAAT)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Agriculture And Agricultural Technology (SAAT)</option>
                            <option value="College Of Health Science (CHS)"  {{ old('faculty') == 'College Of Health Science (CHS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">College Of Health Science (CHS)</option>
                            <option value="School Of Computing (SOC)"    {{ old('faculty') == 'School Of Computing (SOC)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Computing (SOC)</option>
                            <option value="School Of Earth And Mineral Science (SEMS)"  {{ old('faculty') == 'School Of Earth And Mineral Science (SEMS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Earth And Mineral Science (SEMS)</option>
                            <option value="School Of Environmental Technology (SET)"                {{ old('faculty') == 'School Of Environmental Technology (SET)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Environmental Technology (SET)</option>
                            <option value="School Of Clinical Science (SCS)"           {{ old('faculty') == 'School Of Clinical Science (SCS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Clinical Science (SCS)</option>
                            <option value="School Of Logistic And Innovation Technology (SLIT)"          {{ old('faculty') == 'School Of Logistic And Innovation Technology (SLIT)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Logistic And Innovation Technology (SLIT)</option>
                            <option value="School Of Basic Clinical Science (SBCS)"  {{ old('faculty') == 'School Of Basic Clinical Science (SBCS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Basic Clinical Science (SBCS)</option>
                            <option value="School Of Basic Medical Science (SBMS)"                {{ old('faculty') == 'School Of Basic Medical Science (SBMS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Basic Medical Science (SBMS)</option>
                            <option value="School Of Physical Science (SPS)"           {{ old('faculty') == 'School Of Physical Science (SPS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Physical Science (SPS)</option>
                            <option value="School Of Life Science (SLS)"          {{ old('faculty') == 'School Of Life Science (SLS)' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Life Science (SLS)</option>
                            <option value="School Of Postgraduate Studies"          {{ old('faculty') == 'School Of Postgraduate Studies' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">School Of Postgraduate Studies</option>
                        </select>
                        @error('faculty')
                            <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="department">Department</label>
                        <input
                            id="department" type="text" name="department"
                            value="{{ old('department') }}"
                            placeholder="e.g. Computer Science"
                            required
                            style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        @error('department')
                            <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="level">Level / Year of Study</label>
                    <select id="level" name="level" required
                        style="width:100%;padding:12px 34px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;appearance:none;-webkit-appearance:none;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;cursor:pointer;">
                        <option value="" disabled {{ old('level') ? '' : 'selected' }}>Select level</option>
                        <option value="100" {{ old('level') == '100' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">100 Level</option>
                        <option value="200" {{ old('level') == '200' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">200 Level</option>
                        <option value="300" {{ old('level') == '300' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">300 Level</option>
                        <option value="400" {{ old('level') == '400' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">400 Level</option>
                        <option value="500" {{ old('level') == '500' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">500 Level</option>
                        <option value="600" {{ old('level') == '600' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">600 Level</option>
                        <option value="Postgraduate" {{ old('level') == 'Postgraduate' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">Postgraduate</option>
                    </select>
                    @error('level')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- ── PASSWORD ── --}}
                <div class="section-divider"><span>Set a Password</span></div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="pw-wrap">
                        <input
                            id="password" type="password" name="password"
                            placeholder="At least 8 characters"
                            required autocomplete="new-password"
                            oninput="checkStrength(this.value)"
                            style="width:100%;padding:12px 44px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        <button type="button" class="pw-eye" onclick="togglePw('password')">
                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="strength-bar" id="strengthBar">
                        <div class="strength-seg" id="seg1"></div>
                        <div class="strength-seg" id="seg2"></div>
                        <div class="strength-seg" id="seg3"></div>
                        <div class="strength-seg" id="seg4"></div>
                    </div>
                    <p style="font-size:11.5px;min-height:16px;margin-top:4px;" id="strengthLabel"></p>
                    @error('password')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="pw-wrap">
                        <input
                            id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Re-enter your password"
                            required autocomplete="new-password"
                            style="width:100%;padding:12px 44px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        <button type="button" class="pw-eye" onclick="togglePw('password_confirmation')">
                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Terms --}}
                <div class="terms-row">
                    <input type="checkbox" id="terms" required>
                    <span>I agree to the <a href="{{ url('/terms') }}">Terms of Service</a> and <a href="{{ url('/privacy') }}">Privacy Policy</a>. My data will be kept confidential.</span>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#ffffff;border:none;padding:14px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);">
                    <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#fff;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Create My Account
                </button>

            </form>

            <div class="form-switch">
                Already registered? <a href="{{ route('login') }}">Log in here</a>
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

    const colors = { 1:'#c0392b', 2:'#e8a027', 3:'#2ecc71', 4:'#1a7f74' };
    const labels = { 0:'', 1:'Weak — add numbers or symbols', 2:'Fair — try mixing cases', 3:'Good — almost there!', 4:'Strong password ✓' };

    function checkStrength(val) {
        let score = 0;
        if (val.length >= 8)          score++;
        if (/[A-Z]/.test(val))        score++;
        if (/[0-9]/.test(val))        score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        for (let i = 1; i <= 4; i++) {
            document.getElementById('seg' + i).style.background = i <= score ? colors[score] : '#e8ecf1';
        }
        const lbl = document.getElementById('strengthLabel');
        lbl.textContent = labels[score];
        lbl.style.color = score > 0 ? colors[score] : '#9aabbc';
    }
</script>

</body>
</html>