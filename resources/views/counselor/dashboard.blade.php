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

        html, body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); min-height: 100vh; overflow-x: hidden; }

        /* ── NAVBAR ── */
        .navbar { background: var(--navy); height: 64px; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 200; box-shadow: 0 1px 0 rgba(255,255,255,.04); }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; min-width: 0; }
        .nav-logo  { width: 38px; height: 38px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .nav-logo svg { width: 20px; height: 20px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 10px; text-transform: uppercase; letter-spacing: .09em; }
        .nav-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .nav-avatar { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: #fff; flex-shrink: 0; }
        .nav-name  { color: #8fa3bf; font-size: 13px; white-space: nowrap; }
        .nav-logout { background: transparent; color: #8fa3bf; border: 1px solid rgba(255,255,255,.15); padding: 7px 16px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; cursor: pointer; text-decoration: none; transition: all .18s; white-space: nowrap; }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        .nav-hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 8px; background: none; border: none; flex-shrink: 0; }
        .nav-hamburger span { display: block; width: 22px; height: 2px; background: #8fa3bf; border-radius: 2px; }
        .nav-mobile-menu { display: none; flex-direction: column; background: var(--navy); border-top: 1px solid rgba(255,255,255,.07); padding: .75rem 1.25rem 1rem; }
        .nav-mobile-menu.open { display: flex; }
        .nav-mobile-user { display: flex; align-items: center; gap: 10px; padding: .5rem 0 .85rem; border-bottom: 1px solid rgba(255,255,255,.07); margin-bottom: .35rem; }
        .nav-mobile-user span { color: #fff; font-size: 13.5px; font-weight: 500; }
        .nav-mobile-logout { background: rgba(192,57,43,.12); color: #ff8f7d; border: 1px solid rgba(192,57,43,.25); padding: 11px; border-radius: 9px; text-align: center; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500; cursor: pointer; width: 100%; }

        /* ── PAGE HEADER ── */
        .page-header { background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%); padding: 2.5rem 2rem; position: relative; overflow: hidden; }
        .page-header::before { content: ''; position: absolute; top: -60px; right: -80px; width: 280px; height: 280px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .page-header::after  { content: ''; position: absolute; bottom: -60px; left: -40px; width: 200px; height: 200px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .page-header-inner { position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; }
        .page-header-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--teal-md); margin-bottom: .4rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.4rem, 5vw, 2rem); color: #fff; line-height: 1.25; margin-bottom: .3rem; word-wrap: break-word; }
        .page-header-title em { font-style: italic; color: var(--teal-md); }
        .page-header-sub { font-size: 13.5px; color: #8fa3bf; }

        .confidential-banner { background: rgba(232,160,39,.15); border: 1px solid rgba(232,160,39,.3); border-radius: 10px; padding: .75rem 1.1rem; display: flex; align-items: flex-start; gap: 10px; margin-top: 1.25rem; font-size: 12.5px; color: #e8c27a; line-height: 1.6; }
        .confidential-banner svg { width: 16px; height: 16px; fill: #e8c27a; flex-shrink: 0; margin-top: 1px; }

        /* ── MAIN ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); transition: all .2s; min-width: 0; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.09); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 22px; height: 22px; }
        .si-teal  { background: var(--teal-lt); }  .si-teal svg  { fill: var(--teal); }
        .si-red   { background: var(--danger-lt); } .si-red svg  { fill: var(--danger); }
        .si-amber { background: var(--amber-lt); }  .si-amber svg { fill: var(--amber); }
        .si-green { background: var(--green-lt); }  .si-green svg { fill: var(--green); }
        .stat-info { min-width: 0; }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); margin-bottom: 1.5rem; }
        .card-header { padding: 1.1rem 1.4rem; border-bottom: 1px solid; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .card-header.urgent  { background: linear-gradient(90deg, var(--danger-lt), #fff8f8); border-bottom-color: #f5c0b8; }
        .card-header.monitor { background: linear-gradient(90deg, var(--amber-lt), #fdf6e8); border-bottom-color: #f0dba8; }
        .card-header.neutral { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); border-bottom-color: #c8e8e4; }
        .card-header-left { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .card-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-icon.red   { background: var(--danger); }
        .card-icon.amber { background: var(--amber); }
        .card-icon.teal  { background: var(--teal); }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; margin-top: 1px; }
        .cs-red   { color: var(--danger); }
        .cs-amber { color: #b07000; }
        .cs-teal  { color: var(--teal); }
        .card-body { padding: 1.4rem; }

        .tier-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; flex-shrink: 0; white-space: nowrap; }
        .tier-badge.red   { background: var(--danger); color: #fff; }
        .tier-badge.amber { background: var(--amber); color: #fff; }
        .tier-badge svg { width: 10px; height: 10px; fill: currentColor; }

        /* ── FLAGGED STUDENT CARDS ── */
        .flagged-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }

        .student-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(13,31,60,.05); transition: all .2s; min-width: 0; }
        .student-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.1); }
        .student-card.urgent  { border-left: 4px solid var(--danger); }
        .student-card.monitor { border-left: 4px solid var(--amber); }

        .student-card-top { padding: 1.1rem 1.25rem; border-bottom: 1px solid; display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .student-card-top.urgent  { background: linear-gradient(90deg, var(--danger-lt), #fff8f8); border-bottom-color: #f5c0b8; }
        .student-card-top.monitor { background: linear-gradient(90deg, var(--amber-lt), #fdf6e8); border-bottom-color: #f0dba8; }

        .student-avatar { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: #fff; flex-shrink: 0; border: 2px solid; }
        .student-avatar.urgent  { background: var(--danger); border-color: #f5c0b8; }
        .student-avatar.monitor { background: var(--amber); border-color: #f0dba8; }

        .student-name-wrap { min-width: 0; flex: 1; }
        .student-name  { font-size: 14.5px; font-weight: 600; color: var(--navy); overflow: hidden; text-overflow: ellipsis; }
        .student-matric { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .student-card-body { padding: 1.1rem 1.25rem; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .6rem; margin-bottom: 1rem; }
        .info-item { min-width: 0; }
        .info-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: #c0cad5; margin-bottom: 2px; }
        .info-value { font-size: 13px; color: var(--text); font-weight: 500; word-break: break-word; }

        .stress-input-box { background: var(--sand); border: 1px solid var(--border); border-radius: 10px; padding: .85rem 1rem; margin-bottom: 1rem; }
        .stress-input-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 5px; }
        .stress-input-text  { font-size: 13px; color: var(--text); line-height: 1.6; font-style: italic; word-break: break-word; }

        .score-row { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
        .score-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; white-space: nowrap; }
        .score-badge.high   { background: #ffe8e0; color: #c2540e; }
        .score-badge.severe { background: var(--danger-lt); color: var(--danger); }
        .score-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
        .score-num { font-size: 12px; color: var(--muted); white-space: nowrap; }

        .btn-contact { display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, var(--teal), var(--teal2)); color: #fff; text-decoration: none; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 500; border: none; cursor: pointer; transition: all .18s; font-family: 'DM Sans', sans-serif; width: 100%; justify-content: center; }
        .btn-contact:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(26,127,116,.3); }
        .btn-contact svg { width: 14px; height: 14px; fill: #fff; flex-shrink: 0; }

        /* ── HISTORY TABLE ── */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; min-width: 700px; }
        .data-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .7rem 1rem; border-bottom: 2px solid var(--border); text-align: left; background: #fafffe; white-space: nowrap; }
        .data-table td { font-size: 13px; color: var(--text); padding: .9rem 1rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; white-space: nowrap; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafffe; }

        .level-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; white-space: nowrap; }
        .level-badge.mild      { background: var(--green-lt);  color: var(--green); }
        .level-badge.moderate  { background: var(--amber-lt);  color: #b07000; }
        .level-badge.high      { background: #ffe8e0;          color: #c2540e; }
        .level-badge.severe    { background: var(--danger-lt); color: var(--danger); }
        .level-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; flex-shrink: 0; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--muted); font-size: 13px; }
        .empty-state svg { width: 40px; height: 40px; fill: #c0cad5; display: block; margin: 0 auto .75rem; }
        .empty-state h3 { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: var(--navy); margin-bottom: .4rem; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        /* ══════════════════════ RESPONSIVE ══════════════════════ */

        @media (max-width: 1000px) {
            .stat-grid    { grid-template-columns: repeat(2, 1fr); }
            .flagged-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 1.25rem; }
            .nav-name, .nav-logout { display: none; }
            .nav-hamburger { display: flex; }
            .nav-title { font-size: 14px; }
            .nav-sub   { display: none; }

            .page-header { padding: 1.75rem 1.25rem; }
        }

        @media (max-width: 540px) {
            .stat-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
            .stat-card { padding: 1rem; gap: .75rem; }
            .stat-icon { width: 38px; height: 38px; }
            .stat-icon svg { width: 18px; height: 18px; }
            .stat-value { font-size: 1.25rem; }
            .stat-label { font-size: 10.5px; }

            .main { padding: 1.5rem 1rem 3rem; }
            .card-body { padding: 1.1rem; }
            .card-header { padding: 1rem 1.1rem; }

            .info-grid { grid-template-columns: 1fr; }
            .student-card-top { padding: 1rem; }
            .student-card-body { padding: 1rem; }
        }

        @media (max-width: 400px) {
            .stat-grid { grid-template-columns: 1fr; }
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

    <button class="nav-hamburger" onclick="toggleMobileMenu()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<div class="nav-mobile-menu" id="mobileMenu">
    <div class="nav-mobile-user">
        <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <span>{{ auth()->user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="nav-mobile-logout">Log Out</button>
    </form>
</div>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <p class="page-header-eyebrow">Counsellor Dashboard</p>
        <h1 class="page-header-title">Flagged <em>Student Cases</em></h1>
        <p class="page-header-sub">Students with high stress levels requiring your attention and support.</p>

        <div class="confidential-banner">
            <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4l5 2.18V11c0 3.5-2.33 6.79-5 7.93-2.67-1.14-5-4.43-5-7.93V7.18L12 5z"/></svg>
            <span><strong>Confidential:</strong> Student information on this page is strictly confidential. Do not share or reproduce outside of official counselling records.</span>
        </div>

        @if(session('success'))
        <div style="background:var(--green-lt);border:1px solid #a8dcd4;border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:10px;margin-bottom:1.5rem;font-size:13.5px;color:var(--green);">
            <svg viewBox="0 0 24 24" style="width:18px;height:18px;fill:var(--green);flex-shrink:0;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="background:var(--danger-lt);border:1px solid #f5c0b8;border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:10px;margin-bottom:1.5rem;font-size:13.5px;color:var(--danger);">
            <svg viewBox="0 0 24 24" style="width:18px;height:18px;fill:var(--danger);flex-shrink:0;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            {{ session('error') }}
        </div>
        @endif
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
            <div class="stat-info">
                <div class="stat-value">{{ $urgentCount }}</div>
                <div class="stat-label">Urgent (Severe)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-amber">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $monitorCount }}</div>
                <div class="stat-label">Monitor (High)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-teal">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-green">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $avgScore > 0 ? $avgScore : '—' }}</div>
                <div class="stat-label">Avg Stress Score</div>
            </div>
        </div>
    </div>

    {{-- URGENT TIER: SEVERE --}}
    <div class="card">
        <div class="card-header urgent">
            <div class="card-header-left">
                <div class="card-icon red">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                </div>
                <div>
                    <div class="card-title">🚨 Urgent — Severe Stress Level</div>
                    <div class="card-subtitle cs-red">Requires immediate attention and contact</div>
                </div>
            </div>
            @if($urgentCount > 0)
            <span class="tier-badge red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                {{ $urgentCount }} case{{ $urgentCount > 1 ? 's' : '' }}
            </span>
            @endif
        </div>
        <div class="card-body">
            @if($urgentStudents->count() > 0)
            <div class="flagged-grid">
                @foreach($urgentStudents as $student)
                @php $latestRecord = $student->stressRecords->first(); @endphp
                <div class="student-card urgent">
                    <div class="student-card-top urgent">
                        <div class="student-avatar urgent">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                        <div class="student-name-wrap">
                            <div class="student-name">{{ $student->name }}</div>
                            <div class="student-matric">{{ $student->matric_no ?? 'N/A' }}</div>
                        </div>
                        <span class="tier-badge red">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            Severe
                        </span>
                    </div>
                    <div class="student-card-body">
                        <div class="info-grid">
                            <div class="info-item"><div class="info-label">Email</div><div class="info-value" style="font-size:12.5px;">{{ $student->email }}</div></div>
                            <div class="info-item"><div class="info-label">Phone</div><div class="info-value">{{ $student->phone ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Faculty</div><div class="info-value">{{ $student->faculty ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Department</div><div class="info-value">{{ $student->department ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Level</div><div class="info-value">{{ $student->level ? $student->level . ' Level' : 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Assessments</div><div class="info-value">{{ $student->stressRecords->count() }} taken</div></div>
                        </div>
                        @if($latestRecord && $latestRecord->text_input)
                        <div class="stress-input-box">
                            <div class="stress-input-label">Student's Expression</div>
                            <div class="stress-input-text">"{{ $latestRecord->text_input }}"</div>
                        </div>
                        @endif
                        @if($latestRecord)
                        <div class="score-row">
                            <span class="score-badge severe"><span class="score-dot"></span>Severe</span>
                            <span class="score-num">Score: {{ $latestRecord->stress_score }}/142</span>
                            <span class="score-num" style="margin-left:auto;">{{ $latestRecord->created_at->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($latestRecord && $latestRecord->assigned_counselor_id)
                            <div style="background:var(--teal-lt);border:1px solid #c0e0db;border-radius:9px;padding:.6rem .9rem;margin-bottom:.85rem;font-size:12px;color:var(--teal2);display:flex;align-items:center;gap:7px;">
                                <svg viewBox="0 0 24 24" style="width:13px;height:13px;fill:var(--teal2);flex-shrink:0;"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                                <span>
                                    @if($latestRecord->assigned_counselor_id === auth()->id())
                                        <strong>You</strong> are handling this case
                                    @else
                                        <strong>{{ $latestRecord->assignedCounselor->name ?? 'Another counsellor' }}</strong> is handling this case
                                    @endif
                                </span>
                            </div>
                        @else
                            <form method="POST" action="{{ route('counselor.claim', $latestRecord->id) }}" style="margin-bottom:.85rem;">
                                @csrf
                                <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:7px;background:var(--navy);color:#fff;border:none;padding:9px 18px;border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;">
                                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;fill:#fff;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                    I'm Handling This Case
                                </button>
                            </form>
                        @endif
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
                <h3>No Severe Cases</h3>
                <p>There are currently no students at the Severe stress level. Check back regularly.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- MONITOR TIER: HIGH --}}
    <div class="card">
        <div class="card-header monitor">
            <div class="card-header-left">
                <div class="card-icon amber">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
                <div>
                    <div class="card-title">👁 Monitor — High Stress Level</div>
                    <div class="card-subtitle cs-amber">Worth monitoring; not yet at the urgent tier</div>
                </div>
            </div>
            @if($monitorCount > 0)
            <span class="tier-badge amber">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                {{ $monitorCount }} case{{ $monitorCount > 1 ? 's' : '' }}
            </span>
            @endif
        </div>
        <div class="card-body">
            @if($monitorStudents->count() > 0)
            <div class="flagged-grid">
                @foreach($monitorStudents as $student)
                @php $latestRecord = $student->stressRecords->first(); @endphp
                <div class="student-card monitor">
                    <div class="student-card-top monitor">
                        <div class="student-avatar monitor">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                        <div class="student-name-wrap">
                            <div class="student-name">{{ $student->name }}</div>
                            <div class="student-matric">{{ $student->matric_no ?? 'N/A' }}</div>
                        </div>
                        <span class="tier-badge amber">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            High
                        </span>
                    </div>
                    <div class="student-card-body">
                        <div class="info-grid">
                            <div class="info-item"><div class="info-label">Email</div><div class="info-value" style="font-size:12.5px;">{{ $student->email }}</div></div>
                            <div class="info-item"><div class="info-label">Phone</div><div class="info-value">{{ $student->phone ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Faculty</div><div class="info-value">{{ $student->faculty ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Department</div><div class="info-value">{{ $student->department ?? 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Level</div><div class="info-value">{{ $student->level ? $student->level . ' Level' : 'N/A' }}</div></div>
                            <div class="info-item"><div class="info-label">Assessments</div><div class="info-value">{{ $student->stressRecords->count() }} taken</div></div>
                        </div>
                        @if($latestRecord && $latestRecord->text_input)
                        <div class="stress-input-box">
                            <div class="stress-input-label">Student's Expression</div>
                            <div class="stress-input-text">"{{ $latestRecord->text_input }}"</div>
                        </div>
                        @endif
                        @if($latestRecord)
                        <div class="score-row">
                            <span class="score-badge high"><span class="score-dot"></span>High</span>
                            <span class="score-num">Score: {{ $latestRecord->stress_score }}/142</span>
                            <span class="score-num" style="margin-left:auto;">{{ $latestRecord->created_at->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($latestRecord && $latestRecord->assigned_counselor_id)
                            <div style="background:var(--teal-lt);border:1px solid #c0e0db;border-radius:9px;padding:.6rem .9rem;margin-bottom:.85rem;font-size:12px;color:var(--teal2);display:flex;align-items:center;gap:7px;">
                                <svg viewBox="0 0 24 24" style="width:13px;height:13px;fill:var(--teal2);flex-shrink:0;"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                                <span>
                                    @if($latestRecord->assigned_counselor_id === auth()->id())
                                        <strong>You</strong> are handling this case
                                    @else
                                        <strong>{{ $latestRecord->assignedCounselor->name ?? 'Another counsellor' }}</strong> is handling this case
                                    @endif
                                </span>
                            </div>
                        @else
                            <form method="POST" action="{{ route('counselor.claim', $latestRecord->id) }}" style="margin-bottom:.85rem;">
                                @csrf
                                <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:7px;background:var(--navy);color:#fff;border:none;padding:9px 18px;border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;">
                                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;fill:#fff;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                    I'm Handling This Case
                                </button>
                            </form>
                        @endif
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
                <p>There are currently no students at the High stress level.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- ALL ASSESSMENTS TABLE --}}
    <div class="card">
        <div class="card-header neutral">
            <div class="card-header-left">
                <div class="card-icon teal">
                    <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/></svg>
                </div>
                <div>
                    <div class="card-title">All Student Assessments</div>
                    <div class="card-subtitle cs-teal">Full assessment history with student details</div>
                </div>
            </div>
        </div>
        <div class="table-wrap">
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
                        <th>Stress Level</th>
                        <th>Expression</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allRecords as $i => $record)
                    <tr>
                        <td style="color:var(--muted);font-size:12px;">{{ $i + 1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div style="width:30px;height:30px;border-radius:50%;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:var(--teal);flex-shrink:0;">
                                    {{ strtoupper(substr($record->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span style="font-weight:500;">{{ $record->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td style="font-size:12.5px;color:var(--muted);">{{ $record->user->matric_no ?? '—' }}</td>
                        <td style="font-size:12.5px;color:var(--muted);">{{ $record->user->department ?? '—' }}</td>
                        <td style="font-size:12.5px;color:var(--muted);">{{ $record->user->level ? $record->user->level . 'L' : '—' }}</td>
                        <td><strong>{{ $record->stress_score }}</strong><span style="color:var(--muted);font-size:12px;">/142</span></td>
                        <td>
                            <span class="level-badge {{ strtolower($record->stress_level) }}">
                                <span class="level-dot"></span>
                                {{ $record->stress_level }}
                            </span>
                        </td>
                        <td style="font-size:12px;color:var(--muted);max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $record->text_input ? '"' . Str::limit($record->text_input, 40) . '"' : '—' }}
                        </td>
                        <td style="font-size:12px;color:var(--muted);white-space:nowrap;">{{ $record->created_at->format('d M Y') }}</td>
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

<script>
    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('open');
    }
</script>

</body>
</html>