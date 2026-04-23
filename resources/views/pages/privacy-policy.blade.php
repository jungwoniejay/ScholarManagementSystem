@php $page = \App\Models\LandingPage::firstOrCreate(['id' => 1]); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy — ScholarHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --midnight: #060D1F; --navy: #0B1735; --navy2: #0F2050;
            --gold: #E8B84B; --gold-bright: #FFD060;
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }
        body { font-family: var(--font-body); background: var(--midnight); color: #fff; overflow-x: hidden; line-height: 1.7; }

        /* NAV */
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 1.25rem 5vw; display: flex; justify-content: space-between; align-items: center; background: rgba(6,13,31,0.95); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(232,184,75,0.12); }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .logo-mark { width: 38px; height: 38px; background: linear-gradient(135deg, var(--gold), #C8830A); border-radius: 10px; display: grid; place-items: center; }
        .logo-text { font-family: var(--font-display); font-size: 1.4rem; font-weight: 600; color: #fff; }
        .logo-text span { color: var(--gold); }
        .nav-cta { display: flex; gap: 0.75rem; }
        .btn-ghost { background: none; border: 1px solid rgba(232,184,75,0.4); color: var(--gold); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
        .btn-ghost:hover { background: rgba(232,184,75,0.1); }
        .btn-solid { background: linear-gradient(135deg, var(--gold-bright), var(--gold)); color: var(--midnight); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 700; text-decoration: none; }

        /* HERO */
        .page-hero { padding: 8rem 5vw 4rem; background: radial-gradient(ellipse 80% 60% at 50% 0%, #122356 0%, var(--midnight) 70%); position: relative; overflow: hidden; text-align: center; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(232,184,75,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(232,184,75,0.03) 1px, transparent 1px); background-size: 60px 60px; }
        .eyebrow { position: relative; display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.25); border-radius: 100px; padding: 0.35rem 1rem; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.25rem; }
        .page-hero h1 { position: relative; font-family: var(--font-display); font-size: clamp(2.2rem, 4vw, 3.8rem); font-weight: 300; margin-bottom: 0.75rem; }
        .page-hero h1 em { font-style: italic; background: linear-gradient(135deg, var(--gold-bright), var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .page-hero p { position: relative; color: rgba(255,255,255,0.5); font-size: 0.95rem; }

        /* LAYOUT */
        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 4rem 5vw 6rem; display: grid; grid-template-columns: 220px 1fr; gap: 3rem; align-items: start; }

        /* SIDEBAR TOC */
        .toc { position: sticky; top: 90px; }
        .toc-title { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.3); margin-bottom: 1rem; }
        .toc a { display: block; font-size: 0.82rem; color: rgba(255,255,255,0.45); text-decoration: none; padding: 0.4rem 0.75rem; border-left: 2px solid rgba(255,255,255,0.08); margin-bottom: 0.2rem; transition: color 0.2s, border-color 0.2s; }
        .toc a:hover { color: var(--gold); border-left-color: var(--gold); }

        /* CONTENT */
        .content section { margin-bottom: 2.5rem; padding-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .content section:last-child { border-bottom: none; }
        .sec-num { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.5rem; }
        .content h2 { font-family: var(--font-display); font-size: 1.6rem; font-weight: 600; color: #fff; margin-bottom: 1rem; }
        .content p { font-size: 0.95rem; color: rgba(255,255,255,0.6); line-height: 1.85; font-weight: 300; margin-bottom: 0.85rem; }
        .content ul { list-style: none; margin: 0.5rem 0 0.85rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .content ul li { display: flex; align-items: flex-start; gap: 0.6rem; font-size: 0.92rem; color: rgba(255,255,255,0.6); font-weight: 300; line-height: 1.7; }
        .content ul li::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: 0.55rem; }
        .content strong { color: rgba(255,255,255,0.85); font-weight: 600; }
        .content a { color: var(--gold); text-decoration: none; }
        .content a:hover { text-decoration: underline; }

        .last-updated { margin-top: 2rem; padding: 1rem 1.25rem; background: rgba(232,184,75,0.06); border: 1px solid rgba(232,184,75,0.15); border-radius: 10px; font-size: 0.85rem; color: rgba(255,255,255,0.4); }

        /* FOOTER */
        footer { background: #040810; padding: 3rem 5vw 1.5rem; border-top: 1px solid rgba(232,184,75,0.1); }
        .footer-inner { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-links { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .footer-links a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold); }
        .footer-copy { color: rgba(255,255,255,0.25); font-size: 0.82rem; }

        @media (max-width: 768px) {
            .page-wrap { grid-template-columns: 1fr; }
            .toc { display: none; }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">
        <div class="logo-mark">
            <svg width="18" height="18" fill="none" stroke="#060D1F" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <span class="logo-text">Scholar<span>Hub</span></span>
    </a>
    <div class="nav-cta">
        <a href="/login" class="btn-ghost">Log In</a>
        <a href="/register" class="btn-solid">Get Started</a>
    </div>
</nav>

<div class="page-hero">
    <div class="eyebrow">✦ Legal</div>
    <h1>Privacy <em>Policy</em></h1>
    <p>Last updated: {{ $settings->updated_at->format('F j, Y') }}</p>
</div>

<div class="page-wrap">

    <!-- TOC -->
    <aside class="toc">
        <div class="toc-title">On this page</div>
        <a href="#s1">Introduction</a>
        <a href="#s2">Information We Collect</a>
        <a href="#s3">How We Use It</a>
        <a href="#s4">Information Sharing</a>
        <a href="#s5">Data Security</a>
        <a href="#s6">Your Rights</a>
        <a href="#s7">Cookies</a>
        <a href="#s8">Children's Privacy</a>
        <a href="#s9">Policy Changes</a>
        <a href="#s10">Contact Us</a>
    </aside>

    <!-- CONTENT -->
    <div class="content">
        @if($settings->privacy_content)
            {!! nl2br(e($settings->privacy_content)) !!}
        @else

        <section id="s1">
            <div class="sec-num">01</div>
            <h2>Introduction</h2>
            <p>Welcome to ScholarHub. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our scholarship management services.</p>
            <p>Please read this policy carefully. If you disagree with its terms, please discontinue use of our platform.</p>
        </section>

        <section id="s2">
            <div class="sec-num">02</div>
            <h2>Information We Collect</h2>
            <p>We collect information that you provide directly to us, including:</p>
            <ul>
                <li><strong>Personal Information:</strong> Name, email address, phone number, and educational background when you create an account.</li>
                <li><strong>Academic Information:</strong> Transcripts, test scores, essays, and other documents related to scholarship applications.</li>
                <li><strong>Financial Information:</strong> Payment information when processing donations or application fees.</li>
                <li><strong>Usage Data:</strong> Information about how you interact with our platform, including pages visited and features used.</li>
            </ul>
        </section>

        <section id="s3">
            <div class="sec-num">03</div>
            <h2>How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Provide, maintain, and improve our scholarship management services</li>
                <li>Process scholarship applications and match students with appropriate opportunities</li>
                <li>Send notifications about application status, deadlines, and new opportunities</li>
                <li>Respond to your comments, questions, and requests</li>
                <li>Monitor and analyze trends and usage in connection with our services</li>
                <li>Comply with legal obligations and protect our rights</li>
            </ul>
        </section>

        <section id="s4">
            <div class="sec-num">04</div>
            <h2>Information Sharing</h2>
            <p>We may share your information with:</p>
            <ul>
                <li><strong>Scholarship Providers:</strong> When you apply, your application is shared with the provider for review.</li>
                <li><strong>Service Providers:</strong> Third-party vendors who perform services on our behalf, such as payment processing and data storage.</li>
                <li><strong>Educational Institutions:</strong> When required for scholarship verification or award disbursement.</li>
                <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety.</li>
            </ul>
        </section>

        <section id="s5">
            <div class="sec-num">05</div>
            <h2>Data Security</h2>
            <p>We implement appropriate technical and organizational security measures to protect your personal information. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>
        </section>

        <section id="s6">
            <div class="sec-num">06</div>
            <h2>Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access the personal information we hold about you</li>
                <li>Request correction of inaccurate or incomplete information</li>
                <li>Request deletion of your personal information, subject to legal obligations</li>
                <li>Opt-out of marketing communications</li>
                <li>Data portability — receive a copy of your data in a structured format</li>
            </ul>
        </section>

        <section id="s7">
            <div class="sec-num">07</div>
            <h2>Cookies and Tracking</h2>
            <p>We use cookies and similar tracking technologies to collect information about your browsing activities. You can control cookies through your browser settings.</p>
        </section>

        <section id="s8">
            <div class="sec-num">08</div>
            <h2>Children's Privacy</h2>
            <p>Our services are not directed to individuals under 13 years of age. For users between 13–18 years old, we require parental consent for account creation and data collection.</p>
        </section>

        <section id="s9">
            <div class="sec-num">09</div>
            <h2>Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date.</p>
        </section>

        <section id="s10">
            <div class="sec-num">10</div>
            <h2>Contact Us</h2>
            <p>If you have questions about this Privacy Policy, please contact us:</p>
            <ul>
                <li>Email: <a href="mailto:privacy@scholarhub.com">privacy@scholarhub.com</a></li>
                <li>Address: 123 Education Street, Academic City, Philippines 1234</li>
                <li>Phone: +63 912 345 6789</li>
            </ul>
            <div class="last-updated">This privacy policy is effective as of {{ $settings->updated_at->format('F j, Y') }}.</div>
        </section>

        @endif
    </div>
</div>

<footer>
    <div class="footer-inner">
        <span class="footer-copy">© {{ date('Y') }} ScholarHub. All rights reserved.</span>
        <div class="footer-links">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            <a href="/privacy-policy">Privacy Policy</a>
            <a href="/terms-and-conditions">Terms &amp; Conditions</a>
        </div>
    </div>
</footer>

</body>
</html>
