<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Admin Dashboard</title>
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
        .nav-right { display: flex; align-items: center; gap: 10px; }
        .nav-avatar { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: #fff; }
        .nav-name  { color: #8fa3bf; font-size: 13px; }
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
        .btn-view-users { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; text-decoration: none; padding: 11px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 500; transition: all .2s; }
        .btn-view-users:hover { background: rgba(255,255,255,.18); }
        .btn-view-users svg { width: 15px; height: 15px; fill: #fff; }

        /* ── MAIN ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); transition: all .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.09); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 22px; height: 22px; }
        .si-teal   { background: var(--teal-lt); }   .si-teal svg   { fill: var(--teal); }
        .si-amber  { background: var(--amber-lt); }  .si-amber svg  { fill: var(--amber); }
        .si-red    { background: var(--danger-lt); } .si-red svg    { fill: var(--danger); }
        .si-green  { background: var(--green-lt); }  .si-green svg  { fill: var(--green); }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── THREE COL ── */
        .three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
        .two-col   { display: grid; grid-template-columns: 1.6fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; justify-content: space-between; }
        .card-header-left { display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }
        .card-body { padding: 1.4rem; }

        /* ── DISTRIBUTION BARS ── */
        .dist-item { margin-bottom: 1.1rem; }
        .dist-item:last-child { margin-bottom: 0; }
        .dist-label { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        .dist-name  { font-size: 13px; font-weight: 500; color: var(--text); display: flex; align-items: center; gap: 7px; }
        .dist-dot   { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .dist-count { font-size: 12px; color: var(--muted); }
        .dist-track { background: #e8ecf1; border-radius: 6px; height: 8px; overflow: hidden; }
        .dist-fill  { height: 100%; border-radius: 6px; transition: width .5s ease; }

        /* ── DONUT CHART ── */
        .donut-wrap { display: flex; align-items: center; justify-content: center; gap: 1.5rem; padding: .5rem 0; flex-wrap: wrap; }
        .donut-svg  { flex-shrink: 0; }
        .donut-legend { display: flex; flex-direction: column; gap: .6rem; }
        .donut-legend-item { display: flex; align-items: center; gap: 8px; font-size: 12.5px; color: var(--text); }
        .donut-legend-dot  { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }

        /* ── RECENT TABLE ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .7rem 1rem; border-bottom: 2px solid var(--border); text-align: left; white-space: nowrap; }
        .data-table td { font-size: 13px; color: var(--text); padding: .9rem 1rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafffe; }

        .level-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .level-badge.low      { background: var(--green-lt); color: var(--green); }
        .level-badge.moderate { background: var(--amber-lt); color: #b07000; }
        .level-badge.high     { background: var(--danger-lt); color: var(--danger); }
        .level-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        .alert-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px; background: var(--danger-lt); color: var(--danger); }
        .alert-badge svg { width: 10px; height: 10px; fill: var(--danger); }

        .empty-state { text-align: center; padding: 2.5rem 1rem; color: var(--muted); font-size: 13px; }
        .empty-state svg { width: 36px; height: 36px; fill: #c0cad5; display: block; margin: 0 auto .75rem; }

        /* ── HIGH RISK LIST ── */
        .risk-item { display: flex; align-items: center; gap: 12px; padding: .85rem 0; border-bottom: 1px solid #f0f2f5; }
        .risk-item:last-child { border-bottom: none; }
        .risk-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--danger-lt); border: 2px solid var(--danger); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: var(--danger); flex-shrink: 0; }
        .risk-name  { font-size: 13.5px; font-weight: 500; color: var(--text); }
        .risk-meta  { font-size: 11.5px; color: var(--muted); margin-top: 2px; }
        .risk-score { margin-left: auto; text-align: right; }
        .risk-score-num   { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: var(--danger); }
        .risk-score-label { font-size: 10.5px; color: var(--muted); }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; margin-top: .5rem; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1000px) { .three-col { grid-template-columns: 1fr 1fr; } .two-col { grid-template-columns: 1fr; } }
        @media (max-width: 700px)  { .stat-grid { grid-template-columns: 1fr 1fr; } .three-col { grid-template-columns: 1fr; } }
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
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('admin.users') }}"     class="nav-link">Students</a>
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
            <h1 class="page-header-title">Admin <em>Dashboard</em></h1>
            <p class="page-header-sub">Overview of student stress data and system activity.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="btn-view-users">
            <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            Manage Students
        </a>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- STAT CARDS --}}
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
            <div class="stat-icon si-red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $highRisk }}</div>
                <div class="stat-label">High Risk Cases</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-amber">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $moderate }}</div>
                <div class="stat-label">Moderate Cases</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-green">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
                <div class="stat-value">{{ $low }}</div>
                <div class="stat-label">Low Stress Cases</div>
            </div>
        </div>
    </div>

    {{-- STRESS DISTRIBUTION + HIGH RISK --}}
    <div class="two-col">

        {{-- Stress Distribution --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Stress Distribution</div>
                        <div class="card-subtitle">Breakdown of all student stress levels</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @php
                    $total_records = $highRisk + $moderate + $low;
                    $high_pct      = $total_records > 0 ? round($highRisk / $total_records * 100) : 0;
                    $mod_pct       = $total_records > 0 ? round($moderate / $total_records * 100)  : 0;
                    $low_pct       = $total_records > 0 ? round($low / $total_records * 100)       : 0;
                @endphp

                @if($total_records > 0)
                <div class="donut-wrap">
                    <svg class="donut-svg" width="140" height="140" viewBox="0 0 140 140">
                        @php
                            $cx = 70; $cy = 70; $r = 50;
                            $circumference = 2 * M_PI * $r;
                            $high_dash  = $circumference * $high_pct / 100;
                            $mod_dash   = $circumference * $mod_pct  / 100;
                            $low_dash   = $circumference * $low_pct  / 100;
                            $high_off   = 0;
                            $mod_off    = -($high_dash);
                            $low_off    = -($high_dash + $mod_dash);
                        @endphp
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#e8ecf1" stroke-width="20"/>
                        @if($highRisk > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#c0392b" stroke-width="20"
                            stroke-dasharray="{{ $high_dash }} {{ $circumference }}"
                            stroke-dashoffset="{{ $high_off }}"
                            transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        @endif
                        @if($moderate > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#e8a027" stroke-width="20"
                            stroke-dasharray="{{ $mod_dash }} {{ $circumference }}"
                            stroke-dashoffset="{{ $mod_off }}"
                            transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        @endif
                        @if($low > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#27ae60" stroke-width="20"
                            stroke-dasharray="{{ $low_dash }} {{ $circumference }}"
                            stroke-dashoffset="{{ $low_off }}"
                            transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        @endif
                        <text x="{{ $cx }}" y="{{ $cy - 6 }}" text-anchor="middle" font-family="DM Serif Display,serif" font-size="22" fill="#0d1f3c">{{ $total_records }}</text>
                        <text x="{{ $cx }}" y="{{ $cy + 14 }}" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="10" fill="#5c6b82">RECORDS</text>
                    </svg>
                    <div class="donut-legend">
                        <div class="donut-legend-item"><div class="donut-legend-dot" style="background:#c0392b;"></div>High Risk — {{ $highRisk }} ({{ $high_pct }}%)</div>
                        <div class="donut-legend-item"><div class="donut-legend-dot" style="background:#e8a027;"></div>Moderate — {{ $moderate }} ({{ $mod_pct }}%)</div>
                        <div class="donut-legend-item"><div class="donut-legend-dot" style="background:#27ae60;"></div>Low Stress — {{ $low }} ({{ $low_pct }}%)</div>
                    </div>
                </div>

                <div style="margin-top:1.5rem;">
                    <div class="dist-item">
                        <div class="dist-label">
                            <span class="dist-name"><span class="dist-dot" style="background:#c0392b;"></span>High Risk</span>
                            <span class="dist-count">{{ $highRisk }} students</span>
                        </div>
                        <div class="dist-track"><div class="dist-fill" style="width:{{ $high_pct }}%;background:#c0392b;"></div></div>
                    </div>
                    <div class="dist-item">
                        <div class="dist-label">
                            <span class="dist-name"><span class="dist-dot" style="background:#e8a027;"></span>Moderate</span>
                            <span class="dist-count">{{ $moderate }} students</span>
                        </div>
                        <div class="dist-track"><div class="dist-fill" style="width:{{ $mod_pct }}%;background:#e8a027;"></div></div>
                    </div>
                    <div class="dist-item">
                        <div class="dist-label">
                            <span class="dist-name"><span class="dist-dot" style="background:#27ae60;"></span>Low Stress</span>
                            <span class="dist-count">{{ $low }} students</span>
                        </div>
                        <div class="dist-track"><div class="dist-fill" style="width:{{ $low_pct }}%;background:#27ae60;"></div></div>
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                    No assessment data yet.
                </div>
                @endif
            </div>
        </div>

        {{-- High Risk Alerts --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-icon" style="background:#c0392b;">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    </div>
                    <div>
                        <div class="card-title">High-Risk Alerts</div>
                        <div class="card-subtitle">Students requiring immediate attention</div>
                    </div>
                </div>
                @if($highRisk > 0)
                <span class="alert-badge">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    {{ $highRisk }} alert{{ $highRisk > 1 ? 's' : '' }}
                </span>
                @endif
            </div>
            <div class="card-body">
                @php
                    $highRiskRecords = $recentRecords->where('stress_level', 'High')->take(6);
                @endphp
                @if($highRiskRecords->count() > 0)
                    @foreach($highRiskRecords as $i => $record)
                    <div class="risk-item">
                        <div class="risk-avatar" style="background:var(--danger-lt);color:var(--danger);border-color:var(--danger);">
                            ⚠
                        </div>
                        <div>
                            <div class="risk-name">Student #{{ $i + 1 }}</div>
                            <div class="risk-meta">{{ $record->created_at->format('d M Y') }} &bull; {{ ucfirst($record->academic_period ?? 'N/A') }}</div>
                        </div>
                        <div class="risk-score">
                            <div class="risk-score-num">{{ $record->stress_score }}/50</div>
                            <div class="risk-score-label">Score</div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="empty-state">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    No high-risk cases at the moment.
                </div>
                @endif
            </div>
        </div>

    </div>

    {{-- RECENT ASSESSMENTS TABLE --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/></svg>
                </div>
                <div>
                    <div class="card-title">Recent Assessments</div>
                    <div class="card-subtitle">Latest 10 student submissions</div>
                </div>
            </div>
            <a href="{{ route('admin.users') }}" style="font-size:12.5px;color:var(--teal);text-decoration:none;font-weight:500;">View All →</a>
        </div>
        <div class="card-body" style="padding:0;">
            @if($recentRecords->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Matric No</th>
                        <th>Score</th>
                        <th>Level</th>
                        <th>Time Period</th>
                        <th>Academic Period</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentRecords as $i => $record)
                    <tr>
                        <td style="color:var(--muted);font-size:12px;">{{ $i + 1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div style="width:30px;height:30px;border-radius:50%;background:var(--teal-lt);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:var(--teal);flex-shrink:0;">
                                    S{{ $i + 1 }}
                                </div>
                                <span style="font-weight:500;">Student {{ $i + 1 }}</span>
                            </div>
                        </td>
                        <td style="color:var(--muted);font-size:12.5px;">Confidential</td>
                        <td><strong>{{ $record->stress_score }}</strong><span style="color:var(--muted);font-size:12px;">/50</span></td>
                        <td>
                            <span class="level-badge {{ strtolower($record->stress_level) }}">
                                <span class="level-dot"></span>
                                {{ $record->stress_level }}
                            </span>
                        </td>
                        <td style="font-size:12.5px;color:var(--muted);text-transform:capitalize;">{{ $record->time_period ?? '—' }}</td>
                        <td style="font-size:12.5px;color:var(--muted);text-transform:capitalize;">{{ $record->academic_period ?? '—' }}</td>
                        <td style="font-size:12px;color:var(--muted);">{{ $record->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9z"/></svg>
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

</body>
</html>