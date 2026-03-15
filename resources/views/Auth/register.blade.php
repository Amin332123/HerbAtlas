<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap"
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
        }

        /* Diagonal split background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-left {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--teal) 0%, #5ab0b0 100%);
            clip-path: polygon(0 0, 55% 0, 45% 100%, 0 100%);
            animation: slideInLeft 1s ease-out;
        }

        .bg-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--light-teal) 0%, var(--white) 100%);
            clip-path: polygon(55% 0, 100% 0, 100% 100%, 45% 100%);
            animation: slideInRight 1s ease-out;
        }

        /* Decorative elements */
        .circle-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(247, 107, 138, 0.1);
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(102, 191, 191, 0.08);
            bottom: -80px;
            right: 100px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.05);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Container */
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            padding: 40px 80px;
            position: relative;
        }

        /* Left content */
        .left-content {
            flex: 1;
            max-width: 500px;
            color: var(--white);
            animation: fadeInUp 1s ease-out 0.3s backwards;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            letter-spacing: -1px;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -2px;
        }

        .welcome-text p {
            font-size: 1.2rem;
            font-weight: 300;
            opacity: 0.95;
            line-height: 1.6;
        }

        /* Form container */
        .form-container {
            background: var(--white);
            border-radius: 30px;
            padding: 50px 45px;
            box-shadow: 0 30px 80px var(--shadow);
            max-width: 480px;
            width: 100%;
            position: relative;
            animation: fadeInUp 1s ease-out 0.5s backwards;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 400;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
        }

        input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(102, 191, 191, 0.1);
            transform: translateY(-2px);
        }

        input::placeholder {
            color: #9ca3af;
        }

        /* Submit button */
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--coral) 0%, #ff7b9a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 10px 30px rgba(247, 107, 138, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(247, 107, 138, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        /* Login link */
        .login-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .login-section p {
            color: #6b7280;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .login-link {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .login-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--teal);
            transition: width 0.3s ease;
        }

        .login-link:hover::after {
            width: 100%;
        }

        .login-link:hover {
            color: #5ab0b0;
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                justify-content: center;
                padding: 40px;
                gap: 3rem;
            }

            .left-content {
                text-align: center;
                max-width: 100%;
            }

            .bg-left {
                clip-path: polygon(0 0, 100% 0, 100% 50%, 0 40%);
            }

            .bg-right {
                clip-path: polygon(0 50%, 100% 40%, 100% 100%, 0 100%);
            }

            .welcome-text h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 20px;
            }

            .form-container {
                padding: 35px 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .welcome-text h1 {
                font-size: 2rem;
            }

            .logo {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="bg-left"></div>
        <div class="bg-right"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
    </div>

    <div class="container">
        <div class="left-content">
            <div class="logo">Herb Atlas</div>
            <div class="welcome-text">
                <h1>Start your journey with us</h1>
                <p>Join thousands of users who trust us with their experience. Create an account and unlock amazing
                    features.</p>
            </div>
        </div>

        <div class="form-container">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Please fill in your information below</p>
            </div>

            <form id="signupForm" action="{{ route('register.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="John" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Doe" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="john.doe@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••">
                </div>

                <button type="submit" class="submit-btn">Create Account</button>

                @if ($errors->any())
                    <div style="color: red; border: 1px solid red; padding: 10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="login-section">
                    <p>Already have an account? <a href="{{ route('login') }}" class="login-link">Log in</a></p>
                </div>
            </form>
        </div>
    </div>


</body>

</html>