<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us — ScholarHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --midnight: #060D1F; --navy: #0F2050; --gold: #E8B84B;
            --gold-bright: #FFD060; --white: #FFFFFF;
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }
        body { font-family: var(--font-body); background: var(--midnight); color: var(--white); overflow-x: hidden; }

        /* NAV */
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 1.25rem 5vw; display: flex; justify-content: space-between; align-items: center; background: rgba(6,13,31,0.95); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(232,184,75,0.12); }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .logo-mark { width: 38px; height: 38px; background: linear-gradient(135deg, var(--gold), #C8830A); border-radius: 10px; display: grid; place-items: center; }
        .logo-text { font-family: var(--font-display); font-size: 1.4rem; font-weight: 600; color: var(--white); }
        .logo-text span { color: var(--gold); }
        .nav-cta { display: flex; gap: 0.75rem; }
        .btn-ghost { background: none; border: 1px solid rgba(232,184,75,0.4); color: var(--gold); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
        .btn-ghost:hover { background: rgba(232,184,75,0.1); }
        .btn-solid { background: linear-gradient(135deg, var(--gold-bright), var(--gold)); color: var(--midnight); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 700; text-decoration: none; }

        /* HERO */
        .page-hero { padding: 9rem 5vw 5rem; text-align: center; background: radial-gradient(ellipse 80% 60% at 50% 0%, #122356 0%, var(--midnight) 70%); position: relative; overflow: hidden; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(232,184,75,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(232,184,75,0.03) 1px, transparent 1px); background-size: 60px 60px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.25); border-radius: 100px; padding: 0.35rem 1rem; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.5rem; }
        .page-hero h1 { font-family: var(--font-display); font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 300; line-height: 1.15; margin-bottom: 1rem; }
        .page-hero h1 em { font-style: italic; background: linear-gradient(135deg, var(--gold-bright), var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .page-hero p { font-size: 1.05rem; color: rgba(255,255,255,0.6); max-width: 520px; margin: 0 auto; line-height: 1.8; font-weight: 300; }

        /* CONTENT */
        .container { max-width: 1100px; margin: 0 auto; padding: 5rem 5vw; }
        .section { margin-bottom: 5rem; }
        .section-label { font-size: 0.75rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-label::before { content: ''; width: 24px; height: 1px; background: var(--gold); }
        .section h2 { font-family: var(--font-display); font-size: clamp(1.8rem, 3vw, 2.8rem); font-weight: 300; margin-bottom: 1.25rem; }
        .section h2 strong { font-weight: 700; }
        .section p { color: rgba(255,255,255,0.6); font-size: 1rem; line-height: 1.85; font-weight: 300; margin-bottom: 1rem; max-width: 680px; }

        /* MISSION / VALUES GRID */
        .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 2.5rem; }
        .value-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(232,184,75,0.1); border-radius: 16px; padding: 2rem; transition: border-color 0.3s, transform 0.3s; }
        .value-card:hover { border-color: rgba(232,184,75,0.3); transform: translateY(-4px); }
        .value-icon { width: 44px; height: 44px; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.2); border-radius: 12px; display: grid; place-items: center; margin-bottom: 1.25rem; }
        .value-card h3 { font-family: var(--font-display); font-size: 1.3rem; font-weight: 600; margin-bottom: 0.5rem; }
        .value-card p { font-size: 0.9rem; color: rgba(255,255,255,0.5); line-height: 1.7; font-weight: 300; margin: 0; }

        /* TEAM / IDENTITY */
        .identity-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; }
        .identity-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(232,184,75,0.12); border-radius: 20px; padding: 2.5rem; }
        .identity-card h3 { font-family: var(--font-display); font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: var(--gold); }
        .identity-card p { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.8; font-weight: 300; }
        .identity-card ul { list-style: none; margin-top: 1rem; display: flex; flex-direction: column; gap: 0.6rem; }
        .identity-card ul li { display: flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; color: rgba(255,255,255,0.65); }
        .identity-card ul li::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }

        /* STATS */
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-top: 2.5rem; }
        .stat-box { text-align: center; padding: 2rem 1rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(232,184,75,0.1); border-radius: 16px; }
        .stat-box .num { font-family: var(--font-display); font-size: 2.5rem; font-weight: 700; color: var(--gold); display: block; }
        .stat-box .lbl { font-size: 0.8rem; color: rgba(255,255,255,0.45); letter-spacing: 0.06em; text-transform: uppercase; margin-top: 0.25rem; }

        /* DIVIDER */
        .divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(232,184,75,0.2), transparent); margin: 0 0 5rem; }

        /* FOOTER */
        footer { background: #040810; padding: 3rem 5vw 1.5rem; border-top: 1px solid rgba(232,184,75,0.1); }
        .footer-inner { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-links { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .footer-links a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold); }
        .footer-copy { color: rgba(255,255,255,0.25); font-size: 0.82rem; }

        @media (max-width: 768px) {
            .values-grid { grid-template-columns: 1fr; }
            .identity-grid { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: 1fr 1fr; }
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

<!-- HERO -->
<div class="page-hero">
    <div class="eyebrow">✦ About ScholarHub</div>
    <h1>Empowering students through<br><em>accessible education funding</em></h1>
    <p>We bridge the gap between deserving students and generous donors — making scholarship management transparent, efficient, and human.</p>
</div>

<div class="container">

    <!-- MISSION -->
    <div class="section">
        <div class="section-label">Our Mission</div>
        <h2>Why we <strong>exist</strong></h2>
        <p>ScholarHub was built on a simple belief: financial barriers should never stand between a student and their potential. We created a platform that makes it easy for donors to fund scholarships and for students to discover, apply, and receive the support they deserve.</p>
        <p>Every feature we build, every process we streamline, is in service of one goal — getting more students funded, faster.</p>

        <div class="stats-row">
            <div class="stat-box"><span class="num">5,000+</span><span class="lbl">Students Supported</span></div>
            <div class="stat-box"><span class="num">₱50M+</span><span class="lbl">Scholarships Awarded</span></div>
            <div class="stat-box"><span class="num">98%</span><span class="lbl">Satisfaction Rate</span></div>
            <div class="stat-box"><span class="num">200+</span><span class="lbl">Partner Donors</span></div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- VALUES -->
    <div class="section">
        <div class="section-label">Our Values</div>
        <h2>What we <strong>stand for</strong></h2>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <svg width="20" height="20" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3>Transparency</h3>
                <p>Every step of the scholarship process is visible to all parties — no hidden decisions, no surprises.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg width="20" height="20" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3>Inclusivity</h3>
                <p>We design for every student — regardless of background, location, or circumstance.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg width="20" height="20" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3>Efficiency</h3>
                <p>We eliminate paperwork and manual processes so donors and students can focus on what matters.</p>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- ORGANIZATION IDENTITY -->
    <div class="section">
        <div class="section-label">Organization Identity</div>
        <h2>Who we <strong>are</strong></h2>
        <div class="identity-grid">
            <div class="identity-card">
                <h3>ScholarHub</h3>
                <p>ScholarHub is a scholarship management system designed to connect students with educational funding opportunities. We serve as the digital backbone for scholarship programs — from application intake to fund disbursement.</p>
                <ul>
                    <li>Founded to democratize access to education funding</li>
                    <li>Serving students, donors, and academic institutions</li>
                    <li>Built on principles of fairness and merit</li>
                    <li>Committed to data privacy and security</li>
                </ul>
            </div>
            <div class="identity-card">
                <h3>Our Platform</h3>
                <p>We provide a full-cycle scholarship management experience — from discovery to disbursement — with tools built for every stakeholder.</p>
                <ul>
                    <li>Student application portal with document management</li>
                    <li>Donor dashboard for funding and tracking</li>
                    <li>Admin tools for review, approval, and reporting</li>
                    <li>Real-time notifications and status tracking</li>
                    <li>Secure wallet system for fund disbursement</li>
                </ul>
            </div>
        </div>
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
            <a href="/terms-and-conditions">Terms & Conditions</a>
        </div>
    </div>
</footer>

</body>
</html>
