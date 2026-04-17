<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
            --soft-border: rgba(102, 191, 191, 0.16);
            --shadow: 0 12px 32px rgba(102, 191, 191, 0.12);
            --shadow-strong: 0 18px 42px rgba(102, 191, 191, 0.18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(102, 191, 191, 0.16), transparent 30%),
                radial-gradient(circle at top right, rgba(247, 107, 138, 0.10), transparent 24%),
                var(--light-teal);
            color: var(--dark);
            min-height: 100vh;
        }

        .main-content {
            max-width: 1440px;
            margin: 0 auto;
            padding: 34px 60px 56px;
        }

        .dashboard-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.98), rgba(102, 191, 191, 0.92) 40%, rgba(247, 107, 138, 0.96));
            color: white;
            border-radius: 32px;
            padding: 34px 36px;
            box-shadow: 0 18px 40px rgba(102, 191, 191, 0.22);
            margin-bottom: 28px;
            isolation: isolate;
        }

        .dashboard-hero::before,
        .dashboard-hero::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            z-index: -1;
        }

        .dashboard-hero::before {
            width: 320px;
            height: 320px;
            background: rgba(255, 255, 255, 0.09);
            right: -120px;
            top: -130px;
        }

        .dashboard-hero::after {
            width: 260px;
            height: 260px;
            background: rgba(255, 255, 255, 0.07);
            left: -100px;
            bottom: -120px;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .hero-copy {
            max-width: 760px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 16px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 4vw, 3.9rem);
            line-height: 1.02;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .hero-subtitle {
            max-width: 700px;
            font-size: 1.02rem;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.92);
        }

        .hero-meta {
            display: grid;
            gap: 12px;
            min-width: 280px;
            flex: 1;
            max-width: 360px;
        }

        .hero-meta-card {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 22px;
            padding: 18px 18px;
            backdrop-filter: blur(8px);
        }

        .hero-meta-label {
            font-size: 0.84rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            opacity: 0.88;
            margin-bottom: 8px;
        }

        .hero-meta-value {
            font-size: 1.45rem;
            font-weight: 800;
        }

        .hero-meta-note {
            margin-top: 6px;
            font-size: 0.92rem;
            opacity: 0.92;
            line-height: 1.5;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .kpi-card {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            padding: 22px 20px;
            box-shadow: var(--shadow);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-strong);
        }

        .kpi-label {
            color: var(--gray);
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .kpi-value {
            font-size: 2rem;
            line-height: 1;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 10px;
            word-break: break-word;
        }

        .kpi-caption {
            color: var(--gray);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .kpi-card.accent-teal .kpi-value { color: var(--teal); }
        .kpi-card.accent-coral .kpi-value { color: var(--coral); }

        .analytics-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 22px;
            margin-bottom: 28px;
        }

        .panel {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid var(--soft-border);
            border-radius: 28px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 26px 28px 18px;
            border-bottom: 1px solid rgba(102, 191, 191, 0.10);
        }

        .panel-title-wrap {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: var(--dark);
            font-weight: 800;
        }

        .panel-subtitle {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .panel-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--light-teal);
            color: var(--teal);
            border-radius: 999px;
            padding: 10px 14px;
            font-size: 0.9rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .analytics-cards {
            padding: 24px 28px 28px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .analytics-card {
            background: linear-gradient(180deg, #ffffff 0%, #fbffff 100%);
            border: 1px solid rgba(102, 191, 191, 0.14);
            border-radius: 22px;
            padding: 20px;
            min-height: 132px;
        }

        .analytics-card h4 {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 10px;
        }

        .analytics-stat {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 10px;
            word-break: break-word;
        }

        .analytics-desc {
            color: var(--gray);
            font-size: 0.94rem;
            line-height: 1.55;
        }

        .analytics-card.highlight {
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.10), rgba(247, 107, 138, 0.08));
        }

        .mini-insights {
            display: grid;
            gap: 14px;
            padding: 24px 28px 28px;
        }

        .insight-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: #fbffff;
            border: 1px solid rgba(102, 191, 191, 0.13);
            border-radius: 20px;
            padding: 18px 18px;
        }

        .insight-copy {
            min-width: 0;
        }

        .insight-label {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .insight-text {
            color: var(--gray);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .insight-value {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--teal);
            white-space: nowrap;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 22px;
        }

        .list-panel {
            padding: 22px 26px 26px;
        }

        .list-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .list-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--dark);
        }

        .list-link {
            color: var(--teal);
            font-weight: 700;
            text-decoration: none;
        }

        .list-link:hover {
            text-decoration: underline;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid rgba(102, 191, 191, 0.14);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(102, 191, 191, 0.08);
        }

        .product-image {
            width: 100%;
            height: 165px;
            object-fit: cover;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.12), rgba(247, 107, 138, 0.08));
        }

        .product-body {
            padding: 16px;
        }

        .product-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--light-teal);
            color: var(--teal);
            font-size: 0.78rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 1.08rem;
            line-height: 1.35;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            word-break: break-word;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 12px;
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .product-price {
            font-weight: 800;
            color: var(--coral);
            font-size: 1.05rem;
        }

        .product-description {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.55;
            margin-top: 10px;
        }

        .orders-list {
            display: grid;
            gap: 14px;
            padding: 0 26px 26px;
        }

        .order-card {
            background: #ffffff;
            border: 1px solid rgba(102, 191, 191, 0.14);
            border-radius: 22px;
            padding: 18px 18px;
            box-shadow: 0 8px 18px rgba(102, 191, 191, 0.07);
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 12px;
        }

        .order-id {
            font-weight: 800;
            font-size: 1.04rem;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .order-customer {
            color: var(--gray);
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .order-chip {
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 0.8rem;
            font-weight: 800;
            background: var(--light-teal);
            color: var(--teal);
            white-space: nowrap;
        }

        .order-details {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 16px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .order-total {
            font-weight: 800;
            color: var(--coral);
        }

        .empty-state {
            padding: 24px;
            border: 1px dashed rgba(102, 191, 191, 0.28);
            border-radius: 22px;
            text-align: center;
            color: var(--gray);
            background: #fbffff;
        }

        .empty-state strong {
            display: block;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .top-products {
            padding: 0 28px 28px;
        }

        .top-product-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(102, 191, 191, 0.10);
        }

        .top-product-row:last-child {
            border-bottom: none;
        }

        .top-product-rank {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.14), rgba(247, 107, 138, 0.12));
            color: var(--dark);
            font-weight: 800;
            flex-shrink: 0;
        }

        .top-product-name {
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .top-product-meta {
            color: var(--gray);
            font-size: 0.92rem;
        }

        .top-product-value {
            margin-left: auto;
            text-align: right;
            font-weight: 800;
            color: var(--coral);
        }

        @media (max-width: 1200px) {
            .kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .analytics-grid,
            .section-grid {
                grid-template-columns: 1fr;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 22px 18px 34px;
            }

            .dashboard-hero {
                padding: 24px 20px;
                border-radius: 26px;
            }

            .panel-header,
            .analytics-cards,
            .mini-insights,
            .list-panel,
            .orders-list,
            .top-products {
                padding-left: 18px;
                padding-right: 18px;
            }

            .kpi-grid,
            .analytics-cards,
            .product-grid {
                grid-template-columns: 1fr;
            }

            .hero-top {
                flex-direction: column;
            }

            .hero-meta {
                max-width: none;
                width: 100%;
            }

            .order-top {
                flex-direction: column;
            }

            .top-product-value {
                margin-left: 0;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <x-header />

    <main class="main-content">
        <section class="dashboard-hero">
            <div class="hero-top">
                <div class="hero-copy">
                    <div class="eyebrow">
                        <span>•</span>
                        <span>Herb Atlas Admin Dashboard</span>
                    </div>
                    <h1 class="hero-title">Premium ecommerce control center</h1>
                    <p class="hero-subtitle">
                        Track store health at a glance with live user, product, inventory, and order performance.
                        Everything here is powered by your backend stats and recent collections.
                    </p>
                </div>

                <div class="hero-meta">
                    <div class="hero-meta-card">
                        <div class="hero-meta-label">Estimated revenue</div>
                        <div class="hero-meta-value">{{ $estimatedRevenue ?? 0 }}</div>
                        <div class="hero-meta-note">Generated from order items using stored pivot prices.</div>
                    </div>
                    <div class="hero-meta-card">
                        <div class="hero-meta-label">Operational note</div>
                        <div class="hero-meta-value">{{ $totalOrders ?? 0 }} orders</div>
                        <div class="hero-meta-note">{{ $totalItemsSold ?? 0 }} items moved through the store.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="kpi-grid">
            <div class="kpi-card accent-teal">
                <div class="kpi-label">Total users</div>
                <div class="kpi-value">{{ $totalUsers ?? 0 }}</div>
                <div class="kpi-caption">Registered customers and admin accounts combined.</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Active users</div>
                <div class="kpi-value">{{ $activeUsers ?? 0 }}</div>
                <div class="kpi-caption">Users currently available for normal access.</div>
            </div>
            <div class="kpi-card accent-coral">
                <div class="kpi-label">Banned users</div>
                <div class="kpi-value">{{ $bannedUsers ?? 0 }}</div>
                <div class="kpi-caption">Accounts flagged by moderation controls.</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Total products</div>
                <div class="kpi-value">{{ $totalProducts ?? 0 }}</div>
                <div class="kpi-caption">Catalog size across all available categories.</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Low stock</div>
                <div class="kpi-value">{{ $lowStockProducts ?? 0 }}</div>
                <div class="kpi-caption">Products at or below the replenishment threshold.</div>
            </div>
        </section>

        <section class="analytics-grid">
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title-wrap">
                        <h2 class="panel-title">Store analytics overview</h2>
                        <p class="panel-subtitle">Secondary performance snapshot for inventory and sales rhythm.</p>
                    </div>
                    <div class="panel-badge">Live backend data</div>
                </div>

                <div class="analytics-cards">
                    <div class="analytics-card">
                        <h4>Total categories</h4>
                        <div class="analytics-stat">{{ $totalCategories ?? 0 }}</div>
                        <div class="analytics-desc">Category structure supporting product discovery.</div>
                    </div>
                    <div class="analytics-card highlight">
                        <h4>Total orders</h4>
                        <div class="analytics-stat">{{ $totalOrders ?? 0 }}</div>
                        <div class="analytics-desc">All time order count captured by the store.</div>
                    </div>
                    <div class="analytics-card">
                        <h4>Total items sold</h4>
                        <div class="analytics-stat">{{ $totalItemsSold ?? 0 }}</div>
                        <div class="analytics-desc">Summed quantity from every order item.</div>
                    </div>
                    <div class="analytics-card highlight">
                        <h4>Total stock units</h4>
                        <div class="analytics-stat">{{ $totalStockUnits ?? 0 }}</div>
                        <div class="analytics-desc">Available units currently across your catalog.</div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title-wrap">
                        <h2 class="panel-title">Inventory pulse</h2>
                        <p class="panel-subtitle">Quick operational signals to protect stock health.</p>
                    </div>
                    <div class="panel-badge">Threshold: 5 units</div>
                </div>

                <div class="mini-insights">
                    <div class="insight-row">
                        <div class="insight-copy">
                            <div class="insight-label">Low-stock watchlist</div>
                            <div class="insight-text">Products requiring attention before they sell out.</div>
                        </div>
                        <div class="insight-value">{{ $lowStockProducts ?? 0 }}</div>
                    </div>
                    <div class="insight-row">
                        <div class="insight-copy">
                            <div class="insight-label">Stock coverage</div>
                            <div class="insight-text">Total inventory units backing current demand.</div>
                        </div>
                        <div class="insight-value">{{ $totalStockUnits ?? 0 }}</div>
                    </div>
                    <div class="insight-row">
                        <div class="insight-copy">
                            <div class="insight-label">Catalog breadth</div>
                            <div class="insight-text">Number of active categories in the storefront.</div>
                        </div>
                        <div class="insight-value">{{ $totalCategories ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-grid">
            <div class="panel list-panel">
                <div class="list-head">
                    <div>
                        <h2 class="list-title">Newest products</h2>
                        <p class="panel-subtitle">Recently added catalog items for merchandising focus.</p>
                    </div>
                </div>

                @if(!empty($newestProducts) && count($newestProducts))
                    <div class="product-grid">
                        @foreach($newestProducts as $product)
                            <article class="product-card">
                                @if(!empty($product->image))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                                @else
                                    <div class="product-image"></div>
                                @endif
                                <div class="product-body">
                                    <div class="product-badge">New arrival</div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-meta">
                                        @if(isset($product->stock))
                                            <span>Stock: {{ $product->stock }}</span>
                                        @endif
                                        @if(isset($product->category_name) && $product->category_name)
                                            <span>Category: {{ $product->category_name }}</span>
                                        @endif
                                    </div>
                                    @if(isset($product->price))
                                        <div class="product-price">{{ $product->price }}</div>
                                    @endif
                                    @if(!empty($product->description_excerpt))
                                        <div class="product-description">{{ $product->description_excerpt }}</div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <strong>No recent products yet</strong>
                        <span>Once products are added, they will appear here automatically.</span>
                    </div>
                @endif
            </div>

            <div class="panel list-panel">
                <div class="list-head">
                    <div>
                        <h2 class="list-title">Latest orders</h2>
                        <p class="panel-subtitle">Most recent purchases captured from the checkout flow.</p>
                    </div>
                </div>

                <div class="orders-list">
                    @if(!empty($latestOrders) && count($latestOrders))
                        @foreach($latestOrders as $order)
                            <article class="order-card">
                                <div class="order-top">
                                    <div>
                                        <div class="order-id">Order #{{ $order->id }}</div>
                                        <div class="order-customer">
                                            @if(!empty($order->name))
                                                {{ $order->name }}
                                            @else
                                                Customer ID {{ $order->user_id ?? '—' }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="order-chip">{{ $order->created_at ? $order->created_at->format('M d, Y') : 'Recent' }}</div>
                                </div>
                                <div class="order-details">
                                    @if(isset($order->items_count))
                                        <span>{{ $order->items_count }} item(s)</span>
                                    @endif
                                    @if(isset($order->total_quantity))
                                        <span>{{ $order->total_quantity }} units</span>
                                    @endif
                                    @if(isset($order->total_amount))
                                        <span class="order-total">{{ $order->total_amount }}</span>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <strong>No latest orders yet</strong>
                            <span>Orders will appear here after customers start checking out.</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if(!empty($topSellingProducts) && count($topSellingProducts))
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title-wrap">
                        <h2 class="panel-title">Top selling products</h2>
                        <p class="panel-subtitle">Best performers ranked by total quantity sold.</p>
                    </div>
                    <div class="panel-badge">Sales ranking</div>
                </div>

                <div class="top-products">
                    @foreach($topSellingProducts as $index => $product)
                        <div class="top-product-row">
                            <div class="top-product-rank">{{ $index + 1 }}</div>
                            <div class="top-product-copy">
                                <div class="top-product-name">{{ $product->name ?? 'Unnamed product' }}</div>
                                <div class="top-product-meta">
                                    @if(isset($product->total_sold))
                                        Sold: {{ $product->total_sold }}
                                    @endif
                                    @if(isset($product->stock))
                                        @if(isset($product->total_sold)) · @endif Stock: {{ $product->stock }}
                                    @endif
                                </div>
                            </div>
                            <div class="top-product-value">
                                @if(isset($product->revenue))
                                    {{ $product->revenue }}
                                @elseif(isset($product->total_sold))
                                    {{ $product->total_sold }}
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</body>
</html>