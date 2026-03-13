<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herb Atlas - Natural Beauty & Wellness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&family=Cormorant+Garamond:wght@300;400;600&display=swap" rel="stylesheet">
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
            background: var(--white);
            color: var(--dark);
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(252, 254, 254, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            border-bottom: 1px solid rgba(102, 191, 191, 0.1);
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
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
            box-shadow: 0 4px 15px rgba(102, 191, 191, 0.3);
            transition: all 0.3s ease;
        }

        .logo-icon:hover {
            transform: rotate(5deg) scale(1.05);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--teal);
            letter-spacing: -1px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .nav-btn {
            padding: 12px 28px;
            border: none;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login {
            background: transparent;
            color: var(--teal);
            border: 2px solid var(--teal);
        }

        .btn-login:hover {
            background: var(--teal);
            color: white;
            transform: translateY(-2px);
        }

        .btn-signup {
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            color: white;
            box-shadow: 0 4px 15px rgba(247, 107, 138, 0.3);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(247, 107, 138, 0.4);
        }

        /* Hero Section */
        .hero {
            padding: 150px 80px 80px;
            background: linear-gradient(135deg, var(--light-teal) 0%, var(--white) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(102, 191, 191, 0.1), transparent);
            border-radius: 50%;
            animation: floatCircle 20s infinite ease-in-out;
        }

        @keyframes floatCircle {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-50px, 50px); }
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            font-weight: 900;
            color: var(--teal);
            margin-bottom: 1.5rem;
            letter-spacing: -3px;
            line-height: 1.1;
            animation: fadeInUp 1s ease-out 0.2s backwards;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: var(--gray);
            font-weight: 300;
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            animation: fadeInUp 1s ease-out 0.4s backwards;
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

        /* Product Cards */
        .products-section {
            margin-top: 60px;
            animation: fadeInUp 1s ease-out 0.6s backwards;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 35px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(102, 191, 191, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 520px;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--teal), var(--coral));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 60px rgba(102, 191, 191, 0.2);
        }

        .product-image-container {
            width: 100%;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.03), rgba(247, 107, 138, 0.03));
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(247, 107, 138, 0.3);
        }

        .product-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .product-description {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 20px;
            flex: 1;
        }

        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--coral);
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #fbbf24;
            font-size: 0.9rem;
        }

        .product-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--teal), #5ab0b0);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 191, 191, 0.3);
        }

        /* About Section */
        .about-section {
            padding: 120px 80px;
            background: white;
            position: relative;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--teal);
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: -2px;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            color: var(--gray);
            line-height: 1.9;
            font-weight: 400;
        }

        .about-text p {
            margin-bottom: 1.5rem;
        }

        .about-features {
            display: grid;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            background: var(--light-teal);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 20px rgba(102, 191, 191, 0.15);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .feature-text h3 {
            font-size: 1.2rem;
            color: var(--teal);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .feature-text p {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 80px;
            background: linear-gradient(135deg, var(--teal), #5ab0b0);
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            opacity: 0.3;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 300;
            opacity: 0.95;
        }

        /* Contact Section */
        .contact-section {
            padding: 120px 80px;
            background: var(--light-teal);
        }

        .contact-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .contact-info h2 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--teal);
            margin-bottom: 1.5rem;
            font-weight: 900;
            letter-spacing: -2px;
        }

        .contact-info p {
            font-size: 1.2rem;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: white;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 20px rgba(102, 191, 191, 0.15);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(102, 191, 191, 0.15);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(102, 191, 191, 0.1);
        }

        .submit-contact-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(247, 107, 138, 0.4);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark) 0%, #1a202c 100%);
            color: white;
            padding: 80px 80px 40px;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--teal), transparent);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-logo-icon {
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
            letter-spacing: -1px;
        }

        .footer-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            background: rgba(102, 191, 191, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal);
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .social-icon:hover {
            background: var(--teal);
            color: white;
            transform: translateY(-3px);
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--teal);
            transform: translateX(5px);
            display: inline-block;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .navbar {
                padding: 20px 50px;
            }

            .hero {
                padding: 140px 50px 70px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
            }

            .about-section,
            .contact-section,
            .stats-section {
                padding: 90px 50px;
            }
        }

        @media (max-width: 1024px) {
            .navbar {
                padding: 20px 40px;
            }

            .hero {
                padding: 130px 40px 60px;
            }

            .hero-title {
                font-size: 3.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
                padding: 0 20px;
            }

            .product-card {
                min-height: 500px;
                padding: 30px;
            }

            .product-image-container {
                height: 240px;
            }

            .about-section,
            .contact-section,
            .stats-section {
                padding: 80px 40px;
            }

            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 35px;
            }

            .footer {
                padding: 60px 40px 30px;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 30px;
            }

            .hero {
                padding: 120px 30px 50px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 25px;
                padding: 0;
            }

            .product-card {
                min-height: 480px;
                max-width: 500px;
                margin: 0 auto;
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-title {
                font-size: 3rem;
            }
        }

        @media (max-width: 640px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .logo-text {
                font-size: 1.4rem;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .nav-buttons {
                gap: 10px;
            }

            .nav-btn {
                padding: 10px 20px;
                font-size: 0.85rem;
            }

            .hero {
                padding: 110px 20px 40px;
            }

            .hero-title {
                font-size: 2.5rem;
                letter-spacing: -2px;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .products-grid {
                padding: 0;
            }

            .product-card {
                min-height: 460px;
                padding: 25px;
            }

            .product-image-container {
                height: 220px;
            }

            .product-name {
                font-size: 1.5rem;
            }

            .product-description {
                font-size: 0.9rem;
            }

            .product-price {
                font-size: 1.4rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .about-section,
            .contact-section,
            .stats-section {
                padding: 60px 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .stat-number {
                font-size: 3rem;
            }

            .footer {
                padding: 40px 20px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .product-card {
                min-height: 440px;
                padding: 20px;
            }

            .product-image-container {
                height: 200px;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-icon">HA</div>
            <div class="logo-text">Herb Atlas</div>
        </div>
        <div class="nav-buttons">
            <a href="{{ route('login.show') }}" class="nav-btn btn-login">Login</a>
            <a href="{{ route('register.show') }}" class="nav-btn btn-signup">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Pure Nature,<br>Pure Beauty</h1>
            <p class="hero-subtitle">Discover the finest collection of natural herbs and botanical essences, carefully curated to enhance your wellness journey.</p>
            
            <!-- Product Cards -->
            <div class="products-section">
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=800&fit=crop&q=80" alt="Argan Oil" class="product-image">
                            <div class="product-badge">Bestseller</div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-name">Argan Oil</h3>
                            <p class="product-description">Pure Moroccan argan oil, rich in vitamin E and fatty acids for radiant skin and hair.</p>
                            <div class="product-footer">
                                <div class="product-price">$29.99</div>
                                <div class="product-rating">
                                    <span>⭐⭐⭐⭐⭐</span>
                                    <span>(248)</span>
                                </div>
                            </div>
                            <button class="product-btn">Add to Cart</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=800&fit=crop&q=80" alt="Lavender Essential Oil" class="product-image">
                            <div class="product-badge">Popular</div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-name">Lavender Essence</h3>
                            <p class="product-description">Calming lavender essential oil for relaxation, better sleep, and aromatherapy wellness.</p>
                            <div class="product-footer">
                                <div class="product-price">$24.99</div>
                                <div class="product-rating">
                                    <span>⭐⭐⭐⭐⭐</span>
                                    <span>(192)</span>
                                </div>
                            </div>
                            <button class="product-btn">Add to Cart</button>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=800&fit=crop&q=80i" alt="Tea Tree Oil" class="product-image">
                            <div class="product-badge">New</div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-name">Tea Tree Oil</h3>
                            <p class="product-description">Powerful natural antibacterial oil for clear skin and natural healing properties.</p>
                            <div class="product-footer">
                                <div class="product-price">$19.99</div>
                                <div class="product-rating">
                                    <span>⭐⭐⭐⭐⭐</span>
                                    <span>(156)</span>
                                </div>
                            </div>
                            <button class="product-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="section-container">
            <h2 class="section-title">About Herb Atlas</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>At Herb Atlas, we believe in the power of nature to transform and heal. Our journey began with a simple mission: to bring the world's finest botanical treasures directly to your doorstep.</p>
                    <p>Every product in our collection is ethically sourced, sustainably harvested, and rigorously tested to ensure the highest quality. We partner with local farmers and communities around the globe to preserve traditional knowledge while supporting fair trade practices.</p>
                    <p>From the sun-kissed fields of Provence to the ancient forests of Southeast Asia, we traverse the world to discover nature's most precious gifts for your wellness journey.</p>
                </div>
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">🌿</div>
                        <div class="feature-text">
                            <h3>100% Natural</h3>
                            <p>Pure botanical ingredients with no synthetic additives or harmful chemicals</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🌍</div>
                        <div class="feature-text">
                            <h3>Sustainably Sourced</h3>
                            <p>Ethically harvested with respect for nature and local communities</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✨</div>
                        <div class="feature-text">
                            <h3>Lab Tested</h3>
                            <p>Every batch is rigorously tested for purity and potency</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💚</div>
                        <div class="feature-text">
                            <h3>Cruelty Free</h3>
                            <p>Never tested on animals, always kind to all living beings</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100+</div>
                <div class="stat-label">Premium Products</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">25+</div>
                <div class="stat-label">Countries Sourced</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-content">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                <p>Have questions about our products or need personalized recommendations? We'd love to hear from you!</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <strong>Email</strong><br>
                            hello@herbatlas.com
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div>
                            <strong>Phone</strong><br>
                            +1 (555) 123-4567
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <strong>Location</strong><br>
                            123 Wellness Avenue, Nature City
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form>
                    <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" placeholder="john@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea placeholder="Tell us how we can help you..." required></textarea>
                    </div>
                    <button type="submit" class="submit-contact-btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-icon">HA</div>
                    <div class="footer-logo-text">Herb Atlas</div>
                </div>
                <p class="footer-description">Your trusted source for premium natural herbs and botanical essences. Bringing nature's finest gifts to your wellness journey since 2020.</p>
                <div class="social-links">
                    <div class="social-icon">📘</div>
                    <div class="social-icon">📷</div>
                    <div class="social-icon">🐦</div>
                    <div class="social-icon">📌</div>
                </div>
            </div>
            <div class="footer-column">
                <h3>Shop</h3>
                <div class="footer-links">
                    <a href="#">All Products</a>
                    <a href="#">Essential Oils</a>
                    <a href="#">Carrier Oils</a>
                    <a href="#">Herbal Blends</a>
                    <a href="#">New Arrivals</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Company</h3>
                <div class="footer-links">
                    <a href="#">About Us</a>
                    <a href="#">Our Story</a>
                    <a href="#">Sustainability</a>
                    <a href="#">Blog</a>
                    <a href="#">Careers</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Support</h3>
                <div class="footer-links">
                    <a href="#">Contact Us</a>
                    <a href="#">FAQ</a>
                    <a href="#">Shipping Info</a>
                    <a href="#">Returns</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Herb Atlas. All rights reserved. Crafted with love and nature.</p>
        </div>
    </footer>

    <script>
        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Add to cart animation
        document.querySelectorAll('.product-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const original = this.textContent;
                this.textContent = '✓ Added!';
                this.style.background = 'linear-gradient(135deg, #66bfbf, #5ab0b0)';
                setTimeout(() => {
                    this.textContent = original;
                    this.style.background = '';
                }, 2000);
            });
        });

        // Contact form submission
        document.querySelector('.contact-form form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for reaching out! We\'ll get back to you soon.');
            this.reset();
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.product-card, .feature-item, .stat-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
