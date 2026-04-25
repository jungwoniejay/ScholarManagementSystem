<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarHub — Your Path to Educational Excellence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --midnight: #060D1F;
            --navy-deep: #0B1735;
            --navy: #0F2050;
            --navy-light: #1A3570;
            --gold: #E8B84B;
            --gold-bright: #FFD060;
            --gold-pale: #F5D98A;
            --gold-dim: rgba(232, 184, 75, 0.15);
            --cream: #FDF6E3;
            --white: #FFFFFF;
            --white-80: rgba(255,255,255,0.8);
            --white-50: rgba(255,255,255,0.5);
            --white-20: rgba(255,255,255,0.2);
            --white-10: rgba(255,255,255,0.08);
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--midnight);
            color: var(--white);
            overflow-x: hidden;
        }


        /* ── Canvas for particles ── */
        #particle-canvas {
            position: absolute; inset: 0;
            pointer-events: none; z-index: 0;
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 1.5rem 5vw;
            display: flex; justify-content: space-between; align-items: center;
            transition: background 0.4s, backdrop-filter 0.4s, padding 0.4s;
        }
        nav.scrolled {
            background: rgba(6, 13, 31, 0.9);
            backdrop-filter: blur(18px);
            padding: 1rem 5vw;
            border-bottom: 1px solid rgba(232,184,75,0.12);
        }

        .logo {
            display: flex; align-items: center; gap: 0.75rem;
            text-decoration: none;
        }
        .logo-mark {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--gold), #C8830A);
            border-radius: 10px;
            display: grid; place-items: center;
            box-shadow: 0 0 20px rgba(232,184,75,0.35);
            position: relative;
            overflow: hidden;
        }
        .logo-mark::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, transparent 60%);
        }
        .logo-text {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 600;
            color: var(--white); letter-spacing: 0.02em;
        }
        .logo-text span { color: var(--gold); }

        .nav-links {
            display: flex; gap: 2.5rem; list-style: none;
        }
        .nav-links a {
            color: var(--white-80); text-decoration: none;
            font-size: 0.88rem; letter-spacing: 0.06em;
            text-transform: uppercase; font-weight: 500;
            position: relative; transition: color 0.3s;
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: -4px; left: 0;
            width: 0; height: 1px; background: var(--gold);
            transition: width 0.3s ease;
        }
        .nav-links a:hover { color: var(--gold); }
        .nav-links a:hover::after { width: 100%; }

        .nav-cta {
            display: flex; gap: 1rem; align-items: center;
        }
        .btn-ghost {
            background: none; border: 1px solid rgba(232,184,75,0.4);
            color: var(--gold); padding: 0.6rem 1.4rem; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 500;
            cursor: pointer; text-decoration: none;
            letter-spacing: 0.04em;
        }
        .btn-ghost:hover {
            background: rgba(232,184,75,0.1);
            border-color: var(--gold);
            box-shadow: 0 0 20px rgba(232,184,75,0.15);
        }
        .btn-solid {
            background: linear-gradient(135deg, var(--gold-bright) 0%, var(--gold) 50%, #C8830A 100%);
            color: var(--midnight); padding: 0.6rem 1.4rem; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 600;
            cursor: pointer; text-decoration: none; border: none;
            box-shadow: 0 4px 24px rgba(232,184,75,0.4);
            transition: transform 0.3s, box-shadow 0.3s;
            letter-spacing: 0.04em;
        }
        .btn-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(232,184,75,0.55);
        }

        /* ── HERO ── */
        .hero {
            position: relative; min-height: 100vh;
            background: radial-gradient(ellipse 80% 70% at 50% 0%, #122356 0%, var(--midnight) 70%);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }

        /* Grid lines background */
        .hero-grid {
            position: absolute; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(232,184,75,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(232,184,75,0.04) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }

        /* Glowing orbs */
        .orb {
            position: absolute; border-radius: 50%; pointer-events: none;
            filter: blur(80px);
        }
        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(232,184,75,0.18) 0%, transparent 70%);
            top: -100px; left: -80px;
        }
        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(26,53,112,0.8) 0%, transparent 70%);
            bottom: -50px; right: -60px;
        }
        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(232,184,75,0.1) 0%, transparent 70%);
            top: 40%; right: 10%;
        }

        /* Decorative arc lines */
        .arc-lines {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 900px; height: 900px;
            pointer-events: none; z-index: 0;
        }

        .hero-inner {
            position: relative; z-index: 2;
            text-align: center; max-width: 900px;
            padding: 8rem 2rem 6rem;
        }

        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 0.6rem;
            background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.25);
            border-radius: 100px; padding: 0.4rem 1.2rem;
            font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--gold-pale); margin-bottom: 2rem;
        }
        .eyebrow-pulse {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--gold); animation: eyepulse 2s ease-in-out infinite;
        }
        @keyframes eyepulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(232,184,75,0.5); }
            50% { opacity: 0.5; box-shadow: 0 0 0 6px rgba(232,184,75,0); }
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(3.2rem, 7vw, 6.5rem);
            font-weight: 300; line-height: 1.1;
            letter-spacing: -0.01em;
            margin-bottom: 1.5rem;
        }
        .hero-title em {
            font-style: italic;
            background: linear-gradient(135deg, var(--gold-bright) 0%, var(--gold) 50%, #E8A020 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-title strong { font-weight: 700; }

        .hero-sub {
            font-size: 1.1rem; line-height: 1.85; color: var(--white-80);
            max-width: 560px; margin: 0 auto 3rem;
            font-weight: 300;
        }

        .hero-actions {
            display: flex; align-items: center; justify-content: center;
            gap: 1.25rem; flex-wrap: wrap;
            margin-bottom: 4rem;
        }

        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 0.65rem;
            background: linear-gradient(135deg, var(--gold-bright), var(--gold), #C8830A);
            color: var(--midnight); padding: 1rem 2.2rem;
            border-radius: 12px; font-size: 0.95rem; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 8px 36px rgba(232,184,75,0.45);
            letter-spacing: 0.03em;
            position: relative; overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-hero-primary::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, transparent 50%);
            opacity: 0; transition: opacity 0.3s;
        }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 44px rgba(232,184,75,0.6); }
        .btn-hero-primary:hover::before { opacity: 1; }
        .btn-arrow { transition: transform 0.3s; }
        .btn-hero-primary:hover .btn-arrow { transform: translateX(4px); }

        .btn-hero-secondary {
            display: inline-flex; align-items: center; gap: 0.65rem;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.18);
            color: var(--white); padding: 1rem 2.2rem;
            border-radius: 12px; font-size: 0.95rem; font-weight: 500;
            text-decoration: none; cursor: pointer;
            transition: background 0.3s, border-color 0.3s;
            letter-spacing: 0.03em;
        }
        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.35);
        }

        /* Stats row */
        .hero-stats {
            display: flex; justify-content: center; gap: 3.5rem;
            flex-wrap: wrap;
        }
        .stat { text-align: center; }
        .stat-num {
            font-family: var(--font-display);
            font-size: 2.75rem; font-weight: 700; line-height: 1;
            color: var(--white); display: block; margin-bottom: 0.3rem;
        }
        .stat-num span { color: var(--gold); }
        .stat-lbl {
            font-size: 0.78rem; color: var(--white-50);
            letter-spacing: 0.08em; text-transform: uppercase;
        }
        .stat-divider {
            width: 1px; background: rgba(255,255,255,0.1);
            align-self: stretch;
        }

        /* scroll indicator */
        .scroll-ind {
            position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
            opacity: 0; animation: fadein 1s ease 3s forwards;
        }
        @keyframes fadein { to { opacity: 0.5; } }
        .scroll-ind span {
            font-size: 0.7rem; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--white-50);
        }
        .scroll-line {
            width: 1px; height: 40px;
            background: linear-gradient(to bottom, rgba(232,184,75,0.6), transparent);
            animation: scrolldown 2s ease-in-out 3s infinite;
        }
        @keyframes scrolldown {
            0% { transform: scaleY(0); transform-origin: top; }
            50% { transform: scaleY(1); transform-origin: top; }
            51% { transform: scaleY(1); transform-origin: bottom; }
            100% { transform: scaleY(0); transform-origin: bottom; }
        }

        /* ── FEATURES ── */
        .features {
            background: var(--midnight);
            padding: 8rem 5vw;
            position: relative;
        }
        .features::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(232,184,75,0.3), transparent);
        }

        .section-label {
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.78rem; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--gold);
            margin-bottom: 1.25rem;
        }
        .section-label::before {
            content: ''; width: 32px; height: 1px; background: var(--gold);
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            font-weight: 300; line-height: 1.2;
            margin-bottom: 1rem;
        }
        .section-title strong { font-weight: 700; }

        .features-header {
            max-width: 540px; margin-bottom: 4.5rem;
        }
        .features-header p {
            color: var(--white-50); font-size: 1rem; line-height: 1.8; font-weight: 300;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5px;
            background: rgba(232,184,75,0.08);
            border: 1px solid rgba(232,184,75,0.08);
            border-radius: 20px; overflow: hidden;
        }

        .feat-card {
            background: var(--navy-deep);
            padding: 2.5rem 2.25rem;
            position: relative; overflow: hidden;
            transition: background 0.4s;
        }
        .feat-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            transform: scaleX(0); transition: transform 0.4s ease;
        }
        .feat-card:hover { background: #0e1e45; }
        .feat-card:hover::before { transform: scaleX(1); }

        .feat-number {
            font-family: var(--font-display);
            font-size: 5rem; font-weight: 700; line-height: 1;
            color: rgba(232,184,75,0.08);
            position: absolute; top: 1rem; right: 1.5rem;
            transition: color 0.4s;
        }
        .feat-card:hover .feat-number { color: rgba(232,184,75,0.14); }

        .feat-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.2);
            display: grid; place-items: center; margin-bottom: 1.75rem;
            transition: background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .feat-card:hover .feat-icon {
            background: rgba(232,184,75,0.18);
            border-color: rgba(232,184,75,0.5);
            box-shadow: 0 0 20px rgba(232,184,75,0.2);
        }

        .feat-title {
            font-family: var(--font-display);
            font-size: 1.6rem; font-weight: 600; margin-bottom: 0.75rem;
        }
        .feat-desc { color: var(--white-50); font-size: 0.9rem; line-height: 1.75; font-weight: 300; }
        .feat-link {
            display: inline-flex; align-items: center; gap: 0.4rem;
            color: var(--gold); font-size: 0.82rem; letter-spacing: 0.08em;
            text-transform: uppercase; text-decoration: none;
            margin-top: 1.5rem; opacity: 1;
            transition: gap 0.3s;
        }
        .feat-link:hover { gap: 0.75rem; }
        @media (hover: hover) {
            .feat-link { opacity: 0; transition: opacity 0.3s, gap 0.3s; }
            .feat-card:hover .feat-link { opacity: 1; }
        }

        /* ── HOW IT WORKS ── */
        .how {
            background: var(--navy-deep);
            padding: 8rem 5vw;
            position: relative; overflow: hidden;
        }
        .how::before, .how::after {
            content: ''; position: absolute;
            width: 600px; height: 600px; border-radius: 50%;
            pointer-events: none; filter: blur(120px);
        }
        .how::before {
            background: rgba(232,184,75,0.06);
            top: -200px; right: -200px;
        }
        .how::after {
            background: rgba(26,53,112,0.5);
            bottom: -200px; left: -200px;
        }

        .how-inner {
            position: relative; z-index: 1;
            display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;
        }

        .steps-list { display: flex; flex-direction: column; gap: 0; }

        .step-item {
            display: flex; gap: 1.75rem;
            padding: 2rem 0; border-bottom: 1px solid rgba(255,255,255,0.06);
            position: relative;
        }
        .step-item:last-child { border-bottom: none; }

        .step-left { display: flex; flex-direction: column; align-items: center; gap: 0; }
        .step-num-circle {
            width: 48px; height: 48px; border-radius: 50%; flex-shrink: 0;
            border: 1.5px solid rgba(232,184,75,0.25);
            display: grid; place-items: center;
            font-family: var(--font-display); font-size: 1.2rem; font-weight: 600;
            color: var(--gold); transition: all 0.3s;
            position: relative;
        }
        .step-item:hover .step-num-circle {
            background: var(--gold);
            color: var(--midnight);
            border-color: var(--gold);
            box-shadow: 0 0 24px rgba(232,184,75,0.4);
        }
        .step-connector {
            width: 1px; flex: 1; min-height: 20px;
            background: linear-gradient(to bottom, rgba(232,184,75,0.2), transparent);
            margin-top: 6px;
        }
        .step-item:last-child .step-connector { display: none; }

        .step-content { padding-top: 0.6rem; }
        .step-title {
            font-family: var(--font-display);
            font-size: 1.4rem; font-weight: 600; margin-bottom: 0.5rem;
        }
        .step-desc { color: var(--white-50); font-size: 0.88rem; line-height: 1.7; font-weight: 300; }

        /* Visual side */
        .how-visual {
            position: relative;
        }
        .how-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(232,184,75,0.12);
            border-radius: 20px; padding: 2.5rem;
            backdrop-filter: blur(20px);
            position: relative; overflow: hidden;
        }
        .how-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(232,184,75,0.5), transparent);
        }
        .dashboard-preview {
            display: flex; flex-direction: column; gap: 1rem;
        }
        .dp-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        .dp-title {
            font-family: var(--font-display);
            font-size: 1.1rem; font-weight: 600; color: var(--white-80);
        }
        .dp-badge {
            background: rgba(232,184,75,0.15); border: 1px solid rgba(232,184,75,0.3);
            color: var(--gold); padding: 0.2rem 0.7rem; border-radius: 20px;
            font-size: 0.72rem; letter-spacing: 0.06em;
        }
        .dp-row {
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,0.04); border-radius: 10px;
            padding: 0.85rem 1.1rem;
            border-left: 2px solid transparent;
            transition: border-color 0.3s, background 0.3s;
        }
        .dp-row.active { border-left-color: var(--gold); background: rgba(232,184,75,0.06); }
        .dp-row-label { font-size: 0.85rem; color: var(--white-80); display: flex; gap: 0.6rem; align-items: center; }
        .dp-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); }
        .dp-dot.green { background: #4ade80; }
        .dp-dot.blue { background: #60a5fa; }
        .dp-status {
            font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 5px; letter-spacing: 0.04em;
        }
        .s-gold { background: rgba(232,184,75,0.15); color: var(--gold); }
        .s-green { background: rgba(74,222,128,0.15); color: #4ade80; }
        .s-blue { background: rgba(96,165,250,0.15); color: #60a5fa; }

        .dp-progress-section { margin-top: 0.5rem; }
        .dp-prog-label {
            display: flex; justify-content: space-between;
            font-size: 0.78rem; color: var(--white-50);
            margin-bottom: 0.5rem;
        }
        .dp-prog-bar {
            height: 5px; background: rgba(255,255,255,0.08); border-radius: 10px; overflow: hidden;
        }
        .dp-prog-fill {
            height: 100%; border-radius: 10px;
            background: linear-gradient(90deg, var(--gold), var(--gold-bright));
            animation: progfill 2s ease 1.5s both;
        }
        @keyframes progfill { from { width: 0; } }

        /* decorative floating cards */
        .float-badge {
            position: absolute;
            background: var(--navy); border: 1px solid rgba(232,184,75,0.2);
            border-radius: 12px; padding: 0.7rem 1rem;
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.8rem; color: var(--white-80);
            box-shadow: 0 12px 32px rgba(0,0,0,0.4);
            white-space: nowrap;
        }
        .fb-1 { top: -24px; right: 20px; animation: floatbadge 4s ease-in-out infinite; }
        .fb-2 { bottom: -20px; left: 15px; animation: floatbadge 4s ease-in-out 2s infinite; }
        @keyframes floatbadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* ── TESTIMONIALS ── */
        .testimonials {
            background: var(--midnight);
            padding: 8rem 5vw;
            position: relative; overflow: hidden;
        }
        .testimonials::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(232,184,75,0.3), transparent);
        }

        .t-header { text-align: center; max-width: 540px; margin: 0 auto 5rem; }
        .t-header .section-label { justify-content: center; }
        .t-header .section-label::before { display: none; }
        .t-header p { color: var(--white-50); font-size: 0.95rem; line-height: 1.8; font-weight: 300; margin-top: 0.75rem; }

        .t-grid {
            display: grid; grid-template-columns: 1.2fr 1fr 1fr;
            gap: 1.5rem; align-items: start;
        }

        .t-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px; padding: 2.25rem;
            transition: border-color 0.3s, transform 0.3s;
            position: relative;
        }
        .t-card:hover { border-color: rgba(232,184,75,0.25); transform: translateY(-4px); }
        .t-card.featured {
            border-color: rgba(232,184,75,0.2);
            background: rgba(232,184,75,0.04);
        }

        .t-quote {
            font-family: var(--font-display);
            font-size: 3rem; line-height: 1; color: rgba(232,184,75,0.25);
            margin-bottom: 0.5rem;
        }
        .t-text {
            font-size: 0.95rem; line-height: 1.75; color: var(--white-80);
            margin-bottom: 1.75rem; font-weight: 300;
        }
        .t-card.featured .t-text { font-size: 1.05rem; }
        .t-author { display: flex; align-items: center; gap: 0.85rem; }
        .t-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), #C8830A);
            display: grid; place-items: center;
            font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
            color: var(--midnight); flex-shrink: 0;
        }
        .t-name { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.15rem; }
        .t-role { font-size: 0.78rem; color: var(--white-50); }

        .t-stars {
            display: flex; gap: 3px; margin-bottom: 1.25rem;
        }
        .t-star { color: var(--gold); font-size: 0.85rem; }

        /* ── CTA BAND ── */
        .cta-band {
            background: linear-gradient(135deg, var(--gold-bright) 0%, var(--gold) 40%, #C8830A 100%);
            padding: 6rem 5vw;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-band::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 40%),
                              radial-gradient(circle at 80% 50%, rgba(255,255,255,0.1) 0%, transparent 40%);
        }
        .cta-band-inner { position: relative; z-index: 1; }
        .cta-band h2 {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 300; color: var(--midnight);
            margin-bottom: 1rem; line-height: 1.15;
        }
        .cta-band h2 strong { font-weight: 700; }
        .cta-band p {
            color: rgba(6,13,31,0.7); font-size: 1.05rem;
            max-width: 480px; margin: 0 auto 2.5rem; line-height: 1.75; font-weight: 300;
        }
        .btn-dark {
            display: inline-flex; align-items: center; gap: 0.65rem;
            background: var(--midnight); color: var(--gold);
            padding: 1rem 2.5rem; border-radius: 12px;
            font-size: 0.95rem; font-weight: 700; text-decoration: none;
            cursor: pointer; letter-spacing: 0.04em;
            box-shadow: 0 8px 32px rgba(6,13,31,0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-dark:hover { transform: translateY(-3px); box-shadow: 0 14px 44px rgba(6,13,31,0.4); }

        /* ── FOOTER ── */
        footer {
            background: #040810; padding: 4rem 5vw 2rem;
            border-top: 1px solid rgba(232,184,75,0.1);
        }
        .footer-grid {
            display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem; margin-bottom: 3rem;
        }
        .footer-brand {}
        .footer-brand .logo { opacity: 1; margin-bottom: 1rem; display: inline-flex; }
        .footer-brand p { color: var(--white-50); font-size: 0.88rem; line-height: 1.75; max-width: 260px; font-weight: 300; }
        .footer-col h4 {
            font-family: var(--font-display); font-size: 1rem; font-weight: 600;
            color: var(--white-80); margin-bottom: 1.25rem; letter-spacing: 0.02em;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.65rem; }
        .footer-col a {
            color: var(--white-50); text-decoration: none; font-size: 0.87rem;
            transition: color 0.25s; display: inline-block;
        }
        .footer-col a:hover { color: var(--gold); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding-top: 1.5rem;
            display: flex; justify-content: space-between; align-items: center;
            color: rgba(255,255,255,0.25); font-size: 0.82rem;
        }
        .footer-bottom a { color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.2s; }
        .footer-bottom a:hover { color: var(--gold); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .features-grid { grid-template-columns: 1fr 1fr; }
            .how-inner { grid-template-columns: 1fr; gap: 4rem; }
            .t-grid { grid-template-columns: 1fr 1fr; }
            .t-card.featured { grid-column: span 2; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .nav-links { display: none; }
            .feat-card { padding: 2rem 1.75rem; }
        }
        @media (max-width: 640px) {
            .features-grid { grid-template-columns: 1fr; }
            .feat-card { padding: 1.75rem 1.5rem; }
            .feat-number { font-size: 3.5rem; }
            .feat-title { font-size: 1.35rem; }
            .feat-link { opacity: 1; margin-top: 1.25rem; }
            .t-grid { grid-template-columns: 1fr; }
            .t-card.featured { grid-column: span 1; }
            .hero-stats { gap: 2rem; }
            .stat-divider { display: none; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 0.75rem; text-align: center; }
        }
    </style>
</head>
<body>



<!-- ══ ANNOUNCEMENTS TICKER ══ -->
@if($announcements->count() > 0)
@php
    $annColors = [
        'info'    => ['bg'=>'linear-gradient(135deg,#1E3A8A,#1e40af)','glow'=>'rgba(59,130,246,0.4)','badge'=>'#60A5FA','text'=>'#e0f2fe','border'=>'rgba(96,165,250,0.4)'],
        'success' => ['bg'=>'linear-gradient(135deg,#064E3B,#065f46)','glow'=>'rgba(16,185,129,0.4)','badge'=>'#34D399','text'=>'#d1fae5','border'=>'rgba(52,211,153,0.4)'],
        'warning' => ['bg'=>'linear-gradient(135deg,#78350F,#92400e)','glow'=>'rgba(245,158,11,0.4)','badge'=>'#FBBF24','text'=>'#fef3c7','border'=>'rgba(251,191,36,0.4)'],
        'danger'  => ['bg'=>'linear-gradient(135deg,#7F1D1D,#991b1b)','glow'=>'rgba(239,68,68,0.4)','badge'=>'#F87171','text'=>'#fee2e2','border'=>'rgba(248,113,113,0.4)'],
    ];
@endphp
<style>
    #ann-wrapper {
        position: fixed; top: 0; left: 0; right: 0; z-index: 500;
    }
    .ann-bar {
        position: relative;
        height: 56px;
        display: flex;
        align-items: center;
        overflow: hidden;
        border-bottom: 1px solid;
        box-shadow: 0 4px 24px var(--ann-glow);
    }
    .ann-label {
        flex-shrink: 0;
        display: flex; align-items: center; gap: 8px;
        padding: 0 20px;
        height: 100%;
        font-size: 0.72rem; font-weight: 800;
        letter-spacing: 0.12em; text-transform: uppercase;
        border-right: 1px solid rgba(255,255,255,0.15);
        background: rgba(0,0,0,0.25);
        z-index: 2;
        white-space: nowrap;
    }
    .ann-label-dot {
        width: 7px; height: 7px; border-radius: 50%;
        animation: annpulse 1.2s ease-in-out infinite;
    }
    @keyframes annpulse {
        0%,100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.5; }
    }
    .ann-track {
        flex: 1; overflow: hidden; position: relative;
    }
    .ann-ticker {
        display: flex; align-items: center; gap: 0;
        white-space: nowrap;
        will-change: transform;
    }
    .ann-item {
        display: inline-flex; align-items: center; gap: 14px;
        padding: 0 60px;
        font-size: 1rem; font-weight: 600;
        letter-spacing: 0.01em;
    }
    .ann-item-icon {
        width: 28px; height: 28px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,0.12);
        flex-shrink: 0;
    }
    .ann-item-title {
        font-weight: 800; font-size: 1rem;
        margin-right: 6px;
    }
    .ann-item-body {
        font-weight: 400; font-size: 0.95rem;
        opacity: 0.9;
    }
    .ann-sep {
        display: inline-flex; align-items: center;
        padding: 0 40px;
        opacity: 0.3; font-size: 1.2rem;
    }
    .ann-close {
        flex-shrink: 0;
        width: 56px; height: 56px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(0,0,0,0.2);
        border: none; border-left: 1px solid rgba(255,255,255,0.15);
        cursor: pointer;
        transition: background 0.2s;
        z-index: 2;
    }
    .ann-close:hover { background: rgba(0,0,0,0.4); }
    .ann-progress {
        position: absolute; bottom: 0; left: 0;
        height: 3px;
        background: rgba(255,255,255,0.5);
        animation: annprogress 60s linear forwards;
        transform-origin: left;
    }
    @keyframes annprogress {
        from { width: 100%; }
        to   { width: 0%; }
    }
