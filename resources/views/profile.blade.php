<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Herb Atlas</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/js/intlTelInput.min.js"></script>
    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
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
        }

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

        .main-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 60px;
        }

        .profile-header {
            background: white;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--teal);
        }

        .profile-name {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--teal);
            font-weight: 800;
            margin-bottom: 5px;
        }

        .profile-email {
            color: var(--gray);
        }

        .profile-section {
            background: white;
            padding: 35px;
            border-radius: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(102, 191, 191, 0.08);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 25px;
        }

        .info-grid {
            display: grid;
            gap: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: var(--light-teal);
            border-radius: 12px;
        }

        .info-label {
            font-weight: 600;
            color: var(--dark);
        }

        .info-value {
            color: var(--gray);
        }

        .edit-btn {
            padding: 8px 16px;
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .edit-btn:hover {
            background: #5ab0b0;
        }

        .footer {
            background: linear-gradient(135deg, var(--dark), #1a202c);
            color: white;
            padding: 60px 60px 30px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--coral));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.1rem;
        }

        .footer-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        .footer-column h3 {
            margin-bottom: 15px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }

        /* Modal Overlay - Darkens the background */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(45, 55, 72, 0.6);
            display: none;
            /* Hidden by default */
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        /* The Modal Box */
        .modal-card {
            background: white;
            padding: 40px;
            /* Increase from 30px to 40px for more internal "breath" */
            border-radius: 20px;

            /* Controlling the Size */
            width: 90%;
            /* Ensures it doesn't touch screen edges on mobile */
            max-width: 600px;
            /* Increase this (e.g., 600px or 700px) to make it wider */

            /* Optional: Controlling Height */
            min-height: 400px;
            /* Force a minimum height if you want it to look "tall" */

            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--teal);
            margin-bottom: 20px;
        }



        .modal-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-input {
            padding: 12px;
            border: 2px solid var(--light-teal);
            border-radius: 10px;
            font-family: inherit;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .save-btn {
            flex: 1;
            padding: 12px;
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .cancel-btn {
            padding: 12px;
            background: var(--gray);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.02);
        }

        .avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-overlay {
            position: absolute;
            inset: 0;
            background: rgba(45, 55, 72, 0.6);
            /* Your dark teal/gray theme */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .avatar-wrapper:hover .upload-overlay {
            opacity: 1;
        }

        .upload-overlay i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .save-photo-btn {
            margin-top: 15px;
            padding: 8px 20px;
            background-color: var(--teal);
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            animation: fadeIn 0.5s ease;
        }

        /* Update your form-grid to use the new space */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* Equal 50/50 split now that it's wider */
            gap: 20px;
            /* Bigger gap for a bigger modal */
        }

        .form-group {
            display: grid;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
            /* Soft dark gray */
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .modal-input {
            padding: 12px 16px;
            border: 2px solid #edf2f7;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .modal-input:focus {
            outline: none;
            border-color: var(--teal);
            /* Your main project color */
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 128, 128, 0.1);
        }

        /* Modal Styling */
        .modal-card {
            background: white;
            padding: 40px;
            /* Increase from 30px to 40px for more internal "breath" */
            border-radius: 20px;

            /* Controlling the Size */
            width: 90%;
            /* Ensures it doesn't touch screen edges on mobile */
            max-width: 600px;
            /* Increase this (e.g., 600px or 700px) to make it wider */

            /* Optional: Controlling Height */
            min-height: 400px;
            /* Force a minimum height if you want it to look "tall" */

            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-subtitle {
            font-size: 0.9rem;
            color: #718096;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 10px;
        }

        .btn-primary {
            background: var(--teal);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            filter: brightness(110%);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
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

        @media (max-width: 640px) {
            .header {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .main-content {
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .footer {
                padding: 40px 20px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <x-header />
    <main class="main-content">
        @if ($errors->any())
            <div style="color: #b91c1c; padding: 1rem; margin-bottom: 1rem; text-align: center;">
                <strong>Whoops! Something went wrong:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        <p id="responseFromBackend"></p>
                    @endforeach
                </ul>
            </div>
        @endif
        @error('phone')
            <small style="color: var(--coral); margin-top: 5px;">{{ $message }}</small>
        @enderror

        <p id="responseFromBackend"></p>
        <div class="profile-header">
            <div class="profile-image-container">
                <form action="{{ route('profileImage.update') }}" method="POST" enctype="multipart/form-data"
                    id="imageUploadForm">
                    @csrf
                    @method('PUT')

                    <div class="avatar-wrapper">
                        <img id="avatar-preview"
                            src="{{ $user->picture ? asset('storage/' . $user->picture->img_path) : 'https://ui-avatars.com/api/?background=random&name=' . $user->firstName . ' ' . $user->lastName }}"
                            alt="Profile Picture">

                        <label for="file-input" class="upload-overlay">
                            <i class="fas fa-camera"></i>
                            <span>Change Photo</span>
                        </label>

                        <input id="file-input" type="file" name="photo" accept="image/*" onchange="previewImage(event)"
                            style="display: none;" />
                    </div>

                    <button type="submit" id="save-photo-btn" class="save-photo-btn" style="display: none;">
                        Save New Photo
                    </button>


                    <span id="imgerror" style="color:red;"></span>
                </form>
            </div>

            <div>
                <h1 class="profile-name">{{ $user->firstName }} {{ $user->lastName }}</h1>
                <p class="profile-email">{{ $user->email }}</p>
            </div>
        </div>
        <section class="profile-section">
            <h2 class="section-title">Personal Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div>
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $user->firstName }} {{ $user->lastName }}</div>
                    </div>
                    <button class="edit-btn" onclick="showModal('nameModal')">Edit</button>
                </div>

                <div class="info-item">
                    <div>
                        <div class="info-label">Phone Number</div>
                        <div class="info-value" id="phoneDisplay">
                            {{ $user->phone_number ? $user->phone_number : 'No Number Phone Added' }}
                        </div>
                    </div>
                    <button class="edit-btn"
                        onclick="showPhoneModal()">{{ $user->phone_number ? 'Edit' : 'Add'}}</button>
                </div>

                <div class="info-item">
                    <div>
                        <div class="info-label">Password</div>
                        <div class="info-value">••••••••</div>
                    </div>
                    <button class="edit-btn" onclick="showModal('passwordModal')">Edit</button>
                </div>

                <div class="info-item">
                    <div>
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $user->Region }} - {{ $user->city }} {{ $user->street }}  {{ $user->postal_code }}</div>
                    </div>
                    <button class="edit-btn" onclick="showModal('addressModal')">{{ $user->city ? "Edit" : "Add" }}</button>
                </div>

            </div>
        </section>





        <div class="modal-overlay" id="nameModal">
            <div class="modal-card">
                <h2 class="modal-title">Edit Name</h2>

                <form action="{{ route('profileName.update') }}" method="POST" class="modal-form">
                    @csrf
                    @method('PUT')

                    <div style="display: grid; gap: 10px;">
                        <input type="text" name="firstName" placeholder="First Name" class="modal-input"
                            style="flex: 1;" value="{{ $user->firstName }}" required>

                        <input type="text" name="lastName" placeholder="Last Name" class="modal-input" style="flex: 1;"
                            value="{{ $user->lastName }}" required>
                    </div>


                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal('nameModal')">Cancel</button>
                        <button type="submit" class="edit-btn" onclick="showModal('nameModal')">Edit</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal-overlay" id="phoneModal">
            <div class="modal-card">
                <h2 class="modal-title">Edit Phone Number</h2>
                <form action="{{ route('profilePhone.update') }}" method="POST" class="modal-form" id="phoneForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="phone_number" id="hiddenPhoneValue">
                    <input type="tel" id="phoneInput" class="modal-input" style="width: 100%;" required>
                    <span id="phoneError"></span>
                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal('phoneModal')">Cancel</button>
                        <button type="submit" class="edit-btn">{{ $user->phone_number ? 'Edit' : 'Add'}}</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal-overlay" id="passwordModal">
            <div class="modal-card">
                <h2 class="modal-title">Change Password</h2>
                <form id="passwordForm" action="{{ route('profilePassword.update') }}" method="POST" class="modal-form">
                    @csrf
                    @method('PUT')
                    <div id="PasswordErrors" style="color: red;">

                    </div>
                    <input id="oldPassword" type="password" name="old_password" placeholder="Current Password"
                        class="modal-input" required>
                    <input id="newPassword" type="password" name="new_password" placeholder="New Password"
                        class="modal-input" required>
                    <input id="newPasswordConfirmation" type="password" name="new_password_confirmation"
                        placeholder="Confirm New Password" class="modal-input" required>

                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal('passwordModal')">Cancel</button>
                        <button type="submit" class="edit-btn" onclick="showModal('passwordModal')">Edit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-overlay" id="addressModal">
            <div class="modal-card">
                <div class="modal-header">
                    <h2 class="modal-title">{{ $user->city ? "Edit" : "Add" }} Shipping Address</h2>
                    <p class="modal-subtitle">Ensure your delivery details are accurate.</p>
                </div>

                <form action="{{ route('profileAddress.update') }}" method="POST" class="modal-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="street"><i class="fas fa-map-marker-alt"></i> Street Address</label>
                        <input type="text" name="street" id="street" value="{{ $user->address->street ?? '' }}"
                            placeholder="e.g. 15 Rue Hassan II, Appt 4" class="modal-input" required>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" value="{{ $user->address->city ?? '' }}"
                                placeholder="Casablanca" class="modal-input" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code"
                                    value="{{ $user->address->postal_code ?? '' }}" placeholder="20000"
                                    class="modal-input" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="region">State / Region</label>
                        <input type="text" name="region" id="region" value="{{ $user->address->region ?? '' }}"
                            placeholder="Grand Casablanca" class="modal-input">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" onclick="closeModal('addressModal')">Cancel</button>
                        <button type="submit" class="btn-primary">Save Address</button>
                    </div>
                </form>
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

    <script>
        let iti;
        function showModal(modalId) {
            let PasswordErrors = document.getElementById('PasswordErrors');
            if (PasswordErrors) {
                PasswordErrors.innerHTML = " ";
            }


            document.getElementById(modalId).style.display = 'flex';
        }
        function showPhoneModal() {
            const modal = document.getElementById('phoneModal');
            modal.style.display = 'flex';
            const input = document.querySelector("#phoneInput");

            if (!iti) {
                iti = window.intlTelInput(input, {
                    initialCountry: "ma",
                    separateDialCode: true,
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@21.1.1/build/js/utils.js",
                });
            }
            const currentNumber = "{{ $user->phone_number ?? '' }}";

            if (currentNumber) {

                iti.setNumber(currentNumber);
            } else {

                iti.setNumber("");
            }


            const phoneForm = document.getElementById('phoneForm');
            phoneForm.addEventListener('submit', function (e) {

                e.preventDefault();
                const errorMsg = document.getElementById('phoneError');
                errorMsg.innerHTML = " ";
                const inputField = document.getElementById('phoneInput');

                if (iti.isValidNumber()) {
                    const fullNumber = iti.getNumber();
                    document.getElementById('hiddenPhoneValue').value = fullNumber;

                    // AJAX Submit to avoid 302 Redirect
                    fetch("{{ route('profilePhone.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'PUT',
                            phone_number: fullNumber
                        })
                    })
                        .then(async response => {
                            const data = await response.json();
                            if (!response.ok) throw data;
                            return data;
                        })
                        .then(data => {
                            document.getElementById('phoneDisplay').textContent = fullNumber;
                            document.getElementById('responseFromBackend').innerText = data.message;
                            closeModal('phoneModal');
                            // Clear success message after 3 seconds
                            setTimeout(() => document.getElementById('responseFromBackend').innerText = "", 3000);
                        })
                        .catch(error => {
                            errorMsg.innerHTML = error.errors?.phone_number ? error.errors.phone_number[0] : (error.message || "An error occurred");
                        });
                } else {
                    errorMsg.innerHTML = "Please enter a valid phone number.";
                    return;
                }

            });



        }



        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }



        // password :

        var regex = /^(?=.*[A-Z])[A-Za-z\d]{8,}$/;


        let passwordForm = document.getElementById('passwordForm');


        passwordForm.addEventListener('submit', (e) => {
            updatePassword(e);
        })


        function updatePassword(e) {
            e.preventDefault();

            let PasswordErrors = document.getElementById('PasswordErrors');
            PasswordErrors.innerHTML = " ";
            let old_password = document.getElementById('oldPassword').value;
            let new_password = document.getElementById('newPassword').value;
            let new_password_confirmation = document.getElementById('newPasswordConfirmation').value;

            if (!regex.test(old_password) || !regex.test(new_password)) {
                PasswordErrors.innerHTML += `ivalid password or new Password`;
                return;

            }
            else if (new_password != new_password_confirmation) {
                PasswordErrors.innerHTML += `new password confirmation is wrong`;
                return;
            }


            fetch('/profile/password', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({ _method: 'PUT', old_password, new_password, new_password_confirmation })
            })
                .then(async res => {

                    const data = await res.json();

                    if (res.ok) {
                        return data;
                    } else {
                        throw data;
                    }
                })
                .then(data => {
                    document.getElementById('passwordForm').reset();
                    document.getElementById('responseFromBackend').innerHTML = data.message;
                    setTimeout(() => {
                        document.getElementById('responseFromBackend').innerHTML = " ";

                    });
                    document.getElementById('responseFromBackend').innerHTML = " ";



                })
                .catch(error => {
                    const errorDiv = document.getElementById('PasswordErrors');

                    if (error.message) {

                        errorDiv.innerHTML = error.message;
                    } else {
                        errorDiv.innerHTML = "An unexpected error occurred.";
                    }
                });



        }



        // profile pic :

        function previewImage(event) {
            document.getElementById('imgerror').innerHTML = " ";

            const reader = new FileReader();
            const preview = document.getElementById('avatar-preview');
            const saveBtn = document.getElementById('save-photo-btn');
            saveBtn.style.display = 'none';

            reader.onload = function () {
                if (reader.readyState === 2) {
                    preview.src = reader.result;
                    saveBtn.style.display = 'inline-block';
                }
            }

            if (event.target.files[0]) {
                if (event.target.files[0].size > 2 * 1024 * 1024) {
                    document.getElementById('imgerror').innerHTML = "This file is too big! Please choose an image under 2MB.";
                    return;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        }



        document.querySelector('#addressModal form').addEventListener('submit', function (e) {
            let isValid = true;
            const street = document.getElementById('street').value.trim();
            const city = document.getElementById('city').value.trim();
            const postalCode = document.getElementById('postal_code').value.trim();

            // Clear previous errors
            document.querySelectorAll('.js-error').forEach(el => el.remove());

            // Validation Logic
            if (street.length < 5) {
                showJsError('street', 'Street address seems too short.');
                isValid = false;
            }

            if (city.length < 2) {
                showJsError('city', 'Please enter a valid city name.');
                isValid = false;
            }

            // Moroccan Postal Code check (usually 5 digits)
            if (!/^\d{5}$/.test(postalCode)) {
                showJsError('postal_code', 'Postal code must be exactly 5 digits.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); 
            }
        });

        function showJsError(id, message) {
            const input = document.getElementById(id);
            const error = document.createElement('small');
            error.className = 'js-error';
            error.style.color = 'var(--coral)';
            error.style.marginTop = '5px';
            error.innerText = message;
            input.after(error);
        }


    </script>
</body>

</html>