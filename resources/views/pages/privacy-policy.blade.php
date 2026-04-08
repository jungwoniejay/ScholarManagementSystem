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
            @if($settings->privacy_content)
                {!! nl2br(e($settings->privacy_content)) !!}
            @else
                <h2>1. Introduction</h2>
                <p>Welcome to ScholarHub. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our scholarship management services.</p>

                <h2>2. Information We Collect</h2>
                <p>We collect information that you provide directly to us, including:</p>
                <ul>
                    <li><strong>Personal Information:</strong> Name, email address, phone number, and educational background when you create an account.</li>
                    <li><strong>Academic Information:</strong> Transcripts, test scores, essays, and other documents related to scholarship applications.</li>
                    <li><strong>Financial Information:</strong> Payment information when processing donations or application fees.</li>
                    <li><strong>Usage Data:</strong> Information about how you interact with our platform, including pages visited and features used.</li>
                </ul>

                <h2>3. How We Use Your Information</h2>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Provide, maintain, and improve our scholarship management services</li>
                    <li>Process scholarship applications and match students with appropriate opportunities</li>
                    <li>Send you notifications about application status, deadlines, and new scholarship opportunities</li>
                    <li>Respond to your comments, questions, and requests</li>
                    <li>Monitor and analyze trends, usage, and activities in connection with our services</li>
                    <li>Comply with legal obligations and protect our rights</li>
                </ul>

                <h2>4. Information Sharing</h2>
                <p>We may share your information with:</p>
                <ul>
                    <li><strong>Scholarship Providers:</strong> When you apply for a scholarship, your application information is shared with the scholarship provider for review.</li>
                    <li><strong>Service Providers:</strong> Third-party vendors who perform services on our behalf, such as payment processing and data storage.</li>
                    <li><strong>Educational Institutions:</strong> When required for scholarship verification or award disbursement.</li>
                    <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety.</li>
                </ul>

                <h2>5. Data Security</h2>
                <p>We implement appropriate technical and organizational security measures to protect your personal information. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>

                <h2>6. Your Rights</h2>
                <p>You have the right to:</p>
                <ul>
                    <li>Access the personal information we hold about you</li>
                    <li>Request correction of inaccurate or incomplete information</li>
                    <li>Request deletion of your personal information, subject to legal obligations</li>
                    <li>Opt-out of marketing communications</li>
                    <li>Data portability - receive a copy of your data in a structured format</li>
                </ul>

                <h2>7. Cookies and Tracking</h2>
                <p>We use cookies and similar tracking technologies to collect information about your browsing activities. You can control cookies through your browser settings. See our Cookie Policy for more details.</p>

                <h2>8. Children's Privacy</h2>
                <p>Our services are not directed to individuals under 13 years of age. For users between 13-18 years old, we require parental consent for account creation and data collection.</p>

                <h2>9. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date.</p>

                <h2>10. Contact Us</h2>
                <p>If you have questions about this Privacy Policy, please contact us at:</p>
                <p>Email: privacy@scholarhub.com<br>
                Address: 123 Education Street, Academic City, AC 12345</p>

                <div class="last-updated">
                    This privacy policy is effective as of {{ $settings->updated_at->format('F j, Y') }}.
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