<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --shadow: rgba(102, 191, 191, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
            background: var(--light-teal);
        }

        /* Animated gradient background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(45deg, var(--teal), var(--light-teal), var(--white));
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating geometric shapes */
        .shape {
            position: absolute;
            opacity: 0.15;
            animation: floatShape 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            background: var(--coral);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            background: var(--teal);
            border-radius: 50%;
            top: 60%;
            right: 15%;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 180px;
            height: 180px;
            background: var(--coral);
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            bottom: 15%;
            left: 20%;
            animation-delay: -10s;
        }

        .shape-4 {
            width: 120px;
            height: 120px;
            background: var(--teal);
            border-radius: 20% 80% 80% 20% / 80% 20% 20% 80%;
            top: 30%;
            right: 25%;
            animation-delay: -15s;
        }

        @keyframes floatShape {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            25% {
                transform: translate(30px, -30px) rotate(90deg) scale(1.1);
            }

            50% {
                transform: translate(-20px, 40px) rotate(180deg) scale(0.9);
            }

            75% {
                transform: translate(40px, 20px) rotate(270deg) scale(1.05);
            }
        }

        /* Grid pattern overlay */
        .grid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(102, 191, 191, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(102, 191, 191, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(50px, 50px);
            }
        }

        /* Container */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px;
            position: relative;
        }

        /* Main card */
        .login-card {
            background: rgba(252, 254, 254, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow:
                0 50px 100px rgba(102, 191, 191, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.5);
            animation: cardEntrance 1s ease-out;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Left side - Decorative */
        .left-side {
            background: linear-gradient(135deg, var(--teal) 0%, #5ab0b0 50%, var(--coral) 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: rotatePattern 30s linear infinite;
        }

        @keyframes rotatePattern {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .decoration-content {
            position: relative;
            z-index: 1;
            color: var(--white);
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 2rem;
            letter-spacing: -2px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInLeft 1s ease-out 0.3s backwards;
        }

        .welcome-back {
            animation: fadeInLeft 1s ease-out 0.5s backwards;
        }

        .welcome-back h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -2px;
        }

        .welcome-back p {
            font-size: 1.15rem;
            font-weight: 300;
            opacity: 0.95;
            line-height: 1.7;
            max-width: 400px;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Decorative circles on left */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .deco-circle-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation: pulse 4s ease-in-out infinite;
        }

        .deco-circle-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation: pulse 4s ease-in-out infinite 1s;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.2;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.3;
            }
        }

        /* Right side - Form */
        .right-side {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeInRight 1s ease-out 0.4s backwards;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-header {
            margin-bottom: 3rem;
        }

        .form-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 0.8rem;
            letter-spacing: -1.5px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1.8rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.7rem;
            color: #374151;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            opacity: 0.4;
            transition: all 0.3s ease;
        }

        input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            font-size: 1rem;
            font-family: 'Outfit', sans-serif;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--white);
        }

        input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 5px rgba(102, 191, 191, 0.1);
            transform: translateY(-2px);
        }

        input:focus+.input-icon {
            opacity: 0.8;
            transform: translateY(-50%) scale(1.1);
        }

        input::placeholder {
            color: #9ca3af;
        }

        /* Forgot password */
        .forgot-password {
            text-align: right;
            margin-top: 0.5rem;
        }

        .forgot-link {
            color: var(--coral);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--coral);
            transition: width 0.3s ease;
        }

        .forgot-link:hover::after {
            width: 100%;
        }

        /* Submit button */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--coral) 0%, #ff7b9a 50%, #ffb5c5 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 15px 35px rgba(247, 107, 138, 0.3);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 45px rgba(247, 107, 138, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-2px);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 2.5rem 0;
            gap: 1rem;
        }

        .divider span {
            color: #9ca3af;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
        }

        /* Signup section */
        .signup-section {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.05), rgba(247, 107, 138, 0.05));
            border-radius: 16px;
            margin-top: 1.5rem;
        }

        .signup-section p {
            color: #6b7280;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .signup-link {
            color: var(--teal);
            text-decoration: none;
            font-weight: 700;
            position: relative;
            transition: all 0.3s ease;
            padding: 0 4px;
        }

        .signup-link::before {
            content: '';
            position: absolute;
            inset: -4px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            opacity: 0;
            border-radius: 6px;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .signup-link:hover::before {
            opacity: 0.1;
        }

        .signup-link:hover {
            color: #5ab0b0;
            transform: scale(1.05);
        }

        /* Responsive design */
        @media (max-width: 968px) {
            .login-card {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .left-side {
                padding: 40px;
                min-height: 300px;
            }

            .brand-logo {
                font-size: 2.5rem;
            }

            .welcome-back h1 {
                font-size: 2.5rem;
            }

            .welcome-back p {
                max-width: 100%;
            }

            .right-side {
                padding: 40px 30px;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 20px;
            }

            .login-card {
                border-radius: 30px;
            }

            .left-side {
                padding: 30px;
            }

            .brand-logo {
                font-size: 2rem;
            }

            .welcome-back h1 {
                font-size: 2rem;
            }

            .form-header h2 {
                font-size: 2rem;
            }

            .right-side {
                padding: 30px 20px;
            }
        }

        /* Loading animation for button */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="grid-overlay"></div>
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="left-side">
                <div class="deco-circle deco-circle-1"></div>
                <div class="deco-circle deco-circle-2"></div>
                <div class="decoration-content">
                    <div class="brand-logo">Herb Atlas</div>
                    <div class="welcome-back">
                        <h1>Welcome<br>Back!</h1>
                        <p>We're excited to see you again. Log in to continue your amazing journey with us.</p>
                    </div>
                </div>
            </div>

            <div class="right-side">
                <div class="form-header">
                    <h2>Login</h2>
                    <p>Enter your credentials to access your account</p>
                </div>

                <form id="loginForm" action="{{ route('login.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" placeholder="Enter your password"
                                required>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        
                        <div class="forgot-password">
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>

                        @if ($errors->any())
                            <div style="color: red; border: red; padding: 10px;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>

                    <button type="submit" class="submit-btn">Login</button>

                    <div class="divider">
                        <span>OR</span>
                    </div>


                    <div class="signup-section">
                        <p>Don't have an account? <a href="{{ route('register.show') }}" class="signup-link">Sign up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>


        // Add floating animation to input icons
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--teal)';
            });

            input.addEventListener('blur', function () {
                this.parentElement.querySelector('.input-icon').style.color = '';
            });
        });
    </script>
</body>

</html>