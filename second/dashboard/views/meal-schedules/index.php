<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Favicon -->
  <link rel="icon" href="assets/img/wrist-watch.ico" type="image/x-icon" />
  <!-- Dot Style -->
  <style>
    .pagination-dot {
      width: 12px;
      height: 12px;
      background-color: black;
      border-radius: 50%;
      display: inline-block;
      margin-bottom: 10px;
      cursor: pointer;
      opacity: 0.4;
      transition: opacity 0.3s ease;
    }

    .pagination-dot.active,
    .pagination-dot:hover {
      opacity: 1;
    }
  </style>
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
          <h1>Meal Schedules</h1>
          <!-- Search Form -->
          <form id="meal-schedule-form" class="form-inline my-2 d-flex gap-2">
            <input type="text" name="keyword" class="form-control" placeholder="Search by date (e.g. 2025-04-06)">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>

          <table class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>User</th>
                <th>Locked</th>
                <th>Meals</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="meals-table-body">
              <!-- Meal schedules will be inserted here -->
            </tbody>
          </table>
        </div>
      </div>
      <div id="paginationDots" class="d-flex justify-content-center mt-3 gap-2"></div>

      <!-- Footer -->
      <?php require_once "views/layouts/components/spinner.html"; ?>
      <?php require_once "views/layouts/components/footer.html"; ?>
    </div>
  </div>

  <!--   Core JS Files   -->
  <?php require "views/layouts/components/scripts.html"; ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const spinnerOverlay = document.getElementById('spinner-overlay');
      const tbody = document.getElementById('meals-table-body');
      const paginationDots = document.getElementById('paginationDots');
      const searchForm = document.getElementById('meal-schedule-form');
      const searchInput = searchForm.querySelector('input[name="keyword"]');

      const pageSize = 7;
      let currentPage = 0;
      let scheduleData = [];
      let filteredData = [];

      function renderTablePage(data, page) {
        const start = page * pageSize;
        const end = start + pageSize;
        const paginated = data.slice(start, end);

        tbody.innerHTML = '';
        if (paginated.length === 0) {
          tbody.innerHTML = '<tr><td colspan="7" class="text-center">No matching records found.</td></tr>';
          return;
        }

        paginated.forEach(schedule => {
          const user = schedule.user_subscription.user;
          const subscriptionName = schedule.user_subscription.subscription?.name || 'N/A';
          const meals = schedule.selections.map(sel => sel.meal.name).join(', ');

          const tr = document.createElement('tr');
          tr.innerHTML = `
          <td>${schedule.id}</td>
          <td>${schedule.date}</td>
          <td>${user.name}</td>
          <td><span class="badge bg-${schedule.locked ? 'danger' : 'success'}">${schedule.locked ? 'Locked' : 'Unlocked'}</span></td>
          <td>${meals}</td>
          <td>
            <a href="index.php?page=meal-schedules/show&id=${schedule.id}" class="btn btn-sm btn-info">
              <i class="fas fa-eye"></i>
            </a>
          </td>
        `;
          tbody.appendChild(tr);
        });
      }

      function renderPaginationDots(dataLength) {
        const totalPages = Math.ceil(dataLength / pageSize);
        paginationDots.innerHTML = '';

        for (let i = 0; i < totalPages; i++) {
          const dot = document.createElement('span');
          dot.className = 'pagination-dot';
          dot.dataset.page = i;
          if (i === currentPage) dot.classList.add('active');
          paginationDots.appendChild(dot);
        }

        document.querySelectorAll('.pagination-dot').forEach(dot => {
          dot.addEventListener('click', () => {
            currentPage = parseInt(dot.dataset.page);
            renderTablePage(filteredData, currentPage);
            renderPaginationDots(filteredData.length);
          });
        });
      }

      function filterDataByDate(keyword) {
        if (!keyword) return [...scheduleData];

        const cleanKeyword = keyword.replace(/\D/g, ''); // Remove non-digits
        return scheduleData.filter(schedule => {
          const dateParts = schedule.date.split('-'); // e.g. "2025-04-04" → ["2025", "04", "04"]
          const monthDay = dateParts[1] + dateParts[2]; // "0404"

          return monthDay.includes(cleanKeyword);
        });
      }


      // Fetch and render data
      spinnerOverlay.style.display = 'block';
      fetch('http://127.0.0.1:8000/api/admin/meal-schedules')
        .then(res => res.json())
        .then(data => {
          scheduleData = data;
          filteredData = [...scheduleData];
          renderTablePage(filteredData, currentPage);
          renderPaginationDots(filteredData.length);
        })
        .catch(err => {
          console.error('Failed to load meal schedules:', err);
          tbody.innerHTML = '<tr><td colspan="7">Error loading data.</td></tr>';
        })
        .finally(() => {
          spinnerOverlay.style.display = 'none';
        });

      // Handle date search
      searchForm.addEventListener('submit', e => {
        e.preventDefault();
        const keyword = searchInput.value.trim();
        filteredData = filterDataByDate(keyword);
        currentPage = 0;
        renderTablePage(filteredData, currentPage);
        renderPaginationDots(filteredData.length);
      });
    });
  </script>
</body>

</html>