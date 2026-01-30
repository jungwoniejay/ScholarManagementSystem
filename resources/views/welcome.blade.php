<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarHub - Your Path to Educational Success</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #10B981;
            --primary-dark: #059669;
            --secondary: #34D399;
            --accent: #6EE7B7;
            --success: #10B981;
            --warning: #F59E0B;
            --dark: #0F172A;
            --dark-light: #1E293B;
            --gray: #64748B;
            --light: #F8FAFC;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%);
            min-height: 100vh;
            color: var(--dark);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(16, 185, 129, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(52, 211, 153, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #10B981, #34D399);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--white), #F1F5F9);
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            padding: 3rem 0;
        }

        .content-left {
            color: var(--white);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #FFF 0%, #E0E7FF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            font-size: 1.25rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .btn-large {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #10B981, #059669);
            color: var(--white);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.5);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Card Section */
        .content-right {
            position: relative;
        }

        .card-container {
            background: var(--white);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .card-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #10B981, #34D399, #6EE7B7);
        }

        .card-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .card-header h2 {
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .card-header p {
            color: var(--gray);
            font-size: 1rem;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border-radius: 16px;
            background: var(--light);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(52, 211, 153, 0.05));
            transform: translateX(8px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .icon-purple {
            background: linear-gradient(135d, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.2));
        }

        .icon-blue {
            background: linear-gradient(135deg, rgba(52, 211, 153, 0.1), rgba(52, 211, 153, 0.2));
        }

        .icon-cyan {
            background: linear-gradient(135deg, rgba(110, 231, 183, 0.1), rgba(110, 231, 183, 0.2));
        }

        .feature-content h3 {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .feature-content p {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .action-card {
            background: linear-gradient(135deg, #10B981, #059669);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            color: var(--white);
        }

        .action-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .action-card p {
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        .btn-white {
            background: var(--white);
            color: var(--primary);
            font-weight: 700;
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        .float-1 {
            width: 100px;
            height: 100px;
            background: #34D399;
            top: 10%;
            right: -30px;
            animation-delay: 0s;
        }

        .float-2 {
            width: 60px;
            height: 60px;
            background: #6EE7B7;
            bottom: 20%;
            left: -20px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive */
        @media (max-width: 968px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            h1 {
                font-size: 2.5rem;
            }

            .stats {
                grid-template-columns: repeat(3, 1fr);
            }

            .card-container {
                padding: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 0 1rem;
            }

            .nav-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            .stats {
                gap: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <div class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z"/>
                        <path d="M2 17L12 22L22 17"/>
                        <path d="M2 12L12 17L22 12"/>
                    </svg>
                </div>
                <span>ScholarHub</span>
            </div>
            <div class="nav-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <main class="main-content">
            <div class="content-left">
                <div class="badge">
                    <span class="badge-dot"></span>
                    <span>Trusted by 50,000+ Students Worldwide</span>
                </div>
                
                <h1>
                    Your Gateway to
                    <span class="gradient-text">Educational Excellence</span>
                </h1>
                
                <p class="subtitle">
                    Discover thousands of scholarship opportunities, manage applications seamlessly, and turn your academic dreams into reality. Start your journey to success today.
                </p>

                <div class="cta-buttons">
                    <a href="{{ route('login') }}" class="btn btn-gradient btn-large">Explore Scholarships</a>
                    <a href="#about" class="btn btn-outline btn-large">Learn More</a>
                </div>

                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-number">5,000+</span>
                        <span class="stat-label">Active Scholarships</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">$50M+</span>
                        <span class="stat-label">Awarded Annually</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <div class="floating-element float-1"></div>
                <div class="floating-element float-2"></div>
                
                <div class="card-container">
                    <div class="card-header">
                        <h2>Why Choose ScholarHub?</h2>
                        <p>Everything you need to succeed in one platform</p>
                    </div>

                    <ul class="feature-list">
                        <li class="feature-item">
                            <div class="feature-icon icon-purple">
                                🎯
                            </div>
                            <div class="feature-content">
                                <h3>Smart Matching</h3>
                                <p>AI-powered system matches you with scholarships that fit your profile perfectly</p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="feature-icon icon-blue">
                                📊
                            </div>
                            <div class="feature-content">
                                <h3>Track Progress</h3>
                                <p>Monitor all your applications in real-time with our intuitive dashboard</p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="feature-icon icon-cyan">
                                🔔
                            </div>
                            <div class="feature-content">
                                <h3>Never Miss Deadlines</h3>
                                <p>Automated reminders keep you on track with every application deadline</p>
                            </div>
                        </li>
                    </ul>

                    <div class="action-card">
                        <h3>Ready to Get Started?</h3>
                        <p>Join thousands of successful students who found their scholarships through our platform</p>
                        <a href="{{ route('register') }}" class="btn btn-white">Create Free Account</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>