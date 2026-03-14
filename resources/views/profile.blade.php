<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Herb Atlas</title>
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
        .main-content { max-width: 1000px; margin: 0 auto; padding: 40px 60px; }
        .profile-header { background: white; padding: 40px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08); display: flex; align-items: center; gap: 30px; }
        .profile-image { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--teal); }
        .profile-name { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--teal); font-weight: 800; margin-bottom: 5px; }
        .profile-email { color: var(--gray); }
        .profile-section { background: white; padding: 35px; border-radius: 20px; margin-bottom: 25px; box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08); }
        .section-title { font-size: 1.5rem; font-weight: 700; color: var(--dark); margin-bottom: 25px; }
        .info-grid { display: grid; gap: 20px; }
        .info-item { display: flex; justify-content: space-between; align-items: center; padding: 20px; background: var(--light-teal); border-radius: 12px; }
        .info-label { font-weight: 600; color: var(--dark); }
        .info-value { color: var(--gray); }
        .edit-btn { padding: 8px 16px; background: var(--teal); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.85rem; }
        .edit-btn:hover { background: #5ab0b0; }
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
        @media (max-width: 640px) { .header { padding: 15px 20px; flex-direction: column; gap: 15px; } .main-content { padding: 20px; } .profile-header { flex-direction: column; text-align: center; } .footer { padding: 40px 20px 20px; } .footer-content { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="logo-icon">HA</div>
            <div class="logo-text">Herb Atlas</div>
        </div>
        <nav class="nav-menu">
            <a href="dashboard.html" class="nav-link">Dashboard</a>
            <a href="profile.html" class="nav-link active">Profile</a>
            <a href="my-orders.html" class="nav-link">My Orders</a>
            <a href="products.html" class="nav-link">Products</a>
            <a href="chat.html" class="nav-link">Chat</a>
            <button class="logout-btn">Log Out</button>
        </nav>
    </header>
    <main class="main-content">
        <div class="profile-header">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop" class="profile-image">
            <div>
                <h1 class="profile-name">Sarah Johnson</h1>
                <p class="profile-email">sarah.johnson@email.com</p>
            </div>
        </div>
        <section class="profile-section">
            <h2 class="section-title">Personal Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div>
                        <div class="info-label">Full Name</div>
                        <div class="info-value">Sarah Johnson</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
                <div class="info-item">
                    <div>
                        <div class="info-label">Email Address</div>
                        <div class="info-value">sarah.johnson@email.com</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
                <div class="info-item">
                    <div>
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">+1 (555) 123-4567</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
                <div class="info-item">
                    <div>
                        <div class="info-label">Password</div>
                        <div class="info-value">••••••••</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
            </div>
        </section>
        <section class="profile-section">
            <h2 class="section-title">Shipping Address</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div>
                        <div class="info-label">Address</div>
                        <div class="info-value">123 Wellness Avenue, Nature City, NC 12345</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
            </div>
        </section>
        <section class="profile-section">
            <h2 class="section-title">Payment Methods</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div>
                        <div class="info-label">Credit Card</div>
                        <div class="info-value">•••• •••• •••• 4532</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
                <div class="info-item">
                    <div>
                        <div class="info-label">PayPal</div>
                        <div class="info-value">sarah.johnson@email.com</div>
                    </div>
                    <button class="edit-btn" onclick="alert('Edit functionality coming soon!')">Edit</button>
                </div>
            </div>
        </section>
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
