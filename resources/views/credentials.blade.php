<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarHub - Login Credentials</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: radial-gradient(ellipse 80% 70% at 50% 0%, #122356 0%, #060D1F 70%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #fff;
        }
        .container {
            max-width: 900px;
            width: 100%;
        }
        .header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            text-decoration: none;
        }
        .logo-mark {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #FFD700, #B8860B);
            border-radius: 12px;
            display: grid;
            place-items: center;
            box-shadow: 0 0 20px rgba(232,184,75,0.35);
        }
        .logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 600;
            color: #fff;
        }
        .logo-text span { color: #FFD700; }
        h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .card {
            background: #0F2044;
            border: 1px solid #1E3A8A;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(255,215,0,0.2);
        }
        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
        }
        .admin-icon {
            background: linear-gradient(135deg, #FFD700, #B8860B);
        }
        .donor-icon {
            background: linear-gradient(135deg, #22C55E, #16A34A);
        }
        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card-role {
            color: rgba(255,255,255,0.6);
            font-size: 0.875rem;
        }
        .credential-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .credential-row:last-child {
            border-bottom: none;
        }
        .label {
            color: rgba(255,255,255,0.5);
            font-size: 0.875rem;
            font-weight: 500;
        }
        .value {
            color: #FFD700;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .copy-btn {
            background: rgba(255,215,0,0.1);
            border: 1px solid rgba(255,215,0,0.3);
            color: #FFD700;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .copy-btn:hover {
            background: rgba(255,215,0,0.2);
            border-color: #FFD700;
        }
        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .btn {
            flex: 1;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.875rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #FFD700, #B8860B);
            color: #060D1F;
            box-shadow: 0 4px 15px rgba(255,215,0,0.4);
        }
        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(255,215,0,0.6);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
        }
        .info-box {
            background: rgba(255,215,0,0.1);
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        .info-title {
            color: #FFD700;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .info-text {
            color: rgba(255,255,255,0.7);
            font-size: 0.875rem;
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .cards {
                grid-template-columns: 1fr;
            }
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="/" class="logo">
                <div class="logo-mark">
                    <svg width="24" height="24" fill="none" stroke="#060D1F" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="logo-text">Scholar<span>Hub</span></span>
            </a>
            <h1>Login Credentials</h1>
            <p class="subtitle">Use these accounts to access the system</p>
        </div>

        <div class="cards">
            <!-- Admin Card -->
            <div class="card">
                <div class="card-header">
                    <div class="icon admin-icon">👤</div>
                    <div>
                        <div class="card-title">Administrator</div>
                        <div class="card-role">Full System Access</div>
                    </div>
                </div>
                <div class="credential-row">
                    <span class="label">Email</span>
                    <span class="value">
                        admin@scholarhub.com
                        <button class="copy-btn" onclick="copyText('admin@scholarhub.com')">Copy</button>
                    </span>
                </div>
                <div class="credential-row">
                    <span class="label">Password</span>
                    <span class="value">
                        admin123
                        <button class="copy-btn" onclick="copyText('admin123')">Copy</button>
                    </span>
                </div>
                <div class="actions">
                    <a href="/login" class="btn btn-primary">Login as Admin</a>
                </div>
            </div>

            <!-- Donor Card -->
            <div class="card">
                <div class="card-header">
                    <div class="icon donor-icon">💰</div>
                    <div>
                        <div class="card-title">Donor</div>
                        <div class="card-role">ScholarHub Foundation</div>
                    </div>
                </div>
                <div class="credential-row">
                    <span class="label">Email</span>
                    <span class="value">
                        donor@scholarhub.com
                        <button class="copy-btn" onclick="copyText('donor@scholarhub.com')">Copy</button>
                    </span>
                </div>
                <div class="credential-row">
                    <span class="label">Password</span>
                    <span class="value">
                        donor123
                        <button class="copy-btn" onclick="copyText('donor123')">Copy</button>
                    </span>
                </div>
                <div class="credential-row">
                    <span class="label">Initial Fund</span>
                    <span class="value">₱100,000.00</span>
                </div>
                <div class="actions">
                    <a href="/login" class="btn btn-primary">Login as Donor</a>
                </div>
            </div>
        </div>

        <div class="info-box">
            <div class="info-title">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Important Notes
            </div>
            <div class="info-text">
                • These are default credentials for development and testing purposes only<br>
                • Change passwords immediately in production environments<br>
                • Never share credentials publicly or commit them to version control<br>
                • For security, consider implementing two-factor authentication
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="/" class="btn btn-secondary" style="display: inline-block; max-width: 300px;">
                ← Back to Home
            </a>
        </div>
    </div>

    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show temporary success message
                const btn = event.target;
                const originalText = btn.textContent;
                btn.textContent = 'Copied!';
                btn.style.background = 'rgba(34,197,94,0.2)';
                btn.style.borderColor = '#22C55E';
                btn.style.color = '#22C55E';
                
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = 'rgba(255,215,0,0.1)';
                    btn.style.borderColor = 'rgba(255,215,0,0.3)';
                    btn.style.color = '#FFD700';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
</body>
</html>
