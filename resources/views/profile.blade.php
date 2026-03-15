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
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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

        <p id="responseFromBackend"></p>
        <div class="profile-header">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop"
                class="profile-image">
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
                        <div class="info-value">+1 (555) 123-4567</div>
                    </div>
                    <button class="edit-btn" onclick="showPhoneModal()">Edit</button>
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
                        <div class="info-value">123 Wellness Avenue, Nature City, NC 12345</div>
                    </div>
                    <button class="edit-btn" onclick="showModal('addressModal')">Edit</button>
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
                    <input type="hidden" name="phone" id="hiddenPhoneValue">
                    <input type="tel" id="phoneInput" class="modal-input" style="width: 100%;" required>
                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal('phoneModal')">Cancel</button>
                        <button class="edit-btn" onclick="showPhoneModal()">Edit</button>
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
                <h2 class="modal-title">Edit Address</h2>
                <form action="{{ route('profileAddress.update') }}" method="POST" class="modal-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="address" placeholder="Shipping Address" class="modal-input" required>
                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeModal('addressModal')">Cancel</button>
                        <button type="submit" class="save-btn">Save Changes</button>
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
        }
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        document.getElementById('phoneForm').onsubmit = function (e) {
            if (iti) {
                const fullNumber = iti.getNumber();
                document.getElementById('hiddenPhoneValue').value = fullNumber;
            }
        };


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


    </script>
</body>

</html>