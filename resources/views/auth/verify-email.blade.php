<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Verify Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:#0d1f3c; --teal:#1a7f74; --teal2:#15928a; --teal3:#25b8a8;
            --teal-lt:#e6f5f3; --teal-md:#9fd8d2; --sand:#f5f2ed;
            --white:#ffffff; --text:#1a2236; --muted:#5c6b82;
            --border:#dde3ea; --danger:#c0392b;
        }
        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); }

        .page {
            min-height: 100vh; display: flex;
            align-items: center; justify-content: center;
            padding: 2rem; position: relative; overflow: hidden;
        }
        .page::before {
            content: ''; position: fixed; inset: 0;
            background: linear-gradient(145deg, #071422 0%, var(--navy) 40%, #0f3330 100%);
            z-index: 0;
        }
        .page::after {
            content: ''; position: fixed; top: -80px; right: -80px;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(26,127,116,.2) 0%, transparent 70%);
            z-index: 0; pointer-events: none;
        }
        .orb-bottom {
            position: fixed; bottom: -80px; left: -60px;
            width: 350px; height: 350px; border-radius: 50%;
            background: radial-gradient(circle, rgba(232,160,39,.1) 0%, transparent 70%);
            z-index: 0; pointer-events: none;
        }
        .grid-bg {
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(26,127,116,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(26,127,116,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            z-index: 0; pointer-events: none;
        }

        .box {
            position: relative; z-index: 2;
            background: var(--white); border-radius: 22px;
            width: 100%; max-width: 460px; overflow: hidden;
            box-shadow: 0 24px 60px rgba(0,0,0,.3);
            animation: fadeUp .5s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .box-top {
            background: linear-gradient(135deg, var(--navy), #1a5a54);
            padding: 2rem 2rem 1.75rem; text-align: center;
        }
        .brand {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; text-decoration: none; margin-bottom: 1.5rem;
        }
        .brand-logo {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--teal), var(--teal3));
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
        }
        .brand-logo svg { width: 16px; height: 16px; fill: #fff; }
        .brand-name { font-size: 14px; font-weight: 600; color: #fff; }

        .email-anim {
            width: 70px; height: 70px;
            background: rgba(26,127,116,.2);
            border: 2px solid rgba(159,216,210,.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            animation: pulse 2.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(159,216,210,.4); }
            50%       { box-shadow: 0 0 0 14px rgba(159,216,210,0); }
        }
        .email-anim svg { width: 30px; height: 30px; fill: var(--teal-md); }

        .box-title { font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: #fff; margin-bottom: .4rem; }
        .box-desc  { font-size: 13px; color: #8fa3bf; line-height: 1.7; max-width: 320px; margin: 0 auto; }

        .box-body { padding: 1.75rem 2rem 2rem; }

        /* Status */
        .status-msg {
            background: var(--teal-lt); border: 1px solid #b5ddd9;
            border-radius: 10px; padding: 10px 14px;
            font-size: 13px; color: var(--teal2); margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        .status-msg svg { width: 15px; height: 15px; fill: var(--teal2); flex-shrink: 0; }

        /* Info box */
        .info-box {
            background: var(--sand); border: 1px solid var(--border);
            border-radius: 12px; padding: 1.1rem 1.25rem;
            margin-bottom: 1.5rem;
        }
        .info-box p { font-size: 13.5px; color: var(--muted); line-height: 1.7; }
        .info-box strong { color: var(--text); }

        /* Steps */
        .steps { display: flex; flex-direction: column; gap: .6rem; margin-bottom: 1.5rem; }
        .step-item { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--muted); }
        .step-num {
            width: 22px; height: 22px; border-radius: 50%;
            background: var(--teal-lt); color: var(--teal);
            font-size: 11px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .btn-resend {
            width: 100%; display: flex; align-items: center; justify-content: center; gap: 9px;
            background: linear-gradient(135deg, var(--teal), var(--teal2));
            color: #fff; border: none; padding: 14px; border-radius: 11px;
            font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600;
            cursor: pointer; box-shadow: 0 4px 18px rgba(26,127,116,.28);
            transition: transform .2s, box-shadow .2s; margin-bottom: .85rem;
        }
        .btn-resend:hover { transform: translateY(-1px); box-shadow: 0 7px 24px rgba(26,127,116,.38); }
        .btn-resend svg   { width: 16px; height: 16px; fill: #fff; }

        .btn-logout {
            width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
            background: transparent; color: var(--muted);
            border: 1.5px solid var(--border); padding: 12px; border-radius: 11px;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
            cursor: pointer; transition: all .18s;
        }
        .btn-logout:hover { border-color: var(--danger); color: var(--danger); }
        .btn-logout svg { width: 15px; height: 15px; fill: currentColor; }

        .email-display {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--teal-lt); color: var(--teal);
            font-size: 12.5px; font-weight: 500;
            padding: 4px 12px; border-radius: 20px; margin: .5rem 0;
        }
        .email-display svg { width: 13px; height: 13px; fill: var(--teal); }
    </style>
</head>
<body>

<div class="page">
    <div class="orb-bottom"></div>
    <div class="grid-bg"></div>

    <div class="box">
        <div class="box-top">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-logo">
                    <svg viewBox="0 0 24 24"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3Z"/></svg>
                </div>
                <span class="brand-name">WASMIS</span>
            </a>
            <div class="email-anim">
                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            </div>
            <h2 class="box-title">Verify Your Email</h2>
            <p class="box-desc">Almost there! We sent a verification link to your email address. Please check your inbox.</p>
        </div>

        <div class="box-body">

            @if (session('status') == 'verification-link-sent')
            <div class="status-msg">
                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                A new verification link has been sent to your email address.
            </div>
            @endif

            <div class="info-box">
                <p>A verification email was sent to:<br>
                <span class="email-display">
                    <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    {{ auth()->user()->email }}
                </span><br>
                Click the verification link in the email to activate your account.</p>
            </div>

            <div class="steps">
                <div class="step-item"><div class="step-num">1</div>Open your email inbox</div>
                <div class="step-item"><div class="step-num">2</div>Find the email from WASMIS</div>
                <div class="step-item"><div class="step-num">3</div>Click the "Verify Email" button</div>
                <div class="step-item"><div class="step-num">4</div>You'll be redirected to your dashboard</div>
            </div>

            <form method="POST" action="{{ route('verification.send') }}" style="margin-bottom:.75rem;">
                @csrf
                <button type="submit" class="btn-resend"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;border:none;padding:14px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);margin-bottom:.75rem;">
                    <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#fff;"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;background:transparent;color:#5c6b82;border:1.5px solid #dde3ea;padding:12px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;">
                    <svg viewBox="0 0 24 24" style="width:15px;height:15px;fill:currentColor;"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Log Out &amp; Use Different Account
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>