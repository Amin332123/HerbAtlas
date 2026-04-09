<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Herb Atlas</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --teal: #66bfbf;
            --teal-dark: #4aa8a8;
            --light-teal: #eaf6f6;
            --light-teal-2: #f5fbfb;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
            --border: rgba(102, 191, 191, 0.15);
            --success: #059669;
            --warning: #b45309;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(102, 191, 191, 0.08), transparent 24%),
                radial-gradient(circle at bottom right, rgba(247, 107, 138, 0.08), transparent 22%),
                var(--light-teal);
            color: var(--dark);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.94);
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 18px rgba(102, 191, 191, 0.12);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(12px);
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
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.1rem;
            color: white;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--teal);
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 32px 80px;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .page-header h1 i {
            color: var(--teal);
            font-size: 1.7rem;
        }

        .page-header p {
            color: var(--gray);
            font-size: 0.96rem;
            max-width: 720px;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--gray);
            margin: 0 0 16px;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, var(--border), transparent);
        }

        .pending-card,
        .history-card,
        .empty-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 35px rgba(102, 191, 191, 0.12);
        }

        .pending-card {
            border-radius: 28px;
            padding: 28px 30px;
            position: relative;
            overflow: hidden;
            margin-bottom: 50px;
        }

        .pending-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(to bottom, var(--teal), var(--coral));
        }

        .pending-card::after {
            content: '';
            position: absolute;
            right: -60px;
            top: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(102, 191, 191, 0.08), transparent 70%);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 22px;
            position: relative;
            z-index: 1;
        }

        .order-id-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 4px;
        }

        .order-id-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--dark);
        }

        .order-sub {
            color: var(--gray);
            font-size: 0.84rem;
            margin-top: 4px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff8e6;
            color: var(--warning);
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid rgba(180, 83, 9, 0.12);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
            animation: pulse 1.6s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.72);
            }
        }

        .product-strip {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
        }

        .product-thumb-wrap {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid white;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            margin-right: -12px;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .product-thumb-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .more-badge {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--light-teal);
            border: 3px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal-dark);
            font-size: 0.74rem;
            font-weight: 700;
            margin-right: -12px;
            flex-shrink: 0;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .strip-meta {
            margin-left: 28px;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .items-count {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .items-names {
            color: var(--gray);
            font-size: 0.8rem;
            max-width: 350px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-stats {
            display: flex;
            gap: 18px;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .stat-block {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--gray);
        }

        .stat-value {
            font-size: 1.28rem;
            font-weight: 800;
            color: var(--dark);
            margin-top: 2px;
        }

        .stat-value.total {
            color: var(--coral);
        }

        .stat-divider {
            width: 1px;
            height: 34px;
            background: var(--border);
        }

        .card-actions {
            margin-left: auto;
        }

        .btn-view {
            padding: 13px 24px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
            color: white;
            border: none;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s;
            box-shadow: 0 5px 18px rgba(102, 191, 191, 0.3);
            text-decoration: none;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 191, 191, 0.4);
        }

        .empty-card {
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            border: 1.5px dashed rgba(102, 191, 191, 0.32);
            margin-bottom: 48px;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--light-teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--teal);
            opacity: 0.75;
        }

        .empty-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .empty-card p {
            color: var(--gray);
            font-size: 0.92rem;
        }

        .empty-card a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            color: var(--teal);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.92rem;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .history-card {
            border-radius: 22px;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.25s;
        }

        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(102, 191, 191, 0.16);
        }

        .history-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            background: #d1fae5;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
            font-size: 1.15rem;
        }

        .history-body {
            flex: 1;
            min-width: 0;
        }

        .history-id {
            font-weight: 700;
            font-size: 1rem;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .history-meta {
            color: var(--gray);
            font-size: 0.84rem;
            line-height: 1.5;
        }

        .history-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 9px;
        }

        .history-total {
            font-weight: 800;
            font-size: 1.05rem;
            color: var(--dark);
        }

        .delivered-badge {
            background: #d1fae5;
            color: var(--success);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        footer {
            background: var(--dark);
            color: white;
            padding: 32px 60px;
            text-align: center;
            font-size: 0.88rem;
            opacity: 0.88;
        }

        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .page {
                padding: 30px 16px 60px;
            }

            .card-top,
            .history-card,
            .card-stats {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-actions,
            .history-right {
                margin-left: 0;
                align-items: flex-start;
            }

            .stat-divider {
                display: none;
            }

            .strip-meta {
                margin-left: 20px;
            }
        }
    </style>
</head>

<body>
    <x-header />
    <main class="page">
        <div class="page-header">
            <h1><i class="fas fa-receipt"></i> My Orders</h1>
            <p>Your order area now supports two sources of truth: your browser draft order stored in local storage, and
                your confirmed orders loaded from the database.</p>
        </div>

        <div class="section-label"><i class="fas fa-clock" style="color:var(--teal)"></i> Draft Order</div>
        <div id="pendingSection"></div>

        <div class="section-label"><i class="fas fa-check-circle" style="color:var(--teal)"></i> Saved Orders</div>
        @if($orders->isEmpty())
            <div class="empty-card">
                <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                <h3>No saved orders yet</h3>
                <p>Your database-backed orders will appear here after checkout is completed.</p>
                <a href="{{ route('product.index') }}"><i class="fas fa-arrow-right"></i> Browse Products</a>
            </div>
        @else
            <div class="history-list">
                @foreach($orders as $order)
                    @php
                        $firstProduct = $order->products->first();
                        $previewNames = $order->products->take(2)->pluck('name')->implode(', ');
                        $remainingCount = max($order->products->count() - 2, 0);
                        $metaTail = $remainingCount > 0 ? ' +' . $remainingCount . ' more' : '';
                        $displayName = $order->name ?: ('Order #' . $order->id);
                    @endphp
                    <div class="history-card">
                        <div class="history-icon"><i class="fas fa-box"></i></div>
                        <div class="history-body">
                            <div class="history-id">#{{ $displayName }}</div>
                            <div class="history-meta">
                                Saved {{ optional($order->created_at)->format('d M Y') ?? 'recently' }}
                                &nbsp;·&nbsp;
                                {{ $previewNames ?: 'Natural Herb Atlas products' }}{{ $metaTail }}
                            </div>
                        </div>
                        <div class="history-right">
                            <span class="delivered-badge"><i class="fas fa-database"></i> In Database</span>
                            <span class="history-total">{{ number_format($order->calculated_total ?? 0, 2) }} MAD</span>
                            <a href="{{ route('orders.show', 'draft') !== '' ? route('orders.show', $order->id) : '/orders/' . $order->id }}"
                                class="btn-view">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <footer>&copy; 2026 Herb Atlas — Natural Products from Morocco</footer>

    <script>
        function getDraftOrder() {
            try {
                const raw = localStorage.getItem('herb_order');
                return raw ? JSON.parse(raw) : [];
            } catch (error) {
                return [];
            }
        }

        function getDraftOrderId() {
            const stored = localStorage.getItem('herb_order_id');
            if (stored) return stored;

            const generated = 'DRAFT-' + new Date().getFullYear() + '-' + Math.floor(1000 + Math.random() * 9000);
            localStorage.setItem('herb_order_id', generated);
            return generated;
        }

        function renderPending() {
            const section = document.getElementById('pendingSection');
            const cart = getDraftOrder();

            if (!cart.length) {
                section.innerHTML = `
                <div class="empty-card">
                    <div class="empty-icon"><i class="fas fa-cart-plus"></i></div>
                    <h3>Your draft order is empty</h3>
                    <p>Add products to local storage from the product details page, then open the draft order details page from here.</p>
                    <a href="{{ route('products/*  */.index') }}"><i class="fas fa-arrow-right"></i> Browse Products</a>
                </div>`;
                return;
            }

            const orderId = getDraftOrderId();
            const normalized = cart.map(item => ({
                id: item.id ?? item.product_id,
                name: item.name ?? 'Unnamed Product',
                image: item.image ?? item.picture ?? 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=150',
                quantity: parseInt(item.quantity ?? 1, 10) || 1,
                price: parseFloat(item.price ?? 0) || 0
            }));

            const total = normalized.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const totalQty = normalized.reduce((sum, item) => sum + item.quantity, 0);
            const visible = normalized.slice(0, 5);
            const extra = normalized.length - visible.length;
            const names = normalized.map(item => item.name).join(', ');
            const dateStr = new Date().toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });

            let thumbsHTML = visible.map(item => `
            <div class="product-thumb-wrap" title="${item.name}">
                <img src="${item.image}" alt="${item.name}" onerror="this.src='https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=150'">
            </div>
        `).join('');

            if (extra > 0) {
                thumbsHTML += `<div class="more-badge">+${extra}</div>`;
            }

            section.innerHTML = `
            <div class="pending-card">
                <div class="card-top">
                    <div>
                        <div class="order-id-label">Draft Reference</div>
                        <div class="order-id-value">#${orderId}</div>
                        <div class="order-sub"><i class="far fa-calendar-alt"></i> Updated ${dateStr}</div>
                    </div>
                    <div class="status-pill">
                        <span class="status-dot"></span>
                        Stored in Local Storage
                    </div>
                </div>

                <div class="product-strip">
                    ${thumbsHTML}
                    <div class="strip-meta">
                        <span class="items-count">${totalQty} item${totalQty !== 1 ? 's' : ''} · ${normalized.length} product${normalized.length !== 1 ? 's' : ''}</span>
                        <span class="items-names">${names}</span>
                    </div>
                </div>

                <div class="card-stats">
                    <div class="stat-block">
                        <span class="stat-label">Products</span>
                        <span class="stat-value">${normalized.length}</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-block">
                        <span class="stat-label">Total Qty</span>
                        <span class="stat-value">${totalQty}</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-block">
                        <span class="stat-label">Draft Total</span>
                        <span class="stat-value total">${total.toFixed(2)} MAD</span>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('orders.show', 'draft') }}" class="btn-view">
                            <i class="fas fa-eye"></i> View Order Details
                        </a>
                    </div>
                </div>
            </div>`;
        }

        renderPending();
    </script>
</body>

</html>