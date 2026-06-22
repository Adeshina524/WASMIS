<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Manage Students</title>
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
        .page-header-inner { position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; }
        .page-header-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--teal-md); margin-bottom: .4rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.5rem, 3vw, 2rem); color: #fff; line-height: 1.2; margin-bottom: .3rem; }
        .page-header-title em { font-style: italic; color: var(--teal-md); }
        .page-header-sub { font-size: 13.5px; color: #8fa3bf; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; text-decoration: none; padding: 11px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 500; transition: all .2s; }
        .btn-back:hover { background: rgba(255,255,255,.18); }
        .btn-back svg { width: 15px; height: 15px; fill: #fff; }

        /* ── MAIN ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT ROW ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.1rem 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); }
        .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 20px; height: 20px; }
        .si-teal  { background: var(--teal-lt); } .si-teal svg  { fill: var(--teal); }
        .si-red   { background: var(--danger-lt); } .si-red svg { fill: var(--danger); }
        .si-amber { background: var(--amber-lt); } .si-amber svg { fill: var(--amber); }
        .si-green { background: var(--green-lt); } .si-green svg { fill: var(--green); }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .card-header-left { display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }

        /* ── SEARCH ── */
        .search-wrap { position: relative; }
        .search-wrap input {
            padding: 8px 14px 8px 36px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text);
            background: var(--white);
            outline: none;
            width: 220px;
            transition: border-color .18s;
        }
        .search-wrap input:focus { border-color: var(--teal); }
        .search-wrap input::placeholder { color: #9aabbc; }
        .search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; fill: #9aabbc; }

        /* ── TABLE ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .7rem 1.1rem; border-bottom: 2px solid var(--border); text-align: left; white-space: nowrap; background: #fafffe; }
        .data-table td { font-size: 13px; color: var(--text); padding: .9rem 1.1rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafffe; }

        /* ── BADGES ── */
        .level-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .level-badge.low      { background: var(--green-lt);  color: var(--green); }
        .level-badge.moderate { background: var(--amber-lt);  color: #b07000; }
        .level-badge.high     { background: var(--danger-lt); color: var(--danger); }
        .level-badge.none     { background: #f0f2f5; color: var(--muted); }
        .level-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        .role-badge { display: inline-flex; align-items: center; gap: 5px; background: var(--teal-lt); color: var(--teal); font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px; }

        /* ── DELETE BUTTON ── */
        .btn-delete {
            display: inline-flex; align-items: center; gap: 5px;
            background: var(--danger-lt); color: var(--danger);
            border: 1px solid #f5c0b8; border-radius: 8px;
            padding: 6px 12px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; cursor: pointer;
            transition: all .18s;
        }
        .btn-delete:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .btn-delete svg { width: 13px; height: 13px; fill: currentColor; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--muted); font-size: 13px; }
        .empty-state svg { width: 40px; height: 40px; fill: #c0cad5; display: block; margin: 0 auto .75rem; }

        /* ── SUCCESS/ERROR ALERT ── */
        .alert-success { background: var(--green-lt); border: 1px solid #a8dcd4; border-radius: 12px; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; font-size: 13.5px; color: var(--green); }
        .alert-success svg { width: 18px; height: 18px; fill: var(--green); flex-shrink: 0; }

        /* ── MODAL ── */
        .modal-overlay { position: fixed; inset: 0; background: rgba(8,15,28,.6); backdrop-filter: blur(3px); z-index: 500; display: flex; align-items: center; justify-content: center; padding: 1rem; opacity: 0; pointer-events: none; transition: opacity .2s; }
        .modal-overlay.open { opacity: 1; pointer-events: auto; }
        .modal { background: #fff; border-radius: 18px; width: 100%; max-width: 420px; overflow: hidden; transform: scale(.95); transition: transform .22s; }
        .modal-overlay.open .modal { transform: scale(1); }
        .modal-top { background: linear-gradient(135deg, #3d0000, var(--danger)); padding: 1.5rem; }
        .modal-top h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: #fff; margin-bottom: .3rem; }
        .modal-top p  { font-size: 13px; color: rgba(255,255,255,.7); }
        .modal-body { padding: 1.5rem; }
        .modal-body p { font-size: 13.5px; color: var(--muted); line-height: 1.65; margin-bottom: 1.25rem; }
        .modal-actions { display: flex; gap: .75rem; justify-content: flex-end; }
        .btn-cancel { background: #f0f2f5; color: var(--muted); border: none; padding: 10px 20px; border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500; cursor: pointer; transition: all .18s; }
        .btn-cancel:hover { background: var(--border); }
        .btn-confirm-delete { background: var(--danger); color: #fff; border: none; padding: 10px 20px; border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 600; cursor: pointer; transition: all .18s; }
        .btn-confirm-delete:hover { background: #a93226; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 700px) { .stat-grid { grid-template-columns: 1fr 1fr; } }
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
        <a href="{{ route('admin.dashboard') }}"  class="nav-link active">Dashboard</a>
        <a href="{{ route('admin.users') }}"      class="nav-link">Students</a>
        <a href="{{ route('admin.create.user') }}" class="nav-link">Create User</a>
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
            <h1 class="page-header-title">Manage <em>Students</em></h1>
            <p class="page-header-sub">View and manage all registered student accounts.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Back to Dashboard
        </a>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
    <div class="alert-success">
        <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- STAT CARDS --}}
    @php
        $totalStudents = $users->count();
        $highRiskCount = $users->filter(fn($u) => $u->stressRecords->where('stress_level','High')->count() > 0)->count();
        $noAssessment  = $users->filter(fn($u) => $u->stressRecords->count() === 0)->count();
        $assessed      = $totalStudents - $noAssessment;
    @endphp

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon si-teal">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-green">
                <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $assessed }}</div>
                <div class="stat-label">Assessed Students</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-amber">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $noAssessment }}</div>
                <div class="stat-label">Not Yet Assessed</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $highRiskCount }}</div>
                <div class="stat-label">High Risk Students</div>
            </div>
        </div>
    </div>

    {{-- STUDENTS TABLE --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <div>
                    <div class="card-title">All Students</div>
                    <div class="card-subtitle">{{ $totalStudents }} registered student{{ $totalStudents !== 1 ? 's' : '' }}</div>
                </div>
            </div>
            <div class="search-wrap">
                <svg class="search-icon" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input type="text" id="searchInput" placeholder="Search students..." onkeyup="searchTable()">
            </div>
        </div>

        <div style="overflow-x:auto;">
            @if($users->count() > 0)
            <table class="data-table" id="studentsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Identity</th>
                        <th>Matric No</th>
                        <th>Assessments</th>
                        <th>Latest Level</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $student)
                    @php
                        $latestRecord = $student->stressRecords->sortByDesc('created_at')->first();
                        $latestLevel  = $latestRecord ? strtolower($latestRecord->stress_level) : 'none';
                        $latestLabel  = $latestRecord ? $latestRecord->stress_level : 'N/A';
                        $totalRecords = $student->stressRecords->count();
                    @endphp
                    <tr>
                        <td style="color:var(--muted);font-size:12px;">{{ $i + 1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:50%;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:var(--teal);flex-shrink:0;">
                                    S{{ $i + 1 }}
                                </div>
                                <div>
                                    <div style="font-weight:500;font-size:13.5px;">Student {{ $i + 1 }}</div>
                                    <div class="role-badge" style="margin-top:3px;">{{ ucfirst($student->role) }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color:var(--muted);font-size:13px;">Confidential</td>
                        <td style="font-size:13px;">Confidential</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <span style="font-family:'DM Serif Display',serif;font-size:1.1rem;color:var(--navy);">{{ $totalRecords }}</span>
                                <span style="font-size:11.5px;color:var(--muted);">{{ $totalRecords === 1 ? 'assessment' : 'assessments' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="level-badge {{ $latestLevel }}">
                                <span class="level-dot"></span>
                                {{ $latestLabel }}
                            </span>
                        </td>
                        <td style="font-size:12.5px;color:var(--muted);">{{ $student->created_at->format('d M Y') }}</td>
                        <td>
                            <button
                                class="btn-delete"
                                onclick="confirmDelete({{ $student->id }}, '{{ addslashes($student->name) }}')"
                            >
                                <svg viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                No students registered yet.
            </div>
            @endif
        </div>
    </div>

</div>

{{-- DELETE CONFIRMATION MODAL --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-top">
            <h3>Delete Student</h3>
            <p>This action cannot be undone.</p>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete <strong id="deleteStudentName"></strong>? This will permanently remove their account and all assessment records.</p>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteForm" method="POST" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm-delete">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

<script>
    // Search
    function searchTable() {
        const input  = document.getElementById('searchInput').value.toLowerCase();
        const rows   = document.querySelectorAll('#studentsTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    }

    // Delete modal
    function confirmDelete(id, name) {
        document.getElementById('deleteStudentName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/user/' + id;
        document.getElementById('deleteModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>

</body>
</html>