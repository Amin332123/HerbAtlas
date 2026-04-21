<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product - Herb Atlas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light-teal);
            color: var(--dark);
            line-height: 1.6;
        }
        .page-wrap {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }
        .page-card {
            background: white;
            border-radius: 30px;
            padding: 35px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(102, 191, 191, 0.15);
        }
        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .page-title h1 {
            color: var(--teal);
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            margin-bottom: 8px;
        }
        .page-title p {
            color: var(--gray);
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
            background: white;
        }
        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--teal);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 191, 191, 0.1);
        }
        .form-textarea { resize: vertical; min-height: 140px; }
        .section {
            margin-bottom: 20px;
        }
        .label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
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
        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }
        .cancel-btn,
        .submit-btn {
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            font-size: 1rem;
            text-decoration: none;
            text-align: center;
        }
        .cancel-btn {
            background: #f0f0f0;
            color: var(--gray);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .cancel-btn:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }
        .submit-btn {
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            box-shadow: 0 4px 10px rgba(102, 191, 191, 0.3);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 191, 191, 0.4);
        }
        .errors {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 14px;
            background: #fff5f5;
            border: 1px solid rgba(247, 107, 138, 0.35);
            color: var(--coral);
        }
        .current-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }
        .current-image-card {
            background: #f9f9f9;
            border-radius: 16px;
            padding: 10px;
            text-align: center;
        }
        .current-image-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 8px;
        }
        .hint {
            margin-top: 8px;
            font-size: 0.9rem;
            color: var(--gray);
        }
        @media (max-width: 768px) {
            .page-card { padding: 25px 18px; }
            .grid-2,
            .actions { grid-template-columns: 1fr; }
            .page-title h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <x-header />
    <div class="page-wrap">
        <div class="page-card">
            <div class="page-title">
                <h1>Update Product</h1>
                <p>Edit the product details and save your changes</p>
            </div>

            @if ($errors->any())
                <div class="errors">
                    <strong>Validation Errors:</strong>
                    <ul style="margin: 10px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="updateProductForm" onsubmit="return validateUpdateForm()">
                @csrf
                @method('PUT')

                <div class="section">
                    <label class="label" for="name">
                        <i class="fas fa-tag" style="color: var(--teal); margin-right: 5px;"></i>Product Name *
                    </label>
                    <input type="text" name="name" id="name" class="form-input" required value="{{ old('name', $product->name) }}">
                </div>

                <div class="grid-2">
                    <div class="section">
                        <label class="label" for="stock">
                            <i class="fas fa-boxes" style="color: var(--teal); margin-right: 5px;"></i>Stock Quantity *
                        </label>
                        <input type="number" name="stock" id="stock" class="form-input" required min="0" value="{{ old('stock', $product->stock) }}">
                    </div>
                    <div class="section">
                        <label class="label" for="price">
                            <i class="fas fa-coins" style="color: var(--teal); margin-right: 5px;"></i>Price (MAD) *
                        </label>
                        <input type="number" name="price" id="price" class="form-input" required min="0" step="0.01" value="{{ old('price', $product->price) }}">
                    </div>
                </div>

                <div class="section">
                    <label class="label" for="category">
                        <i class="fas fa-folder" style="color: var(--teal); margin-right: 5px;"></i>Category *
                    </label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled>-- Select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->title }}" @selected(old('category', optional($product->category)->title) === $category->title)>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="section">
                    <label class="label" for="description">
                        <i class="fas fa-align-left" style="color: var(--teal); margin-right: 5px;"></i>Description *
                    </label>
                    <textarea name="description" id="description" class="form-textarea" required rows="5">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="upload-container">
                    <label class="label">
                        <i class="fas fa-images" style="color: var(--teal); margin-right: 5px;"></i>Product Images
                    </label>

                    @if($product->pictures->count())
                        <div class="current-images">
                            @foreach($product->pictures as $picture)
                                <div class="current-image-card">
                                    <img src="{{ asset('storage/' . $picture->img_path) }}" alt="{{ $product->name }}">
                                    <label style="display:flex; align-items:center; justify-content:center; gap:6px; font-size:0.85rem; margin-top:8px;">
                                        <input type="checkbox" name="deleted_pictures[]" value="{{ $picture->id }}">
                                        Remove
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <p class="hint">You can add new images below. Check "Remove" to delete any existing picture from the database and storage.</p>

                    <div id="image-upload-rows" style="margin-top: 15px;">
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
                </div>

                <div class="actions">
                    <a href="{{ route('products.index') }}" class="cancel-btn">
                        <i class="fas fa-times" style="margin-right: 8px;"></i>Cancel
                    </a>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save" style="margin-right: 8px;"></i>Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let imageRowCounter = 1;

        function addImageRow() {
            const container = document.getElementById('image-upload-rows');
            const rowId = imageRowCounter;
            container.insertAdjacentHTML('beforeend', `
                <div class="upload-row" id="upload-row-${rowId}">
                    <div class="file-input-wrapper">
                        <input type="file" name="images[]" accept="image/*" class="image-input" onchange="previewImage(this, ${rowId})">
                    </div>
                    <div class="preview-wrapper" id="preview-wrapper-${rowId}"></div>
                </div>
            `);
            imageRowCounter++;
        }

        function previewImage(input, rowId) {
            const wrapper = document.getElementById(`preview-wrapper-${rowId}`);
            wrapper.innerHTML = '';

            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (!file.type.startsWith('image/')) {
                    swal('Only image files are allowed.', "",  "error");
                    input.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    swal('Each image must be 2MB or less.', "",   "error");
                    input.value = '';
                    return;
                }

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
                reader.readAsDataURL(file);
            }
        }

        function validateUpdateForm() {
            const name = document.getElementById('name').value.trim();
            const stock = document.getElementById('stock').value.trim();
            const price = document.getElementById('price').value.trim();
            const category = document.getElementById('category').value;
            const description = document.getElementById('description').value.trim();

            if (!name || !stock || !price || !category || !description) {
                swal('All fields are required.', "", "error");
                return false;
            }

            if (Number(stock) < 0 || Number.isNaN(Number(stock))) {
                swal('Stock must be a valid positive number.',  "",  "error");
                return false;
            }

            if (Number(price) <= 0 || Number.isNaN(Number(price))) {
                swal('Price must be a valid positive number.', "" ,"error");
                return false;
            }

            const fileInputs = document.querySelectorAll('.image-input');
            for (const input of fileInputs) {
                if (!input.files || !input.files.length) continue;
                const file = input.files[0];
                if (!file.type.startsWith('image/')) {
                    swal('Only image files are allowed.',  "", "error");
                    return false;
                }
                if (file.size > 2 * 1024 * 1024) {
                    swal('Each image must be 2MB or less.', "", "error");
                    return false;
                }
            }

            return true;
        }
    </script>
</body>
</html>
        </div>
    </div>

    <script>
        let imageRowCounter = 1;

        function addImageRow() {
            const container = document.getElementById('image-upload-rows');
            const rowId = imageRowCounter;
            container.insertAdjacentHTML('beforeend', `
                <div class="upload-row" id="upload-row-${rowId}">
                    <div class="file-input-wrapper">
                        <input type="file" name="images[]" accept="image/*" class="image-input" onchange="previewImage(this, ${rowId})">
                    </div>
                    <div class="preview-wrapper" id="preview-wrapper-${rowId}"></div>
                </div>
            `);
            imageRowCounter++;
        }

        function previewImage(input, rowId) {
            const wrapper = document.getElementById(`preview-wrapper-${rowId}`);
            wrapper.innerHTML = '';

            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (!file.type.startsWith('image/')) {
                    swal('Only image files are allowed.', "error");
                    input.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    swal('Each image must be 2MB or less..', "error");
                    input.value = '';
                    return;
                }

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
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
