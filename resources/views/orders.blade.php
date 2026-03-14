<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; background: var(--light-teal); color: var(--dark); }
        .header { background: white; padding: 20px 60px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(102, 191, 191, 0.1); position: sticky; top: 0; z-index: 100; }
        .logo-container { display: flex; align-items: center; gap: 12px; }
        .logo-icon { width: 45px; height: 45px; background: linear-gradient(135deg, var(--teal), var(--coral)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.2rem; color: white; }
        .logo-text { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 800; color: var(--teal); }
        .nav-menu { display: flex; align-items: center; gap: 35px; }
        .nav-link { color: var(--gray); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .nav-link:hover { color: var(--teal); }
        .nav-link.active { color: var(--teal); font-weight: 600; }
        .logout-btn { padding: 10px 24px; background: linear-gradient(135deg, var(--coral), #ff7b9a); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .main-content { max-width: 1200px; margin: 0 auto; padding: 40px 60px; }
        .search-section { background: white; padding: 25px; border-radius: 16px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08); }
        .search-bar { display: flex; gap: 15px; }
        .search-input { flex: 1; padding: 14px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-family: 'Outfit', sans-serif; }
        .search-input:focus { outline: none; border-color: var(--teal); }
        .search-btn { padding: 14px 32px; background: var(--teal); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; }
        .section-header { margin-bottom: 20px; }
        .section-title { font-size: 1.8rem; font-weight: 700; color: var(--dark); margin-bottom: 30px; }
        .orders-grid { display: grid; gap: 20px; margin-bottom: 40px; }
        .order-card { background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(102, 191, 191, 0.08); }
        .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 2px solid var(--light-teal); }
        .order-id { font-weight: 700; font-size: 1.2rem; color: var(--dark); }
        .order-date { color: var(--gray); font-size: 0.9rem; }
        .order-details { display: grid; gap: 15px; margin-bottom: 20px; }
        .order-info-row { display: flex; justify-content: space-between; align-items: center; }
        .order-label { color: var(--gray); font-weight: 500; }
        .order-value { font-weight: 600; color: var(--dark); }
        .order-status { display: inline-block; padding: 8px 20px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        .status-shipping { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #fef3c7; color: #92400e; }
        .status-pending { background: #fee2e2; color: #991b1b; }
        .order-actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn { padding: 12px 24px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: var(--teal); color: white; }
        .btn-primary:hover { background: #5ab0b0; }
        .btn-secondary { background: var(--light-teal); color: var(--teal); }
        .btn-secondary:hover { background: #d5eded; }
        .btn-danger { background: linear-gradient(135deg, var(--coral), #ff7b9a); color: white; opacity: 1; }
        .btn-danger:hover { transform: translateY(-2px); }
        .btn-danger.expired { opacity: 0.3; cursor: not-allowed; }
        .btn-danger.expired:hover { transform: none; }
        .footer { background: linear-gradient(135deg, var(--dark), #1a202c); color: white; padding: 60px 60px 30px; margin-top: 60px; }
        .footer-content { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 50px; margin-bottom: 40px; }
        .footer-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .footer-logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--teal), var(--coral)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.1rem; }
        .footer-logo-text { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; }
        .footer-description { color: rgba(255, 255, 255, 0.7); line-height: 1.6; }
        .footer-column h3 { margin-bottom: 15px; }
        .footer-links { display: flex; flex-direction: column; gap: 10px; }
        .footer-links a { color: rgba(255, 255, 255, 0.7); text-decoration: none; }
        .footer-bottom { text-align: center; padding-top: 25px; border-top: 1px solid rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.5); }
        @media (max-width: 640px) { .header { padding: 15px 20px; flex-direction: column; gap: 15px; } .main-content { padding: 20px; } .order-actions { flex-direction: column; } .footer { padding: 40px 20px 20px; } .footer-content { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <x-header />
    <main class="main-content">
        <section class="search-section">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search orders by ID or product name...">
                <button class="search-btn">Search</button>
            </div>
        </section>

        <h2 class="section-title">Completed Orders</h2>
        <div class="orders-grid">
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">#ORD-2024-001</div>
                        <div class="order-date">Placed on Feb 10, 2026</div>
                    </div>
                    <span class="order-status status-delivered">Delivered</span>
                </div>
                <div class="order-details">
                    <div class="order-info-row">
                        <span class="order-label">Number of Products</span>
                        <span class="order-value">3 items</span>
                    </div>
                    <div class="order-info-row">
                        <span class="order-label">Total Amount</span>
                        <span class="order-value">$74.97</span>
                    </div>
                    <div class="order-info-row">
                        <span class="order-label">Delivery Date</span>
                        <span class="order-value">Feb 14, 2026</span>
                    </div>
                </div>
                <div class="order-actions">
                    <button class="btn btn-primary" onclick="alert('Order details modal will open here')">Show Details</button>
                    <button class="btn btn-danger expired" disabled>Cancel Order (Expired)</button>
                </div>
            </div>

            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">#ORD-2024-002</div>
                        <div class="order-date">Placed on Feb 12, 2026</div>
                    </div>
                    <span class="order-status status-shipping">Shipping</span>
                </div>
                <div class="order-details">
                    <div class="order-info-row">
                        <span class="order-label">Number of Products</span>
                        <span class="order-value">2 items</span>
                    </div>
                    <div class="order-info-row">
                        <span class="order-label">Total Amount</span>
                        <span class="order-value">$54.98</span>
                    </div>
                    <div class="order-info-row">
                        <span class="order-label">Expected Delivery</span>
                        <span class="order-value">Feb 18, 2026</span>
                    </div>
                </div>
                <div class="order-actions">
                    <button class="btn btn-primary" onclick="alert('Order details modal will open here')">Show Details</button>
                    <button class="btn btn-danger" onclick="if(confirm('Cancel this order?')) alert('Order cancelled!')">Cancel Order</button>
                </div>
            </div>
        </div>

        <h2 class="section-title">Pending Orders (Local Storage)</h2>
        <div class="orders-grid">
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Pending Cart</div>
                        <div class="order-date">Last updated: Today</div>
                    </div>
                    <span class="order-status status-pending">Not Submitted</span>
                </div>
                <div class="order-details">
                    <div class="order-info-row">
                        <span class="order-label">Number of Products</span>
                        <span class="order-value">4 items</span>
                    </div>
                    <div class="order-info-row">
                        <span class="order-label">Estimated Total</span>
                        <span class="order-value">$99.96</span>
                    </div>
                </div>
                <div class="order-actions">
                    <button class="btn btn-primary" onclick="alert('Viewing cart details...')">View Details</button>
                    <button class="btn btn-secondary" onclick="alert('Checkout functionality coming soon!')">Proceed to Checkout</button>
                    <button class="btn btn-danger" onclick="if(confirm('Clear cart?')) alert('Cart cleared!')">Remove</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-icon">HA</div>
                    <div class="footer-logo-text">Herb Atlas</div>
                </div>
                <p class="footer-description">Your trusted source for premium natural herbs.</p>
            </div>
            <div class="footer-column">
                <h3>Shop</h3>
                <div class="footer-links">
                    <a href="#">All Products</a>
                    <a href="#">Essential Oils</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Company</h3>
                <div class="footer-links">
                    <a href="#">About Us</a>
                    <a href="#">Blog</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Support</h3>
                <div class="footer-links">
                    <a href="#">Contact</a>
                    <a href="#">FAQ</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Herb Atlas. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
