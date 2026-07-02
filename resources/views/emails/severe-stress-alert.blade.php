<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASMIS Alert</title>
</head>
<body style="margin:0;padding:0;background:#f5f2ed;font-family:'Helvetica Neue',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f2ed;padding:2rem 1rem;">
    <tr>
        <td align="center">
            <table width="560" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(13,31,60,0.08);">

                {{-- HEADER --}}
                <tr>
                    <td style="background:linear-gradient(135deg,#0d1f3c,#1a5a54);background-color:#0d1f3c;padding:2rem 2rem 1.5rem;text-align:center;">
                        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:#9fd8d2;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:6px 14px;border-radius:20px;margin-bottom:1rem;">
                            🚨 Urgent Alert
                        </div>
                        <h1 style="font-size:22px;color:#ffffff;margin:0 0 6px;font-weight:700;">New Severe Stress Case</h1>
                        <p style="font-size:13px;color:#8fa3bf;margin:0;">A student has been flagged at the Severe stress level</p>
                    </td>
                </tr>

                {{-- BODY --}}
                <tr>
                    <td style="padding:2rem;">
                        <p style="font-size:14px;color:#1a2236;line-height:1.7;margin:0 0 1.25rem;">
                            Dear Counsellor,
                        </p>
                        <p style="font-size:14px;color:#1a2236;line-height:1.7;margin:0 0 1.5rem;">
                            A student has just completed a stress assessment on WASMIS and has been classified at the <strong style="color:#c0392b;">Severe</strong> stress level. This requires prompt attention.
                        </p>

                        {{-- STUDENT INFO BOX --}}
                        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fff0f0;border:1px solid #f5c0b8;border-radius:12px;margin-bottom:1.5rem;">
                            <tr>
                                <td style="padding:1.25rem 1.5rem;">
                                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.6px;color:#c0392b;margin:0 0 .85rem;">Case Details</p>

                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="font-size:11px;color:#5c6b82;padding-bottom:4px;width:40%;">Student Name</td>
                                            <td style="font-size:13px;color:#1a2236;font-weight:600;padding-bottom:4px;">{{ $studentName }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px;color:#5c6b82;padding-bottom:4px;">Matric Number</td>
                                            <td style="font-size:13px;color:#1a2236;padding-bottom:4px;">{{ $matricNo ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px;color:#5c6b82;padding-bottom:4px;">Faculty / Dept.</td>
                                            <td style="font-size:13px;color:#1a2236;padding-bottom:4px;">{{ $faculty ?? 'N/A' }} — {{ $department ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px;color:#5c6b82;padding-bottom:4px;">Final Score</td>
                                            <td style="font-size:13px;color:#1a2236;font-weight:700;padding-bottom:4px;">{{ $score }} / 142</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px;color:#5c6b82;">Submitted</td>
                                            <td style="font-size:13px;color:#1a2236;">{{ $submittedAt }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        @if($textInput)
                        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f2ed;border:1px solid #dde3ea;border-radius:12px;margin-bottom:1.5rem;">
                            <tr>
                                <td style="padding:1rem 1.25rem;">
                                    <p style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.6px;color:#5c6b82;margin:0 0 6px;">Student's Expression</p>
                                    <p style="font-size:13px;color:#1a2236;font-style:italic;line-height:1.6;margin:0;">"{{ $textInput }}"</p>
                                </td>
                            </tr>
                        </table>
                        @endif

                        <p style="font-size:13px;color:#5c6b82;line-height:1.7;margin:0 0 1.5rem;">
                            This case is currently <strong>unassigned</strong>. Log in to your counsellor dashboard to view full details and claim this case.
                        </p>

                        {{-- CTA --}}
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <a href="{{ $dashboardUrl }}" style="display:inline-block;background:linear-gradient(135deg,#1a7f74,#15928a);background-color:#1a7f74;color:#ffffff;text-decoration:none;font-size:14px;font-weight:600;padding:13px 32px;border-radius:10px;">
                                        View Case on Dashboard →
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="background:#0d1f3c;padding:1.25rem 2rem;text-align:center;">
                        <p style="font-size:11px;color:#3d5060;margin:0;">
                            &copy; {{ date('Y') }} WASMIS &mdash; This is an automated alert from the Academic Stress Management Information System.
                        </p>
                        <p style="font-size:11px;color:#3d5060;margin:6px 0 0;">
                            This information is strictly confidential. Do not forward outside official counselling channels.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>