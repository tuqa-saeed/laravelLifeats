<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Successful - Meal Plan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: rgb(253, 154, 84);
            --primary-light: rgba(253, 154, 84, 0.15);
            --dark: #333;
            --gray: #777;
            --light-gray: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .success-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            flex: 1;
        }

        .success-icon {
            width: 120px;
            height: 120px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }

        .success-icon i {
            font-size: 60px;
            color: var(--primary);
        }

        .success-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .success-message {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .subscription-details {
            background-color: var(--light-gray);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 40px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: var(--gray);
        }

        .detail-value {
            font-weight: 600;
            color: var(--dark);
        }

        .return-button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 16px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .return-button:hover {
            background-color: rgb(233, 134, 64);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(253, 154, 84, 0.3);
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: var(--primary);
            animation: confetti-fall 3s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .success-container {
                margin: 20px;
                padding: 30px 20px;
            }

            .success-icon {
                width: 100px;
                height: 100px;
            }

            .success-icon i {
                font-size: 50px;
            }

            .success-title {
                font-size: 28px;
            }

            .success-message {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="success-title">Subscription Successful!</h1>
        <p class="success-message">Your meal plan has been successfully purchased and your meals have been scheduled. Get ready for delicious, nutritious meals tailored to your goals!</p>

        <div class="subscription-details">
            <div class="detail-row">
                <span class="detail-label">Plan Name:</span>
                <span class="detail-value" id="planName">Muscle Gain Plan</span>
            </div>
            <!-- Extra user info (optional) -->
            <div class="detail-row">
                <span class="detail-label">Subscriber:</span>
                <span class="detail-value" id="subscriberName"></span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Goal:</span>
                <span class="detail-value" id="planGoal">Muscle Gain</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Duration:</span>
                <span class="detail-value" id="planDuration">30 days</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Start Date:</span>
                <span class="detail-value" id="startDate">April 11, 2025</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">End Date:</span>
                <span class="detail-value" id="endDate">May 11, 2025</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Amount Paid:</span>
                <span class="detail-value" id="amountPaid">JOD 649.99</span>
            </div>
        </div>

        <a href="/Auth/profile.php" class="return-button">Return to Profile</a>
    </div>

    <script>
        // Create confetti effect
        function createConfetti() {
            const colors = [
                'rgb(253, 154, 84)', // Primary color
                '#FFD700', // Gold
                '#FFFFFF', // White
                'rgb(233, 134, 64)', // Darker primary
                'rgb(253, 174, 104)' // Lighter primary
            ];

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 5 + 's';
                document.body.appendChild(confetti);
            }
        }

        // Format date for display
        function formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        // Populate subscription details from response data
        function populateSubscriptionDetails() {
            const storedData = localStorage.getItem('subscriptionSuccessData');

            if (!storedData) {
                document.querySelector('.subscription-details').innerHTML = "<p>⚠️ No subscription data found.</p>";
                return;
            }

            const subscriptionData = JSON.parse(storedData);

            const plan = subscriptionData.subscription_plan;
            const sub = subscriptionData.user_subscription;

            document.getElementById('subscriberName').textContent = subscriptionData.user.name;
            document.getElementById('planName').textContent = plan.name;
            document.getElementById('planGoal').textContent = plan.goal.charAt(0).toUpperCase() + plan.goal.slice(1);
            document.getElementById('planDuration').textContent = plan.duration_days + ' days';
            document.getElementById('startDate').textContent = formatDate(sub.start_date);
            document.getElementById('endDate').textContent = formatDate(sub.end_date);
            document.getElementById('amountPaid').textContent = 'JOD ' + parseFloat(plan.price).toFixed(2);

            // Optionally clear after render
            // localStorage.removeItem('subscriptionSuccessData');
        }


        // Execute when page loads
        document.addEventListener('DOMContentLoaded', () => {
            createConfetti();
            populateSubscriptionDetails();
        });
    </script>
</body>

</html>