<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Management Dashboard</title>
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

        /* date badge */
        .date-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); color: #8fa3bf; font-size: 12.5px; padding: 8px 16px; border-radius: 10px; }
        .date-badge svg { width: 14px; height: 14px; fill: #8fa3bf; }

        /* ── MAIN ── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

        /* ── STAT GRID ── */
        .stat-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.1rem 1.25rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); transition: all .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,31,60,.09); }
        .stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: .75rem; }
        .stat-icon svg { width: 18px; height: 18px; }
        .si-teal  { background: var(--teal-lt); }  .si-teal svg  { fill: var(--teal); }
        .si-red   { background: var(--danger-lt); } .si-red svg  { fill: var(--danger); }
        .si-amber { background: var(--amber-lt); }  .si-amber svg { fill: var(--amber); }
        .si-green { background: var(--green-lt); }  .si-green svg { fill: var(--green); }
        .si-navy  { background: #eef1f6; }           .si-navy svg  { fill: var(--navy); }
        .si-teal2 { background: #e0f7f5; }           .si-teal2 svg { fill: var(--teal2); }
        .stat-value { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--navy); line-height: 1; }
        .stat-label { font-size: 11.5px; color: var(--muted); margin-top: 3px; }

        /* ── TWO / THREE COL ── */
        .two-col   { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
        .three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }

        /* ── CARD ── */
        .card { background: #fff; border-radius: 18px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 14px rgba(13,31,60,.05); }
        .card-header { background: linear-gradient(90deg, var(--teal-lt), #f0faf9); padding: 1.1rem 1.4rem; border-bottom: 1px solid #c8e8e4; display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 38px; height: 38px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-icon svg { width: 18px; height: 18px; fill: #fff; }
        .card-title    { font-size: 14px; font-weight: 600; color: var(--navy); }
        .card-subtitle { font-size: 12px; color: var(--teal); margin-top: 1px; }
        .card-body { padding: 1.4rem; }

        /* ── RISK OVERVIEW ── */
        .risk-overview { display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .risk-pill { flex: 1; min-width: 120px; background: var(--sand); border: 1px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center; }
        .risk-pill-num   { font-family: 'DM Serif Display', serif; font-size: 1.8rem; line-height: 1; }
        .risk-pill-label { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; margin-top: 4px; }
        .risk-pill.high     .risk-pill-num { color: var(--danger); }
        .risk-pill.moderate .risk-pill-num { color: var(--amber); }
        .risk-pill.low      .risk-pill-num { color: var(--green); }

        /* ── BAR CHART ── */
        .bar-chart { display: flex; flex-direction: column; gap: .85rem; }
        .bar-row   { display: grid; grid-template-columns: 120px 1fr 50px; align-items: center; gap: .75rem; }
        .bar-label { font-size: 12.5px; color: var(--text); font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .bar-track { background: #e8ecf1; border-radius: 6px; height: 10px; overflow: hidden; }
        .bar-fill  { height: 100%; border-radius: 6px; transition: width .6s ease; }
        .bar-value { font-size: 12px; color: var(--muted); text-align: right; }

        /* ── PERIOD TABLE ── */
        .period-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .period-card { background: var(--sand); border: 1px solid var(--border); border-radius: 12px; padding: 1.1rem; text-align: center; }
        .period-icon  { font-size: 1.5rem; margin-bottom: .4rem; }
        .period-name  { font-size: 12px; font-weight: 600; color: var(--navy); text-transform: capitalize; margin-bottom: .5rem; }
        .period-count { font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: var(--navy); }
        .period-avg   { font-size: 11.5px; color: var(--muted); margin-top: 3px; }
        .period-bar   { background: #e8ecf1; border-radius: 4px; height: 6px; margin-top: .5rem; overflow: hidden; }
        .period-bar-fill { height: 100%; border-radius: 4px; }

        /* ── TREND ── */
        .trend-chart { display: flex; align-items: flex-end; gap: .5rem; height: 140px; padding: 0 .5rem; }
        .trend-bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; height: 100%; justify-content: flex-end; }
        .trend-bar { width: 100%; background: linear-gradient(180deg, var(--teal), var(--teal2)); border-radius: 6px 6px 0 0; transition: height .5s ease; min-height: 4px; }
        .trend-month { font-size: 10px; color: var(--muted); text-align: center; }
        .trend-val   { font-size: 10px; color: var(--teal); font-weight: 600; }

        /* ── FACULTY TABLE ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); padding: .7rem 1rem; border-bottom: 2px solid var(--border); text-align: left; background: #fafffe; }
        .data-table td { font-size: 13px; color: var(--text); padding: .85rem 1rem; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafffe; }

        .risk-indicator { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .ri-high     { background: var(--danger-lt); color: var(--danger); }
        .ri-moderate { background: var(--amber-lt);  color: #b07000; }
        .ri-low      { background: var(--green-lt);  color: var(--green); }

        /* ── POLICY HIGHLIGHT ── */
        .policy-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .policy-item { background: var(--sand); border: 1px solid var(--border); border-radius: 12px; padding: 1.1rem; }
        .policy-icon { font-size: 1.4rem; margin-bottom: .5rem; }
        .policy-title { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: .3rem; }
        .policy-desc  { font-size: 12px; color: var(--muted); line-height: 1.6; }

        /* ── EMPTY ── */
        .empty-state { text-align: center; padding: 2rem; color: var(--muted); font-size: 13px; }

        /* ── FOOTER ── */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 1100px) { .stat-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 900px)  { .two-col { grid-template-columns: 1fr; } .three-col { grid-template-columns: 1fr; } }
        @media (max-width: 600px)  { .stat-grid { grid-template-columns: repeat(2, 1fr); } .period-grid { grid-template-columns: 1fr; } .policy-grid { grid-template-columns: 1fr; } }
        @media (max-width: 420px) {
            .navbar { padding: 0 1.25rem; }
            .nav-sub  { display: none; }
            .nav-name { display: none; }
        }

        @media (max-width: 760px) {
            /* Faculty Stress Report table → stacked cards */
            .data-table-wrap { overflow-x: visible; }
            .data-table { min-width: 0; }
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tbody { padding: .9rem; display: flex; flex-direction: column; gap: .75rem; }
            .data-table tr {
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: .15rem .9rem;
                box-shadow: 0 1px 6px rgba(13,31,60,.04);
            }
            .data-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
                white-space: normal;
                text-align: right;
                padding: .6rem 0;
                border-bottom: 1px solid #f0f2f5;
            }
            .data-table td:last-child { border-bottom: none; }
            .data-table td::before {
                content: attr(data-label);
                font-size: 10.5px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .06em;
                color: var(--muted);
                flex-shrink: 0;
                text-align: left;
            }
            .data-table td[data-label="#"] { display: none; }
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
            <div class="nav-sub">Management Panel</div>
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
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <p class="page-header-eyebrow">University Management</p>
            <h1 class="page-header-title">Stress Trends &amp; <em>Policy Reports</em></h1>
            <p class="page-header-sub">Aggregated institutional data for strategic decision-making. No individual student data is shown.</p>
        </div>
        <div class="date-badge">
            <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg>
            Report as of {{ now()->format('d M Y') }}
        </div>
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
            <div class="stat-value">{{ $totalStudents }}</div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-navy">
                <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zM5 3H3v18l4-4h14a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
            </div>
            <div class="stat-value">{{ $totalAssessments }}</div>
            <div class="stat-label">Total Assessments</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div class="stat-value">{{ $highRisk }}</div>
            <div class="stat-label">High Risk Cases</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-amber">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="stat-value">{{ $moderate }}</div>
            <div class="stat-label">Moderate Cases</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-green">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="stat-value">{{ $low }}</div>
            <div class="stat-label">Low Stress Cases</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-teal2">
                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
            <div class="stat-value">{{ $avgScore > 0 ? $avgScore : '—' }}</div>
            <div class="stat-label">Avg Stress Score</div>
        </div>
    </div>

    {{-- RISK OVERVIEW + TREND --}}
    <div class="two-col">

        {{-- Risk Overview --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                </div>
                <div>
                    <div class="card-title">Stress Level Distribution</div>
                    <div class="card-subtitle">Institutional overview — no individual data</div>
                </div>
            </div>
            <div class="card-body">
                @php
                    $total = $highRisk + $moderate + $low;
                    $highPct = $total > 0 ? round($highRisk / $total * 100) : 0;
                    $modPct  = $total > 0 ? round($moderate / $total * 100)  : 0;
                    $lowPct  = $total > 0 ? round($low / $total * 100)       : 0;
                @endphp

                <div class="risk-overview">
                    <div class="risk-pill high">
                        <div class="risk-pill-num">{{ $highRisk }}</div>
                        <div class="risk-pill-label">High Risk</div>
                    </div>
                    <div class="risk-pill moderate">
                        <div class="risk-pill-num">{{ $moderate }}</div>
                        <div class="risk-pill-label">Moderate</div>
                    </div>
                    <div class="risk-pill low">
                        <div class="risk-pill-num">{{ $low }}</div>
                        <div class="risk-pill-label">Low Stress</div>
                    </div>
                </div>

                @if($total > 0)
                <div class="bar-chart">
                    <div class="bar-row">
                        <span class="bar-label">High Risk</span>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ $highPct }}%;background:var(--danger);"></div></div>
                        <span class="bar-value">{{ $highPct }}%</span>
                    </div>
                    <div class="bar-row">
                        <span class="bar-label">Moderate</span>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ $modPct }}%;background:var(--amber);"></div></div>
                        <span class="bar-value">{{ $modPct }}%</span>
                    </div>
                    <div class="bar-row">
                        <span class="bar-label">Low Stress</span>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ $lowPct }}%;background:var(--green);"></div></div>
                        <span class="bar-value">{{ $lowPct }}%</span>
                    </div>
                </div>

                {{-- Policy insight --}}
                <div style="background:var(--teal-lt);border:1px solid #c0e0db;border-radius:10px;padding:.85rem 1rem;margin-top:1.25rem;font-size:12.5px;color:var(--teal2);line-height:1.6;">
                    <strong style="display:block;font-size:11.5px;text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px;">📊 Policy Insight</strong>
                    @if($highPct >= 40)
                        High stress prevalence is significant ({{ $highPct }}%). Consider increasing counselling resources and reviewing academic workload policies.
                    @elseif($highPct >= 20)
                        Moderate high-risk rate ({{ $highPct }}%). Monitor trends and ensure counselling capacity meets demand.
                    @else
                        Stress levels are generally manageable ({{ $highPct }}% high risk). Continue current wellness initiatives.
                    @endif
                </div>
                @else
                <div class="empty-state">No assessment data available yet.</div>
                @endif
            </div>
        </div>

        {{-- Monthly Trend --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/></svg>
                </div>
                <div>
                    <div class="card-title">Monthly Stress Trend</div>
                    <div class="card-subtitle">Average stress score over last 6 months</div>
                </div>
            </div>
            <div class="card-body">
                @if($monthlyTrend->count() > 0)
                @php
                    $maxScore = $monthlyTrend->max('avg_score') ?: 1;
                    $months   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                @endphp
                <div class="trend-chart">
                    @foreach($monthlyTrend as $item)
                    @php $height = max(8, round($item->avg_score / 50 * 120)); @endphp
                    <div class="trend-bar-wrap">
                        <div class="trend-val">{{ round($item->avg_score, 1) }}</div>
                        <div class="trend-bar" style="height:{{ $height }}px;"></div>
                        <div class="trend-month">{{ $months[$item->month - 1] }}</div>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;font-size:12px;color:var(--muted);">
                    <span>Score range: 10 (lowest) — 50 (highest)</span>
                    <span>{{ $monthlyTrend->count() }} month{{ $monthlyTrend->count() > 1 ? 's' : '' }} of data</span>
                </div>
                @else
                <div class="empty-state">Not enough data for trend analysis yet.</div>
                @endif
            </div>
        </div>

    </div>

    {{-- STRESS BY ACADEMIC PERIOD --}}
    <div class="card" style="margin-bottom:1.25rem;">
        <div class="card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23L12.5 13V7z"/></svg>
            </div>
            <div>
                <div class="card-title">Stress by Academic Period</div>
                <div class="card-subtitle">When is stress highest across the academic calendar?</div>
            </div>
        </div>
        <div class="card-body">
            @if($stressByPeriod->count() > 0)
            @php
                $maxPeriod = $stressByPeriod->max('total') ?: 1;
                $periodIcons = ['normal' => '📚', 'test' => '📝', 'exam' => '🎓'];
            @endphp
            <div class="period-grid">
                @foreach($stressByPeriod as $period)
                @php $pct = round($period->total / $maxPeriod * 100); @endphp
                <div class="period-card">
                    <div class="period-icon">{{ $periodIcons[$period->academic_period] ?? '📋' }}</div>
                    <div class="period-name">{{ ucfirst($period->academic_period) }} Period</div>
                    <div class="period-count">{{ $period->total }}</div>
                    <div class="period-avg">Avg score: {{ round($period->avg_score, 1) }}/50</div>
                    <div class="period-bar">
                        <div class="period-bar-fill" style="width:{{ $pct }}%;background:{{ $period->academic_period === 'exam' ? 'var(--danger)' : ($period->academic_period === 'test' ? 'var(--amber)' : 'var(--teal)') }};"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">No period data available yet.</div>
            @endif
        </div>
    </div>


    {{-- STRESS BY FACULTY / DEPARTMENT / LEVEL --}}
    <div class="three-col">

        {{-- Stress by Faculty --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
                </div>
                <div>
                    <div class="card-title">By Faculty</div>
                    <div class="card-subtitle">Stress across faculties</div>
                </div>
            </div>
            <div class="card-body">
                @if($stressByFaculty->count() > 0)
                @php $maxFaculty = $stressByFaculty->max('total') ?: 1; @endphp
                <div class="bar-chart">
                    @foreach($stressByFaculty as $faculty => $data)
                    @php $pct = round($data['total'] / $maxFaculty * 100); @endphp
                    <div class="bar-row">
                        <span class="bar-label" title="{{ $faculty }}">{{ Str::limit($faculty, 12) }}</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:{{ $pct }}%;background:linear-gradient(90deg,var(--teal),var(--teal3));"></div>
                        </div>
                        <span class="bar-value">{{ $data['total'] }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">No faculty data yet.</div>
                @endif
            </div>
        </div>

        {{-- Stress by Department --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                </div>
                <div>
                    <div class="card-title">By Department</div>
                    <div class="card-subtitle">Stress across departments</div>
                </div>
            </div>
            <div class="card-body">
                @if($stressByDepartment->count() > 0)
                @php $maxDept = $stressByDepartment->max('total') ?: 1; @endphp
                <div class="bar-chart">
                    @foreach($stressByDepartment as $dept => $data)
                    @php $pct = round($data['total'] / $maxDept * 100); @endphp
                    <div class="bar-row">
                        <span class="bar-label" title="{{ $dept }}">{{ Str::limit($dept, 12) }}</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:{{ $pct }}%;background:linear-gradient(90deg,#7b4ea0,#a06cc7);"></div>
                        </div>
                        <span class="bar-value">{{ $data['total'] }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">No department data yet.</div>
                @endif
            </div>
        </div>

        {{-- Stress by Level --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
                </div>
                <div>
                    <div class="card-title">By Academic Level</div>
                    <div class="card-subtitle">Which year groups are affected?</div>
                </div>
            </div>
            <div class="card-body">
                @if($stressByLevel->count() > 0)
                @php $maxLevel = $stressByLevel->max('total') ?: 1; @endphp
                <div class="bar-chart">
                    @foreach($stressByLevel->sortKeys() as $level => $data)
                    @php $pct = round($data['total'] / $maxLevel * 100); @endphp
                    <div class="bar-row">
                        <span class="bar-label">{{ $level }} Level</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:{{ $pct }}%;background:linear-gradient(90deg,var(--amber),#f5c158);"></div>
                        </div>
                        <span class="bar-value">{{ $data['total'] }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">No level data yet.</div>
                @endif
            </div>
        </div>

    </div>

    {{-- FACULTY DETAIL TABLE --}}
    <div class="card" style="margin-bottom:1.25rem;">
        <div class="card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
            <div>
                <div class="card-title">Faculty Stress Report</div>
                <div class="card-subtitle">Aggregated data per faculty — for policy decisions</div>
            </div>
        </div>
        <div class="data-table-wrap" style="overflow-x:auto;">
            @if($stressByFaculty->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Faculty</th>
                        <th>Students</th>
                        <th>High Risk Count</th>
                        <th>High Risk %</th>
                        <th>Avg Score</th>
                        <th>Risk Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stressByFaculty as $faculty => $data)
                    @php
                        $highPctFaculty = $data['total'] > 0 ? round($data['high'] / $data['total'] * 100) : 0;
                        $riskClass = $highPctFaculty >= 40 ? 'ri-high' : ($highPctFaculty >= 20 ? 'ri-moderate' : 'ri-low');
                        $riskLabel = $highPctFaculty >= 40 ? 'High Concern' : ($highPctFaculty >= 20 ? 'Monitor' : 'Stable');
                    @endphp
                    <tr>
                        <td data-label="#" style="color:var(--muted);font-size:12px;">{{ $loop->iteration }}</td>
                        <td data-label="Faculty" style="font-weight:500;">{{ $faculty }}</td>
                        <td data-label="Students">{{ $data['total'] }}</td>
                        <td data-label="High Risk Count">{{ $data['high'] }}</td>
                        <td data-label="High Risk %">
                            <div style="display:flex;align-items:center;gap:8px;width:130px;">
                                <div style="flex:1;background:#e8ecf1;border-radius:4px;height:6px;overflow:hidden;max-width:80px;">
                                    <div style="height:100%;border-radius:4px;background:{{ $highPctFaculty >= 40 ? 'var(--danger)' : ($highPctFaculty >= 20 ? 'var(--amber)' : 'var(--green)') }};width:{{ $highPctFaculty }}%;"></div>
                                </div>
                                <span style="font-size:12px;">{{ $highPctFaculty }}%</span>
                            </div>
                        </td>
                        <td data-label="Avg Score"><strong>{{ $data['avg'] ?: '—' }}</strong><span style="color:var(--muted);font-size:11px;">/50</span></td>
                        <td data-label="Risk Level"><span class="risk-indicator {{ $riskClass }}">{{ $riskLabel }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">No faculty data available yet.</div>
            @endif
        </div>
    </div>

    {{-- STRATEGIC RECOMMENDATIONS --}}
    <div class="card">
        <div class="card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <div>
                <div class="card-title">Strategic Recommendations</div>
                <div class="card-subtitle">Data-driven insights for institutional policy</div>
            </div>
        </div>
        <div class="card-body">
            <div class="policy-grid">
                <div class="policy-item">
                    <div class="policy-icon">🎯</div>
                    <div class="policy-title">Workload Management</div>
                    <div class="policy-desc">Review assignment deadlines and exam schedules to reduce clustering of high-stress periods. Distribute academic workload more evenly across the semester.</div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">🧑‍⚕️</div>
                    <div class="policy-title">Counselling Resources</div>
                    <div class="policy-desc">Ensure counsellor-to-student ratios are adequate during peak stress periods (exam and test periods). Consider expanding the wellness team if high-risk rates exceed 30%.</div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">📢</div>
                    <div class="policy-title">Awareness Campaigns</div>
                    <div class="policy-desc">Run stress awareness and mental health programmes at the start of each semester. Target faculties with consistently high stress scores for focused interventions.</div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">📈</div>
                    <div class="policy-title">Continuous Monitoring</div>
                    <div class="policy-desc">Track stress trends monthly and compare across academic years. Use this dashboard to measure the impact of policy changes on student wellbeing over time.</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

</body>
</html>