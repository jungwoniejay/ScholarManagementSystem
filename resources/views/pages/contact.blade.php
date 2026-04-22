<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us — ScholarHub</title>
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

        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 1.25rem 5vw; display: flex; justify-content: space-between; align-items: center; background: rgba(6,13,31,0.95); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(232,184,75,0.12); }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .logo-mark { width: 38px; height: 38px; background: linear-gradient(135deg, var(--gold), #C8830A); border-radius: 10px; display: grid; place-items: center; }
        .logo-text { font-family: var(--font-display); font-size: 1.4rem; font-weight: 600; color: var(--white); }
        .logo-text span { color: var(--gold); }
        .nav-cta { display: flex; gap: 0.75rem; }
        .btn-ghost { background: none; border: 1px solid rgba(232,184,75,0.4); color: var(--gold); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
        .btn-ghost:hover { background: rgba(232,184,75,0.1); }
        .btn-solid { background: linear-gradient(135deg, var(--gold-bright), var(--gold)); color: var(--midnight); padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 700; text-decoration: none; }

        .page-hero { padding: 9rem 5vw 5rem; text-align: center; background: radial-gradient(ellipse 80% 60% at 50% 0%, #122356 0%, var(--midnight) 70%); position: relative; overflow: hidden; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(232,184,75,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(232,184,75,0.03) 1px, transparent 1px); background-size: 60px 60px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.25); border-radius: 100px; padding: 0.35rem 1rem; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.5rem; }
        .page-hero h1 { font-family: var(--font-display); font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 300; line-height: 1.15; margin-bottom: 1rem; }
        .page-hero h1 em { font-style: italic; background: linear-gradient(135deg, var(--gold-bright), var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .page-hero p { font-size: 1.05rem; color: rgba(255,255,255,0.6); max-width: 520px; margin: 0 auto; line-height: 1.8; font-weight: 300; }

        .container { max-width: 1100px; margin: 0 auto; padding: 5rem 5vw; }

        /* CONTACT GRID */
        .contact-grid { display: grid; grid-template-columns: 1fr 1.4fr; gap: 3rem; align-items: start; }

        /* INFO CARDS */
        .info-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(232,184,75,0.1); border-radius: 16px; padding: 1.75rem; display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; transition: border-color 0.3s; }
        .info-card:hover { border-color: rgba(232,184,75,0.3); }
        .info-icon { width: 42px; height: 42px; background: rgba(232,184,75,0.1); border: 1px solid rgba(232,184,75,0.2); border-radius: 10px; display: grid; place-items: center; flex-shrink: 0; }
        .info-card h4 { font-size: 0.8rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.35rem; }
        .info-card p { font-size: 0.9rem; color: rgba(255,255,255,0.65); line-height: 1.6; }
        .info-card a { color: rgba(255,255,255,0.65); text-decoration: none; }
        .info-card a:hover { color: var(--gold); }

        .section-label { font-size: 0.75rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-label::before { content: ''; width: 24px; height: 1px; background: var(--gold); }
        .contact-left h2 { font-family: var(--font-display); font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 300; margin-bottom: 0.75rem; }
        .contact-left h2 strong { font-weight: 700; }
        .contact-left > p { color: rgba(255,255,255,0.5); font-size: 0.95rem; line-height: 1.8; font-weight: 300; margin-bottom: 2rem; }

        /* FORM */
        .form-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(232,184,75,0.12); border-radius: 20px; padding: 2.5rem; }
        .form-card h3 { font-family: var(--font-display); font-size: 1.6rem; font-weight: 600; margin-bottom: 0.5rem; }
        .form-card > p { font-size: 0.9rem; color: rgba(255,255,255,0.45); margin-bottom: 2rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 0.5rem; }
        .form-group input,
        .form-group select,
        .form-group textarea { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.75rem 1rem; color: #fff; font-family: var(--font-body); font-size: 0.9rem; outline: none; transition: border-color 0.2s; }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { border-color: rgba(232,184,75,0.5); }
        .form-group input::placeholder,
        .form-group textarea::placeholder { color: rgba(255,255,255,0.25); }
        .form-group select option { background: #0F2050; }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .btn-submit { width: 100%; background: linear-gradient(135deg, var(--gold-bright), var(--gold)); color: var(--midnight); padding: 0.9rem; border-radius: 10px; font-size: 0.95rem; font-weight: 700; border: none; cursor: pointer; letter-spacing: 0.03em; transition: box-shadow 0.3s, transform 0.2s; }
        .btn-submit:hover { box-shadow: 0 8px 28px rgba(232,184,75,0.45); transform: translateY(-2px); }

        @if(session('contact_success'))
        .success-msg { background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); color: #22C55E; padding: 0.85rem 1rem; border-radius: 10px; font-size: 0.9rem; margin-bottom: 1.5rem; }
        @endif

        /* FOOTER */
        footer { background: #040810; padding: 3rem 5vw 1.5rem; border-top: 1px solid rgba(232,184,75,0.1); }
        .footer-inner { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-links { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .footer-links a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold); }
        .footer-copy { color: rgba(255,255,255,0.25); font-size: 0.82rem; }

        @media (max-width: 768px) {
            .contact-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
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
    <div class="eyebrow">✦ Get In Touch</div>
    <h1>We'd love to<br><em>hear from you</em></h1>
    <p>Have a question, partnership inquiry, or just want to say hello? Reach out and our team will get back to you promptly.</p>
</div>

<div class="container">
    <div class="contact-grid">

        <!-- LEFT: Contact Info -->
        <div class="contact-left">
            <div class="section-label">Contact Information</div>
            <h2>Reach us <strong>anytime</strong></h2>
            <p>Our team is available Monday through Friday, 8AM – 5PM. We typically respond within 24 hours.</p>

            <div class="info-card">
                <div class="info-icon">
                    <svg width="18" height="18" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h4>Email</h4>
                    <p><a href="mailto:support@scholarhub.com">support@scholarhub.com</a></p>
                    <p><a href="mailto:partnerships@scholarhub.com">partnerships@scholarhub.com</a></p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg width="18" height="18" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h4>Phone</h4>
                    <p><a href="tel:+639123456789">+63 912 345 6789</a></p>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.35);margin-top:0.25rem;">Mon – Fri, 8AM – 5PM</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg width="18" height="18" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h4>Address</h4>
                    <p>123 Education Street<br>Academic City, Philippines 1234</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg width="18" height="18" fill="none" stroke="#E8B84B" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4>Office Hours</h4>
                    <p>Monday – Friday: 8:00 AM – 5:00 PM<br>Saturday – Sunday: Closed</p>
                </div>
            </div>
        </div>

        <!-- RIGHT: Contact Form -->
        <div class="form-card">
            <h3>Send us a message</h3>
            <p>Fill out the form below and we'll get back to you as soon as possible.</p>

            @if(session('contact_success'))
                <div class="success-msg">✓ Your message has been sent! We'll be in touch shortly.</div>
            @endif

            <form method="POST" action="/contact">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="Juan" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="dela Cruz" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="juan@example.com" required>
                </div>
                <div class="form-group">
                    <label>I am a</label>
                    <select name="role">
                        <option value="">Select your role...</option>
                        <option value="student">Student</option>
                        <option value="donor">Donor / Organization</option>
                        <option value="institution">Academic Institution</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="How can we help?" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" placeholder="Tell us more about your inquiry..." required></textarea>
                </div>
                <button type="submit" class="btn-submit">Send Message →</button>
            </form>
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
