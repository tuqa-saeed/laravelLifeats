<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/wrist-watch.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <?php require_once "views/layouts/components/fonts.html"; ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php require_once "views/layouts/components/sidebar.php"; ?>

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <?php require_once "views/layouts/components/logoheader.php"; ?>
                </div>
                <!-- Navbar Header -->
                <?php require_once "views/layouts/components/navbar.php"; ?>
            </div>

            <!-- Main Content -->
            <div class="container">
                <div class="page-inner">
                    <h2>Meal Schedule Details</h2>
                    <hr>

                    <h4>Schedule Info</h4>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>ID:&nbsp;</strong><span id="schedule-id"></span></li>
                        <li class="list-group-item"><strong>Date:&nbsp;</strong><span id="schedule-date"></span></li>
                        <li class="list-group-item"><strong>Locked:&nbsp;</strong><span id="schedule-locked"></span></li>
                    </ul>

                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Name:&nbsp;</strong><span id="user-name"></span></li>
                        <li class="list-group-item"><strong>Email:&nbsp;</strong><span id="user-email"></span></li>
                    </ul>

                    <h4>Subscription Info</h4>
                    <div class="accordion mb-4" id="subscriptionAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSub">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSub" aria-expanded="false" aria-controls="collapseSub">
                                    Subscription #<span id="subscription-id-header">...</span>
                                </button>
                            </h2>
                            <div id="collapseSub" class="accordion-collapse collapse" aria-labelledby="headingSub" data-bs-parent="#subscriptionAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3 text-center">
                                        <img id="subscription-image" src="" alt="Subscription Image" class="img-fluid rounded" style="max-height: 200px;" />
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Name:&nbsp;</strong><span id="subscription-name"></span></li>
                                        <li class="list-group-item"><strong>Goal:&nbsp;</strong><span id="subscription-goal"></span></li>
                                        <li class="list-group-item"><strong>Price:&nbsp;</strong><span id="subscription-price"></span></li>
                                        <li class="list-group-item"><strong>Duration:&nbsp;</strong><span id="subscription-duration"></span> days</li>
                                        <li class="list-group-item"><strong>Description:&nbsp;</strong><span id="subscription-description"></span></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>


                    <h4>Meal Selections</h4>
                    <div id="meal-selection-list">
                        <!-- Meal cards will be injected here -->
                    </div>

                    <a href="index.php?page=meal-schedules/index" class="btn btn-primary mt-4">Back to List</a>
                </div>
            </div>



            <!-- Footer -->
            <?php require_once "views/layouts/components/spinner.html"; ?>
            <?php require_once "views/layouts/components/footer.html"; ?>
        </div>
    </div>

    <!--   Core JS Files   -->
    <?php require "views/layouts/components/scripts.html"; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function getQueryParam(key) {
            const url = new URLSearchParams(window.location.search);
            return url.get(key);
        }

        const scheduleId = getQueryParam('id');

        if (scheduleId) {
            const spinnerOverlay = document.getElementById('spinner-overlay');
            spinnerOverlay.style.display = 'block';

            fetch(`http://127.0.0.1:8000/api/admin/meal-schedules/${scheduleId}`)
                .then(res => res.json())
                .then(schedule => {
                    console.log(schedule);

                    // Schedule info
                    document.getElementById('schedule-id').textContent = schedule.id;
                    document.getElementById('schedule-date').textContent = schedule.date;
                    document.getElementById('schedule-locked').textContent = schedule.locked ? 'Yes' : 'No';

                    // User info
                    const user = schedule.user_subscription.user;
                    document.getElementById('user-name').textContent = user.name;
                    document.getElementById('user-email').textContent = user.email;

                    // Subscription info
                    const subscriptionId = schedule.user_subscription.subscription_id;
                    document.getElementById('subscription-id-header').textContent = subscriptionId;

                    // Fetch subscription details
                    fetch(`http://127.0.0.1:8000/api/admin/subscriptions/${subscriptionId}`)
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to fetch subscription');
                            return res.json();
                        })
                        .then(subscription => {
                            document.getElementById('subscription-name').textContent = subscription.name;
                            document.getElementById('subscription-goal').textContent = subscription.goal;
                            document.getElementById('subscription-price').textContent = `$${subscription.price}`;
                            document.getElementById('subscription-duration').textContent = subscription.duration_days;
                            document.getElementById('subscription-description').textContent = subscription.description || 'N/A';
                            document.getElementById('subscription-image').src = subscription.image_url;
                        })
                        .catch(err => {
                            console.error('Subscription fetch failed:', err);
                        });

                    // Meal Selections
                    const container = document.getElementById('meal-selection-list');
                    container.innerHTML = '';

                    // Check for selected meals
                    const hasCustomSelection = schedule.selections.some(sel => sel.selected === 1);

                    let displayMeals;

                    if (hasCustomSelection) {
                        // Show only selected meals
                        displayMeals = schedule.selections.filter(sel => sel.selected === 1);
                    } else {
                        // No selected meals → Pick one per category
                        const categoryMap = new Map();

                        schedule.selections.forEach(sel => {
                            const categoryId = sel.category_id;
                            if (!categoryMap.has(categoryId)) {
                                categoryMap.set(categoryId, sel); // take the first selection per category
                            }
                        });

                        displayMeals = Array.from(categoryMap.values());
                    }

                    // Render meals
                    displayMeals.forEach(selection => {
                        const meal = selection.meal;
                        const card = document.createElement('div');
                        card.className = 'card mb-3';

                        card.innerHTML = `
    <div class="row no-gutters">
      <div class="col-md-3">
        <img src="${meal.image_url}" class="img-fluid rounded-start" alt="${meal.name}">
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <h5 class="card-title">${meal.name}</h5>
          <p class="card-text">${meal.description}</p>
          <p class="card-text">
            <small>Calories: ${meal.calories} | Protein: ${meal.protein}g | Carbs: ${meal.carbs}g | Fats: ${meal.fats}g</small>
          </p>
          <span class="badge bg-${selection.selected === 1 ? 'success' : 'secondary'}">
            ${selection.selected === 1 ? 'Selected' : 'Default'}
          </span>
        </div>
      </div>
    </div>
  `;

                        container.appendChild(card);
                    });

                })
                .catch(err => {
                    console.error('Error loading schedule:', err);
                    alert('Failed to load meal schedule.');
                })
                .finally(() => {
                    spinnerOverlay.style.display = 'none';
                });
        } else {
            alert('No schedule ID provided.');
        }
    </script>


</body>

</html>