<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Meal Plan</title>
    <link rel="stylesheet" href="../css/checkout.css">
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Load Modal First -->
    <?php include '../../assets/modal.php'; ?>
    <style>
        #spinner-overlay {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
            justify-content: center;
            align-items: center;
            pointer-events: all;
            background: transparent;
        }

        .spinner-backdrop {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            z-index: 1;
        }

        .spinner-wrapper {
            position: relative;
            z-index: 2;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            left: 50%;
            top: 50%;
        }

        .spinner-border {
            width: 80px;
            height: 80px;
            border-width: 6px;
            border-color: #ff691c transparent #ff691c transparent;
            animation: spinner-rotate 1s linear infinite;
            border-radius: 50%;
        }

        .spinner-icon {
            position: absolute;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            pointer-events: none;
            object-fit: cover;
        }

        .text-orange {
            color: #ff691c !important;
        }

        /* Stripe Card Element Styling */
        .card-container {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #card-element {
            padding: 10px 0;
        }

        #card-errors {
            color: #dc3545;
            font-size: 14px;
            margin-top: 8px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .payment-option.selected {
            border-color: #ff691c;
            background-color: rgba(255, 105, 28, 0.05);
        }

        .payment-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #ddd;
            margin-left: auto;
        }

        .payment-option.selected .payment-radio {
            border-color: #ff691c;
            background-color: #ff691c;
        }

        @keyframes spinner-rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="p-0 m-0">
    <?php
    require_once __DIR__ . "/../../Homepage/includes/navbar.php";
    ?>
    <div class="container">
        <div class="left-column">
            <div class="section">
                <div class="section-title">Delivery address</div>
                <div class="location-container">
                    <div class="location-icon">📍</div>
                    <div class="location-info">
                        Jordan
                        <div class="location-address">Amman</div>
                    </div>
                </div>
                <div style="text-align: right;">
                    <a href="#" class="edit-link">Edit</a>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Delivery time</div>
                <div class="time-options">
                    <div class="time-option selected">08:00AM - 12:00AM</div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Contact details</div>
                <div class="contact-form">
                    <div class="country-code">
                        <span class="flag">JO</span>
                        +962
                    </div>
                    <input type="text" class="mobile-input" placeholder="Mobile number">
                </div>
                <div class="error-message">The mobile number is not valid</div>
            </div>

            <div class="section">
                <div class="section-title">Payment</div>
                <div class="payment-option selected" id="credit-card-option">
                    <div class="payment-icon">💳</div>
                    <div class="payment-text">Credit Card</div>
                    <div class="payment-radio"></div>
                </div>

                <!-- Stripe Card Element -->
                <div class="card-container">
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <div class="credits-row">
                    <div>Use credits</div>
                    <div style="display: flex; align-items: center;">
                        <span class="credit-button">JOD 0</span>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="discount-row">
                    <div>Looking for discount code?</div>
                    <a href="#" class="add-code">Add code</a>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="plan-summary-title">Plan summary</div>

            <div class="meal-plan-container">
                <div class="meal-plan-info">
                    <div class="meal-icon">🍽️</div>
                    <div>
                        <div id="planName">Loading...</div>
                        <div class="meal-details">
                            <span id="planGoal">Loading...</span><br>
                            <span id="planDescription">Loading...</span>, <span id="planDays">Loading...</span> days
                        </div>
                    </div>
                </div>
                <a href="meal-details.php" class="edit-link">Edit</a>
            </div>

            <div class="start-date-box">
                <div class="calendar-icon">📅</div>
                <div class="date-info">
                    <div class="date-title">Start your plan as early as <span id="startDate">Loading...</span></div>
                    <div class="date-description">
                        You will be able to choose the start date that suits you after checkout.
                    </div>
                </div>
            </div>

            <div class="payment-summary-title">Payment summary</div>

            <div class="price-row">
                <div>Package Price</div>
                <div id="packagePrice">Loading...</div>
            </div>

            <div class="total-row">
                <div>Total</div>
                <div>
                    <span id="totalPrice">Loading...</span>
                </div>
            </div>

            <form id="paymentForm">
                <input type="hidden" name="plan_id" id="planId">
                <button class="pay-button" type="submit" id="payButton">Pay Loading...</button>
            </form>
        </div>
    </div>
    <div id="spinner-overlay">
        <div class="spinner-backdrop"></div>
        <div class="spinner-wrapper">
            <div class="spinner-border text-orange" role="status"></div>
            <img src="../../dashboard/views/layouts/components/logo3.ico" alt="Center Icon" class="spinner-icon" />
        </div>
    </div>

    <?php
    require_once __DIR__ . "/../../Homepage/includes/footer.php";
    ?>
    <script>
        // Initialize Stripe
        const stripe = Stripe('pk_test_51RCHdtP6U0BieMqErDqEgOGZ9g67eUENpyYCvbscH8ekZBijy7MygIXiMubZQk4E8FyPspPZJSDjj84pBCID8nPV00LQ8s53dJ'); // Your publishable key
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        // Mount the card element
        cardElement.mount('#card-element');

        // Handle real-time validation errors on the card element
        cardElement.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const spinnerOverlay = document.getElementById('spinner-overlay');

        // Helper to read cookie by name
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
        }

        // Format current date
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        // Load selected plan details
        function loadSelectedPlan() {
            const planData = localStorage.getItem('selectedPlan');
            if (!planData) {
                showModal("Error", 'No selected plan found. Please go back and choose a plan.');
                window.location.href = 'meal-details.php';
                return;
            }

            const plan = JSON.parse(planData);
            document.getElementById('planName').textContent = plan.name;
            document.getElementById('planGoal').textContent = plan.goal;
            document.getElementById('planDescription').textContent = plan.description;
            document.getElementById('planDays').textContent = plan.duration_days;

            const today = new Date();
            document.getElementById('startDate').textContent = formatDate(today);

            const price = parseFloat(plan.price).toFixed(2);
            const priceText = `JOD ${price}`;
            document.getElementById('packagePrice').textContent = priceText;
            document.getElementById('totalPrice').textContent = priceText;
            document.getElementById('payButton').textContent = `Pay ${priceText}`;
            document.getElementById('planId').value = plan.id;
        }

        // Handle payment and subscription with Stripe
        async function processPayment(userId, planId) {
            try {
                spinnerOverlay.style.display = 'block';
                const token = getCookie('token');

                if (!token) {
                    showModal("Error", 'Missing authentication token.');
                    spinnerOverlay.style.display = 'none';
                    return;
                }

                // Create payment method with Stripe
                const {
                    paymentMethod,
                    error
                } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    showModal("Payment Error", error.message);
                    spinnerOverlay.style.display = 'none';
                    return;
                }

                // Send to backend using your existing storeWithAutoSchedule endpoint
                const response = await fetch('http://127.0.0.1:8000/api/user-subscriptions/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        subscription_id: planId,
                        payment_method: paymentMethod.id // Match your backend parameter name
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    showModal("Success!", `${data.message || 'Payment successful and meals scheduled!'}`);
                    console.log('Success:', data);
                    // Optional: redirect to success page or dashboard
                    // setTimeout(() => window.location.href = '../dashboard/', 3000);
                } else if (response.status === 402) {
                    // Handle payment that requires additional action (like 3D Secure)
                    const {
                        payment_intent
                    } = data;

                    // Use Stripe to handle additional authentication
                    const {
                        error: confirmError
                    } = await stripe.confirmCardPayment(payment_intent);

                    if (confirmError) {
                        showModal("Payment Failed", confirmError.message);
                    } else {
                        showModal("Success!", "Payment confirmed successfully!");
                        // Redirect to success page after confirmation
                        // setTimeout(() => window.location.href = '../dashboard/', 3000);
                    }
                } else if (response.status === 409) {
                    // Conflict - user already has an active subscription
                    showModal("Subscription Exists", `${data.message}`);
                } else {
                    showModal("Error", `${data.message || 'Payment failed.'}`);
                    console.error('Error:', data);
                }
            } catch (error) {
                showModal("Error", "An error occurred during payment processing.");
                console.error('Request failed:', error);
            } finally {
                spinnerOverlay.style.display = 'none';
            }
        }

        // Run when DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            loadSelectedPlan();

            document.getElementById('paymentForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const plan = JSON.parse(localStorage.getItem('selectedPlan'));
                const userCookie = getCookie('user');

                if (!plan || !plan.id || !userCookie) {
                    showModal("Error", 'Missing user or plan data.');
                    return;
                }

                const user = JSON.parse(userCookie);
                processPayment(user.id, plan.id);
            });

            // Optional time option behavior
            document.querySelectorAll('.time-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.time-option').forEach(o => o.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your global modal script -->
    <script src="../../assets/global-modal.js"></script>

</body>

</html>