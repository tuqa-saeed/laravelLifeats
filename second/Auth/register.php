<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Join Lifeats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to left, #ff691c, #ff9d57);
            font-family: 'Quicksand', sans-serif;
            margin: 0;
        }

        .register-card {
            background: #fff;
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .register-card h2 {
            font-weight: 700;
            color: #ff691c;
            margin-bottom: 1rem;
            text-align: center;
        }

        .tagline {
            font-size: 1rem;
            color: #555;
            margin-bottom: 2rem;
            text-align: center;
        }

        .tagline strong {
            color: #ff691c;
        }

        .form-label {
            font-weight: 600;
        }

        input,
        textarea {
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-size: 1rem;
        }

        textarea {
            resize: none;
        }

        .btn-orange {
            background-color: #ff691c;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-orange:hover {
            background-color: #e85d17;
        }

        .message {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: red;
            text-align: center;
        }

        .register-link {
            display: block;
            margin-top: 1rem;
            text-align: center;
            font-size: 0.95rem;
            color: #ff691c;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 600;
        }

        .register-link:hover {
            color: #e85d17;
            text-decoration: underline;
        }
        #error {
    /* تخصيص الأنماط باستخدام ID */
    font-size: 1rem;
}

.error {
    /* تخصيص الأنماط باستخدام class */
    color: red;
}

       
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 2rem;">
        <div class="register-card">
            <h2>Let’s Get You Started 🚀</h2>
            <p class="tagline">Welcome to <strong>Lifeats</strong> — your journey to healthy eating begins now!</p>

            <form id="registerForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" required>
                    <div id="nameError" class="error"></div>

                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="you@lifeats.com" required>
                    <div id="emailError" class="error"></div>

                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="•••••••••••" required>
                    <div id="passwordError" class="error"></div>

                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Repeat your password" required>
                    <div id="passwordConfirmationError" class="error"></div>

                </div>
                <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Your address" required>
                <div id="addressError" class="error"></div>

                </div>

                <div class="mb-3">
                    <label for="preferences" class="form-label">Preferences / Allergies</label>
                    <textarea class="form-control" id="preferences" rows="3" placeholder="No peanuts, dairy-free, etc."></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-orange">Join the Feast 🍽️</button>
                </div>
                <a href="login.php" class="register-link">I already have an account</a>
                <div id="message" class="message"></div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const messageDiv = document.getElementById('message');

        //RegEx for email and password validation
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        function showError(elementId, message) {
        const errorDiv = document.getElementById(elementId);
        errorDiv.textContent = message;
        }
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            let hasError = false;

            document.querySelectorAll('.error').forEach(errorDiv => errorDiv.textContent = '');

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const preferences = document.getElementById('preferences').value.trim();
            const address = document.getElementById('address').value.trim();
                    
            //validate email
            if (!emailRegex.test(email)) {
                showError('emailError', 'Please enter a valid email address.');
                hasError = true;

            }

           //validate password
            if (!passwordRegex.test(password)) {
                showError('passwordError', 'Password must be at least 8 characters long and contain both letters and numbers.');
                hasError = true;

            }

            //passwordConfirmation 
            if (password !== passwordConfirmation) {
                showError('passwordConfirmationError', 'Passwords do not match.');
                hasError = true;

            }

        //validate address
            if (!address) {
                showError('addressError', 'Please provide your address.');
                hasError = true;

            return;
        }
            if (hasError) {
                    return; 
                }

        const payload = {
            name,
            email,
            password,
            password_confirmation: passwordConfirmation,
            preferences,
            address,
        };


            try {
                const res = await fetch('http://127.0.0.1:8000/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (res.ok) {
                    // Store token and user in cookies
                    setCookie('token', data.token || '');
                    setCookie('user', JSON.stringify(data.user || {}));

                    messageDiv.style.color = 'green';
                    messageDiv.textContent = 'Account created! Redirecting...';

                    setTimeout(() => {
                        window.location.href = 'profile.php';
                    }, 2000);
                } else {
                    messageDiv.textContent = data.message || 'Registration failed.';
                }
            } catch (error) {
                console.error(error);
                messageDiv.textContent = 'Something went wrong. Please try again.';
            }
        });
    </script>

</body>

</html>