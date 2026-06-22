<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS – Terms of Service</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:#0d1f3c; --teal:#1a7f74; --teal2:#15928a; --teal3:#25b8a8;
            --teal-lt:#e6f5f3; --teal-md:#9fd8d2; --sand:#f5f2ed;
            --white:#ffffff; --text:#1a2236; --muted:#5c6b82;
            --border:#dde3ea;
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

        /* MAIN */
        .main { max-width: 820px; margin: 0 auto; padding: 3rem 1.5rem 5rem; }

        /* TOC */
        .toc {
            background: #fff; border: 1px solid var(--border); border-radius: 16px;
            padding: 1.4rem 1.6rem; margin-bottom: 2.5rem;
            box-shadow: 0 2px 12px rgba(13,31,60,.05);
        }
        .toc-title { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); margin-bottom: .85rem; }
        .toc-list  { list-style: none; display: flex; flex-direction: column; gap: .35rem; }
        .toc-list a { font-size: 13.5px; color: var(--teal); text-decoration: none; display: flex; align-items: center; gap: 7px; transition: opacity .18s; }
        .toc-list a:hover { opacity: .75; }
        .toc-list a::before { content: ''; width: 4px; height: 4px; border-radius: 50%; background: var(--teal); flex-shrink: 0; }

        /* SECTIONS */
        .section { margin-bottom: 2.5rem; scroll-margin-top: 80px; }
        .section-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--teal-lt); color: var(--teal);
            font-size: 12px; font-weight: 700; margin-bottom: .75rem;
        }
        .section h2 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--navy); margin-bottom: .75rem; }
        .section p  { font-size: 14px; color: var(--muted); line-height: 1.8; margin-bottom: .85rem; }
        .section p:last-child { margin-bottom: 0; }
        .section ul { list-style: none; display: flex; flex-direction: column; gap: .5rem; margin-bottom: .85rem; }
        .section ul li { font-size: 14px; color: var(--muted); line-height: 1.7; display: flex; align-items: flex-start; gap: 9px; }
        .section ul li::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--teal); flex-shrink: 0; margin-top: 7px; }

        /* HIGHLIGHT BOX */
        .highlight {
            background: var(--teal-lt); border: 1px solid #c0e0db;
            border-radius: 12px; padding: 1rem 1.25rem;
            font-size: 13.5px; color: var(--teal2); line-height: 1.7;
            margin-bottom: 1rem;
        }
        .highlight strong { font-weight: 600; }

        /* DIVIDER */
        .divider { height: 1px; background: var(--border); margin-bottom: 2.5rem; }

        /* CONTACT */
        .contact-box {
            background: linear-gradient(135deg, var(--navy), #1a5a54);
            border-radius: 18px; padding: 2rem;
            text-align: center; color: #fff;
        }
        .contact-box h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; margin-bottom: .5rem; }
        .contact-box p  { font-size: 13.5px; color: #8fa3bf; margin-bottom: 1rem; line-height: 1.6; }
        .contact-btn {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal); color: #fff; text-decoration: none;
            padding: 10px 22px; border-radius: 9px; font-size: 13.5px; font-weight: 500;
            transition: background .18s;
        }
        .contact-btn:hover { background: var(--teal2); }
        .contact-btn svg { width: 14px; height: 14px; fill: #fff; }

        /* FOOTER */
        .footer { background: var(--navy); padding: 1.5rem 2rem; text-align: center; }
        .footer p { font-size: 12px; color: #3d5060; }
        .footer span { color: var(--teal-md); }
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
        <div class="hero-badge">📋 Legal Document</div>
        <h1>Terms of Service</h1>
        <p>Please read these terms carefully before using the WASMIS platform. By registering, you agree to be bound by these terms.</p>
        <div class="hero-date">Last updated: {{ date('d F Y') }}</div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- TABLE OF CONTENTS --}}
    <div class="toc">
        <div class="toc-title">Table of Contents</div>
        <ul class="toc-list">
            <li><a href="#acceptance">1. Acceptance of Terms</a></li>
            <li><a href="#eligibility">2. Eligibility</a></li>
            <li><a href="#account">3. Account Responsibilities</a></li>
            <li><a href="#use">4. Acceptable Use</a></li>
            <li><a href="#data">5. Data & Privacy</a></li>
            <li><a href="#confidentiality">6. Confidentiality</a></li>
            <li><a href="#disclaimers">7. Disclaimers</a></li>
            <li><a href="#termination">8. Termination</a></li>
            <li><a href="#changes">9. Changes to Terms</a></li>
            <li><a href="#contact">10. Contact</a></li>
        </ul>
    </div>

    {{-- SECTION 1 --}}
    <div class="section" id="acceptance">
        <div class="section-num">1</div>
        <h2>Acceptance of Terms</h2>
        <p>By accessing or using the Web-based Academic Stress Management Information System (WASMIS), you confirm that you have read, understood, and agree to be bound by these Terms of Service. If you do not agree to these terms, you must not use the platform.</p>
        <div class="highlight">
            <strong>Important:</strong> These terms constitute a legal agreement between you (the user) and WASMIS. Continued use of the platform after any modifications to these terms constitutes acceptance of the updated terms.
        </div>
    </div>

    <div class="divider"></div>

    {{-- SECTION 2 --}}
    <div class="section" id="eligibility">
        <div class="section-num">2</div>
        <h2>Eligibility</h2>
        <p>WASMIS is designed exclusively for use by:</p>
        <ul>
            <li>Currently enrolled students of the institution</li>
            <li>Authorised counsellors and wellness staff</li>
            <li>Designated university administrators</li>
            <li>University management with appropriate access credentials</li>
        </ul>
        <p>You must provide accurate and truthful registration information including your real name, valid student email address, and correct matric number. Registration with false information is a violation of these terms and may result in account termination.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 3 --}}
    <div class="section" id="account">
        <div class="section-num">3</div>
        <h2>Account Responsibilities</h2>
        <p>You are solely responsible for maintaining the confidentiality of your account credentials. You agree to:</p>
        <ul>
            <li>Keep your password secure and not share it with any third party</li>
            <li>Notify the system administrator immediately of any unauthorised use of your account</li>
            <li>Log out of your account after each session, especially on shared devices</li>
            <li>Not allow others to access the platform using your credentials</li>
            <li>Take full responsibility for all activities that occur under your account</li>
        </ul>
        <p>WASMIS will not be liable for any loss or damage arising from your failure to comply with these security obligations.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 4 --}}
    <div class="section" id="use">
        <div class="section-num">4</div>
        <h2>Acceptable Use</h2>
        <p>You agree to use WASMIS only for its intended purpose of academic stress assessment and wellness support. You must not:</p>
        <ul>
            <li>Submit false, misleading, or fabricated assessment responses</li>
            <li>Attempt to access data belonging to other users</li>
            <li>Attempt to reverse-engineer, copy, or reproduce any part of the platform</li>
            <li>Use the platform for any unlawful, harmful, or abusive purpose</li>
            <li>Interfere with the platform's security, integrity, or performance</li>
            <li>Share screenshots or data from the platform publicly without authorisation</li>
        </ul>
        <p>Violation of these terms may result in immediate account suspension and referral to the appropriate university disciplinary body.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 5 --}}
    <div class="section" id="data">
        <div class="section-num">5</div>
        <h2>Data & Privacy</h2>
        <p>WASMIS collects and processes personal data to provide its wellness assessment services. The data collected includes your name, email, matric number, faculty, department, academic level, phone number, and stress assessment responses.</p>
        <p>All data is collected, stored, and processed in accordance with our <a href="{{ route('privacy') }}" style="color:var(--teal);text-decoration:none;font-weight:500;">Privacy Policy</a>. By using WASMIS, you consent to the collection and use of your data as described in the Privacy Policy.</p>
        <div class="highlight">
            <strong>Your data is never sold or shared with third parties</strong> outside of the institution. It is used solely to provide you with wellness support and to generate anonymised institutional reports for management purposes.
        </div>
    </div>

    <div class="divider"></div>

    {{-- SECTION 6 --}}
    <div class="section" id="confidentiality">
        <div class="section-num">6</div>
        <h2>Confidentiality</h2>
        <p>WASMIS is designed with strict confidentiality principles:</p>
        <ul>
            <li>Your individual stress assessment results are visible only to you and authorised counsellors</li>
            <li>Administrators and management only see anonymised, aggregated statistical data</li>
            <li>Counsellors may only view your details if your stress level is flagged as high risk</li>
            <li>No individual student data is shared with faculty members, lecturers, or other students</li>
            <li>All counsellors are bound by professional confidentiality obligations</li>
        </ul>
        <p>Information you share through the stress expression field is treated as sensitive personal data and is only accessible to your assigned counsellor when your case is flagged.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 7 --}}
    <div class="section" id="disclaimers">
        <div class="section-num">7</div>
        <h2>Disclaimers</h2>
        <p>WASMIS is an academic wellness support tool and is not a substitute for professional medical or psychological diagnosis or treatment. The stress assessments provided are for informational and support purposes only.</p>
        <ul>
            <li>WASMIS does not provide clinical diagnoses or medical advice</li>
            <li>If you are experiencing a mental health crisis, please seek immediate professional help</li>
            <li>The platform's recommendations are general wellness guidance only</li>
            <li>WASMIS is provided "as is" and we do not guarantee uninterrupted availability</li>
        </ul>
        <p>The institution and WASMIS team shall not be liable for any decisions made based solely on the platform's assessment results without professional consultation.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 8 --}}
    <div class="section" id="termination">
        <div class="section-num">8</div>
        <h2>Termination</h2>
        <p>Your access to WASMIS may be terminated in the following circumstances:</p>
        <ul>
            <li>Violation of any of these Terms of Service</li>
            <li>Graduation or end of enrolment at the institution</li>
            <li>Request by the student or university administration</li>
            <li>Extended inactivity as defined by the platform's data retention policy</li>
        </ul>
        <p>Upon termination, your access to the platform will be revoked. Your data will be retained in accordance with the institution's data retention policy as described in the Privacy Policy.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 9 --}}
    <div class="section" id="changes">
        <div class="section-num">9</div>
        <h2>Changes to Terms</h2>
        <p>WASMIS reserves the right to update or modify these Terms of Service at any time. When changes are made, the "Last updated" date at the top of this page will be revised. We encourage you to review these terms periodically.</p>
        <p>Continued use of the platform after any changes constitutes your acceptance of the revised terms. If you do not agree to the updated terms, you should discontinue use of the platform and contact the administrator to deactivate your account.</p>
    </div>

    <div class="divider"></div>

    {{-- SECTION 10 / CONTACT --}}
    <div class="section" id="contact">
        <div class="section-num">10</div>
        <h2>Contact</h2>
        <p>If you have any questions, concerns, or requests regarding these Terms of Service, please contact the WASMIS administrator through the institution's official channels.</p>
    </div>

    {{-- CONTACT BOX --}}
    <div class="contact-box">
        <h3>Questions about these terms?</h3>
        <p>Our team is here to help. Reach out to the WASMIS administrator for any clarifications about these terms or your data.</p>
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