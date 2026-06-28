<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Student Dashboard</title>
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
        }

        html, body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); min-height: 100vh; overflow-x: hidden; }

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
            box-shadow: 0 1px 0 rgba(255,255,255,.04);
        }

        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; min-width: 0; }
        .nav-logo  { width: 38px; height: 38px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .nav-logo svg { width: 20px; height: 20px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 10px; text-transform: uppercase; letter-spacing: .09em; }

        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link  { color: #8fa3bf; font-size: 13px; padding: 7px 14px; border-radius: 8px; text-decoration: none; transition: all .18s; white-space: nowrap; }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.08); }
        .nav-link.active { color: var(--teal-md); background: rgba(26,127,116,.18); }

        .nav-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .nav-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--teal), var(--teal3));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600; color: #fff;
            flex-shrink: 0;
        }
        .nav-name { color: #8fa3bf; font-size: 13px; white-space: nowrap; }

        .nav-logout {
            background: transparent; color: #8fa3bf;
            border: 1px solid rgba(255,255,255,.15);
            padding: 7px 16px; border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: 13px;
            cursor: pointer; text-decoration: none; transition: all .18s;
            white-space: nowrap;
        }
        .nav-logout:hover { color: #fff; border-color: rgba(255,255,255,.35); }

        /* Mobile hamburger */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            background: none;
            border: none;
            flex-shrink: 0;
        }
        .nav-hamburger span { display: block; width: 22px; height: 2px; background: #8fa3bf; border-radius: 2px; transition: background .18s; }
        .nav-hamburger:hover span { background: #fff; }

        .nav-mobile-menu {
            display: none;
            flex-direction: column;
            background: var(--navy);
            border-top: 1px solid rgba(255,255,255,.07);
            padding: .75rem 1.25rem 1rem;
        }
        .nav-mobile-menu.open { display: flex; }
        .nav-mobile-user {
            display: flex; align-items: center; gap: 10px;
            padding: .5rem 0 .85rem; border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: .35rem;
        }
        .nav-mobile-user span { color: #fff; font-size: 13.5px; font-weight: 500; }
        .nav-mobile-menu a {
            color: #8fa3bf; font-size: 14px; padding: .7rem 0;
            text-decoration: none; border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .nav-mobile-menu a:last-of-type { border-bottom: none; }
        .nav-mobile-menu a.active { color: var(--teal-md); }
        .nav-mobile-logout {
            background: rgba(192,57,43,.12); color: #ff8f7d;
            border: 1px solid rgba(192,57,43,.25);
            padding: 11px; border-radius: 9px; text-align: center;
            font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 500;
            cursor: pointer; width: 100%; margin-top: .6rem;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%);
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        .page-header::before { content: ''; position: absolute; top: -60px; right: -80px; width: 280px; height: 280px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .page-header::after  { content: ''; position: absolute; bottom: -60px; left: -40px; width: 200px; height: 200px; border-radius: 50%; background: rgba(232,160,39,.08); pointer-events: none; }
        .page-header-inner { position: relative; z-index: 2; max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; }
        .page-header-left { min-width: 0; }
        .page-header-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--teal-md); margin-bottom: .4rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: clamp(1.4rem, 5vw, 2rem); color: #fff; line-height: 1.25; margin-bottom: .3rem; word-wrap: break-word; }
        .page-header-title em { font-style: italic; color: var(--teal-md); }
        .page-header-sub { font-size: 13.5px; color: #8fa3bf; }
        .btn-start {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--teal), var(--teal2));
            color: #fff; text-decoration: none;
            padding: 13px 28px; border-radius: 12px;
            font-size: 14px; font-weight: 600;
            box-shadow: 0 4px 18px rgba(26,127,116,.35);
            transition: all .2s; white-space: nowrap;
        }
        .btn-start:hover { transform: translateY(-2px); box-shadow: 0 7px 24px rgba(26,127,116,.45); }
        .btn-start svg { width: 16px; height: 16px; fill: #fff; flex-shrink: 0; }

        /* ── MAIN ── */
        .main { max-width: 1100px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 12px rgba(13,31,60,.05);
            transition: all .2s;
            min-width: 0;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.09); }

        .stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 22px; height: 22px; }
        .si-teal   { background: var(--teal-lt); }
        .si-teal svg { fill: var(--teal); }
        .si-amber  { background: var(--amber-lt); }
        .si-amber svg { fill: var(--amber); }
        .si-red    { background: var(--danger-lt); }
        .si-red svg { fill: var(--danger); }
        .si-navy   { background: #eef1f6; }
        .si-navy svg { fill: var(--navy); }

        .stat-info { min-width: 0; }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--navy); line-height: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── TWO COL ── */
        .two-col { display: grid; grid-template-columns: 1fr 1.4fr; gap: 1.25rem; margin-bottom: 1.25rem; }

        /* ── CARDS ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .card-header > div:last-child { min-width: 0; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }
        .card-body { padding: 1.4rem; }

        /* ── STRESS LEVEL DISPLAY ── */
        .stress-display { text-align: center; padding: 1.5rem 1rem; }
        .stress-circle {
            width: 120px; height: 120px;
            border-radius: 50%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            border: 4px solid;
        }
        .stress-circle.mild      { background: #e8f9f0; border-color: #27ae60; }
        .stress-circle.moderate  { background: var(--amber-lt); border-color: var(--amber); }
        .stress-circle.high      { background: #ffe8e0; border-color: #e8743a; }
        .stress-circle.severe    { background: var(--danger-lt); border-color: var(--danger); }
        .stress-circle.none      { background: #f0f2f5; border-color: var(--border); }

        .stress-circle-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); }
        .stress-circle-value { font-family: 'DM Serif Display', serif; font-size: 1.4rem; line-height: 1.1; }
        .stress-circle.mild      .stress-circle-value { color: #27ae60; }
        .stress-circle.moderate  .stress-circle-value { color: var(--amber); }
        .stress-circle.high      .stress-circle-value { color: #e8743a; }
        .stress-circle.severe    .stress-circle-value { color: var(--danger); }
        .stress-circle.none      .stress-circle-value { color: var(--muted); }

        .stress-score-text { font-size: 13px; color: var(--muted); margin-bottom: 1rem; }
        .stress-score-text strong { color: var(--text); }

        .stress-bar-wrap { margin: 0 1rem; }
        .stress-bar-track { background: #e8ecf1; border-radius: 6px; height: 8px; overflow: hidden; margin-bottom: .4rem; }
        .stress-bar-fill  { height: 100%; border-radius: 6px; transition: width .5s ease; }
        .stress-bar-fill.mild      { background: #27ae60; }
        .stress-bar-fill.moderate  { background: var(--amber); }
        .stress-bar-fill.high      { background: #e8743a; }
        .stress-bar-fill.severe    { background: var(--danger); }
        .stress-bar-labels { display: flex; justify-content: space-between; font-size: 9.5px; color: #c0cad5; }

        .stress-recommendation {
            background: var(--teal-lt);
            border: 1px solid #c0e0db;
            border-radius: 10px;
            padding: .85rem 1rem;
            font-size: 12.5px;
            color: var(--teal2);
            line-height: 1.6;
            margin-top: 1.1rem;
            text-align: left;
        }
        .stress-recommendation strong { display: block; margin-bottom: 3px; font-size: 12px; text-transform: uppercase; letter-spacing: .06em; }

        .no-assessment {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--muted);
        }
        .no-assessment svg { width: 40px; height: 40px; fill: #c0cad5; margin-bottom: .75rem; }
        .no-assessment p   { font-size: 13px; line-height: 1.6; }

        /* ── PROFILE CARD ── */
        .profile-info { display: flex; flex-direction: column; gap: .75rem; }
        .profile-row  { display: flex; align-items: center; gap: 10px; padding: .6rem 0; border-bottom: 1px solid #f0f2f5; min-width: 0; }
        .profile-row:last-child { border-bottom: none; }
        .profile-row-icon { width: 32px; height: 32px; background: var(--teal-lt); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .profile-row-icon svg { width: 15px; height: 15px; fill: var(--teal); }
        .profile-row-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: #c0cad5; }
        .profile-row-value { font-size: 13.5px; color: var(--text); font-weight: 500; word-break: break-word; }

        .role-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: var(--teal-lt); color: var(--teal);
            font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
            text-transform: capitalize;
        }
        .role-badge span { width: 5px; height: 5px; border-radius: 50%; background: var(--teal); flex-shrink: 0; }

        /* ── HISTORY TABLE ── */
        .history-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .history-table { width: 100%; border-collapse: collapse; min-width: 460px; }
        .history-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .6rem .75rem; border-bottom: 2px solid var(--border); text-align: left; white-space: nowrap; }
        .history-table td { font-size: 13px; color: var(--text); padding: .85rem .75rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; white-space: nowrap; }
        .history-table tr:last-child td { border-bottom: none; }
        .history-table tr:hover td { background: #fafffe; }

        .level-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; white-space: nowrap; }
        .level-badge.mild      { background: #e8f9f0; color: #27ae60; }
        .level-badge.moderate  { background: var(--amber-lt); color: #b07000; }
        .level-badge.high      { background: #ffe8e0; color: #c2540e; }
        .level-badge.severe    { background: var(--danger-lt); color: var(--danger); }
        .level-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; flex-shrink: 0; }

        .empty-history { text-align: center; padding: 2.5rem 1rem; color: var(--muted); font-size: 13px; }
        .empty-history svg { width: 36px; height: 36px; fill: #c0cad5; display: block; margin: 0 auto .75rem; }

        /* ── TIPS CARD ── */
        .tips-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
        .tip-item  { background: var(--sand); border: 1px solid var(--border); border-radius: 12px; padding: 1rem; min-width: 0; }
        .tip-icon  { font-size: 1.4rem; margin-bottom: .4rem; }
        .tip-title { font-size: 12.5px; font-weight: 600; color: var(--navy); margin-bottom: .25rem; }
        .tip-desc  { font-size: 12px; color: var(--muted); line-height: 1.55; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; margin-top: .5rem; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        /* ══════════════════════ RESPONSIVE ══════════════════════ */

        @media (max-width: 900px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .two-col   { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 1.25rem; }
            .nav-links { display: none; }
            .nav-name  { display: none; }
            .nav-logout { display: none; }
            .nav-hamburger { display: flex; }
            .nav-title { font-size: 14px; }
            .nav-sub   { display: none; }

            .page-header { padding: 1.75rem 1.25rem; }
            .page-header-inner { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .btn-start { width: 100%; justify-content: center; }
        }

        @media (max-width: 540px) {
            .stat-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
            .stat-card { padding: 1rem; gap: .75rem; }
            .stat-icon { width: 38px; height: 38px; }
            .stat-icon svg { width: 18px; height: 18px; }
            .stat-value { font-size: 1.25rem; }
            .stat-label { font-size: 10.5px; }

            .tips-grid { grid-template-columns: 1fr; }
            .main { padding: 1.5rem 1rem 3rem; }
            .card-body { padding: 1.1rem; }
            .card-header { padding: 1rem 1.1rem; }

            .stress-circle { width: 100px; height: 100px; }
            .stress-circle-value { font-size: 1.2rem; }
        }

        @media (max-width: 480px) {
            .stat-grid { grid-template-columns: 1fr; }
            .stat-card { padding: .9rem 1rem; }
            .stat-value { white-space: normal; overflow: visible; text-overflow: unset; word-break: break-word; }
        }

        /* History table → stacked cards on small screens */
        @media (max-width: 640px) {
            .history-table-wrap { overflow-x: visible; }
            .history-table { min-width: 0; }
            .history-table thead { display: none; }
            .history-table, .history-table tbody, .history-table tr, .history-table td { display: block; width: 100%; }
            .history-table tbody { padding: .9rem; display: flex; flex-direction: column; gap: .75rem; }
            .history-table tr {
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: .15rem .9rem;
                box-shadow: 0 1px 6px rgba(13,31,60,.04);
            }
            .history-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
                white-space: normal;
                text-align: right;
                padding: .55rem 0;
                border-bottom: 1px solid #f0f2f5;
            }
            .history-table td:last-child { border-bottom: none; }
            .history-table td::before {
                content: attr(data-label);
                font-size: 10.5px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .06em;
                color: var(--muted);
                flex-shrink: 0;
                text-align: left;
            }
            .history-table td[data-label="#"] { display: none; }
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
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

    <div class="nav-links">
        <a href="{{ route('student.dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('student.submit') }}"    class="nav-link">Assessment</a>
    </div>

    <div class="nav-right">
        <div class="nav-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <span class="nav-name">{{ explode(' ', $user->name)[0] }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="nav-logout">Log Out</button>
        </form>
    </div>

    <button class="nav-hamburger" onclick="toggleMobileMenu()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile dropdown menu --}}
<div class="nav-mobile-menu" id="mobileMenu">
    <div class="nav-mobile-user">
        <div class="nav-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <span>{{ $user->name }}</span>
    </div>
    <a href="{{ route('student.dashboard') }}" class="active">Dashboard</a>
    <a href="{{ route('student.submit') }}">Assessment</a>
    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="nav-mobile-logout">Log Out</button>
    </form>
</div>

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="page-header-inner">
        <div class="page-header-left">
            <p class="page-header-eyebrow">Student Dashboard</p>
            <h1 class="page-header-title">
                Welcome back, <em>{{ explode(' ', $user->name)[0] }}</em>
            </h1>
            <p class="page-header-sub">
                {{ $total > 0 ? "You've completed {$total} assessment" . ($total > 1 ? 's' : '') . '. Keep tracking your wellness.' : "You haven't taken an assessment yet. Start one today!" }}
            </p>
        </div>
        <a href="{{ route('student.submit') }}" class="btn-start">
            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            {{ $total > 0 ? 'Take New Assessment' : 'Start First Assessment' }}
        </a>
    </div>
</div>

{{-- ── MAIN ── --}}
<div class="main">

    {{-- ── STAT CARDS ── --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon si-teal">
                <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-label">Assessments Taken</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon si-navy">
                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $average > 0 ? $average : '—' }}</div>
                <div class="stat-label">Average Score</div>
            </div>
        </div>

        @php
            $latestLevelLower = $latest ? strtolower($latest->stress_level) : null;
            $latestIconClass = match($latestLevelLower) {
                'severe' => 'si-red',
                'high'   => 'si-red',
                'moderate' => 'si-amber',
                default  => 'si-teal',
            };
        @endphp
        <div class="stat-card">
            <div class="stat-icon {{ $latestIconClass }}">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $latest ? $latest->stress_level : '—' }}</div>
                <div class="stat-label">Latest Stress Level</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon si-teal">
                <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $latest ? $latest->created_at->format('d M') : '—' }}</div>
                <div class="stat-label">Last Assessment</div>
            </div>
        </div>
    </div>

    {{-- ── TWO COLUMN ── --}}
    <div class="two-col">

        {{-- LEFT: Stress Level + Profile --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Stress Level Card --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Current Stress Status</div>
                        <div class="card-subtitle">Based on your latest assessment</div>
                    </div>
                </div>
                <div class="card-body">
                    @if($latest)
                        @php
                            $level = strtolower($latest->stress_level);
                            $score = $latest->stress_score;
                            $pct   = min(round($score / 142 * 100), 100);
                        @endphp
                        <div class="stress-display">
                            <div class="stress-circle {{ $level }}">
                                <span class="stress-circle-label">Level</span>
                                <span class="stress-circle-value">{{ $latest->stress_level }}</span>
                            </div>
                            <p class="stress-score-text">Score: <strong>{{ $score }} / 142</strong></p>
                            <div class="stress-bar-wrap">
                                <div class="stress-bar-track">
                                    <div class="stress-bar-fill {{ $level }}" style="width:{{ $pct }}%;"></div>
                                </div>
                                <div class="stress-bar-labels"><span>Mild</span><span>Moderate</span><span>High</span><span>Severe</span></div>
                            </div>
                        </div>
                        <div class="stress-recommendation">
                            <strong>💡 Recommendation</strong>
                            @if($level === 'mild')
                                You're managing stress well. Keep maintaining healthy study habits, regular breaks, and good sleep.
                            @elseif($level === 'moderate')
                                Consider speaking with a counsellor. Try time management techniques and don't hesitate to ask for support.
                            @elseif($level === 'high')
                                Your stress level is high. We recommend connecting with a counsellor soon and prioritising rest where possible.
                            @else
                                Your stress level is severe. We strongly recommend connecting with a counsellor as soon as possible. You are not alone.
                            @endif
                        </div>
                    @else
                        <div class="no-assessment">
                            <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
                            <p>No assessment taken yet.<br>Take your first assessment to see your stress status here.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Profile Card --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">My Profile</div>
                        <div class="card-subtitle">Your account information</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-info">
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Full Name</div>
                                <div class="profile-row-value">{{ $user->name }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Email</div>
                                <div class="profile-row-value">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
                            <div>
                                <div class="profile-row-label">Matric Number</div>
                                <div class="profile-row-value">{{ $user->matric_no ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Phone</div>
                                <div class="profile-row-value">{{ $user->phone ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Faculty</div>
                                <div class="profile-row-value">{{ $user->faculty ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Department</div>
                                <div class="profile-row-value">{{ $user->department ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Level</div>
                                <div class="profile-row-value">{{ $user->level ? $user->level . ' Level' : '—' }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Role</div>
                                <div class="role-badge"><span></span>{{ ucfirst($user->role) }}</div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="profile-row-icon"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg></div>
                            <div>
                                <div class="profile-row-label">Member Since</div>
                                <div class="profile-row-value">{{ $user->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT: History + Tips --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Assessment History --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Assessment History</div>
                        <div class="card-subtitle">Your previous stress assessments</div>
                    </div>
                </div>
                <div class="card-body" style="padding:0;">
                    @if($records->count() > 0)
                    <div class="history-table-wrap">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Score</th>
                                <th>Level</th>
                                <th>Period</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records->take(8) as $i => $record)
                            <tr>
                                <td data-label="#" style="color:var(--muted);font-size:12px;">{{ $i + 1 }}</td>
                                <td data-label="Date">{{ $record->created_at->format('d M Y') }}<br><span style="font-size:11px;color:var(--muted);">{{ $record->created_at->format('h:i A') }}</span></td>
                                <td data-label="Score"><strong>{{ $record->stress_score }}</strong><span style="color:var(--muted);font-size:12px;">/142</span></td>
                                <td data-label="Level">
                                    <span class="level-badge {{ strtolower($record->stress_level) }}">
                                        <span class="level-dot"></span>
                                        {{ $record->stress_level }}
                                    </span>
                                </td>
                                <td data-label="Period" style="font-size:12px;color:var(--muted);text-transform:capitalize;">
                                    {{ $record->academic_period ?? '—' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @else
                    <div class="empty-history">
                        <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9z"/></svg>
                        No assessments yet. Take your first one to see your history here.
                    </div>
                    @endif
                </div>
            </div>

            {{-- Wellness Tips --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Wellness Tips</div>
                        <div class="card-subtitle">Simple habits to manage academic stress</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tips-grid">
                        <div class="tip-item">
                            <div class="tip-icon">🧘</div>
                            <div class="tip-title">Take Breaks</div>
                            <div class="tip-desc">Study for 45 mins then rest for 15. The Pomodoro method reduces burnout significantly.</div>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon">😴</div>
                            <div class="tip-title">Sleep Well</div>
                            <div class="tip-desc">7–8 hours of sleep improves memory retention and reduces anxiety before exams.</div>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon">🗣️</div>
                            <div class="tip-title">Talk to Someone</div>
                            <div class="tip-desc">Don't carry stress alone. Speak to a counsellor, friend, or family member.</div>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon">📝</div>
                            <div class="tip-title">Plan Ahead</div>
                            <div class="tip-desc">Break assignments into smaller tasks and set daily targets to avoid deadline panic.</div>
                        </div>
                    </div>
                </div>
            </div>

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