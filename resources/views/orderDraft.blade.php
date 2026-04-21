<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft Order - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="checkout-url" content="{{ route('checkout') }}">
    <meta name="orders-url" content="{{ route('orders.index') }}">
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
            --shadow: 0 18px 48px rgba(102, 191, 191, 0.12);
            --success: #059669;
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
            line-height: 1.6;
            min-height: 100vh;
        }

        .page {
            max-width: 1320px;
            margin: 0 auto;
            padding: 34px 24px 72px;
        }

        .hero {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow: var(--shadow);
            border-radius: 32px;
            padding: 28px 28px 24px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.08), transparent 38%, rgba(247, 107, 138, 0.08));
            pointer-events: none;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .hero-copy h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.1rem);
            line-height: 1.05;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .hero-copy p {
            color: var(--gray);
            max-width: 760px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(102, 191, 191, 0.1);
            color: var(--teal-dark);
            font-weight: 700;
            border: 1px solid rgba(102, 191, 191, 0.18);
            white-space: nowrap;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 24px;
            align-items: start;
        }

        .panel {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 30px;
            box-shadow: var(--shadow);
        }

        .cart-panel {
            padding: 24px;
        }

        .summary-panel {
            position: sticky;
            top: 92px;
            padding: 24px;
        }

        .panel-title {
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            min-height: 220px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 120px minmax(0, 1fr);
            gap: 16px;
            border: 1px solid var(--border);
            background: linear-gradient(180deg, #fff, var(--light-teal-2));
            border-radius: 24px;
            padding: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            align-items: start;
            width: 100%;
            min-width: 0;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(102, 191, 191, 0.09);
        }

        .cart-item__image {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            object-fit: cover;
            background: #edfafa;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
            display: block;
            flex-shrink: 0;
        }

        .cart-item__body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 0;
            width: 100%;
            opacity: 1;
            visibility: visible;
        }

        .cart-list:empty::before {
            content: "No draft items found in the cart.";
            display: block;
            padding: 22px;
            border: 1px dashed var(--border);
            border-radius: 18px;
            color: var(--gray);
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
        }

        .cart-item__top {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: flex-start;
        }

        .cart-item__name {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .cart-item__meta {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .cart-item__price {
            text-align: right;
            flex-shrink: 0;
        }

        .cart-item__price strong {
            display: block;
            color: var(--coral);
            font-size: 1rem;
        }

        .cart-item__price span {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .cart-item__actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .quantity-stepper {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.9);
        }

        .qty-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--light-teal);
            color: var(--teal-dark);
            font-size: 1rem;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .qty-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 14px rgba(102, 191, 191, 0.16);
            background: #dff3f3;
        }

        .qty-input {
            width: 74px;
            height: 42px;
            border: none;
            background: var(--light-teal-2);
            border-radius: 12px;
            text-align: center;
            font-weight: 800;
            color: var(--dark);
        }

        .qty-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.16);
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 12px 14px;
            font-weight: 800;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
            color: white;
            box-shadow: 0 10px 20px rgba(102, 191, 191, 0.22);
        }

        .btn-danger {
            background: rgba(247, 107, 138, 0.1);
            color: var(--coral);
        }

        .btn-ghost {
            background: rgba(102, 191, 191, 0.08);
            color: var(--teal-dark);
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
            margin-top: 8px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 14px;
        }

        .summary-total span {
            font-size: 1.85rem;
            font-weight: 900;
            color: var(--coral);
        }

        .checkout-btn {
            width: 100%;
            margin-top: 18px;
            padding: 16px 18px;
            font-size: 1rem;
        }

        .checkout-note {
            margin-top: 14px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .empty-state {
            padding: 70px 24px;
            text-align: center;
            border-radius: 26px;
            border: 1.5px dashed rgba(102, 191, 191, 0.32);
            background: rgba(255, 255, 255, 0.9);
        }

        .empty-icon {
            width: 86px;
            height: 86px;
            border-radius: 50%;
            background: var(--light-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            color: var(--teal);
            font-size: 2rem;
        }

        .empty-state h3 {
            font-size: 1.22rem;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--gray);
            max-width: 460px;
            margin: 0 auto;
        }

        .empty-state .actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
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

        .checkout-status {
            margin-top: 14px;
            min-height: 24px;
            font-size: 0.93rem;
            color: var(--gray);
        }

        .checkout-status.is-error {
            color: var(--coral);
        }

        .checkout-status.is-success {
            color: var(--success);
        }

        .hidden {
            display: none !important;
        }

        .pulse {
            animation: pulse 1.2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }

            50% {
                opacity: 0.55;
            }
        }

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .summary-panel {
                position: static;
            }
        }

        @media (max-width: 720px) {
            .page {
                padding: 18px 14px 56px;
            }

            .hero {
                padding: 22px 18px 20px;
                border-radius: 24px;
            }

            .hero-top {
                flex-direction: column;
            }

            .cart-panel,
            .summary-panel {
                padding: 18px;
                border-radius: 22px;
            }

            .cart-item {
                grid-template-columns: 1fr;
            }

            .cart-item__image {
                width: 100%;
                height: 220px;
            }

            .cart-item__top,
            .cart-item__actions {
                flex-direction: column;
                align-items: stretch;
            }

            .cart-item__price {
                text-align: left;
            }

            .quantity-stepper {
                width: 100%;
                justify-content: space-between;
            }

            .qty-input {
                flex: 1;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-header />
    <main class="page">
        <section class="hero">
            <div class="hero-top">
                <div class="hero-copy">
                    <h1>Draft your herb order</h1>
                    <p>Build your cart locally, adjust quantities instantly, and complete checkout only when you are ready. Your draft stays in your browser until the order is successfully created in the database.</p>
                </div>
                <div class="hero-badge">
                    <i class="fas fa-sparkles"></i>
                    Local draft cart
                </div>
            </div>
        </section>

        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash flash-error">{{ $errors->first() }}</div>
        @endif

        <div class="layout">
            <section class="panel cart-panel" aria-label="Draft cart items">
                <div class="panel-title">
                    <i class="fas fa-leaf" style="color: var(--teal);"></i>
                    Draft Items
                </div>

                <div id="draftCartEmptyState" class="empty-state hidden">
                    <div class="empty-icon">
                        <i class="fas fa-basket-shopping"></i>
                    </div>
                    <h3>Your draft cart is empty</h3>
                    <p>Add products from the catalog to start building your order. The cart will be restored automatically when you return.</p>
                    <div class="actions">
                        <a href="{{ route('products.index') }}" class="btn btn-primary" style="text-decoration:none;">
                            <i class="fas fa-arrow-right"></i>
                            Browse Products
                        </a>
                    </div>
                </div>

                <div id="draftCartList" class="cart-list"></div>
            </section>

            <aside class="panel summary-panel" aria-label="Draft summary">
                <div class="panel-title">
                    <i class="fas fa-receipt" style="color: var(--teal);"></i>
                    Summary
                </div>

                <div class="summary-row">
                    <span>Items</span>
                    <strong id="draftCartItemsCount">0</strong>
                </div>
                <div class="summary-row">
                    <span>Total quantity</span>
                    <strong id="draftCartQuantityCount">0</strong>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong id="draftCartSubtotal">0.00 USD</strong>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <strong>Free</strong>
                </div>

                <div class="summary-total">
                    <strong>Total</strong>
                    <span id="draftCartTotal">0.00 USD</span>
                </div>

                <button type="button" class="btn btn-primary checkout-btn" id="pay-order-btn">
                    <i class="fas fa-lock"></i>
                    Pay & Order
                </button>

                <div id="draftCheckoutStatus" class="checkout-status" aria-live="polite"></div>
                <p class="checkout-note">You will be redirected to Stripe to pay securely. Local draft data is cleared only after Stripe payment is verified on the success page.</p>
            </aside>
        </div>
    </main>

    <script>
        (function () {
            const DRAFT_ORDER_KEY = 'herb_draft_cart';
            const checkoutUrl = document.querySelector('meta[name="checkout-url"]')?.content || @json(route('checkout'));
            const ordersUrl = document.querySelector('meta[name="orders-url"]')?.content || @json(route('orders.index'));
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            const shouldClearCartAfterSuccess = @json((bool) session('clear_draft_cart', false));
            const listEl = document.getElementById('draftCartList');
            const emptyEl = document.getElementById('draftCartEmptyState');
            const itemsCountEl = document.getElementById('draftCartItemsCount');
            const quantityCountEl = document.getElementById('draftCartQuantityCount');
            const subtotalEl = document.getElementById('draftCartSubtotal');
            const totalEl = document.getElementById('draftCartTotal');
            const checkoutButton = document.getElementById('pay-order-btn');
            const checkoutStatus = document.getElementById('draftCheckoutStatus');

            function escapeHtml(value) {
                return String(value)
                    .replace(/&/g, '&')
                    .replace(/</g, '<')
                    .replace(/>/g, '>')
                    .replace(/"/g, '"')
                    .replace(/'/g, '&#039;');
            }

            function normalizeCartItem(item) {
                return {
                    id: Number(item?.id ?? item?.product_id ?? 0),
                    name: String(item?.name ?? item?.product_name ?? 'Unnamed product'),
                    price: Number(item?.price ?? 0),
                    quantity: Math.max(1, Number(item?.quantity ?? 1)),
                    image: String(item?.image ?? item?.image_url ?? ''),
                    category: String(item?.category ?? ''),
                    stock: Number(item?.stock ?? 0)
                };
            }

            function readCart() {
                try {
                    const stored = window.localStorage.getItem(DRAFT_ORDER_KEY);
                    if (!stored) {
                        return [];
                    }

                    const parsed = JSON.parse(stored);
                    if (!Array.isArray(parsed)) {
                        return [];
                    }

                    return parsed.map(normalizeCartItem).filter(function (item) {
                        return item.id > 0;
                    });
                } catch (error) {
                    return [];
                }
            }

            function notifyDraftCartUpdated() {
                window.dispatchEvent(new CustomEvent('herb-atlas:draft-cart-updated', {
                    detail: {
                        items: readCart()
                    }
                }));
            }

            function saveCart(items) {
                const normalizedItems = Array.isArray(items) ? items.map(normalizeCartItem).filter(function (item) {
                    return item.id > 0;
                }) : [];

                window.localStorage.setItem(DRAFT_ORDER_KEY, JSON.stringify(normalizedItems));
                window.HerbAtlasDraftCart = window.HerbAtlasDraftCart || {};
                window.HerbAtlasDraftCart.items = normalizedItems;
                window.HerbAtlasDraftCart.updateDraftCartBadge?.();
                notifyDraftCartUpdated();
            }

            function clearCart() {
                window.localStorage.removeItem(DRAFT_ORDER_KEY);
                window.HerbAtlasDraftCart = window.HerbAtlasDraftCart || {};
                window.HerbAtlasDraftCart.items = [];
                window.HerbAtlasDraftCart.updateDraftCartBadge?.();
                notifyDraftCartUpdated();
            }

            function formatMoney(value) {
                return Number(value || 0).toFixed(2) + ' USD';
            }

            function updateSummary(items) {
                const itemCount = items.length;
                const totalQuantity = items.reduce(function (sum, item) {
                    return sum + Number(item.quantity || 0);
                }, 0);
                const subtotal = items.reduce(function (sum, item) {
                    return sum + (Number(item.price || 0) * Number(item.quantity || 0));
                }, 0);

                itemsCountEl.textContent = String(itemCount);
                quantityCountEl.textContent = String(totalQuantity);
                subtotalEl.textContent = formatMoney(subtotal);
                totalEl.textContent = formatMoney(subtotal);

                const isEmpty = items.length === 0;
                emptyEl.classList.toggle('hidden', !isEmpty);
                listEl.classList.toggle('hidden', isEmpty);
                checkoutButton.disabled = isEmpty;
                checkoutButton.classList.toggle('pulse', !isEmpty);
            }

            function renderCart() {
                const items = readCart();

                if (!items.length) {
                    listEl.innerHTML = '';
                    updateSummary([]);
                    return;
                }

                listEl.innerHTML = items.map(function (item, index) {
                    const quantity = Number(item.quantity || 1);
                    const stock = Number(item.stock || 0);
                    const lineTotal = Number(item.price || 0) * quantity;
                    const canDecrease = quantity > 1;
                    const canIncrease = stock > 0 ? quantity < stock : true;
                    const image = item.image
                        ? `<img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}" class="cart-item__image">`
                        : `<img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800" alt="${escapeHtml(item.name)}" class="cart-item__image">`;

                    return `
                        <article class="cart-item" data-index="${index}" data-product-id="${item.id}">
                            ${image}
                            <div class="cart-item__body">
                                <div class="cart-item__top">
                                    <div>
                                        <div class="cart-item__name">${escapeHtml(item.name)}</div>
                                        <div class="cart-item__meta">${escapeHtml(item.category || 'Natural Product')} · Stock: ${escapeHtml(String(item.stock || '—'))}</div>
                                    </div>
                                    <div class="cart-item__price">
                                        <strong>${formatMoney(item.price)}</strong>
                                        <span>Subtotal: ${formatMoney(lineTotal)}</span>
                                    </div>
                                </div>

                                <div class="cart-item__actions">
                                    <div class="quantity-stepper">
                                        <button type="button" class="qty-btn" data-action="decrease" aria-label="Decrease quantity" ${canDecrease ? '' : 'disabled'}>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" readonly class="qty-input" value="${escapeHtml(String(quantity))}" data-action="quantity" aria-label="Quantity">
                                        <button type="button" class="qty-btn" data-action="increase" aria-label="Increase quantity" ${canIncrease ? '' : 'disabled'}>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-action="remove">
                                        <i class="fas fa-trash"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </article>
                    `;
                }).join('');

                updateSummary(items);
            }

            function setStatus(message, type) {
                checkoutStatus.textContent = message || '';
                checkoutStatus.className = 'checkout-status' + (type ? ' is-' + type : '');
            }

            function buildCheckoutPayload(items) {
                const normalizedItems = items.map(function (item) {
                    return {
                        id: item.id,
                        quantity: Number(item.quantity || 1)
                    };
                });

                const totalCents = items.reduce(function (sum, item) {
                    return sum + Math.round(Number(item.price || 0) * 100) * Number(item.quantity || 0);
                }, 0);

                return {
                    items: normalizedItems,
                    total: totalCents
                };
            }

            async function checkout() {
                const items = readCart();
                if (!items.length) {
                    setStatus('Your draft cart is empty.', 'error');
                    return;
                }

                checkoutButton.disabled = true;
                setStatus('Creating Stripe checkout session...', '');

                const payload = buildCheckoutPayload(items);

                try {
                    const response = await fetch(checkoutUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const errorMessage = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Unable to complete checkout.');
                        setStatus(errorMessage, 'error');
                        checkoutButton.disabled = false;
                        return;
                    }

                    const redirectUrl = data.url || null;

                    if (!redirectUrl) {
                        setStatus('Stripe checkout URL was not returned.', 'error');
                        checkoutButton.disabled = false;
                        return;
                    }

                    setStatus('Redirecting to Stripe...', 'success');
                    window.location.href = redirectUrl;
                } catch (error) {
                    setStatus('Unable to start Stripe checkout right now. Please try again.', 'error');
                    checkoutButton.disabled = false;
                }
            }

            listEl.addEventListener('click', function (event) {
                const button = event.target.closest('button');
                if (!button || button.disabled) {
                    return;
                }

                const row = event.target.closest('.cart-item');
                if (!row) {
                    return;
                }

                const index = Number(row.dataset.index);
                const cart = readCart();
                const item = cart[index];
                if (!item) {
                    return;
                }

                const action = button.dataset.action;
                const stock = Number(item.stock || 0);

                if (action === 'remove') {
                    cart.splice(index, 1);
                    saveCart(cart);
                    renderCart();
                    return;
                }

                if (action === 'increase') {
                    if (stock > 0 && Number(item.quantity || 1) >= stock) {
                        return;
                    }

                    item.quantity = Number(item.quantity || 1) + 1;
                    saveCart(cart);
                    renderCart();
                    return;
                }

                if (action === 'decrease') {
                    if (Number(item.quantity || 1) <= 1) {
                        return;
                    }

                    item.quantity = Number(item.quantity || 1) - 1;
                    saveCart(cart);
                    renderCart();
                }
            });

            checkoutButton.addEventListener('click', checkout);

            window.HerbAtlasDraftCart = window.HerbAtlasDraftCart || {};
            window.HerbAtlasDraftCart.renderDraftCartFromStorage = renderCart;
            window.HerbAtlasDraftCart.updateDraftCartBadge = function () {
                const count = readCart().reduce(function (sum, item) {
                    return sum + Number(item.quantity || 0);
                }, 0);

                const badge = document.querySelector('[data-draft-cart-badge]');
                const legacyBadge = document.getElementById('cartBadge');
                [badge, legacyBadge].forEach(function (el) {
                    if (!el) {
                        return;
                    }

                    el.textContent = String(count);
                    if ('classList' in el) {
                        el.classList.toggle('hidden', count === 0);
                    }
                });
            };
            window.HerbAtlasDraftCart.getDraftCartItems = readCart;
            window.HerbAtlasDraftCart.setDraftCartItems = function (items) {
                saveCart(items);
                renderCart();
            };
            window.HerbAtlasDraftCart.clearDraftCart = clearCart;
            window.HerbAtlasDraftCart.checkoutDraftCart = checkout;
            window.HerbAtlasDraftCart.checkoutUrl = checkoutUrl;
            window.HerbAtlasDraftCart.ordersUrl = ordersUrl;
            window.HerbAtlasDraftCart.storageKey = DRAFT_ORDER_KEY;

            window.addEventListener('storage', function (event) {
                if (event.key === DRAFT_ORDER_KEY) {
                    renderCart();
                }
            });

            window.addEventListener('herb-atlas:draft-cart-updated', function () {
                renderCart();
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function () {
                    if (shouldClearCartAfterSuccess) {
                        clearCart();
                    }

                    renderCart();
                });
            } else {
                if (shouldClearCartAfterSuccess) {
                    clearCart();
                }

                renderCart();
            }
        })();
    </script>
</body>
</html>
