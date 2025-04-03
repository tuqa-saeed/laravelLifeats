<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Subscription Plans</title>
  <link rel="stylesheet" href="../css/subscription-plans.css" />
  <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            display: inline; 
            background: linear-gradient(to right, #ff691c, #ff9d57);
            -webkit-background-clip: text;
            color: transparent;
            animation: fadeIn 2s ease-in-out, glowing 3s infinite alternate, wave 4s infinite ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes glowing {
            0% {
                text-shadow: 0 0 5px rgba(255, 105, 28, 0.5);
            }
            100% {
                text-shadow: 0 0 15px rgba(255, 157, 87, 0.9);
            }
        }

        @keyframes wave {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(2deg); }
            50% { transform: rotate(0deg); }
            75% { transform: rotate(-2deg); }
            100% { transform: rotate(0deg); }
        }
    </style>
  <?php
  require_once __DIR__ . "/../../Homepage/includes/navbar.php";
  ?>

  <div class="container">
    <h1 class="page-title">Choose the perfect plan for your goals.</h1>
    <p class="page-description">Get fresh, nutritious meals delivered with a plan that works for you.</p>

    <div id="subscriptions" class="categories-grid">
      <!-- Plans will be loaded here dynamically -->
    </div>
  </div>

  <?php
  require_once __DIR__ . "/../../Homepage/includes/footer.php";
  ?>
  <script>
    async function loadSubscriptions() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/subscriptions");
        const data = await response.json();

        if (Array.isArray(data)) {
          const container = document.getElementById("subscriptions");
          container.innerHTML = "";

          data.forEach(plan => {
            const card = document.createElement("div");
            card.classList.add("meal-card");

            card.onclick = function() {
              // Store the plan data in localStorage before navigating
              // localStorage.setItem('selectedPlan', JSON.stringify(plan));
              window.location.href = `meal-details.php?id=${plan.id}`;
            };

            card.innerHTML = `
              <div class="meal-overlay">Optimal for <br>${plan.goal}</div>
              <img src="${plan.image_url}" alt="${plan.name}" class="meal-image" />
              <div class="meal-info">
                <div class="meal-name">${plan.name}</div>
                <div class="meal-description">${plan.description}</div>
                <div class="meal-price">Starting from JOD ${(Number(plan.price)).toFixed(2)} per month</div>
              </div>
            `;

            container.appendChild(card);
          });
        } else {
          console.error("⚠️ API response is not an array");
        }
      } catch (error) {
        console.error("❌ Failed to fetch subscriptions:", error);
      }
    }

    document.addEventListener("DOMContentLoaded", loadSubscriptions);
    
  </script>
  
</body>

</html>