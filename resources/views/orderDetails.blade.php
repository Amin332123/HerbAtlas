<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->display_name ?? ('Order #' . $order->id) }} - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
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
            --shadow: 0 14px 40px rgba(102, 191, 191, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(102, 191, 191, 0.08), transparent 22%),
                radial-gradient(circle at bottom right, rgba(247, 107, 138, 0.08), transparent 20%),
                var(--light-teal);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px 72px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--gray);
            max-width: 720px;
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 14px 18px;
            box-shadow: 0 6px 18px rgba(102, 191, 191, 0.08);
            min-width: 240px;
            text-align: right;
        }

        .status-badge small {
            display: block;
            color: var(--gray);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }

        .status-badge strong {
            font-size: 1.02rem;
            color: var(--dark);
        }

        .order-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 28px;
            box-shadow: var(--shadow);
        }

        .order-card {
            padding: 24px;
        }

        .summary-card {
            position: sticky;
            top: 92px;
            padding: 24px;
        }

        .section-title {
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .meta-box {
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(180deg, #fff, var(--light-teal-2));
            border: 1px solid var(--border);
        }

        .meta-box small {
            display: block;
            color: var(--gray);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }

        .meta-box strong {
            color: var(--dark);
            font-size: 1rem;
        }

        .items {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .item {
            display: grid;
            grid-template-columns: 96px minmax(0, 1fr);
            gap: 16px;
            padding: 16px;
            border: 1px solid var(--border);
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff, var(--light-teal-2));
        }

        .item img {
            width: 96px;
            height: 96px;
            border-radius: 18px;
            object-fit: cover;
            background: #edfafa;
        }

        .item-body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 0;
        }

        .item-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .item-name {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .item-category {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .item-price {
            text-align: right;
            flex-shrink: 0;
        }

        .item-price strong {
            color: var(--coral);
            font-size: 1rem;
        }

        .item-price span {
            display: block;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .item-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .quantity-form {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: #fff;
        }

        .quantity-form input {
            width: 76px;
            height: 42px;
            border: none;
            text-align: center;
            font-weight: 700;
            border-radius: 10px;
            background: var(--light-teal-2);
        }

        .quantity-form input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.15);
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 11px 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-update {
            background: var(--teal);
            color: white;
        }

        .btn-remove {
            background: rgba(247, 107, 138, 0.1);
            color: var(--coral);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
            color: var(--gray);
        }

        .summary-row strong {
            color: var(--dark);
        }

        .summary-total {
            padding-top: 16px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 12px;
            margin-top: 8px;
        }

        .summary-total span {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--coral);
        }

        .empty-state {
            padding: 64px 24px;
            text-align: center;
            border: 1.5px dashed rgba(102, 191, 191, 0.32);
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.9);
        }

        .empty-state h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--gray);
        }

        .back-link {
            display: inline-flex;
            margin-bottom: 20px;
            color: var(--teal);
            text-decoration: none;
            font-weight: 700;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .flash {
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .flash-success {
            background: #ecfdf5;
            color: #166534;
            border-color: #bbf7d0;
        }

        .flash-error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        @media (max-width: 980px) {
            .order-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 720px) {
            .page {
                padding: 22px 14px 52px;
            }

            .page-title {
                font-size: 2rem;
            }

            .order-card,
            .summary-card {
                border-radius: 22px;
                padding: 18px;
            }

            .order-meta {
                grid-template-columns: 1fr;
            }

            .item {
                grid-template-columns: 1fr;
            }

            .item img {
                width: 100%;
                height: 220px;
            }

            .item-top,
            .item-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .item-price {
                text-align: left;
            }

            .quantity-form {
                width: 100%;
                justify-content: space-between;
            }

            .quantity-form input {
                flex: 1;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-header />
    @php
        $orderItems = $orderItems ?? collect();
        $status = strtolower((string) ($order->status ?? 'pending'));
        $displayName = $order->display_name ?? ($order->name ?: ('Order #' . $order->id));
        $itemsCount = (int) ($order->items_count ?? $orderItems->count());
        $totalQuantity = (int) ($order->total_quantity ?? $orderItems->sum(fn ($item) => (int) data_get($item, 'pivot.quantity', 0)));
        $grandTotal = (float) ($order->calculated_total ?? $orderItems->sum(fn ($item) => ((float) data_get($item, 'pivot.price', 0)) * ((int) data_get($item, 'pivot.quantity', 0))));
    @endphp

    <main class="page">
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ $displayName }}</h1>
                <p class="page-subtitle">Database-backed order details with live totals, item controls, and stock-safe updates.</p>
            </div>
            <div class="status-badge" aria-live="polite">
                <small>Status</small>
                <strong>{{ ucfirst($status) }}</strong>
            </div>
        </div>

        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash flash-error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="order-grid">
            <section class="card order-card" aria-label="Order items">
                    <div class="section-title">
                        <i class="fas fa-boxes" style="color: var(--teal);"></i>
                        Order items
                    </div>

                <div class="order-meta">
                    <div class="meta-box">
                        <small>Order ID</small>
                        <strong>#{{ $order->id }}</strong>
                    </div>
                    <div class="meta-box">
                        <small>Placed</small>
                        <strong>{{ optional($order->created_at)->format('d M Y H:i') ?? 'recently' }}</strong>
                    </div>
                    <div class="meta-box">
                        <small>Products</small>
                        <strong>{{ $itemsCount }}</strong>
                    </div>
                    <div class="meta-box">
                        <small>Total quantity</small>
                        <strong>{{ $totalQuantity }}</strong>
                    </div>
                </div>

                @if($orderItems->isEmpty())
                    <div class="empty-state">
                        <h3>No products were found for this order.</h3>
                        <p>The order has no line items attached.</p>
                    </div>
                @else
                    <div class="items">
                        @foreach($orderItems as $item)
                            @php
                                $quantity = (int) data_get($item, 'pivot.quantity', 0);
                                $unitPrice = (float) data_get($item, 'pivot.price', 0);
                                $lineTotal = $quantity * $unitPrice;
                                $image = $item->pictures->first()?->img_path
                                    ? asset('storage/' . $item->pictures->first()->img_path)
                                    : 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=600';
                            @endphp
                            <article class="item">
                                <img src="{{ $image }}" alt="{{ $item->name }}">
                                <div class="item-body">
                                    <div class="item-top">
                                        <div>
                                            <div class="item-name">{{ $item->name }}</div>
                                            <div class="item-category">{{ optional($item->category)->title ?? 'Natural Product' }}</div>
                                        </div>
                                        <div class="item-price">
                                            <strong>{{ number_format($unitPrice, 2) }} MAD</strong>
                                            <span>Subtotal: {{ number_format($lineTotal, 2) }} MAD</span>
                                        </div>
                                    </div>

                                    <div class="item-actions">
                                        @if($order->status === \App\Models\Order::STATUS_PENDING)
                                            <form method="POST" action="{{ route('orders.update-item', [$order, $item]) }}" class="quantity-form">
                                                @csrf
                                                @method('PATCH')
                                                <label class="screen-reader-only" for="quantity-{{ $item->id }}">Quantity</label>
                                                <input id="quantity-{{ $item->id }}" type="number" name="quantity" value="{{ $quantity }}" min="1" step="1" inputmode="numeric">
                                                <button type="submit" class="btn btn-update">
                                                    <i class="fas fa-rotate"></i>
                                                    Update
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('orders.remove-item', [$order, $item]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-remove" onclick="return confirm('Remove this item?')">
                                                    <i class="fas fa-trash"></i>
                                                    Remove
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            <aside class="card summary-card" aria-label="Order summary">
                <div class="section-title">
                    <i class="fas fa-receipt" style="color: var(--teal);"></i>
                    Summary
                </div>

                <div class="summary-row">
                    <span>Products</span>
                    <strong>{{ $itemsCount }}</strong>
                </div>
                <div class="summary-row">
                    <span>Total quantity</span>
                    <strong>{{ $totalQuantity }}</strong>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong>{{ number_format($grandTotal, 2) }} MAD</strong>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <strong>Free</strong>
                </div>

                <div class="summary-total">
                    <strong>Total</strong>
                    <span>{{ number_format($grandTotal, 2) }} MAD</span>
                </div>

                <p class="page-subtitle" style="margin-top: 14px;">
                    All totals are calculated from the stored pivot data and remain accurate after updates.
                </p>
            </aside>
        </div>
    </main>
</body>
</html>
