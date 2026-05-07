<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Reset Password</title>
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
            width: 100%; max-width: 440px; overflow: hidden;
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

        .box-icon {
            width: 56px; height: 56px;
            background: rgba(26,127,116,.25);
            border: 1px solid rgba(159,216,210,.25);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .box-icon svg { width: 26px; height: 26px; fill: var(--teal-md); }

        .box-title { font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: #fff; margin-bottom: .4rem; }
        .box-desc  { font-size: 13px; color: #8fa3bf; line-height: 1.65; }

        .box-body { padding: 1.75rem 2rem 2rem; }

        .field { margin-bottom: 1.1rem; }
        .field label {
            display: block; font-size: 11.5px; font-weight: 600;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: .07em; margin-bottom: 7px;
        }
        .field input {
            width: 100%; padding: 12px 15px;
            border: 1.5px solid #dde3ea; border-radius: 10px;
            font-family: 'DM Sans', sans-serif; font-size: 14px;
            color: #1a2236; background: #f5f2ed; outline: none;
            transition: border-color .18s, background .18s;
        }
        .field input:focus { border-color: var(--teal); background: #fafffe; }
        .field input::placeholder { color: #9aabbc; }

        .pw-wrap { position: relative; }
        .pw-wrap input { padding-right: 44px !important; }
        .pw-eye {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            padding: 2px; display: flex; color: #9aabbc; transition: color .18s;
        }
        .pw-eye:hover { color: var(--teal); }
        .pw-eye svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; }

        .field-error { font-size: 12px; color: var(--danger); margin-top: 5px; display: flex; align-items: center; gap: 5px; }
        .field-error svg { width: 13px; height: 13px; stroke: var(--danger); fill: none; stroke-width: 2; stroke-linecap: round; flex-shrink: 0; }

        /* strength */
        .strength-bar { display: flex; gap: 4px; margin-top: 7px; }
        .strength-seg { height: 3px; flex: 1; border-radius: 3px; background: #e8ecf1; transition: background .3s; }

        .btn-submit {
            width: 100%; display: flex; align-items: center; justify-content: center; gap: 9px;
            background: linear-gradient(135deg, var(--teal), var(--teal2));
            color: #fff; border: none; padding: 14px; border-radius: 11px;
            font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600;
            cursor: pointer; box-shadow: 0 4px 18px rgba(26,127,116,.28);
            transition: transform .2s, box-shadow .2s; margin-top: .5rem;
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 7px 24px rgba(26,127,116,.38); }
        .btn-submit svg   { width: 16px; height: 16px; fill: #fff; }

        .back-link {
            display: flex; align-items: center; justify-content: center;
            gap: 5px; margin-top: 1.1rem;
            font-size: 13px; color: var(--muted); text-decoration: none;
            transition: color .18s;
        }
        .back-link:hover { color: var(--teal); }
        .back-link svg { width: 14px; height: 14px; fill: currentColor; }
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
            <div class="box-icon">
                <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
            </div>
            <h2 class="box-title">Reset Password</h2>
            <p class="box-desc">Create a new strong password for your WASMIS account.</p>
        </div>

        <div class="box-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div class="field">
                    <label for="email">Email Address</label>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email', $request->email) }}"
                        placeholder="student@university.edu"
                        required autofocus
                        style="width:100%;padding:12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                    >
                    @error('email')
                    <p class="field-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="field">
                    <label for="password">New Password</label>
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
                    <div class="strength-bar">
                        <div class="strength-seg" id="seg1"></div>
                        <div class="strength-seg" id="seg2"></div>
                        <div class="strength-seg" id="seg3"></div>
                        <div class="strength-seg" id="seg4"></div>
                    </div>
                    <p style="font-size:11.5px;min-height:16px;margin-top:4px;" id="strengthLabel"></p>
                    @error('password')
                    <p class="field-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="field">
                    <label for="password_confirmation">Confirm New Password</label>
                    <div class="pw-wrap">
                        <input
                            id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Re-enter new password"
                            required autocomplete="new-password"
                            style="width:100%;padding:12px 44px 12px 15px;border:1.5px solid #dde3ea;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#1a2236;background:#f5f2ed;outline:none;"
                        >
                        <button type="button" class="pw-eye" onclick="togglePw('password_confirmation')">
                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                    <p class="field-error">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,#1a7f74,#15928a);color:#fff;border:none;padding:14px;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(26,127,116,.28);">
                    <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#fff;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Reset Password
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link">
                <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                Back to Login
            </a>
        </div>
    </div>
</div>

<script>
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
</script>
</body>
</html>