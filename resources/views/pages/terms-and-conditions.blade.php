@php $page = \App\Models\LandingPage::firstOrCreate(['id' => 1]); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms &amp; Conditions — ScholarHub</title>
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

        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 1.25rem 5vw; display: flex; justify-content: space-between; align-items: center; background: rgba(6,13,31,0.95); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(232,184,75,0.12); }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .logo-mark { width: 38px; height: 38px; background: linear-gradient(135deg, var(--gold), #C8830A); border-radius: 10px; display: grid; place-items: center; }
        .logo-text { font-family: var(--font-display); font-size: 1.4rem; font-weight: 600; color: #fff; }
        .logo-text span { color: var(--gold); }
        .nav-cta { display: flex; gap: 0.75rem; }
        .btn-ghost { background: none; border: 1px solid rgba(232,184,75,0.4); color: var(--gold); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
        .btn-ghost:hover { background: rgba(232,184,75,0.1); }
        .btn-solid { background: linear-gradient(135deg, var(--gold-bright), var(--gold)); color: var(--midnight); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 700; text-decoration: none; }

        .page-hero { padding: 8rem 5vw 4rem; background: radial-gradient(ellipse 80% 60% at 50% 0%, #122356 0%, var(--midnight) 70%); position: relative; overflow: hidden; text-align: center; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(232,184,75,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(232,184,75,0.03) 1px, transparent 1px); background-size: 60px 60px; }
        .eyebrow { position: relative; display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.25); border-radius: 100px; padding: 0.35rem 1rem; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.25rem; }
        .page-hero h1 { position: relative; font-family: var(--font-display); font-size: clamp(2.2rem, 4vw, 3.8rem); font-weight: 300; margin-bottom: 0.75rem; }
        .page-hero h1 em { font-style: italic; background: linear-gradient(135deg, var(--gold-bright), var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .page-hero p { position: relative; color: rgba(255,255,255,0.5); font-size: 0.95rem; }

        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 4rem 5vw 6rem; display: grid; grid-template-columns: 220px 1fr; gap: 3rem; align-items: start; }

        .toc { position: sticky; top: 90px; }
        .toc-title { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.3); margin-bottom: 1rem; }
        .toc a { display: block; font-size: 0.82rem; color: rgba(255,255,255,0.45); text-decoration: none; padding: 0.4rem 0.75rem; border-left: 2px solid rgba(255,255,255,0.08); margin-bottom: 0.2rem; transition: color 0.2s, border-color 0.2s; }
        .toc a:hover { color: var(--gold); border-left-color: var(--gold); }

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
    <h1>Terms &amp; <em>Conditions</em></h1>
    <p>Last updated: {{ $settings->updated_at->format('F j, Y') }}</p>
</div>

<div class="page-wrap">

    <aside class="toc">
        <div class="toc-title">On this page</div>
        <a href="#s1">Acceptance of Terms</a>
        <a href="#s2">Description of Service</a>
        <a href="#s3">User Accounts</a>
        <a href="#s4">User Conduct</a>
        <a href="#s5">Scholarship Applications</a>
        <a href="#s6">Intellectual Property</a>
        <a href="#s7">Privacy</a>
        <a href="#s8">Disclaimers</a>
        <a href="#s9">Limitation of Liability</a>
        <a href="#s10">Indemnification</a>
        <a href="#s11">Termination</a>
        <a href="#s12">Changes to Terms</a>
        <a href="#s13">Governing Law</a>
        <a href="#s14">Contact</a>
    </aside>

    <div class="content">
        @if($settings->terms_content)
            {!! nl2br(e($settings->terms_content)) !!}
        @else

        <section id="s1">
            <div class="sec-num">01</div>
            <h2>Acceptance of Terms</h2>
            <p>By accessing and using ScholarHub, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to these terms, please do not use our service.</p>
        </section>

        <section id="s2">
            <div class="sec-num">02</div>
            <h2>Description of Service</h2>
            <p>ScholarHub is a scholarship management platform that connects students with scholarship opportunities. Our service includes:</p>
            <ul>
                <li>Scholarship search and discovery</li>
                <li>Application management and tracking</li>
                <li>Document submission and verification</li>
                <li>Communication with scholarship providers</li>
                <li>Progress tracking and notifications</li>
            </ul>
        </section>

        <section id="s3">
            <div class="sec-num">03</div>
            <h2>User Accounts</h2>
            <p>To use certain features of ScholarHub, you must create an account. You agree to:</p>
            <ul>
                <li>Provide accurate, current, and complete information during registration</li>
                <li>Maintain and promptly update your account information</li>
                <li>Keep your password secure and confidential</li>
                <li>Notify us immediately of any unauthorized use of your account</li>
                <li>Be responsible for all activities that occur under your account</li>
            </ul>
        </section>

        <section id="s4">
            <div class="sec-num">04</div>
            <h2>User Conduct</h2>
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
        </section>

        <section id="s5">
            <div class="sec-num">05</div>
            <h2>Scholarship Applications</h2>
            <p>When using ScholarHub to apply for scholarships:</p>
            <ul>
                <li>You are responsible for the accuracy and completeness of your applications</li>
                <li>ScholarHub does not guarantee scholarship awards</li>
                <li>Scholarship providers make final decisions on all applications</li>
                <li>You must meet all eligibility requirements for each scholarship</li>
                <li>Application deadlines are set by scholarship providers and are strictly enforced</li>
            </ul>
        </section>

        <section id="s6">
            <div class="sec-num">06</div>
            <h2>Content and Intellectual Property</h2>
            <p>You retain ownership of content you submit. By submitting content, you grant ScholarHub a non-exclusive, worldwide, royalty-free license to use, display, and distribute your content in connection with the service. ScholarHub and its licensors retain all rights to the platform, including trademarks, logos, and software.</p>
        </section>

        <section id="s7">
            <div class="sec-num">07</div>
            <h2>Privacy</h2>
            <p>Your use of ScholarHub is also governed by our <a href="/privacy-policy">Privacy Policy</a>, which explains how we collect, use, and protect your personal information.</p>
        </section>

        <section id="s8">
            <div class="sec-num">08</div>
            <h2>Disclaimers</h2>
            <p>ScholarHub is provided "as is" and "as available" without warranties of any kind. We do not warrant that:</p>
            <ul>
                <li>The service will be uninterrupted, secure, or error-free</li>
                <li>Defects will be corrected</li>
                <li>You will successfully receive scholarships</li>
                <li>The service will meet your specific requirements</li>
            </ul>
        </section>

        <section id="s9">
            <div class="sec-num">09</div>
            <h2>Limitation of Liability</h2>
            <p>To the maximum extent permitted by law, ScholarHub shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses.</p>
        </section>

        <section id="s10">
            <div class="sec-num">10</div>
            <h2>Indemnification</h2>
            <p>You agree to indemnify and hold harmless ScholarHub, its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including attorneys' fees) arising from your use of the service or violation of these terms.</p>
        </section>

        <section id="s11">
            <div class="sec-num">11</div>
            <h2>Termination</h2>
            <p>We may terminate or suspend your account immediately, without prior notice, for any reason, including breach of these terms. Upon termination, your right to use the service will cease immediately.</p>
        </section>

        <section id="s12">
            <div class="sec-num">12</div>
            <h2>Changes to Terms</h2>
            <p>We reserve the right to modify these terms at any time. We will notify users of any material changes by posting the new terms on this page and updating the "Last Updated" date. Your continued use of the service after any changes constitutes acceptance of the new terms.</p>
        </section>

        <section id="s13">
            <div class="sec-num">13</div>
            <h2>Governing Law</h2>
            <p>These terms shall be governed by and construed in accordance with the laws of the Philippines, without regard to its conflict of law provisions.</p>
        </section>

        <section id="s14">
            <div class="sec-num">14</div>
            <h2>Contact Information</h2>
            <p>For questions about these Terms and Conditions, please contact us:</p>
            <ul>
                <li>Email: <a href="mailto:legal@scholarhub.com">legal@scholarhub.com</a></li>
                <li>Address: 123 Education Street, Academic City, Philippines 1234</li>
                <li>Phone: +63 912 345 6789</li>
            </ul>
            <div class="last-updated">These terms and conditions are effective as of {{ $settings->updated_at->format('F j, Y') }}.</div>
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
