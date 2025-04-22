<?php
// stats.php - Admin Statistics Dashboard

// Include your necessary PHP files, configs, etc.
// ...

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Admin Dashboard - Statistics</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="assets/img/wrist-watch.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <?php require_once "views/layouts/components/fonts.html"; ?>

    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #818cf8;
            --success: #10b981;
            --info: #3b82f6;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f3f4f6;
            --dark: #1f2937;
        }

        /* Layout styles */
        .wrapper {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }

        .main-panel>.container {
            overflow: scroll;
        }

        .page-inner {
            padding: 20px;
            flex-grow: 1;
            padding-left: 100px;
        }

        /* Stat cards */
        .stat-card {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .card-blue {
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            color: white;
        }

        .card-purple {
            background: linear-gradient(45deg, #8b5cf6, #a78bfa);
            color: white;
        }

        .card-green {
            background: linear-gradient(45deg, #10b981, #34d399);
            color: white;
        }

        .card-orange {
            background: linear-gradient(45deg, #f59e0b, #fbbf24);
            color: white;
        }

        /* Chart styles */
        .chart-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            height: 100%;
        }

        .chart-wrapper {
            width: 100%;
            height: 300px;
            position: relative;
        }

        /* Badge colors */
        .bg-danger {
            background-color: var(--danger);
            color: white;
        }

        .bg-success {
            background-color: var(--success);
            color: white;
        }
    </style>
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
                    <h1 class="text-2xl font-bold mb-6">Dashboard Statistics</h1>

                    <!-- Stats Overview Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card card-blue">
                            <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                            <div class="flex items-center">
                                <div class="text-3xl font-bold" id="total-users">...</div>
                                <div class="ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm opacity-80 mt-2">Total registered users in the system</p>
                        </div>

                        <div class="stat-card card-purple">
                            <h3 class="text-xl font-semibold mb-2">Active Subscriptions</h3>
                            <div class="flex items-center">
                                <div class="text-3xl font-bold" id="total-subscriptions">...</div>
                                <div class="ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm opacity-80 mt-2">Current active user subscriptions</p>
                        </div>

                        <div class="stat-card card-green">
                            <h3 class="text-xl font-semibold mb-2">Meal Selections</h3>
                            <div class="flex items-center">
                                <div class="text-3xl font-bold" id="total-selections">...</div>
                                <div class="ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm opacity-80 mt-2">Total meal selections made</p>
                        </div>

                        <div class="stat-card card-orange">
                            <h3 class="text-xl font-semibold mb-2">Completed Deliveries</h3>
                            <div class="flex items-center">
                                <div class="text-3xl font-bold" id="total-deliveries">...</div>
                                <div class="ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm opacity-80 mt-2">Successfully completed deliveries</p>
                        </div>
                    </div>

                    <!-- Charts Row 1 -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="chart-container">
                            <h3 class="text-lg font-semibold mb-4">User Growth</h3>
                            <div class="chart-wrapper">
                                <canvas id="userGrowthChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-container">
                            <h3 class="text-lg font-semibold mb-4">Subscription Status</h3>
                            <div class="chart-wrapper">
                                <canvas id="subscriptionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row 2 -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="chart-container">
                            <h3 class="text-lg font-semibold mb-4">Weekly Meal Selections</h3>
                            <div class="chart-wrapper">
                                <canvas id="mealSelectionsChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-container">
                            <h3 class="text-lg font-semibold mb-4">Delivery Completion Rate</h3>
                            <div class="chart-wrapper">
                                <canvas id="deliveryRateChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
        </div>
    </div>

    <!--   Core JS Files   -->
    <?php require "views/layouts/components/scripts.html"; ?>

    <script>
        // Fetch and display stats
        document.addEventListener('DOMContentLoaded', function() {
            fetchStats();
            renderCharts();

            // Make charts responsive
            window.addEventListener('resize', function() {
                if (window.dashboardCharts) {
                    for (const chart in window.dashboardCharts) {
                        if (window.dashboardCharts[chart].resize) {
                            window.dashboardCharts[chart].resize();
                        }
                    }
                }
            });
        });

        async function fetchStats() {
            try {
                // Fetch users
                const usersResponse = await fetch('http://127.0.0.1:8000/api/admin/users');
                const usersData = await usersResponse.json();
                document.getElementById('total-users').textContent = usersData.length || 0;

                // Fetch subscriptions
                const subscriptionsResponse = await fetch('http://127.0.0.1:8000/api/admin/user-subscriptions');
                const subscriptionsData = await subscriptionsResponse.json();
                document.getElementById('total-subscriptions').textContent =
                    subscriptionsData.filter(sub => sub.status === 'active').length || 0;

                // Fetch meal selections
                const selectionsResponse = await fetch('http://127.0.0.1:8000/api/admin/meal-selections');
                const selectionsData = await selectionsResponse.json();
                document.getElementById('total-selections').textContent =
                    selectionsData.filter(selection => selection.selected === 1).length || 0;

                // Fetch deliveries
                const deliveriesResponse = await fetch('http://127.0.0.1:8000/api/admin/meal-schedules');
                const deliveriesData = await deliveriesResponse.json();
                // For completed deliveries, we'll count locked schedules as completed
                const completedDeliveries = deliveriesData.filter(delivery => delivery.locked === 1);
                document.getElementById('total-deliveries').textContent = completedDeliveries.length || 0;

                // Update the charts with real data
                updateChartsWithRealData(usersData, subscriptionsData, selectionsData, deliveriesData);

            } catch (error) {
                console.error('Error fetching stats:', error);
                // Show default placeholder data if API fails
                document.getElementById('total-users').textContent = '0';
                document.getElementById('total-subscriptions').textContent = '0';
                document.getElementById('total-selections').textContent = '0';
                document.getElementById('total-deliveries').textContent = '0';
            }
        }

        function renderCharts() {
            // Chart configurations remain the same - just the initial placeholder data
            // User Growth Chart
            const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
            const userGrowthChart = new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Users',
                        data: [0, 0, 0, 0, 0, 0], // Initialize with zeros
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Subscription Status Chart
            const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
            const subscriptionChart = new Chart(subscriptionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Paused', 'Expired', 'Trial'],
                    datasets: [{
                        data: [0, 0, 0, 0], // Initialize with zeros
                        backgroundColor: [
                            '#4f46e5',
                            '#f59e0b',
                            '#ef4444',
                            '#10b981'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    cutout: '70%'
                }
            });

            // Weekly Meal Selections Chart
            const mealSelectionsCtx = document.getElementById('mealSelectionsChart').getContext('2d');
            const mealSelectionsChart = new Chart(mealSelectionsCtx, {
                type: 'bar',
                data: {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    datasets: [{
                        label: 'Selections',
                        data: [0, 0, 0, 0, 0, 0, 0], // Initialize with zeros
                        backgroundColor: '#8b5cf6'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Delivery Rate Chart
            const deliveryRateCtx = document.getElementById('deliveryRateChart').getContext('2d');
            const deliveryRateChart = new Chart(deliveryRateCtx, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'Pending'],
                    datasets: [{
                        data: [0, 0], // Initialize with zeros
                        backgroundColor: [
                            '#10b981',
                            '#f59e0b'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Store chart instances in window object for later updating
            window.dashboardCharts = {
                userGrowthChart,
                subscriptionChart,
                mealSelectionsChart,
                deliveryRateChart
            };
        }

        function updateChartsWithRealData(users, subscriptions, selections, deliveries) {
            // Process API data for user growth chart
            const usersByMonth = processUsersByDate(users);
            window.dashboardCharts.userGrowthChart.data.labels = Object.keys(usersByMonth);
            window.dashboardCharts.userGrowthChart.data.datasets[0].data = Object.values(usersByMonth);
            window.dashboardCharts.userGrowthChart.update();

            // Process API data for subscription status chart
            const subscriptionStatus = processSubscriptionStatus(subscriptions);
            window.dashboardCharts.subscriptionChart.data.labels = Object.keys(subscriptionStatus);
            window.dashboardCharts.subscriptionChart.data.datasets[0].data = Object.values(subscriptionStatus);
            window.dashboardCharts.subscriptionChart.update();

            // Process API data for meal selections by day
            const selectionsByDay = processSelectionsByDay(selections, deliveries);
            window.dashboardCharts.mealSelectionsChart.data.datasets[0].data = Object.values(selectionsByDay);
            window.dashboardCharts.mealSelectionsChart.update();

            // Process API data for delivery statuses
            const deliveryStatuses = processDeliveryStatuses(deliveries);
            window.dashboardCharts.deliveryRateChart.data.labels = Object.keys(deliveryStatuses);
            window.dashboardCharts.deliveryRateChart.data.datasets[0].data = Object.values(deliveryStatuses);
            window.dashboardCharts.deliveryRateChart.update();
        }

        // Helper functions to process API data
        function processUsersByDate(users) {
            // Group users by registration date (month)
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const usersByMonth = {};

            // Initialize all months with 0
            months.forEach(month => {
                usersByMonth[month] = 0;
            });

            // Count users by month
            if (users && users.length) {
                users.forEach(user => {
                    if (user.created_at) {
                        const date = new Date(user.created_at);
                        const month = months[date.getMonth()];
                        usersByMonth[month]++;
                    }
                });
            }

            // Return only the last 6 months for display
            const lastSixMonths = {};
            const currentMonth = new Date().getMonth();

            for (let i = 5; i >= 0; i--) {
                const monthIndex = (currentMonth - i + 12) % 12; // Handle wrapping around to previous year
                const month = months[monthIndex];
                lastSixMonths[month] = usersByMonth[month];
            }

            return lastSixMonths;
        }

        function processSubscriptionStatus(subscriptions) {
            // Process subscription statuses
            const statuses = {
                'Active': 0,
                'Paused': 0,
                'Expired': 0,
                'Trial': 0
            };

            if (subscriptions && subscriptions.length) {
                subscriptions.forEach(sub => {
                    if (sub.status) {
                        const status = sub.status.toLowerCase();

                        if (status.includes('active')) {
                            statuses['Active']++;
                        } else if (status.includes('pause')) {
                            statuses['Paused']++;
                        } else if (status.includes('expire')) {
                            statuses['Expired']++;
                        } else if (status.includes('trial')) {
                            statuses['Trial']++;
                        } else {
                            // Default to active if status doesn't match any known category
                            statuses['Active']++;
                        }
                    }
                });
            }

            return statuses;
        }

        function processSelectionsByDay(selections, schedules) {
            // Process meal selections by day of week
            const days = {
                'Monday': 0,
                'Tuesday': 0,
                'Wednesday': 0,
                'Thursday': 0,
                'Friday': 0,
                'Saturday': 0,
                'Sunday': 0
            };

            // Create a map of schedule IDs to dates
            const scheduleMap = {};
            if (schedules && schedules.length) {
                schedules.forEach(schedule => {
                    if (schedule.id && schedule.date) {
                        scheduleMap[schedule.id] = schedule.date;
                    }
                });
            }

            if (selections && selections.length) {
                selections.forEach(selection => {
                    if (selection.selected === 1 && selection.meal_schedule_id) {
                        // Get the date from the corresponding schedule
                        const scheduleDate = scheduleMap[selection.meal_schedule_id];

                        if (scheduleDate) {
                            const date = new Date(scheduleDate);
                            const dayIndex = date.getDay(); // 0 = Sunday, 1 = Monday, etc.
                            const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                            const day = dayNames[dayIndex];
                            days[day]++;
                        }
                    }
                });
            }

            return days;
        }

        function processDeliveryStatuses(deliveries) {
            // Process delivery statuses based on locked field
            const statuses = {
                'Completed': 0,
                'Pending': 0
            };

            if (deliveries && deliveries.length) {
                deliveries.forEach(delivery => {
                    // Use locked status to determine if delivery is completed
                    if (delivery.locked === 1) {
                        statuses['Completed']++;
                    } else {
                        statuses['Pending']++;
                    }
                });
            }

            return statuses;
        }
    </script>
</body>

</html>