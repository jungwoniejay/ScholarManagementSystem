<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Flow - ScholarHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .flow-container {
            position: relative;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
        }

        .main-flow {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .user-box {
            flex: 1;
            max-width: 380px;
            border-radius: 16px;
            padding: 24px;
            color: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .user-box.student {
            background: linear-gradient(135deg, #42a5f5, #1e88e5);
        }

        .user-box.admin {
            background: linear-gradient(135deg, #283593, #1a237e);
        }

        .user-box.donor {
            background: linear-gradient(135deg, #66bb6a, #43a047);
        }

        .user-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255,255,255,0.3);
        }

        .user-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .user-title {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .action-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 8px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: transform 0.2s, background 0.2s;
        }

        .action-item:hover {
            transform: translateX(5px);
            background: rgba(255,255,255,0.2);
        }

        .action-number {
            width: 28px;
            height: 28px;
            background: rgba(255,255,255,0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .arrow-connector {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            padding-top: 60px;
        }

        .arrow-line {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ff9800);
            border-radius: 2px;
            position: relative;
        }

        .arrow-line::after {
            content: '';
            position: absolute;
            right: -8px;
            top: -5px;
            border: 7px solid transparent;
            border-left-color: #ff9800;
        }

        .arrow-label {
            background: #ff9800;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            margin-top: 15px;
        }

        .return-flow {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            position: relative;
        }

        .return-box {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            padding: 20px 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .return-box h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .return-box p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .flow-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #ffd700;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
            margin-right: 5px;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .curved-arrow-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .curved-arrow-svg path {
            fill: none;
            stroke: #ff9800;
            stroke-width: 3;
            stroke-dasharray: 15, 8;
            marker-end: url(#arrowhead);
        }

        @media (max-width: 1100px) {
            .main-flow {
                flex-direction: column;
                align-items: center;
            }

            .user-box {
                max-width: 100%;
            }

            .arrow-connector {
                padding: 10px 0;
            }

            .arrow-line {
                width: 3px;
                height: 40px;
            }

            .arrow-line::after {
                right: -5px;
                top: auto;
                bottom: -8px;
                border-left-color: transparent;
                border-top-color: #ff9800;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 px-6 py-5">
                <h1 class="text-2xl font-bold text-white">🎓 Scholarship Management System Flow</h1>
                <p class="text-slate-300 mt-1">User Interactions & Data Flow Diagram</p>
            </div>

            <div class="p-6 bg-gradient-to-br from-purple-50 via-white to-blue-50">
                <!-- Legend -->
                <div class="flex flex-wrap gap-6 mb-8 justify-center">
                    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg" style="background: linear-gradient(135deg, #42a5f5, #2196f3);"></div>
                        <span class="font-medium text-gray-700">Student</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg" style="background: linear-gradient(135deg, #283593, #1a237e);"></div>
                        <span class="font-medium text-gray-700">Admin</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg" style="background: linear-gradient(135deg, #66bb6a, #43a047);"></div>
                        <span class="font-medium text-gray-700">Donor</span>
                    </div>
                </div>

                <!-- Flow Diagram -->
                <div class="flow-container">
                    <svg class="curved-arrow-svg" viewBox="0 0 1200 500" preserveAspectRatio="none">
                        <defs>
                            <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="10" refY="3.5" orient="auto">
                                <polygon points="0 0, 10 3.5, 0 7" fill="#ff9800"/>
                            </marker>
                        </defs>
                        <!-- Return arrow from Donor back to Student -->
                        <path d="M 900 320 Q 600 450, 300 320" marker-end="url(#arrowhead)"/>
                    </svg>

                    <div class="main-flow" style="position: relative; z-index: 1;">
                        <!-- Student Column -->
                        <div class="user-box student">
                            <div class="user-header">
                                <div class="user-icon">👨‍🎓</div>
                                <div class="user-title">Student</div>
                            </div>
                            <ul class="action-list">
                                <li class="action-item">
                                    <span class="action-number">1</span>
                                    <span>Register & Log In</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">2</span>
                                    <span>Complete Profile</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">3</span>
                                    <span>Upload Documents</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">4</span>
                                    <span>Apply for Scholarships</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">5</span>
                                    <span>Receive Notification</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">6</span>
                                    <span>Accept / Decline Award</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Arrow from Student to Admin -->
                        <div class="arrow-connector">
                            <div class="text-center">
                                <div class="arrow-line"></div>
                                <div class="arrow-label">📝 Apply</div>
                            </div>
                        </div>

                        <!-- Admin Column -->
                        <div class="user-box admin">
                            <div class="user-header">
                                <div class="user-icon">👨‍💼</div>
                                <div class="user-title">Admin</div>
                            </div>
                            <ul class="action-list">
                                <li class="action-item">
                                    <span class="action-number">1</span>
                                    <span>Receive Applications</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">2</span>
                                    <span>Review AI Scores & Rankings</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">3</span>
                                    <span>Verify Documents</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">4</span>
                                    <span>Approve / Reject / Shortlist</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">5</span>
                                    <span>Forward to Donors</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Arrow from Admin to Donor -->
                        <div class="arrow-connector">
                            <div class="text-center">
                                <div class="arrow-line"></div>
                                <div class="arrow-label">📋 Shortlist</div>
                            </div>
                        </div>

                        <!-- Donor Column -->
                        <div class="user-box donor">
                            <div class="user-header">
                                <div class="user-icon">🤝</div>
                                <div class="user-title">Donor</div>
                            </div>
                            <ul class="action-list">
                                <li class="action-item">
                                    <span class="action-number">1</span>
                                    <span>Receive Shortlisted Applicants</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">2</span>
                                    <span>Review Applications & AI Scores</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">3</span>
                                    <span>Review Admin Remarks</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">4</span>
                                    <span>Make Final Decision</span>
                                </li>
                                <li class="action-item">
                                    <span class="action-number">5</span>
                                    <span>Allocate & Release Funds 💰</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Return Flow -->
                    <div class="return-flow" style="position: relative; z-index: 1;">
                        <div class="return-box">
                            <h3>🔄 Result Notification</h3>
                            <p><span class="flow-indicator"></span>Scholarship decision sent to Student<br>Student accepts or declines the award</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                <p class="text-center text-sm text-gray-500">
                    🎯 Complete scholarship lifecycle from application to fund distribution
                </p>
            </div>
        </div>
    </div>
</body>
</html>