<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - Dental Clinic DMD</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            text-align: center;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 750px;
            width: 100%;
            overflow: hidden;
        }
        
        /* Container Header */
        .container-header {
            background-color: #0D9488;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .container-header h1 {
            font-size: 24px;
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content {
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }
        
        .icon-container {
            width: 90px;
            height: 90px;
        }
        
        .icon-container svg {
            width: 100%;
            height: 100%;
            animation: bounce 2s infinite;
        }
        
        .notification-box {
            background-color: #e6fffa;
            border-radius: 8px;
            padding: 20px;
            border-left: 4px solid #0D9488;
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .notification-box h2 {
            color: #0D9488;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .notification-box p {
            color: #4b5563;
            font-size: 14px;
        }
        
        .content-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 100%;
        }
        
        .info-box {
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e6fffa;
            padding: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
        }
        
        .info-box p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-size: 14px;
            margin-bottom: 12px;
        }
        
        .btn svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .btn-primary {
            background-color: #0D9488;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            background-color: #0c8577;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background-color: white;
            color: #0D9488;
            border: 1px solid #e6fffa;
        }
        
        .btn-secondary:hover {
            background-color: #f0fdfa;
        }
        
        .success-message {
            background-color: #ecfdf5;
            color: #047857;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 12px;
            border: 1px solid #a7f3d0;
            display: flex;
            align-items: center;
        }
        
        .success-message svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .small-text {
            color: #6b7280;
            font-size: 12px;
            margin-top: 8px;
        }
        
        /* Container Footer */
        .container-footer {
            background-color: #f9fafb;
            padding: 15px;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #4b5563;
            font-size: 14px;
        }
        
        .footer-content svg {
            width: 18px;
            height: 18px;
            color: #0D9488;
        }
        
        /* Animations */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .group:hover .group-hover-translate {
            transform: translateX(4px);
            transition: transform 0.2s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .container {
                max-width: 100%;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .notification-box h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Container Header -->
        <div class="container-header">
            <h1>Ana Fatima Barroso Dental Clinic</h1>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Single Animated Icon -->
            <div class="icon-container">
                <svg fill="#0D9488" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5 3c-7.456 0-13.5 6.044-13.5 13.5s6.044 13.5 13.5 13.5 13.5-6.044 13.5-13.5-6.044-13.5-13.5-13.5zM15.5 27c-5.799 0-10.5-4.701-10.5-10.5s4.701-10.5 10.5-10.5 10.5 4.701 10.5 10.5-4.701 10.5-10.5 10.5zM15.5 10c-0.828 0-1.5 0.671-1.5 1.5v5.062c0 0.828 0.672 1.5 1.5 1.5s1.5-0.672 1.5-1.5v-5.062c0-0.829-0.672-1.5-1.5-1.5zM15.5 20c-0.828 0-1.5 0.672-1.5 1.5s0.672 1.5 1.5 1.5 1.5-0.672 1.5-1.5-0.672-1.5-1.5-1.5z"/>
                </svg>
            </div>
            
            <div class="notification-box">
                <h2>Email Verification Required</h2>
                <p>Please verify your email address to access your account.</p>
            </div>

            <div class="content-section">
                <div class="info-box">
                    <p>Click the button below to send a verification link to your email address.</p>
                    
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Verification Email
                        </button>
                    </form>
                    
                    <!-- Success message (uncomment to show) -->

                    <div class="success-message">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        A new verification link has been sent to your email address.
                    </div>

                    <div class="small-text">
                        <p>Didn't receive the email? Check your spam folder or try again.</p>
                    </div>
                </div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover-translate" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Container Footer -->
        <div class="container-footer">
            <div class="footer-content">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <span>© 2025 Ana Fatima Barroso Dental Clinic. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>