</style>

<div id="ann-wrapper">
    @foreach($announcements as $index => $ann)
    @php $c = $annColors[$ann->type] ?? $annColors['info']; @endphp
    <div class="ann-bar" id="ann-bar-{{ $ann->id }}"
         style="background:{{ $c['bg'] }};border-color:{{ $c['border'] }};--ann-glow:{{ $c['glow'] }};">

        {{-- Label --}}
        <div class="ann-label" style="color:{{ $c['badge'] }};">
            <span class="ann-label-dot" style="background:{{ $c['badge'] }};"></span>
            📢 Announcement
        </div>

        {{-- Scrolling ticker --}}
        <div class="ann-track">
            <div class="ann-ticker" id="ann-ticker-{{ $ann->id }}">
                {{-- Repeated 3x for seamless loop --}}
                @for($r = 0; $r < 3; $r++)
                <span class="ann-item" style="color:{{ $c['text'] }};">
                    <span class="ann-item-icon">
                        <svg width="14" height="14" fill="none" stroke="{{ $c['badge'] }}" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </span>
                    <span class="ann-item-title">{{ $ann->title }}</span>
                    <span style="opacity:0.4;margin:0 4px;">—</span>
                    <span class="ann-item-body">{{ $ann->body }}</span>
                </span>
                <span class="ann-sep">✦</span>
                @endfor
            </div>
        </div>

        {{-- Close button --}}
        <button class="ann-close" onclick="dismissAnn({{ $ann->id }})" style="color:{{ $c['text'] }};">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Progress bar countdown (60s) --}}
        <div class="ann-progress" id="ann-prog-{{ $ann->id }}"></div>
    </div>
    @endforeach
