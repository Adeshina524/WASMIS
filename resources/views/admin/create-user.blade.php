<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Create User</title>
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
            --danger:   #c0392b;
            --danger-lt:#fff0f0;
            --amber:    #e8a027;
            --amber-lt: #fef7e9;
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
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link  { color: #8fa3bf; font-size: 13px; padding: 7px 14px; border-radius: 8px; text-decoration: none; transition: all .18s; }
        .nav-link:hover  { color: #fff; background: rgba(255,255,255,.08); }
        .nav-link.active { color: var(--teal-md); background: rgba(26,127,116,.18); }
        .nav-right  { display: flex; align-items: center; gap: 10px; }
        .nav-avatar { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: #fff; }
        .nav-name   { color: #8fa3bf; font-size: 13px; }
        .nav-logout { background: transparent; color: #8fa3bf; border: 1px solid rgba(255,255,255,.15); padding: 7px 16px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; cursor: pointer; text-decoration: none; transition: all .18s; }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        /* ── PAGE HEADER ── */
        .page-header { background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%); padding: 2.5rem 2rem; position: relative; overflow: hidden; }
        .page-header::before { content: ''; position: absolute; top: -60px; right: -80px; width: 280px; height: 280px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .page-header::after  { content: ''; position: absolute; bottom: -60px; left: -40px; width: 200px; height: 200px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .page-header-inner { position: relative; z-index: 2; max-width: 860px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; }
        .page-header-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--teal-md); margin-bottom: .4rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.5rem, 3vw, 2rem); color: #fff; line-height: 1.2; margin-bottom: .3rem; }
        .page-header-title em { font-style: italic; color: var(--teal-md); }
        .page-header-sub { font-size: 13.5px; color: #8fa3bf; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; text-decoration: none; padding: 11px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 500; transition: all .2s; }
        .btn-back:hover { background: rgba(255,255,255,.18); }
        .btn-back svg { width: 15px; height: 15px; fill: #fff; }

        /* ── MAIN ── */
        .main { max-width: 860px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── ROLE SELECTOR ── */
        .role-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: .85rem; margin-bottom: 1.5rem; }

        .role-card {
            background: #fff;
            border: 2px solid var(--border);
            border-radius: 14px;
            padding: 1.1rem;
            cursor: pointer;
            transition: all .2s;
            text-align: center;
            position: relative;
        }

        .role-card:hover { border-color: var(--teal); transform: translateY(-2px); box-shadow: 0 4px 16px rgba(26,127,116,.12); }
        .role-card.selected { border-color: var(--teal); background: var(--teal-lt); }
        .role-card.selected .role-check { opacity: 1; }

        .role-check {
            position: absolute; top: 8px; right: 8px;
            width: 18px; height: 18px;
            background: var(--teal); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity .18s;
        }
        .role-check svg { width: 10px; height: 10px; fill: #fff; }

        .role-icon { font-size: 1.6rem; margin-bottom: .5rem; }
        .role-name { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: .25rem; }
        .role-desc { font-size: 11px; color: var(--muted); line-height: 1.5; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); margin-bottom: 1.25rem; }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }
        .card-body { padding: 1.5rem; }

        /* ── FIELDS ── */
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
        .field-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
        .field { margin-bottom: 1rem; }
        .field:last-child { margin-bottom: 0; }

        .field label {
            display: block; font-size: 11.5px; font-weight: 600;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: .07em; margin-bottom: 7px;
        }

        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field input[type="tel"],
        .field select {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #dde3ea; border-radius: 10px;
            font-family: 'DM Sans', sans-serif; font-size: 13.5px;
            color: #1a2236; background: #f5f2ed; outline: none;
            transition: border-color .18s, background .18s;
            appearance: none; -webkit-appearance: none;
        }

        .field input:focus,
        .field select:focus { border-color: var(--teal); background: #fafffe; color: #1a2236; }
        .field input::placeholder { color: #9aabbc; }

        .field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' viewBox='0 0 11 7'%3E%3Cpath d='M1 1l4.5 4.5L10 1' stroke='%235c6b82' stroke-width='1.6' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 34px;
            cursor: pointer;
        }

        .field select option { color: #1a2236; background: #fff; }

        /* password wrapper */
        .pw-wrap { position: relative; }
        .pw-wrap input { padding-right: 44px !important; }
        .pw-eye { position: absolute; right: 13px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 2px; display: flex; color: #9aabbc; transition: color .18s; }
        .pw-eye:hover { color: var(--teal); }
        .pw-eye svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; }

        /* optional badge */
        .optional-badge { display: inline-flex; align-items: center; background: #f0f2f5; color: var(--muted); font-size: 10px; font-weight: 500; padding: 2px 7px; border-radius: 10px; margin-left: 6px; text-transform: none; letter-spacing: 0; vertical-align: middle; }

        /* student fields section */
        .student-fields { display: none; }
        .student-fields.visible { display: block; }

        /* field error */
        .field-error { font-size: 12px; color: var(--danger); margin-top: 5px; display: flex; align-items: center; gap: 5px; }
        .field-error svg { width: 13px; height: 13px; stroke: var(--danger); fill: none; stroke-width: 2; stroke-linecap: round; flex-shrink: 0; }

        /* strength */
        .strength-bar { display: flex; gap: 4px; margin-top: 7px; }
        .strength-seg { height: 3px; flex: 1; border-radius: 3px; background: #e8ecf1; transition: background .3s; }

        /* role badge preview */
        .role-preview {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 20px; font-size: 12.5px; font-weight: 600;
            margin-bottom: 1.25rem;
        }
        .role-preview.admin      { background: #eef1f6; color: var(--navy); }
        .role-preview.counselor  { background: var(--teal-lt); color: var(--teal); }
        .role-preview.management { background: var(--amber-lt); color: #b07000; }
        .role-preview.student    { background: var(--green-lt); color: var(--green); }
        .role-preview span { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }

        /* submit */
        .submit-row { display: flex; align-items: center; justify-content: flex-end; gap: 1rem; padding-top: .5rem; }
        .btn-cancel { display: inline-flex; align-items: center; gap: 7px; background: #f0f2f5; color: var(--muted); border: none; padding: 12px 24px; border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; cursor: pointer; text-decoration: none; transition: all .18s; }
        .btn-cancel:hover { background: var(--border); }
        .btn-submit { display: inline-flex; align-items: center; gap: 9px; background: linear-gradient(135deg, var(--teal), var(--teal2)); color: #fff; border: none; padding: 13px 32px; border-radius: 11px; font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 18px rgba(26,127,116,.28); transition: all .2s; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 7px 24px rgba(26,127,116,.38); }
        .btn-submit svg { width: 16px; height: 16px; fill: #fff; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 700px) {
            .role-grid    { grid-template-columns: 1fr 1fr; }
            .field-row    { grid-template-columns: 1fr; }
            .field-row-3  { grid-template-columns: 1fr; }
            .submit-row   { flex-direction: column; }
            .btn-cancel, .btn-submit { width: 100%; justify-content: center; }
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
            <div class="nav-sub">Admin Panel</div>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.users') }}"     class="nav-link">Students</a>
        <a href="{{ route('admin.create.user') }}" class="nav-link active">Create User</a>
    </div>

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
        <div>
            <p class="page-header-eyebrow">Administrator</p>
            <h1 class="page-header-title">Create <em>New User</em></h1>
            <p class="page-header-sub">Add a new admin, counsellor, management, or student account to the system.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="btn-back">
            <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Back to Users
        </a>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    <form method="POST" action="{{ route('admin.store.user') }}" id="createUserForm">
        @csrf

        {{-- STEP 1: ROLE SELECTOR --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                </div>
                <div>
                    <div class="card-title">Step 1 — Select User Role</div>
                    <div class="card-subtitle">Choose what type of account to create</div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="role" id="selectedRole" value="{{ old('role', 'student') }}">

                <div class="role-grid">
                    <div class="role-card {{ old('role', 'student') === 'student' ? 'selected' : '' }}" onclick="selectRole('student')">
                        <div class="role-check"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                        <div class="role-icon">🎓</div>
                        <div class="role-name">Student</div>
                        <div class="role-desc">Can take stress assessments and view their own results</div>
                    </div>
                    <div class="role-card {{ old('role') === 'counselor' ? 'selected' : '' }}" onclick="selectRole('counselor')">
                        <div class="role-check"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                        <div class="role-icon">🧑‍⚕️</div>
                        <div class="role-name">Counsellor</div>
                        <div class="role-desc">Views flagged high-risk students and provides support</div>
                    </div>
                    <div class="role-card {{ old('role') === 'management' ? 'selected' : '' }}" onclick="selectRole('management')">
                        <div class="role-check"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                        <div class="role-icon">🏛️</div>
                        <div class="role-name">Management</div>
                        <div class="role-desc">Views institutional stress trends and policy reports</div>
                    </div>
                    <div class="role-card {{ old('role') === 'admin' ? 'selected' : '' }}" onclick="selectRole('admin')">
                        <div class="role-check"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                        <div class="role-icon">⚙️</div>
                        <div class="role-name">Admin</div>
                        <div class="role-desc">Manages users, views system stats and creates accounts</div>
                    </div>
                </div>

                @error('role')
                <p class="field-error">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>

        {{-- STEP 2: PERSONAL INFO --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <div>
                    <div class="card-title">Step 2 — Personal Information</div>
                    <div class="card-subtitle">Basic account details for the new user</div>
                </div>
            </div>
            <div class="card-body">

                {{-- Role preview badge --}}
                <div class="role-preview student" id="roleBadge">
                    <span></span>
                    <span id="roleBadgeText">Student Account</span>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="name">Full Name</label>
                        <input
                            id="name" type="text" name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Dr. Amina Bello"
                            required
                            style="width:100%;padding:11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        @error('name')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="email">Email Address</label>
                        <input
                            id="email" type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="user@university.edu"
                            required
                            style="width:100%;padding:11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        @error('email')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="phone">Phone Number <span class="optional-badge">Optional</span></label>
                    <input
                        id="phone" type="tel" name="phone"
                        value="{{ old('phone') }}"
                        placeholder="e.g. 08012345678"
                        style="width:100%;padding:11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                    >
                </div>

                {{-- Student-only fields --}}
                <div class="student-fields {{ old('role', 'student') === 'student' ? 'visible' : '' }}" id="studentFields">
                    <div class="field-row">
                        <div class="field">
                            <label for="matric_no">Matric Number</label>
                            <input
                                id="matric_no" type="text" name="matric_no"
                                value="{{ old('matric_no') }}"
                                placeholder="e.g. CSC/2021/001"
                                style="width:100%;padding:11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                            >
                            @error('matric_no')
                            <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="level">Academic Level</label>
                            <select id="level" name="level"
                                style="width:100%;padding:11px 34px 11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;appearance:none;-webkit-appearance:none;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;cursor:pointer;">
                                <option value="" style="color:#9aabbc;">Select level</option>
                                <option value="100" {{ old('level') == '100' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">100 Level</option>
                                <option value="200" {{ old('level') == '200' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">200 Level</option>
                                <option value="300" {{ old('level') == '300' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">300 Level</option>
                                <option value="400" {{ old('level') == '400' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">400 Level</option>
                                <option value="500" {{ old('level') == '500' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">500 Level</option>
                                <option value="600" {{ old('level') == '600' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">600 Level</option>
                                <option value="Postgraduate" {{ old('level') == 'Postgraduate' ? 'selected' : '' }} style="color:#1a2236;background:#fff;">Postgraduate</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field">
                            <label for="faculty">Faculty</label>
                            <select id="faculty" name="faculty"
                                style="width:100%;padding:11px 34px 11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;appearance:none;-webkit-appearance:none;background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2211%22 height=%227%22 viewBox=%220 0 11 7%22%3E%3Cpath d=%22M1 1l4.5 4.5L10 1%22 stroke=%22%235c6b82%22 stroke-width=%221.6%22 fill=%22none%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;cursor:pointer;">
                                <option value="" style="color:#9aabbc;">Select faculty</option>
                                <option value="Sciences"          style="color:#1a2236;background:#fff;">Sciences</option>
                                <option value="Engineering"       style="color:#1a2236;background:#fff;">Engineering</option>
                                <option value="Arts & Humanities" style="color:#1a2236;background:#fff;">Arts &amp; Humanities</option>
                                <option value="Social Sciences"   style="color:#1a2236;background:#fff;">Social Sciences</option>
                                <option value="Medicine & Health" style="color:#1a2236;background:#fff;">Medicine &amp; Health</option>
                                <option value="Law"               style="color:#1a2236;background:#fff;">Law</option>
                                <option value="Business"          style="color:#1a2236;background:#fff;">Business</option>
                                <option value="Education"         style="color:#1a2236;background:#fff;">Education</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="department">Department</label>
                            <input
                                id="department" type="text" name="department"
                                value="{{ old('department') }}"
                                placeholder="e.g. Computer Science"
                                style="width:100%;padding:11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                            >
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- STEP 3: PASSWORD --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                </div>
                <div>
                    <div class="card-title">Step 3 — Set Password</div>
                    <div class="card-subtitle">The user can change this after their first login</div>
                </div>
            </div>
            <div class="card-body">
                <div class="field-row">
                    <div class="field">
                        <label for="password">Password</label>
                        <div class="pw-wrap">
                            <input
                                id="password" type="password" name="password"
                                placeholder="At least 8 characters"
                                required oninput="checkStrength(this.value)"
                                style="width:100%;padding:11px 44px 11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                            >
                            <button type="button" class="pw-eye" onclick="togglePw('password')">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="strength-bar">
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
                                placeholder="Re-enter password"
                                required
                                style="width:100%;padding:11px 44px 11px 14px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13.5px;color:#1a2236;background:#f5f2ed;outline:none;"
                            >
                            <button type="button" class="pw-eye" onclick="togglePw('password_confirmation')">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                        <p class="field-error"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="submit-row">
            <a href="{{ route('admin.users') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"
                style="display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;border:none;padding:13px 32px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);">
                <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#fff;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Create Account
            </button>
        </div>

    </form>
</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

<script>
    const roleConfig = {
        student:    { label: 'Student Account',     cls: 'student',    badge: '🎓' },
        counselor:  { label: 'Counsellor Account',  cls: 'counselor',  badge: '🧑‍⚕️' },
        management: { label: 'Management Account',  cls: 'management', badge: '🏛️' },
        admin:      { label: 'Admin Account',        cls: 'admin',      badge: '⚙️' },
    };

    function selectRole(role) {
        // Update hidden input
        document.getElementById('selectedRole').value = role;

        // Update card selection
        document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
        event.currentTarget.classList.add('selected');

        // Update badge
        const badge = document.getElementById('roleBadge');
        const config = roleConfig[role];
        badge.className = 'role-preview ' + config.cls;
        document.getElementById('roleBadgeText').textContent = config.label;

        // Show/hide student fields
        const studentFields = document.getElementById('studentFields');
        if (role === 'student') {
            studentFields.classList.add('visible');
        } else {
            studentFields.classList.remove('visible');
        }
    }

    function togglePw(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    const colors = { 1:'#c0392b', 2:'#e8a027', 3:'#2ecc71', 4:'#1a7f74' };
    const labels = { 0:'', 1:'Weak', 2:'Fair', 3:'Good', 4:'Strong ✓' };

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

    // Set initial role on page load
    const initialRole = document.getElementById('selectedRole').value || 'student';
    const initialConfig = roleConfig[initialRole];
    const badge = document.getElementById('roleBadge');
    badge.className = 'role-preview ' + initialConfig.cls;
    document.getElementById('roleBadgeText').textContent = initialConfig.label;
</script>

</body>
</html>