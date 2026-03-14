<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Herb Atlas</title>
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
        .main-content { max-width: 1400px; margin: 0 auto; padding: 40px 60px; }
        .search-filter-section { background: white; padding: 30px; border-radius: 20px; margin-bottom: 35px; box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08); }
        .search-bar { display: flex; gap: 15px; margin-bottom: 25px; }
        .search-input { flex: 1; padding: 14px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-family: 'Outfit', sans-serif; font-size: 1rem; }
        .search-input:focus { outline: none; border-color: var(--teal); }
        .search-btn { padding: 14px 32px; background: var(--teal); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; }
        .filters-container { display: flex; gap: 20px; flex-wrap: wrap; }
        .filter-group { flex: 1; min-width: 250px; }
        .filter-label { display: block; margin-bottom: 10px; font-weight: 600; }
        .filter-select { width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px; font-family: 'Outfit', sans-serif; cursor: pointer; }
        .price-range { display: flex; gap: 10px; align-items: center; }
        .price-input { flex: 1; padding: 12px; border: 2px solid #e5e7eb; border-radius: 12px; font-family: 'Outfit', sans-serif; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }
        .product-card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08); transition: all 0.3s; cursor: pointer; }
        .product-card:hover { transform: translateY(-8px); box-shadow: 0 10px 30px rgba(102, 191, 191, 0.15); }
        .product-image { width: 100%; height: 240px; object-fit: cover; border-radius: 16px; margin-bottom: 20px; }
        .product-badge { display: inline-block; background: linear-gradient(135deg, var(--coral), #ff7b9a); color: white; padding: 5px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; margin-bottom: 12px; }
        .product-name { font-size: 1.5rem; font-weight: 700; color: var(--teal); margin-bottom: 10px; }
        .product-description { color: var(--gray); line-height: 1.6; margin-bottom: 15px; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .product-price { font-size: 1.6rem; font-weight: 800; color: var(--coral); }
        .product-rating { color: #fbbf24; }
        .show-details-btn { width: 100%; padding: 14px; background: var(--teal); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 1000; justify-content: center; align-items: center; }
        .modal.active { display: flex; }
        .modal-content { background: white; width: 80%; max-width: 1100px; max-height: 90vh; overflow-y: auto; border-radius: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; padding: 50px; position: relative; }
        .modal-close { position: absolute; top: 20px; right: 20px; width: 40px; height: 40px; background: var(--light-teal); border: none; border-radius: 50%; font-size: 1.5rem; cursor: pointer; }
        .modal-images { display: flex; flex-direction: column; gap: 15px; }
        .main-image { width: 100%; height: 400px; object-fit: cover; border-radius: 16px; }
        .thumbnail-images { display: flex; gap: 10px; }
        .thumbnail { width: calc(33.333% - 7px); height: 100px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 2px solid transparent; }
        .thumbnail:hover { border-color: var(--teal); }
        .modal-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--teal); margin-bottom: 15px; font-weight: 800; }
        .modal-description { color: var(--gray); line-height: 1.8; margin-bottom: 20px; }
        .modal-price { font-size: 2.2rem; font-weight: 800; color: var(--coral); margin-bottom: 15px; }
        .modal-rating { color: #fbbf24; font-size: 1.2rem; margin-bottom: 25px; }
        .add-to-cart-btn { padding: 18px; background: linear-gradient(135deg, var(--coral), #ff7b9a); color: white; border: none; border-radius: 14px; font-weight: 700; font-size: 1.1rem; cursor: pointer; margin-top: 20px; }
        .footer { background: linear-gradient(135deg, var(--dark), #1a202c); color: white; padding: 60px 60px 30px; margin-top: 80px; }
        .footer-content { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 50px; margin-bottom: 40px; }
        .footer-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .footer-logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--teal), var(--coral)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.1rem; }
        .footer-logo-text { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; }
        .footer-description { color: rgba(255, 255, 255, 0.7); line-height: 1.6; }
        .footer-column h3 { margin-bottom: 15px; }
        .footer-links { display: flex; flex-direction: column; gap: 10px; }
        .footer-links a { color: rgba(255, 255, 255, 0.7); text-decoration: none; }
        .footer-bottom { text-align: center; padding-top: 25px; border-top: 1px solid rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.5); }
        @media (max-width: 1024px) { .modal-content { grid-template-columns: 1fr; } .footer-content { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 640px) { .header { padding: 15px 20px; flex-direction: column; gap: 15px; } .main-content { padding: 20px; } .modal-content { padding: 30px 20px; } .footer { padding: 40px 20px 20px; } .footer-content { grid-template-columns: 1fr; } }
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
            <a href="profile.html" class="nav-link">Profile</a>
            <a href="my-orders.html" class="nav-link">My Orders</a>
            <a href="products.html" class="nav-link active">Products</a>
            <a href="chat.html" class="nav-link">Chat</a>
            <button class="logout-btn">Log Out</button>
        </nav>
    </header>
    <main class="main-content">
        <section class="search-filter-section">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search by name...">
                <button class="search-btn">Search</button>
            </div>
            <div class="filters-container">
                <div class="filter-group">
                    <label class="filter-label">Filter by Category</label>
                    <select class="filter-select">
                        <option>All Categories</option>
                        <option>Essential Oils</option>
                        <option>Carrier Oils</option>
                        <option>Herbal Blends</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Filter by Price Range</label>
                    <div class="price-range">
                        <input type="number" class="price-input" placeholder="Min">
                        <span>—</span>
                        <input type="number" class="price-input" placeholder="Max">
                    </div>
                </div>
            </div>
        </section>
        <div class="products-grid">
            <div class="product-card" onclick="openModal(0)">
                <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=600&fit=crop&q=80" class="product-image">
                <span class="product-badge">BESTSELLER</span>
                <h3 class="product-name">Argan Oil</h3>
                <p class="product-description">Pure Moroccan argan oil, rich in vitamin E and fatty acids.</p>
                <div class="product-footer">
                    <div class="product-price">$29.99</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐</div>
                </div>
                <button class="show-details-btn">Show Details</button>
            </div>
            <div class="product-card" onclick="openModal(1)">
                <img src="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=600&fit=crop&q=80" class="product-image">
                <span class="product-badge">POPULAR</span>
                <h3 class="product-name">Lavender Essence</h3>
                <p class="product-description">Calming lavender essential oil for relaxation and sleep.</p>
                <div class="product-footer">
                    <div class="product-price">$24.99</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐</div>
                </div>
                <button class="show-details-btn">Show Details</button>
            </div>
            <div class="product-card" onclick="openModal(2)">
                <img src="data:image/jpeg;base64,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" class="product-image">
                <span class="product-badge">NEW</span>
                <h3 class="product-name">Tea Tree Oil</h3>
                <p class="product-description">Powerful natural antibacterial oil for clear skin.</p>
                <div class="product-footer">
                    <div class="product-price">$19.99</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐</div>
                </div>
                <button class="show-details-btn">Show Details</button>
            </div>
        </div>
    </main>
    <div class="modal" id="productModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">×</button>
            <div class="modal-images">
                <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=800&fit=crop&q=80" class="main-image" id="mainImage">
                <div class="thumbnail-images">
                    <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=300&h=300&fit=crop&q=80" class="thumbnail" onclick="changeImage(this)">
                    <img src="https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=300&h=300&fit=crop&q=80" class="thumbnail" onclick="changeImage(this)">
                    <img src="https://images.unsplash.com/photo-1620756858597-dc036e1ef36f?w=300&h=300&fit=crop&q=80" class="thumbnail" onclick="changeImage(this)">
                </div>
            </div>
            <div class="modal-info">
                <h2 class="modal-title" id="modalTitle">Argan Oil</h2>
                <p class="modal-description" id="modalDescription">Pure Moroccan argan oil, rich in vitamin E and fatty acids for radiant skin and hair.</p>
                <div class="modal-price" id="modalPrice">$29.99</div>
                <div class="modal-rating">⭐⭐⭐⭐⭐ (248 reviews)</div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>
    </div>
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
    <script>
        const products = [
            { name: 'Argan Oil', price: '$29.99', description: 'Pure Moroccan argan oil, rich in vitamin E and fatty acids for radiant skin and hair.', image: 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&h=800&fit=crop&q=80' },
            { name: 'Lavender Essence', price: '$24.99', description: 'Calming lavender essential oil for relaxation, better sleep, and aromatherapy wellness.', image: 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&h=800&fit=crop&q=80' },
            { name: 'Tea Tree Oil', price: '$19.99', description: 'Powerful natural antibacterial oil for clear skin and natural healing properties.', image: 'https://images.unsplash.com/photo-1620756858597-dc036e1ef36f?w=800&h=800&fit=crop&q=80' }
        ];
        function openModal(index) {
            const p = products[index];
            document.getElementById('modalTitle').textContent = p.name;
            document.getElementById('modalDescription').textContent = p.description;
            document.getElementById('modalPrice').textContent = p.price;
            document.getElementById('mainImage').src = p.image;
            document.getElementById('productModal').classList.add('active');
        }
        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }
        function changeImage(img) {
            document.getElementById('mainImage').src = img.src.replace('w=300&h=300', 'w=800&h=800');
        }
        document.getElementById('productModal').addEventListener('click', (e) => {
            if (e.target.id === 'productModal') closeModal();
        });
    </script>
</body>
</html>