</div>

{{-- Spacer so content doesn't hide under the bar --}}
<div id="ann-spacer" style="height:{{ $announcements->count() * 56 }}px;"></div>

<script>
(function() {
    // Start ticker scroll animations
    @foreach($announcements as $ann)
    (function() {
        const ticker = document.getElementById('ann-ticker-{{ $ann->id }}');
        if (!ticker) return;
        let pos = 0;
        // Speed: pixels per second — 60s to cross full width
        const speed = ticker.scrollWidth / 3 / 60; // one copy width / 60s
        let last = null;
        function step(ts) {
            if (!last) last = ts;
            const dt = (ts - last) / 1000;
            last = ts;
            pos += speed * dt;
            const oneWidth = ticker.scrollWidth / 3;
            if (pos >= oneWidth) pos -= oneWidth;
            ticker.style.transform = 'translateX(-' + pos + 'px)';
            requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    })();
    @endforeach

    // Auto-dismiss after 60 seconds
    @foreach($announcements as $ann)
    setTimeout(function() { dismissAnn({{ $ann->id }}); }, 60000);
    @endforeach

    window.dismissAnn = function(id) {
        const bar = document.getElementById('ann-bar-' + id);
        if (!bar) return;
        bar.style.transition = 'opacity 0.5s, transform 0.5s';
        bar.style.opacity = '0';
        bar.style.transform = 'translateY(-100%)';
        setTimeout(function() {
            bar.remove();
            // Shrink spacer
            const spacer = document.getElementById('ann-spacer');
            if (spacer) spacer.style.height = (parseInt(spacer.style.height) - 56) + 'px';
        }, 500);
    };
})();
</script>
@endif

<!-- ══ NAVIGATION ══ -->
<nav id="main-nav">
    <a href="/" class="logo">
        <div class="logo-mark">
            <svg width="20" height="20" fill="none" stroke="#060D1F" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <span class="logo-text">Scholar<span>Hub</span></span>
    </a>

    <ul class="nav-links" id="nav-links">
        <li><a href="#features">Features</a></li>
        <li><a href="#how-it-works">How It Works</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
    </ul>

    <div class="nav-cta" id="nav-cta">
        <a href="/login" class="btn-ghost">Log In</a>
        <a href="/register" class="btn-solid">Get Started</a>
    </div>
</nav>

<!-- ══ HERO ══ -->
<section class="hero" id="hero">
    <canvas id="particle-canvas"></canvas>
    <div class="hero-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Arc SVG -->
    <svg class="arc-lines" viewBox="0 0 900 900" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="450" cy="450" r="200" stroke="rgba(232,184,75,0.05)" stroke-width="1"/>
        <circle cx="450" cy="450" r="300" stroke="rgba(232,184,75,0.04)" stroke-width="1"/>
        <circle cx="450" cy="450" r="400" stroke="rgba(232,184,75,0.03)" stroke-width="1"/>
        <circle cx="450" cy="450" r="200" stroke="rgba(232,184,75,0.12)" stroke-width="0.5" stroke-dasharray="4 14"/>
        <line x1="50" y1="450" x2="850" y2="450" stroke="rgba(232,184,75,0.04)" stroke-width="0.5"/>
        <line x1="450" y1="50" x2="450" y2="850" stroke="rgba(232,184,75,0.04)" stroke-width="0.5"/>
    </svg>

    <div class="hero-inner">
        <div class="hero-eyebrow" id="hero-eyebrow">
            <span class="eyebrow-pulse"></span>
            {{ $page->hero_badge }}
        </div>

        <h1 class="hero-title" id="hero-title">
            {{ $page->hero_title }}
        </h1>

        <p class="hero-sub" id="hero-sub">
            {{ $page->hero_subtitle }}
        </p>

        <div class="hero-actions" id="hero-actions">
            <a href="/register" class="btn-hero-primary">
                Apply for Scholarships
                <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="#how-it-works" class="btn-hero-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Watch Demo
            </a>
        </div>

        <div class="hero-stats" id="hero-stats">
            <div class="stat">
                <span class="stat-num">{{ $page->stat1_number }}</span>
                <span class="stat-lbl">{{ $page->stat1_label }}</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">{{ $page->stat2_number }}</span>
                <span class="stat-lbl">{{ $page->stat2_label }}</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">{{ $page->stat3_number }}</span>
                <span class="stat-lbl">{{ $page->stat3_label }}</span>
            </div>
        </div>
    </div>

    <div class="scroll-ind">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ══ FEATURES ══ -->
<section class="features" id="features">
    <div class="features-header">
        <div class="section-label">Platform Features</div>
        <h2 class="section-title">{{ $page->card_title }}<br><strong>{{ $page->card_subtitle }}</strong></h2>
    </div>

    <div class="features-grid" id="features-grid">
        @foreach([1,2,3] as $i)
        <div class="feat-card">
            <span class="feat-number">0{{ $i }}</span>
            <div class="feat-icon" style="font-size:1.4rem;">
                {{ $page->{"feature{$i}_icon"} }}
            </div>
            <h3 class="feat-title">{{ $page->{"feature{$i}_title"} }}</h3>
            <p class="feat-desc">{{ $page->{"feature{$i}_desc"} }}</p>
            @php $linkLabel = $page->{"feature{$i}_link_label"} ?? 'Learn more'; $linkUrl = $page->{"feature{$i}_link_url"} ?? '#'; @endphp
            @if($linkUrl && $linkUrl !== '#')
            <a href="{{ $linkUrl }}" class="feat-link">{{ $linkLabel }} <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            @else
            <span class="feat-link" style="cursor:default;">{{ $linkLabel }} <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
            @endif
        </div>
        @endforeach
    </div>
</section>

<!-- ══ HOW IT WORKS ══ -->
<section class="how" id="how-it-works">
    <div class="how-inner">
        <div>
            <div class="section-label">Process</div>
            <h2 class="section-title" style="margin-bottom:0.75rem">Three steps to<br><strong>your scholarship</strong></h2>
            <p style="color:var(--white-50);font-size:0.9rem;line-height:1.8;font-weight:300;margin-bottom:3rem;max-width:400px">A streamlined journey from profile creation to award notification.</p>

            <div class="steps-list" id="steps-list">
                @foreach([1,2,3] as $i)
                <div class="step-item">
                    <div class="step-left">
                        <div class="step-num-circle">{{ $i }}</div>
                        <div class="step-connector"></div>
                    </div>
                    <div class="step-content">
                        <h3 class="step-title">{{ $page->{"step{$i}_title"} }}</h3>
                        <p class="step-desc">{{ $page->{"step{$i}_desc"} }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="how-visual" id="how-visual">
            <div class="float-badge fb-1">
                <svg width="14" height="14" fill="none" stroke="#4ade80" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Application Approved!
            </div>
            <div class="how-card">
                <div class="dashboard-preview">
                    <div class="dp-header">
                        <span class="dp-title">My Applications</span>
                        <span class="dp-badge">● Live</span>
                    </div>
                    <div class="dp-row active">
                        <span class="dp-row-label"><span class="dp-dot"></span>STEM Excellence Award</span>
                        <span class="dp-status s-gold">Under Review</span>
                    </div>
                    <div class="dp-row">
                        <span class="dp-row-label"><span class="dp-dot green"></span>Future Leaders Grant</span>
                        <span class="dp-status s-green">Awarded ✓</span>
                    </div>
                    <div class="dp-row">
                        <span class="dp-row-label"><span class="dp-dot blue"></span>Merit Scholarship 2025</span>
                        <span class="dp-status s-blue">Draft</span>
                    </div>
                    <div class="dp-progress-section">
                        <div class="dp-prog-label">
                            <span>Profile completeness</span>
                            <span style="color:var(--gold)">87%</span>
                        </div>
                        <div class="dp-prog-bar">
                            <div class="dp-prog-fill" style="width:87%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-badge fb-2">
                <svg width="14" height="14" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                98% success rate
            </div>
        </div>
    </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section class="testimonials" id="testimonials">
    <div class="t-header">
        <div class="section-label">Testimonials</div>
        <h2 class="section-title">Stories of<br><strong>real success</strong></h2>
        <p>Students from around the world trust ScholarHub to find and secure the funding they deserve.</p>
    </div>

    <div class="t-grid" id="t-grid">
        @foreach([1,2,3] as $i)
        <div class="t-card {{ $i === 1 ? 'featured' : '' }}">
            <div class="t-stars">
                <span class="t-star">★</span><span class="t-star">★</span><span class="t-star">★</span><span class="t-star">★</span><span class="t-star">★</span>
            </div>
            <div class="t-quote">"</div>
            <p class="t-text">{{ $page->{"testimonial{$i}_text"} }}</p>
            <div class="t-author">
                <div class="t-avatar">{{ strtoupper(substr($page->{"testimonial{$i}_name"}, 0, 1)) }}</div>
                <div>
                    <div class="t-name">{{ $page->{"testimonial{$i}_name"} }}</div>
                    <div class="t-role">{{ $page->{"testimonial{$i}_role"} }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ══ CTA BAND ══ -->
<section class="cta-band">
    <div class="cta-band-inner">
        <h2>{{ $page->cta_title }}</h2>
        <p>{{ $page->cta_desc }}</p>
        <a href="/register" class="btn-dark">
            Create Free Account
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="/" class="logo">
                <div class="logo-mark">
                    <svg width="18" height="18" fill="none" stroke="#060D1F" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="logo-text">Scholar<span>Hub</span></span>
            </a>
            <p>{{ $page->footer_tagline }}</p>
        </div>
        <div class="footer-col">
            <h4>Platform</h4>
            <ul>
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Account</h4>
            <ul>
                <li><a href="/login">Log In</a></li>
                <li><a href="/register">Register</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="/about">About Us</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/terms-and-conditions">Terms &amp; Conditions</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>{{ $page->footer_copyright }}</span>
        <div style="display:flex;gap:1.25rem">
            @if($page->footer_facebook && $page->footer_facebook !== '#')<a href="{{ $page->footer_facebook }}">Facebook</a>@endif
            @if($page->footer_twitter && $page->footer_twitter !== '#')<a href="{{ $page->footer_twitter }}">Twitter</a>@endif
            @if($page->footer_linkedin && $page->footer_linkedin !== '#')<a href="{{ $page->footer_linkedin }}">LinkedIn</a>@endif
            @if($page->footer_instagram && $page->footer_instagram !== '#')<a href="{{ $page->footer_instagram }}">Instagram</a>@endif
        </div>
    </div>
</footer>

<script>
    gsap.registerPlugin(ScrollTrigger);

    /* ── Particle canvas ── */
    const canvas = document.getElementById('particle-canvas');
    const ctx = canvas.getContext('2d');
    let W, H, particles = [];

    function resize() {
        W = canvas.width = canvas.offsetWidth;
        H = canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * W;
            this.y = Math.random() * H;
            this.r = Math.random() * 1.8 + 0.3;
            this.vx = (Math.random() - 0.5) * 0.3;
            this.vy = -Math.random() * 0.5 - 0.1;
            this.alpha = Math.random() * 0.5 + 0.1;
            this.life = 0;
            this.maxLife = Math.random() * 200 + 100;
        }
        update() {
            this.x += this.vx; this.y += this.vy;
            this.life++;
            const t = this.life / this.maxLife;
            this.currentAlpha = this.alpha * Math.sin(Math.PI * t);
            if (this.life >= this.maxLife) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(232, 184, 75, ${this.currentAlpha})`;
            ctx.fill();
        }
    }

    for (let i = 0; i < 80; i++) {
        const p = new Particle();
        p.life = Math.random() * p.maxLife;
        particles.push(p);
    }

    function animParticles() {
        ctx.clearRect(0, 0, W, H);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animParticles);
    }
    animParticles();

    /* ── Nav scroll ── */
    window.addEventListener('scroll', () => {
        document.getElementById('main-nav').classList.toggle('scrolled', scrollY > 60);
    });

    /* ── GSAP Hero timeline ── */
    gsap.set(['.logo', '#nav-links', '#nav-cta', '#hero-eyebrow', '#hero-title', '#hero-sub', '#hero-actions', '#hero-stats'], { opacity: 0 });
    gsap.set(['#hero-eyebrow', '#hero-stats', '#hero-actions'], { y: 20 });
    gsap.set('#hero-title', { y: 40 });
    gsap.set('#hero-sub', { y: 30 });

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    tl.to('.logo', { opacity: 1, x: 0, duration: 0.6 })
      .to('#nav-links', { opacity: 1, duration: 0.5 }, '-=0.3')
      .to('#nav-cta', { opacity: 1, duration: 0.5 }, '-=0.3')
      .to('#hero-eyebrow', { opacity: 1, y: 0, duration: 0.7 }, '-=0.1')
      .to('#hero-title', { opacity: 1, y: 0, duration: 0.9 }, '-=0.4')
      .to('#hero-sub', { opacity: 1, y: 0, duration: 0.8 }, '-=0.55')
      .to('#hero-actions', { opacity: 1, y: 0, duration: 0.7 }, '-=0.5')
      .to('#hero-stats', { opacity: 1, y: 0, duration: 0.7 }, '-=0.4');

    /* ── Counter animation ── */
    function animateCount(el, target, suffix) {
        let start = 0;
        const dur = 1800;
        const step = timestamp => {
            if (!start) start = timestamp;
            const prog = Math.min((timestamp - start) / dur, 1);
            const ease = 1 - Math.pow(1 - prog, 3);
            el.querySelector('span').textContent = Math.round(ease * target);
            if (prog < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }

    ScrollTrigger.create({
        trigger: '#hero-stats',
        start: 'top 85%',
        once: true,
        onEnter: () => {
            document.querySelectorAll('.stat-num').forEach(el => {
                const txt = el.textContent;
                if (txt.includes('5,000')) animateCount(el, 5000, '+');
                else if (txt.includes('50')) animateCount(el, 50, 'M');
                else if (txt.includes('98')) animateCount(el, 98, '%');
            });
        }
    });

    /* ── Features stagger ── */
    gsap.from('#features-grid .feat-card', {
        scrollTrigger: { trigger: '#features-grid', start: 'top 80%', toggleActions: 'play none none none' },
        opacity: 0, y: 60, scale: 0.96,
        duration: 0.8, stagger: 0.15, ease: 'power3.out'
    });

    /* ── Steps ── */
    gsap.from('#steps-list .step-item', {
        scrollTrigger: { trigger: '#steps-list', start: 'top 80%', toggleActions: 'play none none none' },
        opacity: 0, x: -40,
        duration: 0.7, stagger: 0.18, ease: 'power3.out'
    });

    /* ── How visual ── */
    gsap.from('#how-visual', {
        scrollTrigger: { trigger: '#how-visual', start: 'top 80%', toggleActions: 'play none none none' },
        opacity: 0, x: 60,
        duration: 1, ease: 'power3.out'
    });

    /* ── Testimonials ── */
    gsap.from('#t-grid .t-card', {
        scrollTrigger: { trigger: '#t-grid', start: 'top 80%', toggleActions: 'play none none none' },
        opacity: 0, y: 50,
        duration: 0.8, stagger: 0.12, ease: 'power3.out'
    });

    /* ── Scroll fade headers ── */
    gsap.utils.toArray('.section-label, .section-title, .features-header p').forEach(el => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' },
            opacity: 0, y: 25, duration: 0.7, ease: 'power2.out'
        });
    });

    /* ── CTA band ── */
    gsap.from('.cta-band-inner', {
        scrollTrigger: { trigger: '.cta-band', start: 'top 80%', toggleActions: 'play none none none' },
        opacity: 0, y: 40, duration: 1, ease: 'power3.out'
    });

    /* ── Magnetic button effect ── */
    document.querySelectorAll('.btn-hero-primary, .btn-hero-secondary, .btn-solid, .btn-ghost, .btn-dark').forEach(btn => {
        btn.addEventListener('mousemove', function(e) {
            const r = this.getBoundingClientRect();
            const x = e.clientX - r.left - r.width / 2;
            const y = e.clientY - r.top - r.height / 2;
            gsap.to(this, { x: x * 0.15, y: y * 0.15, duration: 0.4, ease: 'power2.out' });
        });
        btn.addEventListener('mouseleave', function() {
            gsap.to(this, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1,0.5)' });
        });
    });
</script>

@include('components.cookie-banner', ['settings' => $cookieSettings])

</body>
</html>