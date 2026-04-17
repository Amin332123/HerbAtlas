<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name ?? 'Product Details' }} - Herb Atlas</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
            --shadow: 0 10px 30px rgba(102, 191, 191, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light-teal);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(102, 191, 191, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: white;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--teal);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .nav-link {
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--teal);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart-btn {
            position: relative;
            background: var(--light-teal);
            color: var(--teal);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .cart-btn:hover {
            background: var(--teal);
            color: white;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--coral);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(247, 107, 138, 0.3);
        }

        .toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 1100;
        }

        .toast {
            padding: 15px 25px;
            background: white;
            border-radius: 12px;
            border-left: 5px solid var(--teal);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            animation: slideIn 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .breadcrumb {
            max-width: 1300px;
            margin: 0 auto;
            padding: 25px 60px;
        }

        .breadcrumb-list {
            display: flex;
            align-items: center;
            gap: 12px;
            list-style: none;
            flex-wrap: wrap;
        }

        .breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .breadcrumb-list li:not(:last-child)::after {
            content: '/';
            color: var(--gray);
            opacity: 0.5;
        }

        .breadcrumb-list a {
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .breadcrumb-list a:hover {
            color: var(--teal);
        }

        .breadcrumb-list .current {
            color: var(--teal);
            font-weight: 600;
        }

        .main-content {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 60px 60px;
        }

        .product-details-container {
            display: flex;
            gap: 50px;
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .product-gallery {
            flex: 1;
            max-width: 550px;
        }

        .main-image-container {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            background: var(--light-teal);
            margin-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s;
        }

        .main-image-container:hover .main-image {
            transform: scale(1.03);
        }

        .image-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--teal);
            color: white;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .wishlist-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            color: var(--coral);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .wishlist-btn:hover {
            background: var(--coral);
            color: white;
            transform: scale(1.1);
        }

        .wishlist-btn.active {
            background: var(--coral);
            color: white;
        }

        .thumbnail-gallery {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 5px;
        }

        .thumbnail {
            width: 90px;
            height: 90px;
            border-radius: 16px;
            object-fit: cover;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
            flex-shrink: 0;
        }

        .thumbnail:hover {
            border-color: rgba(102, 191, 191, 0.5);
            transform: translateY(-3px);
        }

        .thumbnail.active {
            border-color: var(--teal);
            box-shadow: 0 4px 15px rgba(102, 191, 191, 0.3);
        }

        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--light-teal);
            color: var(--teal);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
            width: fit-content;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .product-price-section {
            display: flex;
            align-items: baseline;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(102, 191, 191, 0.15);
        }

        .product-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--coral);
        }

        .product-price span {
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--gray);
        }

        .product-description {
            margin-bottom: 30px;
        }

        .product-description h3 {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .product-description h3 i {
            color: var(--teal);
        }

        .product-description p {
            color: var(--gray);
            font-size: 1rem;
            line-height: 1.8;
        }

        .product-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: var(--light-teal);
            border-radius: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 150px;
        }

        .meta-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal);
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(102, 191, 191, 0.1);
        }

        .meta-text {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 0.8rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-weight: 700;
            color: var(--dark);
        }

        .meta-value.in-stock {
            color: var(--teal);
        }

        .meta-value.low-stock {
            color: var(--coral);
        }

        .quantity-section {
            margin-bottom: 30px;
        }

        .quantity-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 12px;
            display: block;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 5px;
            background: var(--light-teal);
            border-radius: 14px;
            padding: 5px;
            width: fit-content;
        }

        .quantity-btn {
            width: 45px;
            height: 45px;
            background: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--teal);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: var(--teal);
            color: white;
        }

        .quantity-btn:disabled {
            background: var(--gray);
            color: white;
            cursor: not-allowed;
        }

        .quantity-btn:disabled:hover {
            background: var(--gray);
            color: white;
        }

        .quantity-input {
            width: 70px;
            height: 45px;
            text-align: center;
            border: none;
            background: white;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            font-family: 'Outfit', sans-serif;
        }

        .quantity-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.2);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: auto;
        }

        .add-to-cart-btn,
        .buy-now-btn {
            padding: 18px 35px;
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s;
        }

        .add-to-cart-btn {
            flex: 1;
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            box-shadow: 0 6px 20px rgba(102, 191, 191, 0.35);
        }

        .buy-now-btn {
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            box-shadow: 0 6px 20px rgba(247, 107, 138, 0.35);
        }

        .add-to-cart-btn:hover,
        .buy-now-btn:hover {
            transform: translateY(-3px);
        }

        .features-section {
            margin-top: 50px;
        }

        .features-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .feature-card {
            flex: 1;
            min-width: 200px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(102, 191, 191, 0.08);
            transition: all 0.3s;
            border: 1px solid rgba(102, 191, 191, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: var(--teal);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--light-teal);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.5rem;
            color: var(--teal);
        }

        .feature-card h4 {
            color: var(--dark);
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .feature-card p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            padding: 10px 0;
            transition: color 0.3s;
        }

        .back-btn:hover {
            color: var(--teal);
        }

        .back-btn i {
            transition: transform 0.3s;
        }

        .back-btn:hover i {
            transform: translateX(-5px);
        }

        @media (max-width: 1024px) {
            .product-details-container {
                flex-direction: column;
                gap: 30px;
            }

            .product-gallery {
                max-width: 100%;
            }

            .main-image {
                height: 400px;
            }

            .product-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .nav-menu {
                display: none;
            }

            .breadcrumb,
            .main-content {
                padding-left: 20px;
                padding-right: 20px;
            }

            .product-details-container {
                padding: 25px;
                border-radius: 24px;
            }

            .main-image {
                height: 300px;
            }

            .thumbnail {
                width: 70px;
                height: 70px;
            }

            .product-title {
                font-size: 1.75rem;
            }

            .product-price {
                font-size: 2rem;
            }

            .product-meta-info {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }

            .features-grid {
                flex-direction: column;
            }

            .feature-card {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo-container">
            <div class="logo-icon">HA</div>
            <span class="logo-text">Herb Atlas</span>
        </div>

        <nav class="nav-menu">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ url('/products') }}" class="nav-link active">Products</a>
            <a href="{{ url('/categories') }}" class="nav-link">Categories</a>
            <a href="{{ url('/about') }}" class="nav-link">About</a>
        </nav>

        <div class="header-actions">
            <button class="cart-btn" onclick="window.location.href='{{ route('order.draft') }}'">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </button>
            <a href="{{ url('/logout') }}" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </header>

    <div class="toast-container" id="toastContainer">
        @if(session('success'))
            <div class="toast">
                <i class="fas fa-check-circle" style="color: var(--teal)"></i>
                {{ session('success') }}
            </div>
        @endif
    </div>

    <main class="main-content">
        <a href="{{ url('/products') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>

        <div class="product-details-container">
            <div class="product-gallery">
                <div class="main-image-container">
                    @if($product->category)
                        <span class="image-badge">{{ $product->category->title }}</span>
                    @endif
                    <button class="wishlist-btn" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </button>
                    <img src="{{ asset('storage/' . $product->pictures->first()->img_path) }}" class="main-image" id="mainImage" alt="{{ $product->name }}">
                </div>

                @if($product->pictures && $product->pictures->count() > 0)
                    <div class="thumbnail-gallery">
                        @foreach($product->pictures as $index => $picture)
                            <img src="{{ asset('storage/' . $picture->img_path) }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage(this)" alt="{{ $product->name }}">
                        @endforeach
                    </div>
                @else
                    <div class="thumbnail-gallery">
                        <img src="{{ $product->picture ? asset('storage/' . $product->picture->img_path) : 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=150' }}" class="thumbnail active" alt="{{ $product->name }}">
                    </div>
                @endif
            </div>

            <div class="product-info">
                @if($product->category)
                    <span class="product-category">
                        <i class="fas fa-leaf"></i> {{ $product->category->title }}
                    </span>
                @endif

                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="product-price-section">
                    <span class="product-price">{{ number_format($product->price, 2) }} <span>MAD</span></span>
                </div>

                <div class="product-description">
                    <h3><i class="fas fa-info-circle"></i> Description</h3>
                    <p>{{ $product->description ?? 'A premium quality herbal product carefully sourced and prepared to provide maximum benefits. Perfect for natural health enthusiasts looking for authentic herbal remedies.' }}</p>
                </div>

                <div class="product-meta-info">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="meta-text">
                            <span class="meta-label">Availability</span>
                            @if(($product->stock ?? 0) > 20)
                                <span class="meta-value in-stock">In Stock ({{ $product->stock }})</span>
                            @elseif(($product->stock ?? 0) > 0)
                                <span class="meta-value low-stock">Low Stock ({{ $product->stock }})</span>
                            @else
                                <span class="meta-value low-stock">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="meta-text">
                            <span class="meta-label">Delivery</span>
                            <span class="meta-value">2-4 Days</span>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="meta-text">
                            <span class="meta-label">Guarantee</span>
                            <span class="meta-value">100% Natural</span>
                        </div>
                    </div>
                </div>

                <div class="quantity-section">
                    <label class="quantity-label">Quantity</label>
                    <div class="quantity-selector">
                        <button class="quantity-btn" id="decreaseBtn" onclick="decreaseQuantity()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="quantity-input" id="quantityInput" value="1" min="1" max="{{ $product->stock ?? 100 }}" onchange="updateQuantityButtons()">
                        <button class="quantity-btn" id="increaseBtn" onclick="increaseQuantity()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="add-to-cart-btn" onclick="addToCart()">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button class="buy-now-btn" onclick="buyNow()">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                </div>
            </div>
        </div>

        <section class="features-section">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4>100% Natural</h4>
                    <p>Pure organic ingredients with no artificial additives</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4>Fast Delivery</h4>
                    <p>Quick and secure shipping to your doorstep</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Premium Quality</h4>
                    <p>Carefully selected and tested for excellence</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Dedicated customer service always ready to help</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        const DRAFT_ORDER_KEY = 'herb_draft_cart';

        function safeParseJson(raw) {
            try {
                const parsed = JSON.parse(raw);
                return Array.isArray(parsed) ? parsed : [];
            } catch (error) {
                return [];
            }
        }

        function getProductImageUrl() {
            @if($product->pictures && $product->pictures->count() > 0)
                return @json(asset('storage/' . $product->pictures->first()->img_path));
            @elseif($product->picture)
                return @json(asset('storage/' . $product->picture->img_path));
            @else
                return 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800';
            @endif
        }

        function normalizeDraftItem(item) {
            const id = item && (item.id ?? item.product_id ?? item.productId ?? item.product?.id);
            return {
                id: id !== undefined && id !== null ? Number(id) : 0,
                name: String(item?.name ?? item?.product?.name ?? @json($product->name)).trim() || @json($product->name),
                price: Number.parseFloat(item?.price ?? item?.unit_price ?? @json($product->price)) || 0,
                quantity: Math.max(Number.parseInt(item?.quantity ?? 1, 10) || 1, 1),
                image: String(item?.image ?? item?.picture ?? getProductImageUrl()),
                category: String(item?.category ?? item?.product?.category?.title ?? @json($product->category->title ?? '')),
                stock: Number.parseInt(item?.stock ?? @json($product->stock ?? 0), 10) || 0
            };
        }

        function getDraftOrder() {
            const raw = localStorage.getItem(DRAFT_ORDER_KEY);
            const parsed = raw ? safeParseJson(raw) : [];
            const normalized = parsed
                .map(normalizeDraftItem)
                .filter(item => item.id && item.quantity > 0 && item.price >= 0);

            if (JSON.stringify(parsed) !== JSON.stringify(normalized)) {
                localStorage.setItem(DRAFT_ORDER_KEY, JSON.stringify(normalized));
            }

            return normalized;
        }

        function updateBadge() {
            const order = getDraftOrder();
            const badge = document.getElementById('cartBadge');
            if (badge) {
                badge.textContent = order.reduce((count, item) => count + item.quantity, 0);
            }
        }

        function persistCart(items) {
            localStorage.setItem(DRAFT_ORDER_KEY, JSON.stringify(items));
            updateBadge();
            window.HerbAtlasDraftCart = window.HerbAtlasDraftCart || {};
            window.HerbAtlasDraftCart.items = items;
            window.HerbAtlasDraftCart.updateDraftCartBadge?.();
        }

        function addToCart() {
            const quantityInput = document.getElementById('quantityInput');
            const quantity = Math.max(parseInt(quantityInput.value, 10) || 1, 1);

            const product = normalizeDraftItem({
                id: @json($product->id),
                name: @json($product->name),
                price: @json($product->price),
                quantity: quantity,
                image: getProductImageUrl(),
                category: @json($product->category->title ?? ''),
                stock: @json($product->stock ?? 0)
            });

            const currentOrder = getDraftOrder();
            const existingIndex = currentOrder.findIndex(item => String(item.id) === String(product.id));

            if (existingIndex > -1) {
                currentOrder[existingIndex].quantity += product.quantity;
            } else {
                currentOrder.push(product);
            }

            persistCart(currentOrder);
            showToast(`Added ${quantity} item(s) to cart!`);
        }

        function buyNow() {
            addToCart();
            window.location.href = @json(route('order.draft'));
        }

        function changeMainImage(thumbnail) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = thumbnail.src.replace('w=150', 'w=600');
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantityInput');
            const currentValue = parseInt(input.value, 10) || 1;
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateQuantityButtons();
            }
        }

        function increaseQuantity() {
            const input = document.getElementById('quantityInput');
            const currentValue = parseInt(input.value, 10) || 1;
            const maxValue = parseInt(input.max, 10) || 1;
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
                updateQuantityButtons();
            }
        }

        function updateQuantityButtons() {
            const input = document.getElementById('quantityInput');
            const decreaseBtn = document.getElementById('decreaseBtn');
            const increaseBtn = document.getElementById('increaseBtn');
            const currentValue = Math.max(parseInt(input.value, 10) || 1, 1);
            const minValue = parseInt(input.min, 10) || 1;
            const maxValue = parseInt(input.max, 10) || 1;

            input.value = currentValue;
            decreaseBtn.disabled = currentValue <= minValue;
            increaseBtn.disabled = currentValue >= maxValue;
        }

        function toggleWishlist(btn) {
            btn.classList.toggle('active');
            const icon = btn.querySelector('i');
            if (btn.classList.contains('active')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                showToast('Added to wishlist!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                showToast('Removed from wishlist');
            }
        }

        function showToast(message) {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `<i class="fas fa-check-circle" style="color: var(--teal)"></i> ${message}`;
            toastContainer.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        window.HerbAtlasDraftCart = window.HerbAtlasDraftCart || {};
        window.HerbAtlasDraftCart.getDraftCartItems = getDraftOrder;
        window.HerbAtlasDraftCart.setDraftCartItems = function (items) {
            persistCart(Array.isArray(items) ? items.map(normalizeDraftItem) : []);
        };
        window.HerbAtlasDraftCart.clearDraftCart = function () {
            localStorage.removeItem(DRAFT_ORDER_KEY);
            updateBadge();
            window.HerbAtlasDraftCart.items = [];
            window.HerbAtlasDraftCart.updateDraftCartBadge?.();
        };
        window.HerbAtlasDraftCart.updateDraftCartBadge = updateBadge;
        window.HerbAtlasDraftCart.storageKey = DRAFT_ORDER_KEY;

        document.addEventListener('DOMContentLoaded', function () {
            updateBadge();
            updateQuantityButtons();
        });
    </script>
</body>
</html>
