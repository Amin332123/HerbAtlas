<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Herb Atlas</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
            --shadow: 0 10px 30px rgba(102, 191, 191, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light-teal);
            color: var(--dark);
            line-height: 1.6;
        }

        .card-actions {
            display: grid;
            grid-template-columns: 33% 33% 33%;
            gap: 5px;
            margin-top: 15px;
        }

        /* --- Header --- */
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
            transition: transform 0.3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(247, 107, 138, 0.3);
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

        /* --- Main Content & Grid --- */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 60px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(102, 191, 191, 0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(102, 191, 191, 0.2);
            backdrop-filter: blur(2px);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
            border-color: var(--teal);
        }

        .product-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .product-card h3 {
            color: var(--teal);
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .product-card p {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .stock-info {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 5px 0;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .stock-info i {
            color: var(--teal);
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--coral);
            margin: 10px 0;
        }

        /* --- Buttons --- */
        .details-btn {
            flex: 1;
            padding: 12px;
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .details-btn:hover {
            background: #5ba8a8;
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.3);
        }

        .edit-btn,
        .delete-btn {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-size: 1.1rem;
        }

        .edit-btn {
            background: var(--light-teal);
            color: var(--teal);
            text-decoration: none;
        }

        .edit-btn:hover {
            background: #d4f0f0;
            transform: scale(1.05);
        }

        .delete-btn {
            background: #fff5f5;
            color: var(--coral);
            border: none;
        }

        .delete-btn:hover {
            background: #ffe5e9;
            transform: scale(1.05);
        }

        /* --- Toast --- */
        .toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 1100;
        }

        .toast {
            padding: 15px 25px;
            background: white;
            border-radius: 12px;
            border-left: 5px solid var(--teal);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* --- Search & Filter Section --- */
        .search-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 60px 0;
        }

        .search-bar-container {
            background: white;
            border-radius: 50px;
            padding: 5px;
            display: flex;
            box-shadow: 0 4px 15px rgba(102, 191, 191, 0.15);
        }

        .search-input-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .search-input-wrapper i {
            color: var(--gray);
            margin-right: 10px;
        }

        .search-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 1rem;
            font-family: 'Outfit', sans-serif;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.3);
        }

        .search-btn:hover {
            transform: translateX(2px);
            box-shadow: 0 6px 15px rgba(102, 191, 191, 0.4);
        }

        .filter-bar {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .category-select {
            padding: 12px 30px 12px 20px;
            border: 2px solid var(--teal);
            border-radius: 40px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            background: white;
            color: var(--dark);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2366bfbf'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
        }

        .category-select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.2);
        }

        .filter-btn {
            background: white;
            color: var(--teal);
            border: 2px solid var(--teal);
            padding: 12px 30px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .filter-btn:hover {
            background: var(--light-teal);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.2);
        }

        .filter-btn i {
            margin-right: 8px;
        }

        /* --- Forms --- */
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            transition: 0.3s;
            font-size: 1rem;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--teal);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.1);
        }

        .cancel-btn {
            padding: 15px;
            background: #f0f0f0;
            color: var(--gray);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            font-size: 1rem;
        }

        .cancel-btn:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .submit-btn {
            padding: 15px;
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 191, 191, 0.4);
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--teal);
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .empty-state p {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 20px;
        }

        /* --- Create Modal (multiple image upload) --- */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            width: 95%;
            max-width: 650px;
            border-radius: 30px;
            padding: 40px;
            position: relative;
            animation: modalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            cursor: pointer;
            border: none;
            background: none;
            color: var(--gray);
            transition: color 0.3s;
            z-index: 10;
        }

        .modal-close:hover {
            color: var(--coral);
        }

        /* Image upload area */
        .upload-container {
            margin-bottom: 25px;
        }

        .upload-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
            align-items: center;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 16px;
        }

        .file-input-wrapper {
            flex: 1;
            min-width: 200px;
        }

        .file-input-wrapper input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 2px dashed var(--teal);
            border-radius: 12px;
            background: white;
            font-size: 0.9rem;
        }

        .preview-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .image-preview {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--teal);
            background: #eee;
        }

        .remove-image-btn {
            background: var(--coral);
            color: white;
            border: none;
            border-radius: 8px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.2s;
        }

        .remove-image-btn:hover {
            background: #ff5a7e;
            transform: scale(1.05);
        }

        .add-more-btn {
            background: var(--light-teal);
            color: var(--teal);
            border: 2px dashed var(--teal);
            padding: 10px 20px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
            margin-top: 5px;
        }

        .add-more-btn:hover {
            background: white;
            transform: translateY(-2px);
        }

        @media (max-width: 850px) {
            .header {
                padding: 15px 20px;
            }

            .nav-menu {
                gap: 15px;
            }

            .search-section {
                padding: 20px;
            }

            .main-content {
                padding: 20px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .modal-content {
                padding: 30px 20px;
            }
        }


        .ai-generator {
            margin-top: 12px;
            padding: 15px;
            background: linear-gradient(135deg, rgba(102, 191, 191, 0.08), rgba(247, 107, 138, 0.05));
            border-radius: 14px;
            border: 1px dashed rgba(102, 191, 191, 0.3);
        }

        .ai-toggle-btn {
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            transition: all 0.3s;
            width: 100%;
            justify-content: center;
        }

        .ai-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 191, 191, 0.3);
        }

        .ai-input-area {
            display: none;
            margin-top: 15px;
        }

        .ai-input-area.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ai-prompt-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(102, 191, 191, 0.3);
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            margin-bottom: 12px;
            transition: all 0.3s;
        }

        .ai-prompt-input:focus {
            border-color: var(--teal);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.1);
        }

        .ai-generate-btn {
            background: var(--coral);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .ai-generate-btn:hover:not(:disabled) {
            background: #ff5a7e;
            transform: translateY(-2px);
        }

        .ai-generate-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .ai-generate-btn .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
    </style>
</head>

<body>

    <!-- Header with Create Product Button -->


    <x-header />

    <div class="toast-container" id="toastContainer">
        @if(session('success'))
            <div class="toast"><i class="fas fa-check-circle" style="color: var(--teal)"></i> {{ session('success') }}</div>
        @endif
    </div>

    <!-- Search & Filter Section (no js, pure forms) -->
    <div class="search-section">
        <!-- Search form -->
        <form method="GET" action="{{ url('/products') }}" class="search-bar-container">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="search-input" id="searchInput"
                    placeholder="Search for herbs, remedies, essential oils..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <!-- Category filter bar (no js) -->
        <div class="filter-bar">
            <form method="GET" action="{{ url('/products') }}" style="display: flex; gap: 10px; align-items: center;">
                <!-- Preserve search parameter if any -->
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <select name="category" class="category-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->title }}">{{ $category->title }}</option>

                    @endforeach
                </select>
                <button type="submit" class="filter-btn"><i class="fas fa-filter"></i> Apply Category</button>
            </form>
        </div>
    </div>





    @if($errors->any())
        <div style="background: #fee; padding: 15px; border-radius: 8px; margin-bottom: 20px; z-index: 1000;">
            <strong>Validation Errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="main-content">
        <div class="products-grid" id="productsGrid">
            @forelse ($products as $product)
                <div class="product-card" data-category="{{ $product->category ?? 'medicinal' }}"
                    data-price="{{ $product->price }}">
                 
                   @foreach ($product->pictures  as $picture)
                    <img src="{{ asset('storage/' . $picture->img_path) }}"
                        class="product-image" alt="{{ $product->name }}">
                        @break
                   @endforeach

                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 60) }}</p>

                    <div class="stock-info">
                        <i class="fas fa-boxes"></i> Stock: <strong>{{ $product->stock ?? rand(10, 100) }}</strong>
                    </div>

                    <div class="price-tag">
                        {{ $product->price }} MAD
                    </div>

                    <div class="card-actions">
                        <!-- Details as a link (no modal) -->
                        <a href="{{ url('/products/' . $product->id) }}" class="details-btn">
                            <i class="fas fa-info-circle"></i> Details
                        </a>

                        <!-- Edit link -->
                        <a href="{{ url('/products/' . $product->id . '/edit') }}" class="edit-btn"
                            onclick="event.preventDefault(); alert('Edit link would go to edit page');">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Delete form -->
                        <form action="{{ url('/products/' . $product->id) }}" method="POST"
                            onsubmit="return confirm('Delete this herb?')" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-leaf"></i>
                    <p>No herbs available. Be the first to add one!</p>
                    <button onclick="openCreateModal()" class="create-product-btn" style="margin: 0 auto;">
                        <i class="fas fa-plus-circle"></i> Add Your First Herb
                    </button>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Create Product Modal (with multiple image upload & previews) -->
    <div class="modal" id="createProductModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>

            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--teal); font-family: 'Playfair Display'; font-size: 2.2rem;">
                    <i class="fas fa-leaf" style="margin-right: 10px;"></i>Add New Herb
                </h2>
                <p style="color: var(--gray);">Share a new herbal treasure with the world</p>
            </div>

            <form id="createProductForm" action="{{ route('products.store') }}" method="post"
                onsubmit="handleCreateSubmit(event)" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-tag" style="color: var(--teal); margin-right: 5px;"></i>Herb Name *
                    </label>
                    <input type="text" name="name" id="productName" required
                        placeholder="e.g., Lavender, Chamomile, Peppermint..." class="form-input">
                </div>

                <!-- Stock & Price Row -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                            <i class="fas fa-boxes" style="color: var(--teal); margin-right: 5px;"></i>Stock Quantity *
                        </label>
                        <input type="number" name="stock" id="productStock" required min="0" placeholder="e.g., 100"
                            class="form-input">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                            <i class="fas fa-coins" style="color: var(--teal); margin-right: 5px;"></i>Price (MAD) *
                        </label>
                        <input type="number" name="price" id="productPrice" required min="0" step="0.01"
                            placeholder="e.g., 29.99" class="form-input">
                    </div>
                </div>

                <!-- Category Selection -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-folder" style="color: var(--teal); margin-right: 5px;"></i>Category *
                    </label>
                    <select name="category" id="productCategory" required class="form-select">
                        <option value="" disabled selected>-- Select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->title }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i> Description <span style="color: var(--coral);">*</span>
                    </label>
                    <textarea name="description" id="productDescription" required rows="4"
                        placeholder="Describe the herb, its benefits, uses, and characteristics..."
                        class="form-textarea"></textarea>

                    <!-- AI Description Generator -->
                    <div class="ai-generator">
                        <button type="button" class="ai-toggle-btn" onclick="toggleAiInput()">
                            <i class="fas fa-magic"></i> Generate with AI
                        </button>
                        <div class="ai-input-area" id="aiInputArea">
                            <input type="text" class="ai-prompt-input" id="aiPromptInput"
                                placeholder="Briefly describe the product (e.g., 'organic lavender oil for relaxation')">
                            <button type="button" class="ai-generate-btn" id="aiGenerateBtn"
                                onclick="generateDescription()">
                                <i class="fas fa-sparkles"></i> Generate Description
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Multiple Image Upload Area (with JS previews) -->
                <div class="upload-container" style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-images" style="color: var(--teal); margin-right: 5px;"></i>Herb Images (you can
                        add multiple)
                    </label>
                    <div id="image-upload-rows">
                        <!-- Initial row -->
                        <div class="upload-row" id="upload-row-0">
                            <div class="file-input-wrapper">
                                <input type="file" name="images[]" accept="image/*" class="image-input"
                                    onchange="previewImage(this, 0)">
                            </div>
                            <div class="preview-wrapper" id="preview-wrapper-0">
                                <!-- Preview and remove button will be injected here -->
                            </div>
                        </div>
                    </div>
                    <button type="button" class="add-more-btn" onclick="addImageRow()">
                        <i class="fas fa-plus-circle"></i> Add another image
                    </button>
                    <p style="font-size: 0.8rem; color: var(--gray); margin-top: 10px;">You can upload multiple images.
                        Click the remove button to delete a picture.</p>
                </div>

                <!-- Form Actions -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <button type="button" onclick="closeCreateModal()" class="cancel-btn">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-plus-circle"></i> Create Herb
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>

        function toggleAiInput() {
            const aiInputArea = document.getElementById('aiInputArea');
            aiInputArea.classList.toggle('active');
            if (aiInputArea.classList.contains('active')) {
                document.getElementById('aiPromptInput').focus();
            }
        }


        // ----- Create Modal JS (only for modal display & image upload) -----
        let imageRowCounter = 1; // start from 1 because we have row 0

        function openCreateModal() {
            document.getElementById('createProductModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            document.getElementById('createProductModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('createProductForm').reset();
            // Clear all upload rows except the first
            const container = document.getElementById('image-upload-rows');
            container.innerHTML = ''; // remove all
            // Re-add initial empty row
            addImageRow(true); // force reset to single row
        }

        // Add a new image upload row
        function addImageRow(reset = false) {
            const container = document.getElementById('image-upload-rows');
            if (reset) {
                container.innerHTML = ''; // clear
                imageRowCounter = 0;
            }
            const rowId = imageRowCounter;
            const html = `
                <div class="upload-row" id="upload-row-${rowId}">
                    <div class="file-input-wrapper">
                        <input type="file" name="images[]" accept="image/*" class="image-input" onchange="previewImage(this, ${rowId})">
                    </div>
                    <div class="preview-wrapper" id="preview-wrapper-${rowId}"></div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            imageRowCounter++;
        }

        // Preview image when file selected
        function previewImage(input, rowId) {
            const wrapper = document.getElementById(`preview-wrapper-${rowId}`);
            wrapper.innerHTML = ''; // clear previous preview

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create image preview
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'image-preview';
                    img.alt = 'Preview';

                    // Create remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-image-btn';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = function () {
                        // Clear the file input and remove preview
                        input.value = '';
                        wrapper.innerHTML = '';
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }



        // Close modal if clicked outside
        window.onclick = function (event) {
            const createModal = document.getElementById('createProductModal');
            if (event.target === createModal) {
                closeCreateModal();
            }
        };

        // Initialize with one row if not present (ensures at least one)
        window.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('image-upload-rows');
            if (container.children.length === 0) {
                addImageRow(true);
            }
        });












        // Inside your script tag or a separate file

        document.getElementById('createProductForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            // --- Client-side validation (quick checks) ---
            const name = document.getElementById('productName').value.trim();
            const stock = document.getElementById('productStock').value.trim();
            const price = document.getElementById('productPrice').value.trim();
            const category = document.getElementById('productCategory').value;
            const description = document.getElementById('productDescription').value.trim();

            if (!name || !stock || !price || !category || !description) {
                showToast('All fields are required!', 'error');
                return;
            }
            if (isNaN(stock) || parseInt(stock) < 0) {
                showToast('Stock must be a positive number', 'error');
                return;
            }
            if (isNaN(price) || parseFloat(price) <= 0) {
                showToast('Price must be a positive number', 'error');
                return;
            }

            // File validation (optional: type/size can also be checked here)
            const fileInputs = document.querySelectorAll('.image-input');
            for (let input of fileInputs) {
                if (input.files.length > 0) {
                    const file = input.files[0];
                    if (!file.type.startsWith('image/')) {
                        showToast('Only image files are allowed', 'error');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('Each image must be ≤ 2MB', 'error');
                        return;
                    }
                }
            }



            e.currentTarget.submit();



        });



        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            const color = type === 'success' ? 'var(--teal)' : 'var(--coral)';
            toast.innerHTML = `<i class="fas ${icon}" style="color: ${color}"></i> ${message}`;
            toastContainer.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
</body>

</html>