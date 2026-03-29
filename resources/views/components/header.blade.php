<header class="header">
    <div class="logo-container">
        <div class="logo-icon">HA</div>
        <div class="logo-text">Herb Atlas</div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('profile.show') }}" class="nav-link">Profile</a>
        <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
        <a href="{{ route('product.index') }}" class="nav-link">Products</a>
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