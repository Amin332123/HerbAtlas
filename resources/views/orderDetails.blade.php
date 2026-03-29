<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --teal: #66bfbf;
            --teal-dark: #4aa8a8;
            --light-teal: #eaf6f6;
            --light-teal-2: #f4fbfb;
            --coral: #f76b8a;
            --coral-dark: #ef476f;
            --dark: #2d3748;
            --dark-soft: #3f4d63;
            --gray: #6b7280;
            --gray-soft: #94a3b8;
            --border: rgba(102, 191, 191, 0.15);
            --shadow: 0 10px 35px rgba(102, 191, 191, 0.12);
            --shadow-soft: 0 4px 18px rgba(45, 55, 72, 0.08);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #e53e3e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(102, 191, 191, 0.08), transparent 26%),
                radial-gradient(circle at bottom right, rgba(247, 107, 138, 0.08), transparent 22%),
                var(--light-teal);
            color: var(--dark);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.92);
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 18px rgba(102, 191, 191, 0.12);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(14px);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 8px 22px rgba(102, 191, 191, 0.28);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--teal);
        }

        .page {
            max-width: 1120px;
            margin: 0 auto;
            padding: 48px 32px 84px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.92rem;
            margin-bottom: 28px;
            transition: color 0.25s ease;
        }

        .back-link i {
            transition: transform 0.25s ease;
        }

        .back-link:hover {
            color: var(--teal);
        }

        .back-link:hover i {
            transform: translateX(-4px);
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(300px, 0.9fr);
            gap: 28px;
            align-items: start;
        }

        .main-column,
        .side-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .order-hero {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-soft) 100%);
            border-radius: 30px;
            padding: 34px 36px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(45, 55, 72, 0.18);
        }

        .order-hero::before,
        .order-hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .order-hero::before {
            width: 320px;
            height: 320px;
            right: -90px;
            top: -80px;
            background: radial-gradient(circle, rgba(102, 191, 191, 0.18), transparent 68%);
        }

        .order-hero::after {
            width: 240px;
            height: 240px;
            right: 60px;
            bottom: -90px;
            background: radial-gradient(circle, rgba(247, 107, 138, 0.16), transparent 70%);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 26px;
        }

        .hero-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.56);
            margin-bottom: 8px;
        }

        .hero-order-id {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1.1;
        }

        .hero-subline {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .hero-subline span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .hero-status {
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .hero-status i {
            font-size: 0.8rem;
        }

        .hero-status.status-draft .status-dot {
            background: var(--warning);
        }

        .hero-status.status-confirmed .status-dot {
            background: var(--success);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.6s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(0.72);
            }
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            overflow: hidden;
        }

        .hero-stat {
            padding: 18px 16px;
            text-align: center;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-stat:last-child {
            border-right: none;
        }

        .hero-stat-label {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 6px;
        }

        .hero-stat-value {
            display: block;
            font-size: 1.32rem;
            font-weight: 800;
            color: white;
        }

        .hero-stat-value.highlight {
            color: #86efac;
        }

        .hero-stat-value.coral {
            color: #fda4af;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .section-card {
            padding: 26px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--teal);
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 0.92rem;
        }

        .products-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .product-row {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 18px;
            display: grid;
            grid-template-columns: 84px minmax(0, 1fr) auto;
            gap: 16px;
            align-items: center;
            box-shadow: var(--shadow-soft);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .product-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(102, 191, 191, 0.14);
        }

        .product-thumb-wrap {
            width: 84px;
            height: 84px;
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--light-teal), #ffffff);
            border: 1px solid rgba(102, 191, 191, 0.18);
        }

        .product-thumb-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-info {
            min-width: 0;
        }

        .product-name {
            font-size: 1.02rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .product-category-tag,
        .product-meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--light-teal-2);
            color: var(--teal-dark);
            border: 1px solid rgba(102, 191, 191, 0.14);
            padding: 5px 11px;
            border-radius: 999px;
            font-size: 0.74rem;
            font-weight: 600;
        }

        .product-pricing {
            text-align: right;
            min-width: 140px;
        }

        .price-unit {
            color: var(--gray);
            font-size: 0.8rem;
            margin-bottom: 7px;
        }

        .price-unit strong {
            color: var(--dark);
        }

        .price-qty {
            margin-bottom: 8px;
        }

        .qty-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            background: var(--light-teal);
            color: var(--teal-dark);
            border-radius: 999px;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .price-subtotal {
            display: block;
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--coral);
            margin-bottom: 12px;
        }

        .btn-primary,
        .btn-clear,
        .btn-remove-item,
        .btn-secondary-link {
            border: none;
            outline: none;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 15px 20px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
            color: white;
            font-size: 0.95rem;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(102, 191, 191, 0.28);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(102, 191, 191, 0.36);
        }

        .btn-clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            background: #fff5f5;
            color: var(--danger);
            border: 1px solid #fed7d7;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .btn-clear:hover {
            background: #fff0f0;
            border-color: #fc8181;
        }

        .btn-remove-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--danger);
            border: 1px solid rgba(229, 62, 62, 0.18);
            border-radius: 12px;
            padding: 8px 11px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .btn-remove-item:hover {
            background: #fff5f5;
            border-color: rgba(229, 62, 62, 0.32);
        }

        .btn-secondary-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--teal-dark);
            font-weight: 700;
            font-size: 0.9rem;
        }

        .btn-secondary-link:hover {
            color: var(--teal);
        }

        .summary-card {
            padding: 28px;
            position: sticky;
            top: 110px;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 22px;
            bottom: 22px;
            right: 0;
            width: 5px;
            border-radius: 999px 0 0 999px;
            background: linear-gradient(to bottom, var(--teal), var(--coral));
        }

        .summary-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.28rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .summary-title i {
            color: var(--teal);
            font-size: 1rem;
        }

        .summary-rows {
            display: flex;
            flex-direction: column;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.92rem;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row .label {
            color: var(--gray);
        }

        .summary-row .value {
            color: var(--dark);
            font-weight: 700;
            text-align: right;
        }

        .summary-row .value.success {
            color: var(--success);
        }

        .summary-total-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 16px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px dashed rgba(102, 191, 191, 0.24);
        }

        .total-label {
            font-family: 'Playfair Display', serif;
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--dark);
        }

        .total-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--coral);
            line-height: 1;
        }

        .currency {
            font-family: 'Outfit', sans-serif;
            font-size: 0.98rem;
            font-weight: 600;
            color: var(--gray);
        }

        .summary-note {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.08), rgba(247, 107, 138, 0.08));
            color: var(--dark-soft);
            font-size: 0.86rem;
            line-height: 1.55;
        }

        .actions-bar {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 22px;
        }

        .empty-box {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 28px;
            padding: 64px 36px;
            text-align: center;
            border: 2px dashed rgba(102, 191, 191, 0.28);
            box-shadow: var(--shadow);
        }

        .empty-box .icon {
            width: 88px;
            height: 88px;
            background: linear-gradient(135deg, var(--light-teal), #ffffff);
            border-radius: 50%;
            margin: 0 auto 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--teal);
            box-shadow: 0 10px 30px rgba(102, 191, 191, 0.16);
        }

        .empty-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .empty-text {
            color: var(--gray);
            font-size: 0.95rem;
            max-width: 480px;
            margin: 0 auto 24px;
            line-height: 1.7;
        }

        .empty-actions {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        footer {
            background: var(--dark);
            color: white;
            padding: 30px 60px;
            text-align: center;
            font-size: 0.87rem;
            opacity: 0.9;
        }

        @media (max-width: 980px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 14px 20px;
            }

            .page {
                padding: 28px 16px 60px;
            }

            .order-hero {
                padding: 26px 22px;
                border-radius: 24px;
            }

            .hero-top {
                flex-direction: column;
            }

            .hero-order-id {
                font-size: 1.7rem;
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-row {
                grid-template-columns: 74px minmax(0, 1fr);
            }

            .product-pricing {
                grid-column: 1 / -1;
                text-align: left;
                border-top: 1px solid var(--border);
                padding-top: 14px;
                margin-top: 2px;
            }
        }

        @media (max-width: 520px) {
            .hero-stats {
                grid-template-columns: 1fr;
            }

            .hero-stat {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .hero-stat:last-child {
                border-bottom: none;
            }

            .section-card,
            .summary-card {
                padding: 20px;
            }

            .empty-box {
                padding: 48px 22px;
            }
        }
    </style>
</head>
<body>
@php
    $isDraft = $isDraft ?? false;
    $orderItems = $orderItems ?? collect();
    $draftOrderToken = $draftOrderToken ?? (session('draft_order_token') ?: localStorageFallbackTokenPlaceholder());
@endphp
<header class="header">
    <a href="/" class="logo-container">
        <div class="logo-icon">HA</div>
        <span class="logo-text">Herb Atlas</span>
    </a>
</header>

<main class="page">
    <a href="{{ route('orders.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        <span>Back to Orders</span>
    </a>

    @if (!$isDraft && isset($order) && $order)
        @php
            $itemsCount = $orderItems->count();
            $totalQuantity = $orderItems->sum(function ($item) {
                return (int) data_get($item, 'pivot.quantity', 0);
            });
            $grandTotal = isset($order->calculated_total)
                ? (float) $order->calculated_total
                : (float) $orderItems->sum(function ($item) {
                    return (float) data_get($item, 'pivot.price', 0) * (int) data_get($item, 'pivot.quantity', 0);
                });
            $displayName = $order->name ?: ('Order #' . $order->id);
            $orderDate = optional($order->created_at)->format('d M Y');
            $orderDateFull = optional($order->created_at)->format('D, d F Y');
        @endphp

        <div class="content-grid">
            <div class="main-column">
                <section class="order-hero">
                    <div class="hero-content">
                        <div class="hero-top">
                            <div>
                                <div class="hero-label">Order Reference</div>
                                <div class="hero-order-id">#{{ $displayName }}</div>
                                <div class="hero-subline">
                                    <span><i class="far fa-calendar-alt"></i> {{ $orderDateFull ?: 'Recently created' }}</span>
                                    <span><i class="fas fa-seedling"></i> Herb Atlas Collection</span>
                                </div>
                            </div>
                            <div class="hero-status status-confirmed">
                                <span class="status-dot"></span>
                                Confirmed Order
                            </div>
                        </div>

                        <div class="hero-stats">
                            <div class="hero-stat">
                                <span class="hero-stat-label">Products</span>
                                <span class="hero-stat-value">{{ $itemsCount }}</span>
                            </div>
                            <div class="hero-stat">
                                <span class="hero-stat-label">Total Items</span>
                                <span class="hero-stat-value highlight">{{ $totalQuantity }}</span>
                            </div>
                            <div class="hero-stat">
                                <span class="hero-stat-label">Placed On</span>
                                <span class="hero-stat-value">{{ $orderDate ?: '—' }}</span>
                            </div>
                            <div class="hero-stat">
                                <span class="hero-stat-label">Order Total</span>
                                <span class="hero-stat-value coral">{{ number_format($grandTotal, 2) }} MAD</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="card section-card">
                    <div class="section-heading">
                        <div>
                            <div class="section-title">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Products in this Order</span>
                            </div>
                            <div class="section-subtitle">A curated summary of every item included in your completed purchase.</div>
                        </div>
                    </div>

                    @if ($itemsCount > 0)
                        <div class="products-list">
                            @foreach ($orderItems as $item)
                                @php
                                    $quantity = (int) data_get($item, 'pivot.quantity', 0);
                                    $unitPrice = (float) data_get($item, 'pivot.price', 0);
                                    $subtotal = $quantity * $unitPrice;
                                    $picture = optional($item->pictures->first())->url ?? optional($item->pictures->first())->image_path ?? optional($item->pictures->first())->path ?? $item->picture ?? 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=300';
                                    $categoryName = optional($item->category)->name ?? 'Natural Product';
                                @endphp
                                <article class="product-row">
                                    <div class="product-thumb-wrap">
                                        <img src="{{ $picture }}" alt="{{ $item->name }}" class="product-thumb-img">
                                    </div>

                                    <div class="product-info">
                                        <h3 class="product-name">{{ $item->name }}</h3>
                                        <div class="product-meta">
                                            <span class="product-category-tag">
                                                <i class="fas fa-leaf"></i>
                                                {{ $categoryName }}
                                            </span>
                                            <span class="product-meta-chip">
                                                <i class="fas fa-box-open"></i>
                                                Ordered item
                                            </span>
                                        </div>
                                    </div>

                                    <div class="product-pricing">
                                        <div class="price-unit">Unit: <strong>{{ number_format($unitPrice, 2) }} MAD</strong></div>
                                        <div class="price-qty">
                                            <span class="qty-badge">×{{ $quantity }}</span>
                                        </div>
                                        <span class="price-subtotal">{{ number_format($subtotal, 2) }} MAD</span>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-box" style="padding: 44px 24px;">
                            <div class="icon"><i class="fas fa-box-open"></i></div>
                            <h2 class="empty-title" style="font-size:1.3rem;">No order items found</h2>
                            <p class="empty-text" style="margin-bottom:0;">This order currently has no associated products to display.</p>
                        </div>
                    @endif
                </section>
            </div>

            <aside class="side-column">
                <section class="card summary-card">
                    <h2 class="summary-title">
                        <i class="fas fa-receipt"></i>
                        Order Summary
                    </h2>

                    <div class="summary-rows">
                        @foreach ($orderItems as $item)
                            @php
                                $quantity = (int) data_get($item, 'pivot.quantity', 0);
                                $lineTotal = (float) data_get($item, 'pivot.price', 0) * $quantity;
                            @endphp
                            <div class="summary-row">
                                <span class="label">{{ $item->name }} ×{{ $quantity }}</span>
                                <span class="value">{{ number_format($lineTotal, 2) }} MAD</span>
                            </div>
                        @endforeach
                        <div class="summary-row">
                            <span class="label">Shipping</span>
                            <span class="value success">Free</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Status</span>
                            <span class="value">Confirmed</span>
                        </div>
                    </div>

                    <div class="summary-total-row">
                        <span class="total-label">Grand Total</span>
                        <span class="total-value">{{ number_format($grandTotal, 2) }} <span class="currency">MAD</span></span>
                    </div>

                    <div class="summary-note">
                        Your order has been saved to your account history. For any issue regarding delivery or product availability, please contact the Herb Atlas support team.
                    </div>

                    <div class="actions-bar">
                        <a href="{{ route('orders.index') }}" class="btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Return to Orders
                        </a>
                    </div>
                </section>
            </aside>
        </div>
    @else
        <div id="draft-order-root"></div>
    @endif
</main>

<footer>&copy; 2026 Herb Atlas — Natural Products from Morocco</footer>

@if ($isDraft)
<script>
    const draftOrderRoot = document.getElementById('draft-order-root');
    const draftOrderStorageKey = 'herb_order';
    const draftOrderToken = @json($draftOrderToken ?: 'draft');
    const draftBackUrl = @json(route('orders.index'));
    const productsUrl = @json(url('/products'));

    function formatMoney(value) {
        const numericValue = Number(value || 0);
        return numericValue.toFixed(2);
    }

    function normalizeDraftItems(items) {
        if (!Array.isArray(items)) {
            return [];
        }

        return items
            .map(function (item) {
                const quantity = Math.max(1, parseInt(item.quantity, 10) || 1);
                const price = parseFloat(item.price) || 0;
                const productId = item.product_id || item.id;

                return {
                    id: productId,
                    product_id: productId,
                    name: item.name || 'Unnamed Product',
                    quantity: quantity,
                    price: price,
                    image: item.image || item.picture || 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=300',
                    category: item.category || 'Natural Product'
                };
            })
            .filter(function (item) {
                return item.product_id !== undefined && item.product_id !== null;
            });
    }

    function loadDraftOrder() {
        try {
            const raw = localStorage.getItem(draftOrderStorageKey);
            if (!raw) {
                return [];
            }

            return normalizeDraftItems(JSON.parse(raw));
        } catch (error) {
            return [];
        }
    }

    function saveDraftOrder(items) {
        localStorage.setItem(draftOrderStorageKey, JSON.stringify(items));
    }

    function removeDraftItem(productId) {
        const items = loadDraftOrder().filter(function (item) {
            return String(item.product_id) !== String(productId);
        });

        saveDraftOrder(items);
        renderDraftOrder();
    }

    function clearDraftOrder() {
        if (window.confirm('Remove all items from this draft order?')) {
            localStorage.removeItem(draftOrderStorageKey);
            localStorage.removeItem('herb_order_id');
            renderDraftOrder();
        }
    }

    function buildEmptyState() {
        draftOrderRoot.innerHTML = `
            <div class="empty-box">
                <div class="icon"><i class="fas fa-box-open"></i></div>
                <h2 class="empty-title">Your draft order is empty</h2>
                <p class="empty-text">There are no products saved in your pending order yet. Explore Herb Atlas products and add your favorite natural essentials to begin a new order.</p>
                <div class="empty-actions">
                    <a href="${productsUrl}" class="btn-primary" style="width:auto;padding-left:22px;padding-right:22px;">
                        <i class="fas fa-leaf"></i>
                        Browse Products
                    </a>
                    <a href="${draftBackUrl}" class="btn-secondary-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Orders
                    </a>
                </div>
            </div>
        `;
    }

    function renderDraftOrder() {
        const items = loadDraftOrder();

        if (!items.length) {
            buildEmptyState();
            return;
        }

        const itemsCount = items.length;
        const totalQuantity = items.reduce(function (sum, item) {
            return sum + item.quantity;
        }, 0);
        const subtotal = items.reduce(function (sum, item) {
            return sum + (item.price * item.quantity);
        }, 0);
        const shippingLabel = 'Free';
        const today = new Date().toLocaleDateString('en-GB', {
            weekday: 'short',
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        const productRows = items.map(function (item) {
            const lineTotal = item.price * item.quantity;

            return `
                <article class="product-row">
                    <div class="product-thumb-wrap">
                        <img src="${item.image}" alt="${item.name}" class="product-thumb-img" onerror="this.src='https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=300'">
                    </div>

                    <div class="product-info">
                        <h3 class="product-name">${item.name}</h3>
                        <div class="product-meta">
                            <span class="product-category-tag">
                                <i class="fas fa-leaf"></i>
                                ${item.category}
                            </span>
                            <span class="product-meta-chip">
                                <i class="fas fa-clock"></i>
                                Saved in draft
                            </span>
                        </div>
                        <button type="button" class="btn-remove-item" onclick="removeDraftItem('${item.product_id}')">
                            <i class="fas fa-trash-alt"></i>
                            Remove item
                        </button>
                    </div>

                    <div class="product-pricing">
                        <div class="price-unit">Unit: <strong>${formatMoney(item.price)} MAD</strong></div>
                        <div class="price-qty">
                            <span class="qty-badge">×${item.quantity}</span>
                        </div>
                        <span class="price-subtotal">${formatMoney(lineTotal)} MAD</span>
                    </div>
                </article>
            `;
        }).join('');

        const summaryRows = items.map(function (item) {
            return `
                <div class="summary-row">
                    <span class="label">${item.name} ×${item.quantity}</span>
                    <span class="value">${formatMoney(item.price * item.quantity)} MAD</span>
                </div>
            `;
        }).join('');

        draftOrderRoot.innerHTML = `
            <div class="content-grid">
                <div class="main-column">
                    <section class="order-hero">
                        <div class="hero-content">
                            <div class="hero-top">
                                <div>
                                    <div class="hero-label">Draft Reference</div>
                                    <div class="hero-order-id">#${draftOrderToken}</div>
                                    <div class="hero-subline">
                                        <span><i class="far fa-calendar-alt"></i> ${today}</span>
                                        <span><i class="fas fa-hourglass-half"></i> Waiting for checkout</span>
                                    </div>
                                </div>
                                <div class="hero-status status-draft">
                                    <span class="status-dot"></span>
                                    Pending Checkout
                                </div>
                            </div>

                            <div class="hero-stats">
                                <div class="hero-stat">
                                    <span class="hero-stat-label">Products</span>
                                    <span class="hero-stat-value">${itemsCount}</span>
                                </div>
                                <div class="hero-stat">
                                    <span class="hero-stat-label">Total Items</span>
                                    <span class="hero-stat-value highlight">${totalQuantity}</span>
                                </div>
                                <div class="hero-stat">
                                    <span class="hero-stat-label">Shipping</span>
                                    <span class="hero-stat-value highlight">${shippingLabel}</span>
                                </div>
                                <div class="hero-stat">
                                    <span class="hero-stat-label">Order Total</span>
                                    <span class="hero-stat-value coral">${formatMoney(subtotal)} MAD</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="card section-card">
                        <div class="section-heading">
                            <div>
                                <div class="section-title">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Products in this Draft</span>
                                </div>
                                <div class="section-subtitle">Review, remove, or refine the products saved before completing your order.</div>
                            </div>
                        </div>

                        <div class="products-list">${productRows}</div>
                    </section>
                </div>

                <aside class="side-column">
                    <section class="card summary-card">
                        <h2 class="summary-title">
                            <i class="fas fa-receipt"></i>
                            Order Summary
                        </h2>

                        <div class="summary-rows">
                            ${summaryRows}
                            <div class="summary-row">
                                <span class="label">Shipping</span>
                                <span class="value success">${shippingLabel}</span>
                            </div>
                            <div class="summary-row">
                                <span class="label">Status</span>
                                <span class="value">Draft</span>
                            </div>
                        </div>

                        <div class="summary-total-row">
                            <span class="total-label">Grand Total</span>
                            <span class="total-value">${formatMoney(subtotal)} <span class="currency">MAD</span></span>
                        </div>

                        <div class="summary-note">
                            This order is stored locally in your browser until checkout is completed. Removing items or clearing the draft updates it instantly.
                        </div>

                        <div class="actions-bar">
                            <button type="button" class="btn-primary btn-checkout" onclick="completeCheckout()">
                                <i class="fas fa-credit-card"></i>
                                Complete Order
                            </button>
                            <button type="button" class="btn-clear" onclick="clearDraftOrder()">
                                <i class="fas fa-trash-alt"></i>
                                Clear Draft Order
                            </button>
                        </div>
                    </section>
                </aside>
            </div>
        `;
    }

    window.removeDraftItem = removeDraftItem;
    window.clearDraftOrder = clearDraftOrder;

    renderDraftOrder();
</script>
@endif
</body>
</html>