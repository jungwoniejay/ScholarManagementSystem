@php
    $page = \App\Models\LandingPage::firstOrCreate(['id' => 1]);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - {{ $page->hero_title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:    #1E3A8A;
            --primary-dark: #1e3480;
            --secondary:  #3B82F6;
            --accent:     #F59E0B;
            --success:    #22C55E;
            --error:      #EF4444;
            --teal:       #14B8A6;
            --bg:         #F3F4F6;
            --white:      #FFFFFF;
            --text:       #1F2937;
            --text-muted: #6B7280;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* NAV */
        nav {
            background: var(--primary);
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 12px rgba(30,58,138,.25);
        }
        .nav-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
        }
        .logo { display:flex; align-items:center; gap:.75rem; text-decoration:none; }
        .logo-icon {
            width:40px; height:40px;
            background: linear-gradient(135deg, var(--accent), #d97706);
            border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            box-shadow: 0 4px 12px rgba(245,158,11,.4);
        }
        .logo-text { font-size:1.35rem; font-weight:800; color:var(--white); letter-spacing:-.3px; }
        .nav-links { display:flex; gap:.75rem; align-items:center; }
        .btn { padding:.6rem 1.4rem; border-radius:8px; font-weight:600; font-size:.9rem; cursor:pointer; text-decoration:none; transition:all .2s; border:none; display:inline-block; }
        .btn-ghost { background:rgba(255,255,255,.1); color:var(--white); border:1.5px solid rgba(255,255,255,.25); }
        .btn-ghost:hover { background:rgba(255,255,255,.2); border-color:rgba(255,255,255,.5); }
        .btn-accent { background:var(--accent); color:var(--primary); box-shadow:0 4px 12px rgba(245,158,11,.35); }
        .btn-accent:hover { background:#d97706; transform:translateY(-1px); box-shadow:0 6px 16px rgba(245,158,11,.45); }

        /* Page Content */
        .page-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1rem;
            color: var(--text-muted);
        }

        .content-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
        }

        .content-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 2rem 0 1rem;
        }

        .content-card h2:first-child {
            margin-top: 0;
        }

        .content-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
            margin: 1.5rem 0 0.75rem;
        }

        .content-card p,
        .content-card ul,
        .content-card ol {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .content-card ul,
        .content-card ol {
            padding-left: 1.5rem;
        }

        .content-card li {
            margin-bottom: 0.5rem;
        }

        .content-card a {
            color: var(--secondary);
            text-decoration: underline;
        }

        .content-card a:hover {
            color: var(--primary);
        }

        .last-updated {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Footer */
        footer {
            background: var(--primary);
            color: var(--white);
            padding: 3.5rem 2rem 1.5rem;
            margin-top: 4rem;
        }
        .footer-inner { max-width: 1280px; margin: 0 auto; }
        .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr; gap:3rem; margin-bottom:2.5rem; }
        .footer-brand h3 { font-size:1.3rem; font-weight:800; margin-bottom:.75rem; color:var(--accent); }
        .footer-brand p  { color:rgba(255,255,255,.65); font-size:.9rem; line-height:1.7; margin-bottom:1.25rem; }
        .social-links { display:flex; gap:.75rem; flex-wrap:wrap; }
        .social-link {
            padding:.4rem .9rem; border-radius:6px; font-size:.8rem; font-weight:600;
            background:rgba(255,255,255,.1); color:rgba(255,255,255,.8);
            text-decoration:none; transition:all .2s; border:1px solid rgba(255,255,255,.15);
        }
        .social-link:hover { background:var(--accent); color:var(--primary); border-color:var(--accent); }
        .footer-col h4 { font-size:1rem; font-weight:700; margin-bottom:1rem; color:var(--white); }
        .footer-col ul { list-style:none; }
        .footer-col ul li { margin-bottom:.6rem; }
        .footer-col ul li a { color:rgba(255,255,255,.6); text-decoration:none; font-size:.9rem; transition:color .2s; }
        .footer-col ul li a:hover { color:var(--accent); }
        .footer-bottom {
            border-top:1px solid rgba(255,255,255,.1); padding-top:1.25rem;
            text-align:center; color:rgba(255,255,255,.45); font-size:.85rem;
        }

        /* Responsive */
        @media(max-width:768px) {
            .page-container { padding: 2rem 1rem; }
            .page-header h1 { font-size: 1.75rem; }
            .content-card { padding: 1.5rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body>

    {{-- NAV --}}
    <nav>
        <div class="nav-inner">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z"/>
                        <path d="M2 17L12 22L22 17"/>
                        <path d="M2 12L12 17L22 12"/>
                    </svg>
                </div>
                <span class="logo-text">ScholarHub</span>
            </a>
            <div class="nav-links">
                @if(Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-accent">Dashboard</a>
                    @else
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-accent">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <div class="page-container">
        <div class="page-header">
            <h1>{{ $pageTitle }}</h1>
            <p>Last updated: {{ $settings->updated_at->format('F j, Y') }}</p>
        </div>

        <div class="content-card">
            @if($settings->terms_content)
                {!! nl2br(e($settings->terms_content)) !!}
            @else
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing and using ScholarHub, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to these terms, please do not use our service.</p>

                <h2>2. Description of Service</h2>
                <p>ScholarHub is a scholarship management platform that connects students with scholarship opportunities. Our service includes:</p>
                <ul>
                    <li>Scholarship search and discovery</li>
                    <li>Application management and tracking</li>
                    <li>Document submission and verification</li>
                    <li>Communication with scholarship providers</li>
                    <li>Progress tracking and notifications</li>
                </ul>

                <h2>3. User Accounts</h2>
                <p>To use certain features of ScholarHub, you must create an account. You agree to:</p>
                <ul>
                    <li>Provide accurate, current, and complete information during registration</li>
                    <li>Maintain and promptly update your account information</li>
                    <li>Keep your password secure and confidential</li>
                    <li>Notify us immediately of any unauthorized use of your account</li>
                    <li>Be responsible for all activities that occur under your account</li>
                </ul>

                <h2>4. User Conduct</h2>
                <p>You agree not to:</p>
                <ul>
                    <li>Use the service for any unlawful purpose or to violate any laws</li>
                    <li>Submit false, misleading, or inaccurate information in scholarship applications</li>
                    <li>Impersonate any person or entity or falsely state your affiliations</li>
                    <li>Use the service to transmit spam, malware, or other harmful code</li>
                    <li>Attempt to gain unauthorized access to any part of the service</li>
                    <li>Use automated systems (bots, scrapers) to access the service</li>
                    <li>Interfere with or disrupt the service or servers</li>
                </ul>

                <h2>5. Scholarship Applications</h2>
                <p>When using ScholarHub to apply for scholarships:</p>
                <ul>
                    <li>You are responsible for the accuracy and completeness of your applications</li>
                    <li>ScholarHub does not guarantee scholarship awards</li>
                    <li>Scholarship providers make final decisions on all applications</li>
                    <li>You must meet all eligibility requirements for each scholarship</li>
                    <li>Application deadlines are set by scholarship providers and are strictly enforced</li>
                </ul>

                <h2>6. Content and Intellectual Property</h2>
                <p>You retain ownership of content you submit. By submitting content, you grant ScholarHub a non-exclusive, worldwide, royalty-free license to use, display, and distribute your content in connection with the service. ScholarHub and its licensors retain all rights to the platform, including trademarks, logos, and software.</p>

                <h2>7. Privacy</h2>
                <p>Your use of ScholarHub is also governed by our <a href="/privacy-policy">Privacy Policy</a>, which explains how we collect, use, and protect your personal information.</p>

                <h2>8. Disclaimers</h2>
                <p>ScholarHub is provided "as is" and "as available" without warranties of any kind, either express or implied. We do not warrant that:</p>
                <ul>
                    <li>The service will be uninterrupted, secure, or error-free</li>
                    <li>Defects will be corrected</li>
                    <li>You will successfully receive scholarships</li>
                    <li>The service will meet your specific requirements</li>
                </ul>

                <h2>9. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, ScholarHub shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses.</p>

                <h2>10. Indemnification</h2>
                <p>You agree to indemnify and hold harmless ScholarHub, its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including attorneys' fees) arising from your use of the service or violation of these terms.</p>

                <h2>11. Termination</h2>
                <p>We may terminate or suspend your account immediately, without prior notice, for any reason, including breach of these terms. Upon termination, your right to use the service will cease immediately.</p>

                <h2>12. Changes to Terms</h2>
                <p>We reserve the right to modify these terms at any time. We will notify users of any material changes by posting the new terms on this page and updating the "Last Updated" date. Your continued use of the service after any changes constitutes acceptance of the new terms.</p>

                <h2>13. Governing Law</h2>
                <p>These terms shall be governed by and construed in accordance with the laws of the jurisdiction in which ScholarHub operates, without regard to its conflict of law provisions.</p>

                <h2>14. Contact Information</h2>
                <p>For questions about these Terms and Conditions, please contact us at:</p>
                <p>Email: legal@scholarhub.com<br>
                Address: 123 Education Street, Academic City, AC 12345</p>

                <div class="last-updated">
                    These terms and conditions are effective as of {{ $settings->updated_at->format('F j, Y') }}.
                </div>
            @endif
        </div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>{{ $page->footer_site_name }}</h3>
                    <p>{{ $page->footer_tagline }}</p>
                    <div class="social-links">
                        @if($page->footer_facebook !== '#')<a href="{{ $page->footer_facebook }}" class="social-link" target="_blank">Facebook</a>@endif
                        @if($page->footer_twitter  !== '#')<a href="{{ $page->footer_twitter  }}" class="social-link" target="_blank">Twitter</a>@endif
                        @if($page->footer_linkedin  !== '#')<a href="{{ $page->footer_linkedin  }}" class="social-link" target="_blank">LinkedIn</a>@endif
                        @if($page->footer_instagram !== '#')<a href="{{ $page->footer_instagram }}" class="social-link" target="_blank">Instagram</a>@endif
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="/#how-it-works">How It Works</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="{{ $settings->privacy_url ?? '/privacy-policy' }}">Privacy Policy</a></li>
                        <li><a href="{{ $settings->terms_url ?? '/terms-and-conditions' }}">Terms and Conditions</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">{{ $page->footer_copyright }}</div>
        </div>
    </footer>

</body>
</html>