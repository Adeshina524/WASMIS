<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Privacy Policy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:#0d1f3c; --teal:#1a7f74; --teal2:#15928a; --teal3:#25b8a8;
            --teal-lt:#e6f5f3; --teal-md:#9fd8d2; --sand:#f5f2ed;
            --white:#ffffff; --text:#1a2236; --muted:#5c6b82;
            --border:#dde3ea; --amber:#e8a027; --amber-lt:#fef7e9;
        }
        html, body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--text); }

        /* NAVBAR */
        .navbar { background: var(--navy); height: 60px; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .nav-brand { display: flex; align-items: center; gap: 9px; text-decoration: none; }
        .nav-logo  { width: 34px; height: 34px; background: linear-gradient(135deg, var(--teal), var(--teal3)); border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .nav-logo svg { width: 18px; height: 18px; fill: #fff; }
        .nav-title { color: #fff; font-size: 15px; font-weight: 600; }
        .nav-sub   { color: #7a96b0; font-size: 9.5px; text-transform: uppercase; letter-spacing: .1em; }
        .nav-back  { color: #8fa3bf; font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color .18s; }
        .nav-back:hover { color: #fff; }
        .nav-back svg { width: 14px; height: 14px; fill: currentColor; }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 55%, #1a5a54 100%);
            padding: 3rem 2rem 2.5rem; text-align: center;
            position: relative; overflow: hidden;
        }
        .hero::before { content: ''; position: absolute; top: -60px; right: -80px; width: 280px; height: 280px; border-radius: 50%; background: rgba(26,127,116,.13); pointer-events: none; }
        .hero-inner { position: relative; z-index: 2; }
        .hero-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(26,127,116,.22); border: 1px solid rgba(159,216,210,.28); color: var(--teal-md); font-size: 11px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; padding: 5px 14px; border-radius: 20px; margin-bottom: 1rem; }
        .hero h1 { font-family: 'DM Serif Display', serif; font-size: clamp(1.6rem, 4vw, 2.2rem); color: #fff; margin-bottom: .6rem; }
        .hero p  { color: #8fa3bf; font-size: 13.5px; max-width: 480px; margin: 0 auto; line-height: 1.7; }
        .hero-date { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1); color: #8fa3bf; font-size: 12px; padding: 5px 14px; border-radius: 20px; margin-top: .85rem; }

        /* COMMITMENT STRIP */
        .commitment-strip {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 2rem;
        }
        .commitment-inner {
            max-width: 820px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        .commit-item { display: flex; align-items: center; gap: 10px; }
        .commit-icon { width: 34px; height: 34px; background: var(--teal-lt); border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .commit-icon svg { width: 16px; height: 16px; fill: var(--teal); }
        .commit-text { font-size: 12.5px; font-weight: 500; color: var(--text); }
        .commit-sub  { font-size: 11px; color: var(--muted); }

        /* MAIN */
        .main { max-width: 820px; margin: 0 auto; padding: 3rem 1.5rem 5rem; }

        /* TOC */
        .toc { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 1.4rem 1.6rem; margin-bottom: 2.5rem; box-shadow: 0 2px 12px rgba(13,31,60,.05); }
        .toc-title { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); margin-bottom: .85rem; }
        .toc-list  { list-style: none; display: flex; flex-direction: column; gap: .35rem; }
        .toc-list a { font-size: 13.5px; color: var(--teal); text-decoration: none; display: flex; align-items: center; gap: 7px; transition: opacity .18s; }
        .toc-list a:hover { opacity: .75; }
        .toc-list a::before { content: ''; width: 4px; height: 4px; border-radius: 50%; background: var(--teal); flex-shrink: 0; }

        /* SECTIONS */
        .section { margin-bottom: 2.5rem; scroll-margin-top: 80px; }
        .section-num { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 8px; background: var(--teal-lt); color: var(--teal); font-size: 12px; font-weight: 700; margin-bottom: .75rem; }
        .section h2 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--navy); margin-bottom: .75rem; }
        .section p  { font-size: 14px; color: var(--muted); line-height: 1.8; margin-bottom: .85rem; }
        .section p:last-child { margin-bottom: 0; }
        .section ul { list-style: none; display: flex; flex-direction: column; gap: .5rem; margin-bottom: .85rem; }
        .section ul li { font-size: 14px; color: var(--muted); line-height: 1.7; display: flex; align-items: flex-start; gap: 9px; }
        .section ul li::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--teal); flex-shrink: 0; margin-top: 7px; }

        /* HIGHLIGHT */
        .highlight { background: var(--teal-lt); border: 1px solid #c0e0db; border-radius: 12px; padding: 1rem 1.25rem; font-size: 13.5px; color: var(--teal2); line-height: 1.7; margin-bottom: 1rem; }
        .highlight strong { font-weight: 600; }

        /* WARNING */
        .warning { background: var(--amber-lt); border: 1px solid #f0c870; border-radius: 12px; padding: 1rem 1.25rem; font-size: 13.5px; color: #8a6000; line-height: 1.7; margin-bottom: 1rem; display: flex; gap: 10px; }
        .warning svg { width: 18px; height: 18px; fill: var(--amber); flex-shrink: 0; margin-top: 1px; }

        /* DATA TABLE */
        .data-table-wrap { overflow-x: auto; margin-bottom: 1rem; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        .data-table th { background: var(--teal-lt); color: var(--teal); font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; padding: .7rem 1rem; text-align: left; }
        .data-table td { padding: .75rem 1rem; border-bottom: 1px solid var(--border); color: var(--muted); line-height: 1.6; vertical-align: top; }
        .data-table tr:last-child td { border-bottom: none; }

        /* DIVIDER */
        .divider { height: 1px; background: var(--border); margin-bottom: 2.5rem; }

        /* CONTACT */
        .contact-box { background: linear-gradient(135deg, var(--navy), #1a5a54); border-radius: 18px; padding: 2rem; text-align: center; color: #fff; }
        .contact-box h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; margin-bottom: .5rem; }
        .contact-box p  { font-size: 13.5px; color: #8fa3bf; margin-bottom: 1rem; line-height: 1.6; }
        .contact-btn { display: inline-flex; align-items: center; gap: 7px; background: var(--teal); color: #fff; text-decoration: none; padding: 10px 22px; border-radius: 9px; font-size: 13.5px; font-weight: 500; transition: background .18s; }
        .contact-btn:hover { background: var(--teal2); }
        .contact-btn svg { width: 14px; height: 14px; fill: #fff; }

        /* FOOTER */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }

        @media (max-width: 640px) { .commitment-inner { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 400px) { .commitment-inner { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-logo">
            <svg viewBox="0 0 24 24"><path d="M13 3C9.23 3 6.19 5.95 6.01 9.67L4.08 12.19C3.84 12.5 4.08 12.96 4.5 12.96H6V16C6 17.1 6.9 18 8 18H9V21H16V18H17C18.1 18 19 17.1 19 16V9C19 5.69 16.31 3 13 3Z"/></svg>
        </div>
        <div>
            <div class="nav-title">WASMIS</div>
            <div class="nav-sub">Academic Wellness</div>
        </div>
    </a>
    <a href="{{ route('register') }}" class="nav-back">
        <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
        Back to Register
    </a>
</nav>

{{-- HERO --}}
<div class="hero">
    <div class="hero-inner">
        <div class="hero-badge">🔒 Privacy Document</div>
        <h1>Privacy Policy</h1>
        <p>We take your privacy seriously. This policy explains what data we collect, how we use it, and how we protect it.</p>
        <div class="hero-date">Last updated: {{ date('d F Y') }}</div>
    </div>
</div>

{{-- COMMITMENT STRIP --}}
<div class="commitment-strip">
    <div class="commitment-inner">
        <div class="commit-item">
            <div class="commit-icon"><svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg></div>
            <div>
                <div class="commit-text">100% Confidential</div>
                <div class="commit-sub">Your data is secured</div>
            </div>
        </div>
        <div class="commit-item">
            <div class="commit-icon"><svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></div>
            <div>
                <div class="commit-text">Never Sold</div>
                <div class="commit-sub">No third-party sharing</div>
            </div>
        </div>
        <div class="commit-item">
            <div class="commit-icon"><svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2z"/></svg></div>
            <div>
                <div class="commit-text">Access Controlled</div>
                <div class="commit-sub">Role-based access only</div>
            </div>
        </div>
        <div class="commit-item">
            <div class="commit-icon"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
            <div>
                <div class="commit-text">Your Rights</div>
                <div class="commit-sub">You control your data</div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- TABLE OF CONTENTS --}}
    <div class="toc">
        <div class="toc-title">Table of Contents</div>
        <ul class="toc-list">
            <li><a href="#overview">1. Overview</a></li>
            <li><a href="#collected">2. Data We Collect</a></li>
            <li><a href="#how-used">3. How We Use Your Data</a></li>
            <li><a href="#who-sees">4. Who Can See Your Data</a></li>
            <li><a href="#security">5. Data Security</a></li>
            <li><a href="#retention">6. Data Retention</a></li>
            <li><a href="#rights">7. Your Rights</a></li>
            <li><a href="#cookies">8. Cookies & Sessions</a></li>
            <li><a href="#changes">9. Changes to This Policy</a></li>
            <li><a href="#contact">10. Contact Us</a></li>
        </ul>
    </div>

    {{-- SECTION 1 --}}
    <div class="section" id="overview">
        <div class="section-num">1</div>
        <h2>Overview</h2>
        <p>The Web-based Academic Stress Management Information System (WASMIS) is committed to protecting the privacy and confidentiality of all users. This Privacy Policy describes how we collect, use, store, and protect your personal information when you use the platform.</p>
        <div class="highlight">
            <strong>Our core commitment:</strong> Your personal data and stress assessment results are strictly confidential. They are never shared with advertisers, external organisations, or anyone outside of the institution's authorised wellness team.
        </div>
    </div>

    <div class="divider"></div>

    {{-- SECTION 2 --}}
    <div class="section" id="collected">
        <div class="section-num">2</div>
        <h2>Data We Collect</h2>
        <p>We collect the following categories of information when you register and use WASMIS:</p>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Data Collected</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Identity</strong></td>
                        <td>Full name, matric number</td>
                        <td>Account identification and counsellor contact</td>
                    </tr>
                    <tr>
                        <td><strong>Contact</strong></td>
                        <td>Email address, phone number</td>
                        <td>Account access and counsellor communication</td>
                    </tr>
                    <tr>
                        <td><strong>Academic</strong></td>
                        <td>Faculty, department, academic level</td>
                        <td>Institutional trend analysis (anonymised)</td>
                    </tr>
                    <tr>
                        <td><strong>Assessment</strong></td>
                        <td>Questionnaire responses, stress score, stress level, text expression</td>
                        <td>Personalised wellness feedback and support</td>
                    </tr>
                    <tr>
                        <td><strong>Usage</strong></td>
                        <td>Login time, assessment dates, session data</td>
                        <td>Platform security and service improvement</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>We do not collect any financial information, government ID numbers, or any data unrelated to your academic wellness.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 3 --}}
    <div class="section" id="how-used">
        <div class="section-num">3</div>
        <h2>How We Use Your Data</h2>
        <p>Your data is used exclusively for the following purposes:</p>
        <ul>
            <li>To provide you with personalised stress level assessments and recommendations</li>
            <li>To alert authorised counsellors when your stress level is flagged as high risk</li>
            <li>To generate anonymised, aggregated reports for university management and policy decisions</li>
            <li>To maintain your account and ensure platform security</li>
            <li>To track your wellness progress over multiple assessments</li>
            <li>To improve the platform's functionality and assessment accuracy</li>
        </ul>
        <div class="warning">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            <span>Your data is <strong>never used for advertising</strong>, sold to any external party, or shared with any organisation outside the institution.</span>
        </div>
    </div>

    <div class="divider"></div>

    {{-- SECTION 4 --}}
    <div class="section" id="who-sees">
        <div class="section-num">4</div>
        <h2>Who Can See Your Data</h2>
        <p>WASMIS operates on a strict role-based access control system. Here is exactly who can see what:</p>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>What They Can See</th>
                        <th>What They Cannot See</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>You (Student)</strong></td>
                        <td>Your own profile, assessment history, stress results</td>
                        <td>Other students' data</td>
                    </tr>
                    <tr>
                        <td><strong>Counsellor</strong></td>
                        <td>Full details of high-risk students only (name, contact, faculty, expression)</td>
                        <td>Data of non-flagged students</td>
                    </tr>
                    <tr>
                        <td><strong>Administrator</strong></td>
                        <td>Anonymous stress statistics, counts per level, system management</td>
                        <td>Individual student names, contact info, assessment content</td>
                    </tr>
                    <tr>
                        <td><strong>Management</strong></td>
                        <td>Aggregated trends by faculty, department, period — no individual data</td>
                        <td>All individual student information</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="divider"></div>

    {{-- SECTION 5 --}}
    <div class="section" id="security">
        <div class="section-num">5</div>
        <h2>Data Security</h2>
        <p>We implement appropriate technical and organisational measures to protect your personal data against unauthorised access, alteration, disclosure, or destruction:</p>
        <ul>
            <li>All passwords are encrypted using industry-standard bcrypt hashing</li>
            <li>Sessions are stored securely and invalidated on logout</li>
            <li>All data transmission is protected using HTTPS encryption</li>
            <li>Role-based access control prevents unauthorised data access within the platform</li>
            <li>Database access is restricted to authorised system administrators only</li>
            <li>CSRF protection is implemented on all forms to prevent cross-site request forgery</li>
        </ul>
        <p>While we take all reasonable steps to protect your data, no system is completely immune to security risks. We encourage you to use a strong, unique password and to log out after each session.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 6 --}}
    <div class="section" id="retention">
        <div class="section-num">6</div>
        <h2>Data Retention</h2>
        <p>We retain your personal data for as long as your account is active and for the duration of your enrolment at the institution. Specifically:</p>
        <ul>
            <li>Account data is retained for the duration of your student enrolment</li>
            <li>Assessment records are retained for the current academic year plus two additional years</li>
            <li>Upon account deletion, personal identifiers are removed within 30 days</li>
            <li>Anonymised assessment data may be retained indefinitely for research purposes</li>
        </ul>
        <p>You may request deletion of your account and personal data at any time by contacting the system administrator.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 7 --}}
    <div class="section" id="rights">
        <div class="section-num">7</div>
        <h2>Your Rights</h2>
        <p>You have the following rights regarding your personal data:</p>
        <ul>
            <li><strong>Right of Access</strong> — you can request a copy of the personal data we hold about you</li>
            <li><strong>Right to Rectification</strong> — you can request correction of inaccurate personal data</li>
            <li><strong>Right to Erasure</strong> — you can request deletion of your account and personal data</li>
            <li><strong>Right to Restrict Processing</strong> — you can request that we limit how we use your data</li>
            <li><strong>Right to Data Portability</strong> — you can request a copy of your data in a portable format</li>
            <li><strong>Right to Object</strong> — you can object to certain uses of your personal data</li>
        </ul>
        <p>To exercise any of these rights, please contact the WASMIS administrator using the details below. We will respond to all requests within 30 days.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 8 --}}
    <div class="section" id="cookies">
        <div class="section-num">8</div>
        <h2>Cookies & Sessions</h2>
        <p>WASMIS uses cookies and session storage to maintain your login state and provide a seamless user experience. Specifically:</p>
        <ul>
            <li><strong>Session cookies</strong> — used to keep you logged in during your visit</li>
            <li><strong>CSRF tokens</strong> — used to protect form submissions from malicious attacks</li>
            <li><strong>Remember me cookies</strong> — stored only if you choose the "Remember me" option at login</li>
        </ul>
        <p>We do not use advertising cookies, tracking pixels, or any third-party analytics cookies. All cookies used by WASMIS are strictly necessary for the platform to function correctly.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 9 --}}
    <div class="section" id="changes">
        <div class="section-num">9</div>
        <h2>Changes to This Policy</h2>
        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal reasons. The "Last updated" date at the top of this page will be revised whenever changes are made.</p>
        <p>We encourage you to review this policy periodically. Continued use of WASMIS after any changes constitutes your acceptance of the updated policy. Significant changes will be communicated through the platform.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 10 --}}
    <div class="section" id="contact">
        <div class="section-num">10</div>
        <h2>Contact Us</h2>
        <p>If you have any questions, concerns, or requests regarding this Privacy Policy or how we handle your data, please do not hesitate to get in touch with us.</p>
    </div>

    {{-- CONTACT BOX --}}
    <div class="contact-box">
        <h3>Have a privacy concern?</h3>
        <p>We take all privacy concerns seriously. Contact the WASMIS administrator and we will respond within 2 business days.</p>
        <a href="mailto:admin@wasmis.com" class="contact-btn">
            <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            Contact Administrator
        </a>
    </div>

</div>

{{-- FOOTER --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} WASMIS &mdash; Built for <span>student wellbeing</span></p>
</footer>

</body>
</html>