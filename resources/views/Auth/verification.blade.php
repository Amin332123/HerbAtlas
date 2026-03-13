<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Herb Atlas</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, var(--light-teal) 0%, var(--white) 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(102, 191, 191, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.3rem;
            color: white;
            letter-spacing: -1px;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--teal);
            letter-spacing: -1px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .verification-card {
            background: white;
            border-radius: 30px;
            padding: 60px 50px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(102, 191, 191, 0.15);
            text-align: center;
        }

        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--light-teal), rgba(102, 191, 191, 0.2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
        }

        .icon-wrapper::before {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            border: 2px solid var(--teal);
            opacity: 0.2;
        }

        .icon {
            font-size: 3rem;
        }

        .verification-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--teal);
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .verification-message {
            font-size: 1.2rem;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .highlight {
            color: var(--teal);
            font-weight: 600;
        }

        .info-box {
            background: var(--light-teal);
            border-radius: 16px;
            padding: 20px;
            margin-top: 30px;
        }

        .info-text {
            font-size: 0.95rem;
            color: var(--gray);
            line-height: 1.6;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .back-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--teal);
            transition: width 0.3s ease;
        }

        .back-link:hover::after {
            width: 100%;
        }

        .back-link:hover {
            color: #5ab0b0;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark) 0%, #1a202c 100%);
            color: white;
            padding: 40px 60px 25px;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-bottom: 15px;
        }

        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.1rem;
        }

        .footer-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .verification-card {
                padding: 40px 30px;
            }

            .verification-title {
                font-size: 2rem;
            }

            .verification-message {
                font-size: 1.1rem;
            }

            .footer {
                padding: 30px 20px 20px;
            }
        }

        @media (max-width: 480px) {
            .logo-text {
                font-size: 1.5rem;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .verification-card {
                padding: 30px 20px;
            }

            .verification-title {
                font-size: 1.8rem;
            }

            .icon-wrapper {
                width: 80px;
                height: 80px;
            }

            .icon {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-container">
            <div class="logo-icon">HA</div>
            <div class="logo-text">Herb Atlas</div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="verification-card">
            <div class="icon-wrapper">
                <div class="icon">📧</div>
            </div>
            <h1 class="verification-title">Check Your Email</h1>
            <p class="verification-message">
                Please check your email to <span class="highlight">verify your account</span>
            </p>
            <div class="info-box">
                <p class="info-text">
                    We've sent a verification link to your email address. Click the link in the email to activate your
                    account and get started with Herb Atlas.
                </p>
            </div>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit">Resend Verification Email</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <div class="footer-logo-icon">HA</div>
                <div class="footer-logo-text">Herb Atlas</div>
            </div>
            <p class="footer-description">Your trusted source for premium natural herbs and botanical essences.</p>
            <div class="footer-bottom">
                <p>&copy; 2026 Herb Atlas. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>