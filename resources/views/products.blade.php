<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products - Herb Atlas</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-is-admin" content="{{ auth()->check() && auth()->user()->role_id == 1 ? '1' : '0' }}">

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
            grid-template-columns: 1fr 34px 34px;
            gap: 10px;
            margin-top: auto;
            align-items: center;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 60px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            padding: 0 24px;
        }

        @media (max-width: 1100px) {
            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                padding: 0 18px;
            }
        }

        @media (max-width: 700px) {
            .products-grid {
                grid-template-columns: 1fr;
                gap: 18px;
                padding: 0 12px;
            }

            .product-card {
                padding: 10px;
            }

            .product-image {
                width: 100%;
                aspect-ratio: 16 / 10;
                height: auto;
                margin: 0 0 8px;
            }

            .product-card h3 {
                font-size: 0.95rem;
            }

            .product-card p {
                font-size: 0.78rem;
            }

            .price-tag {
                font-size: 1rem;
            }
        }

        .product-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, #ffffff 100%);
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 10px 24px rgba(102, 191, 191, 0.07);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(102, 191, 191, 0.14);
            backdrop-filter: blur(2px);
            min-height: 100%;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(102, 191, 191, 0.14);
            border-color: rgba(102, 191, 191, 0.35);
        }

        .product-image {
            width: 100%;
            aspect-ratio: 16 / 10;
            height: auto;
            object-fit: cover;
            border-radius: 16px;
            margin: 0 0 8px;
            box-shadow: 0 8px 16px rgba(15, 23, 42, 0.06);
            display: block;
        }

        .product-card h3 {
            color: #205e5e;
            font-size: 0.98rem;
            font-weight: 700;
            margin-bottom: 3px;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .product-card p {
            font-size: 0.78rem;
            color: var(--gray);
            margin-bottom: 8px;
            line-height: 1.45;
        }

        .stock-info {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 0 0 8px;
            font-size: 0.75rem;
            color: #64748b;
            background: #f8fbfb;
            padding: 6px 9px;
            border-radius: 999px;
            width: fit-content;
        }

        .stock-info i {
            color: var(--teal);
        }

        .price-tag {
            font-size: 0.98rem;
            font-weight: 800;
            color: #f15f7a;
            margin: 0 0 8px;
            letter-spacing: -0.02em;
        }

        .details-btn {
            flex: 1;
            padding: 10px 12px;
            background: linear-gradient(135deg, var(--teal), #82cdcd);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            box-shadow: 0 6px 14px rgba(102, 191, 191, 0.18);
        }

        .details-btn:hover {
            background: linear-gradient(135deg, #4f9b9b, #73c4c4);
            transform: translateY(-1px);
            box-shadow: 0 10px 18px rgba(102, 191, 191, 0.22);
        }

        .edit-btn,
        .delete-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-size: 1rem;
        }

        .edit-btn {
            background: var(--light-teal);
            color: var(--teal);
            text-decoration: none;
        }

        .edit-btn:hover {
            background: #d4f0f0;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(102, 191, 191, 0.16);
        }

        .delete-btn {
            background: #fff5f5;
            color: var(--coral);
            border: none;
        }

        .delete-btn:hover {
            background: #ffe5e9;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(247, 107, 138, 0.14);
        }

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

        .category-card-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .category-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #f9ffff;
            border: 1px solid rgba(102, 191, 191, 0.2);
            border-radius: 16px;
            padding: 14px 16px;
            box-shadow: 0 4px 14px rgba(102, 191, 191, 0.08);
        }

        .category-card-name {
            color: var(--dark);
            font-weight: 600;
            font-size: 0.95rem;
            word-break: break-word;
        }

        .category-card-delete {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 10px;
            background: #ffe5e9;
            color: var(--coral);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            flex-shrink: 0;
        }

        .category-card-delete:hover {
            background: #ffd5dc;
            transform: scale(1.05);
        }

        .category-card-delete:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
        }

        .category-empty-state {
            padding: 18px;
            border: 1px dashed rgba(102, 191, 191, 0.35);
            border-radius: 16px;
            text-align: center;
            color: var(--gray);
            background: #fbffff;
        }

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

        .products-message {
            display: none;
            margin: 20px 60px 0;
            padding: 14px 18px;
            border-radius: 14px;
            background: white;
            border: 1px solid rgba(102, 191, 191, 0.2);
            color: var(--dark);
            box-shadow: 0 4px 15px rgba(102, 191, 191, 0.08);
        }

        .products-message.is-visible {
            display: block;
        }

        .products-message.is-error {
            border-color: rgba(247, 107, 138, 0.35);
            color: var(--coral);
        }

        .products-message.is-success {
            border-color: rgba(102, 191, 191, 0.35);
            color: var(--teal);
        }

        .loading-overlay {
            display: none;
            margin: 20px 0 0;
            font-size: 0.95rem;
            color: var(--gray);
        }

        .loading-overlay.is-visible {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .loading-overlay i {
            color: var(--teal);
        }

        .product-card__cart-actions {
            display: grid;
            gap: 10px;
            margin-top: 14px;
        }

        .product-card__cart-meta {
            font-size: 0.85rem;
            color: var(--gray);
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

            .products-message {
                margin: 20px 20px 0;
            }
        }

        @media (min-width: 1200px) {
            .products-grid {
                padding: 0 40px;
            }
        }
    </style>
</head>

<body>
    <x-header />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-is-admin" content="{{ auth()->check() && auth()->user()->role_id == 1 ? '1' : '0' }}">

    <div class="toast-container" id="toastContainer">
        @if(session('success'))
            <div class="toast"><i class="fas fa-check-circle" style="color: var(--teal)"></i> {{ session('success') }}</div>
        @endif
    </div>

    <div class="search-section">
        <form method="GET" action="{{ url('/products') }}" class="search-bar-container" id="productsSearchForm">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="search-input" id="searchInput" placeholder="Search for herbs, remedies, essential oils..." value="{{ request('search') }}" autocomplete="off">
            </div>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <div class="filter-bar">
            <form method="GET" action="{{ url('/products') }}" id="categoryFilterForm" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; width: 100%;">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <select name="category" class="category-select" id="categorySelect">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->title }}" @selected(request('category') === $category->title)>{{ $category->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="filter-btn" id="categoryFilterButton"><i class="fas fa-filter"></i> Apply Category</button>
                @if(auth()->check() && auth()->user()->role?->status === 'admin')
                <button type="button" class="filter-btn" onclick="openCreateCategoryModal()"><i class="fas fa-plus"></i> Create Category</button>
                <button type="button" class="filter-btn" onclick="openManageCategoriesModal()"><i class="fas fa-trash"></i> Manage Categories</button>
                @endif
            </form>
        </div>

        <div class="products-message" id="productsMessage" aria-live="polite" role="status"></div>
        <div class="loading-overlay" id="productsLoading">
            <i class="fas fa-spinner fa-spin"></i>
            <span>Loading products...</span>
        </div>
    </div>

    @if($errors->any())
        <div class="products-message is-visible is-error" style="margin-top: 20px;">
            <strong>Validation Errors:</strong>
            <ul style="margin: 10px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main>
        <section>
            <div class="products-grid" id="productsGrid">
                @forelse ($products as $product)
                    @php
                        $picture = $product->pictures->first();
                        $imageUrl = $picture ? asset('storage/' . $picture->img_path) : null;
                        $stock = (int) ($product->stock ?? 0);
                        $price = (float) $product->price;
                    @endphp
                    <div class="product-card" data-category="{{ $product->category?->title ?? 'medicinal' }}" data-price="{{ $price }}">
                        @if($imageUrl)
                            <img src="{{ $imageUrl }}" class="product-image" alt="{{ $product->name }}">
                        @endif

                        <div class="product-card__body">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ Str::limit($product->description, 72) }}</p>

                            <div class="stock-info">
                                <i class="fas fa-boxes"></i> Stock: <strong>{{ $stock }}</strong>
                            </div>

                            <div class="price-tag">
                                {{ number_format($price, 2) }} MAD
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('product.show', $product->id) }}" class="details-btn">
                                <i class="fas fa-info-circle"></i> Details
                            </a>

                            @if (auth()->check() && auth()->user()->role_id == 1)
                                <a href="{{ route('products.edit', $product->id) }}" class="edit-btn">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
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
        </section>
    </main>

    <div class="modal" id="createProductModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>

            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--teal); font-family: 'Playfair Display'; font-size: 2.2rem;">
                    <i class="fas fa-leaf" style="margin-right: 10px;"></i>Add New Herb
                </h2>
                <p style="color: var(--gray);">Share a new herbal treasure with the world</p>
            </div>

            <form id="createProductForm" action="{{ route('products.store') }}" method="post" onsubmit="handleCreateSubmit(event)" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-tag" style="color: var(--teal); margin-right: 5px;"></i>Herb Name *
                    </label>
                    <input type="text" name="name" id="productName" required placeholder="e.g., Lavender, Chamomile, Peppermint..." class="form-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                            <i class="fas fa-boxes" style="color: var(--teal); margin-right: 5px;"></i>Stock Quantity *
                        </label>
                        <input type="number" name="stock" id="productStock" required min="0" placeholder="e.g., 100" class="form-input">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                            <i class="fas fa-coins" style="color: var(--teal); margin-right: 5px;"></i>Price (MAD) *
                        </label>
                        <input type="number" name="price" id="productPrice" required min="0" step="0.01" placeholder="e.g., 29.99" class="form-input">
                    </div>
                </div>

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

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i> Description <span style="color: var(--coral);">*</span>
                    </label>
                    <textarea name="description" id="productDescription" required rows="4" placeholder="Describe the herb, its benefits, uses, and characteristics..." class="form-textarea"></textarea>

                    <div class="ai-generator">
                        <button type="button" class="ai-toggle-btn" onclick="toggleAiInput()">
                            <i class="fas fa-magic"></i> Generate with AI
                        </button>
                        <div class="ai-input-area" id="aiInputArea">
                            <input type="text" class="ai-prompt-input" id="aiPromptInput" placeholder="Briefly describe the product (e.g., 'organic lavender oil for relaxation')">
                            <button type="button" class="ai-generate-btn" id="aiGenerateBtn" onclick="generateDescription()">
                                <i class="fas fa-sparkles"></i> Generate Description
                            </button>
                        </div>
                    </div>
                </div>

                <div class="upload-container" style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-images" style="color: var(--teal); margin-right: 5px;"></i>Herb Images (you can add multiple)
                    </label>
                    <div id="image-upload-rows">
                        <div class="upload-row" id="upload-row-0">
                            <div class="file-input-wrapper">
                                <input type="file" name="images[]" accept="image/*" class="image-input" onchange="previewImage(this, 0)">
                            </div>
                            <div class="preview-wrapper" id="preview-wrapper-0"></div>
                        </div>
                    </div>
                    <button type="button" class="add-more-btn" onclick="addImageRow()">
                        <i class="fas fa-plus-circle"></i> Add another image
                    </button>
                    <p style="font-size: 0.8rem; color: var(--gray); margin-top: 10px;">You can upload multiple images. Click the remove button to delete a picture.</p>
                </div>

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

    <div class="modal" id="manageCategoriesModal">
        <div class="modal-content">
            <button class="modal-close" type="button" onclick="closeManageCategoriesModal()">&times;</button>
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--teal); font-family: 'Playfair Display'; font-size: 2.2rem;">
                    <i class="fas fa-layer-group" style="margin-right: 10px;"></i>Manage Categories
                </h2>
                <p style="color: var(--gray);">Delete categories directly without page reloads</p>
            </div>

            <div class="category-card-list" id="categoryCardList">
                @forelse ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}" data-category-title="{{ $category->title }}">
                        <span class="category-card-name">{{ $category->title }}</span>
                        @if(auth()->check() && auth()->user()->role?->status === 'admin')
                        <button type="button" class="category-card-delete" onclick="deleteCategory({{ $category->id }}, @js($category->title), this)" aria-label="Delete {{ $category->title }}">
                            <i class="fas fa-trash"></i>
                        </button>
                        @endif
                    </div>
                @empty
                    <div class="category-empty-state" id="categoryEmptyState">
                        No categories available.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="modal" id="createCategoryModal">
        <div class="modal-content">
            <button class="modal-close" type="button" onclick="closeCreateCategoryModal()">&times;</button>
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--teal); font-family: 'Playfair Display'; font-size: 2.2rem;">
                    <i class="fas fa-folder-plus" style="margin-right: 10px;"></i>Create Category
                </h2>
                <p style="color: var(--gray);">Add a new category for product organization</p>
            </div>

            <form id="createCategoryForm" action="{{ route('categories.store') }}" method="post">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        <i class="fas fa-tag" style="color: var(--teal); margin-right: 5px;"></i>Category Title *
                    </label>
                    <input type="text" name="title" id="categoryTitleInput" required maxlength="80" placeholder="e.g., Essential Oils" class="form-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <button type="button" onclick="closeCreateCategoryModal()" class="cancel-btn">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-plus-circle"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const DRAFT_ORDER_KEY = 'herb_draft_cart';

        function toggleAiInput() {
            const aiInputArea = document.getElementById('aiInputArea');
            aiInputArea.classList.toggle('active');
            if (aiInputArea.classList.contains('active')) {
                document.getElementById('aiPromptInput').focus();
            }
        }

        async function generateDescription() {
            const promptInput = document.getElementById('aiPromptInput');
            const nameInput = document.getElementById('productName');
            const descriptionArea = document.getElementById('productDescription');
            const genBtn = document.getElementById('aiGenerateBtn');

            if (!promptInput.value.trim()) {
                showToast('Please enter a prompt first', 'error');
                return;
            }

            genBtn.disabled = true;
            const originalBtnContent = genBtn.innerHTML;
            genBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';

            try {
                const response = await fetch("{{ route('ai.generate-description') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        prompt: promptInput.value,
                        name: nameInput.value
                    })
                });
                const data = await response.json();
                descriptionArea.value = data.description;
                showToast('AI description generated!');
            } catch (e) {
                showToast('AI service temporarily unavailable', 'error');
            } finally {
                genBtn.disabled = false;
                genBtn.innerHTML = originalBtnContent;
            }
        }

        let imageRowCounter = 1;
        let productsRequestController = null;

        function openCreateModal() {
            document.getElementById('createProductModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            document.getElementById('createProductModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('createProductForm').reset();
            const container = document.getElementById('image-upload-rows');
            container.innerHTML = '';
            addImageRow(true);
        }

        function openCreateCategoryModal() {
            document.getElementById('createCategoryModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateCategoryModal() {
            document.getElementById('createCategoryModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('createCategoryForm').reset();
        }

        function openManageCategoriesModal() {
            document.getElementById('manageCategoriesModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeManageCategoriesModal() {
            document.getElementById('manageCategoriesModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function addImageRow(reset = false) {
            const container = document.getElementById('image-upload-rows');
            if (reset) {
                container.innerHTML = '';
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

        function previewImage(input, rowId) {
            const wrapper = document.getElementById(`preview-wrapper-${rowId}`);
            wrapper.innerHTML = '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'image-preview';
                    img.alt = 'Preview';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-image-btn';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = function () {
                        input.value = '';
                        wrapper.innerHTML = '';
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        window.onclick = function (event) {
            const createModal = document.getElementById('createProductModal');
            const createCategoryModal = document.getElementById('createCategoryModal');
            const manageCategoriesModal = document.getElementById('manageCategoriesModal');
            if (event.target === createModal) {
                closeCreateModal();
            }
            if (event.target === createCategoryModal) {
                closeCreateCategoryModal();
            }
            if (event.target === manageCategoriesModal) {
                closeManageCategoriesModal();
            }
        };

        window.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('image-upload-rows');
            if (container.children.length === 0) {
                addImageRow(true);
            }

            initializeProductsAjax();
            initializeCategoryForm();
            initializeProductDeletion();
            if (window.HerbAtlasDraftCart) {
                window.HerbAtlasDraftCart.renderDraftCartFromStorage();
                window.HerbAtlasDraftCart.updateDraftCartBadge();
            }
        });

        document.getElementById('createProductForm').addEventListener('submit', async function (e) {
            e.preventDefault();

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

        function initializeProductsAjax() {
            const searchForm = document.getElementById('productsSearchForm');
            const categoryForm = document.getElementById('categoryFilterForm');
            const searchInput = document.getElementById('searchInput');
            const categorySelect = document.getElementById('categorySelect');

            searchForm.addEventListener('submit', function (event) {
                const submitter = event.submitter || document.activeElement;
                const isSearchButton = submitter && submitter.classList && submitter.classList.contains('search-btn');

                if (!isSearchButton) {
                    event.preventDefault();
                    return;
                }

                event.preventDefault();
                fetchProducts({
                    search: searchInput.value.trim(),
                    category: categorySelect.value.trim()
                });
            });

            categoryForm.addEventListener('submit', function (event) {
                event.preventDefault();
                fetchProducts({
                    search: '',
                    category: categorySelect.value.trim()
                });
            });

            categorySelect.addEventListener('change', function () {
                fetchProducts({
                    search: '',
                    category: categorySelect.value.trim()
                });
            });
        }

        function initializeProductDeletion() {
            document.getElementById('productsGrid').addEventListener('submit', async function (event) {
                const form = event.target;
                if (!form.matches('.product-delete-form')) {
                    return;
                }

                event.preventDefault();
                await deleteProduct(form);
            });
        }

        function initializeProductDeletion() {
            document.getElementById('productsGrid').addEventListener('submit', async function (event) {
                const form = event.target;
                if (!form.matches('.product-delete-form')) {
                    return;
                }

                event.preventDefault();
                const button = form.querySelector('button[type="submit"]');
                const card = form.closest('.product-card');

                try {
                    if (button) {
                        button.disabled = true;
                    }

                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: new FormData(form)
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        showToast(data.message || 'Unable to delete product', 'error');
                        return;
                    }

                    if (card) {
                        card.remove();
                    }

                    if (!document.querySelector('#productsGrid .product-card')) {
                        renderProductsGrid([]);
                    }

                    showToast(data.message || 'Product deleted successfully');
                } catch (error) {
                    showToast('Unable to delete product right now', 'error');
                } finally {
                    if (button) {
                        button.disabled = false;
                    }
                }
            });
        }

        function initializeCategoryForm() {
            const form = document.getElementById('createCategoryForm');
            const titleInput = document.getElementById('categoryTitleInput');
            const categoryRegex = /^[A-Za-z0-9][A-Za-z0-9\s&()\-,'".]{1,78}[A-Za-z0-9)]?$/;

            form.addEventListener('submit', function (event) {
                const rawTitle = titleInput.value.trim();
                const normalizedTitle = rawTitle.replace(/\s+/g, ' ');

                if (!normalizedTitle) {
                    event.preventDefault();
                    showToast('Category title is required', 'error');
                    return;
                }

                if (!categoryRegex.test(normalizedTitle)) {
                    event.preventDefault();
                    showToast('Category title contains invalid characters', 'error');
                    return;
                }

                titleInput.value = normalizedTitle;
            });
        }

        async function deleteCategory(categoryId, categoryTitle, button = null) {
            if (!categoryId) {
                showToast('Selected category not found', 'error');
                return;
            }

            try {
                if (button) {
                    button.disabled = true;
                }

                const response = await fetch("{{ route('categories.destroy', ['category' => '__CATEGORY__']) }}".replace('__CATEGORY__', encodeURIComponent(categoryId)), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    showToast(data.message || 'Unable to delete category', 'error');
                    return;
                }

                removeCategoryOption(categoryTitle);
                removeCategoryCard(categoryId);
                document.getElementById('categorySelect').value = '';
                showToast(data.message || 'Category deleted successfully');
            } catch (error) {
                showToast('Unable to delete category right now', 'error');
            } finally {
                if (button) {
                    button.disabled = false;
                }
            }
        }

        function removeCategoryOption(categoryTitle) {
            const selects = [
                document.getElementById('categorySelect'),
                document.getElementById('productCategory')
            ];

            selects.forEach(function (select) {
                if (!select) {
                    return;
                }

                Array.from(select.options).forEach(function (option) {
                    if (option.value === categoryTitle) {
                        option.remove();
                    }
                });
            });
        }

        function removeCategoryCard(categoryId) {
            const cardList = document.getElementById('categoryCardList');
            if (!cardList) {
                return;
            }

            const cards = cardList.querySelectorAll('.category-card');
            cards.forEach(function (card) {
                if (card.dataset.categoryId === String(categoryId)) {
                    card.remove();
                }
            });

            const remainingCards = cardList.querySelectorAll('.category-card');
            const currentEmptyState = document.getElementById('categoryEmptyState');

            if (remainingCards.length === 0 && !currentEmptyState) {
                const emptyState = document.createElement('div');
                emptyState.className = 'category-empty-state';
                emptyState.id = 'categoryEmptyState';
                emptyState.textContent = 'No categories available.';
                cardList.appendChild(emptyState);
            }
        }

        async function deleteProduct(form) {
            const button = form.querySelector('button[type="submit"]');
            const card = form.closest('.product-card');

            if (!form.action) {
                return;
            }

            try {
                if (button) {
                    button.disabled = true;
                }

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                });

                const data = await response.json().catch(() => ({}));

                if (!response.ok) {
                    showToast(data.message || 'Unable to delete product', 'error');
                    return;
                }

                if (card) {
                    card.remove();
                }

                if (!document.querySelector('#productsGrid .product-card')) {
                    renderProductsGrid([]);
                }

                showToast(data.message || 'Product deleted successfully');
            } catch (error) {
                showToast('Unable to delete product right now', 'error');
            } finally {
                if (button) {
                    button.disabled = false;
                }
            }
        }

        async function fetchProducts(options = {}) {
            const searchInput = document.getElementById('searchInput');
            const categorySelect = document.getElementById('categorySelect');
            const productsGrid = document.getElementById('productsGrid');
            const productsMessage = document.getElementById('productsMessage');
            const productsLoading = document.getElementById('productsLoading');

            const search = typeof options.search === 'string' ? options.search : searchInput.value.trim();
            const category = typeof options.category === 'string' ? options.category : categorySelect.value.trim();

            if (productsRequestController) {
                productsRequestController.abort();
            }
            productsRequestController = new AbortController();

            productsLoading.classList.add('is-visible');
            productsMessage.className = 'products-message';
            productsMessage.textContent = '';
            productsMessage.classList.remove('is-visible');

            try {
                const url = new URL("{{ route('products.index') }}", window.location.origin);
                if (search) {
                    url.searchParams.set('search', search);
                }
                if (category) {
                    url.searchParams.set('category', category);
                }
                url.searchParams.set('ajax', '1');

                const response = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: productsRequestController.signal
                });

                const data = await response.json();
                window.isAdmin = document.querySelector('meta[name="user-is-admin"]')?.content === '1';
                window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                if (!response.ok) {
                    renderProductsMessage(getErrorMessage(data), 'error');
                    if (data.errors) {
                        return;
                    }
                    return;
                }

                renderProductsGrid(data.products || []);
                if ((data.products || []).length === 0) {
                    renderProductsMessage(data.message || 'No products matched your search.', 'success');
                } else {
                    productsMessage.className = 'products-message';
                    productsMessage.textContent = '';
                    productsMessage.classList.remove('is-visible');
                }

                if (history.replaceState) {
                    const newUrl = new URL(window.location.href);
                    if (search) {
                        newUrl.searchParams.set('search', search);
                    } else {
                        newUrl.searchParams.delete('search');
                    }
                    if (category) {
                        newUrl.searchParams.set('category', category);
                    } else {
                        newUrl.searchParams.delete('category');
                    }
                    history.replaceState({}, '', newUrl.toString());
                }
            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }
                renderProductsMessage('Unable to load products right now. Please try again.', 'error');
            } finally {
                productsLoading.classList.remove('is-visible');
            }
        }

        function renderProductsGrid(products) {
            const productsGrid = document.getElementById('productsGrid');

            if (!products.length) {
                productsGrid.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-leaf"></i>
                        <p>No herbs matched your current search.</p>
                    </div>
                `;
                return;
            }

            productsGrid.innerHTML = products.map(function (product) {
                const picture = Array.isArray(product.pictures) && product.pictures.length ? product.pictures[0] : null;
                const imageUrl = picture && picture.img_path ? `${window.location.origin}/storage/${picture.img_path}` : (product.image || '');
                const image = imageUrl ? `<img src="${escapeHtml(imageUrl)}" class="product-image" alt="${escapeHtml(product.name)}">` : '';
                const productName = escapeHtml(product.name || '');
                const price = Number(product.price ?? 0).toFixed(2);
                const stock = Number(product.stock ?? 0);
                const category = escapeHtml(product.category || 'medicinal');
                const description = escapeHtml(product.description_excerpt || product.description || '');
                const isAdmin = window.isAdmin;
                const productId = escapeHtml(String(product.id));
                const editUrl = escapeHtml(product.edit_url || '#');
                const deleteUrl = escapeHtml(product.delete_url || '#');
                const detailsUrl = escapeHtml(product.details_url || '#');

                return `
                    <div class="product-card" data-category="${category}" data-price="${escapeHtml(String(product.price ?? ''))}" data-product-id="${productId}">
                        ${image}
                        <div class="product-card__body">
                            <h3>${productName}</h3>
                            <p>${description}</p>
                            <div class="stock-info">
                                <i class="fas fa-boxes"></i> Stock: <strong>${escapeHtml(String(stock))}</strong>
                            </div>
                            <div class="price-tag">${escapeHtml(price)} MAD</div>
                        </div>
                        <div class="card-actions">
                            <a href="${detailsUrl}" class="details-btn">
                                <i class="fas fa-info-circle"></i> Details
                            </a>
                            ${isAdmin ? `
                                <a href="${editUrl}" class="edit-btn" aria-label="Edit ${productName}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="${deleteUrl}" method="POST" class="product-delete-form">
                                    <input type="hidden" name="_token" value="${escapeHtml(window.csrfToken || '')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="delete-btn" aria-label="Delete ${productName}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            ` : ''}
                        </div>
                    </div>
                `;
            }).join('');

            if (window.HerbAtlasDraftCart) {
                window.HerbAtlasDraftCart.renderDraftCartFromStorage();
                window.HerbAtlasDraftCart.updateDraftCartBadge();
            }
        }

        function renderProductsMessage(message, type) {
            const productsMessage = document.getElementById('productsMessage');
            productsMessage.className = 'products-message is-visible ' + (type === 'error' ? 'is-error' : 'is-success');
            productsMessage.innerHTML = message;
        }

        function getErrorMessage(data) {
            if (data && data.message) {
                return escapeHtml(data.message);
            }

            if (data && data.errors) {
                const messages = [];
                Object.keys(data.errors).forEach(function (key) {
                    const values = data.errors[key];
                    if (Array.isArray(values)) {
                        values.forEach(function (value) {
                            messages.push(escapeHtml(value));
                        });
                    }
                });
                return messages.length ? `<strong>Validation Errors:</strong><ul style="margin: 10px 0 0 18px;">${messages.map(function (message) { return `<li>${message}</li>`; }).join('')}</ul>` : 'Validation failed.';
            }

            return 'Something went wrong while loading products.';
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&')
                .replace(/</g, '<')
                .replace(/>/g, '>')
                .replace(/"/g, '"')
                .replace(/'/g, '&#039;');
        }

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
