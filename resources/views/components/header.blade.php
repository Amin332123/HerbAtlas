<header class="header">
    <div class="logo-container">
        <div class="logo-icon">HA</div>
        <div class="logo-text">Herb Atlas</div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('profile.show') }}" class="nav-link">Profile</a>
        <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
        <a href="{{ route('products.index') }}" class="nav-link">Products</a>
        <a href="chat.html" class="nav-link">Chat</a>
        <button onclick="openCreateModal()" class="create-product-btn">
            <i class="fas fa-plus-circle"></i> Create Product
        </button>

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="logout-btn">Log Out</button>
        </form>

    </nav>
</header>

<style>
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

        .nav-link:hover {
            color: var(--teal);
        }

        .nav-link.active {
            color: var(--teal);
            font-weight: 600;
        }

        .logout-btn {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--coral), #ff7b9a);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .create-product-btn {
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.3);
            transition: transform 0.3s;
        }

        .create-product-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 191, 191, 0.4);
        }

</style>