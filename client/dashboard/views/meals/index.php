<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

  <!-- Favicon -->
  <link rel="icon" href="assets/img/wrist-watch.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
          <h1>Meals List</h1>
          <a href="index.php?page=meals/create" class="btn btn-primary my-2">Add New Meal</a>
          <form id="meal-search-form" class="form-inline my-2 d-flex">
            <input type="text" name="keyword" class="form-control" placeholder="Search for meals">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>

          <table class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Carbs</th>
                <th>Fats</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="meals-table-body">
              <!-- Meals will be inserted here -->
            </tbody>
          </table>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <button id="prevPage" class="btn btn-secondary">Previous</button>
            <span id="pagination-info"></span>
            <button id="nextPage" class="btn btn-secondary">Next</button>
          </div>
        </div>
      </div>



      <!-- Footer -->
      <?php require_once "views/layouts/components/footer.html"; ?>
      <?php require_once "views/layouts/components/spinner.html"; ?>

    </div>
  </div>

  <!--   Core JS Files   -->
  <?php require "views/layouts/components/scripts.html"; ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    const itemsPerPage = 5;
    let currentPage = 1;
    let mealsData = [];
    let filteredMeals = [];
    const spinnerOverlay = document.getElementById('spinner-overlay');

    function renderTablePage(page) {
      const tbody = document.getElementById('meals-table-body');
      tbody.innerHTML = '';

      const start = (page - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      const meals = filteredMeals.slice(start, end);

      meals.forEach(meal => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
        <td>${meal.id}</td>
        <td><img src="${meal.image_url}" alt="${meal.name}" width="75"></td>
        <td>${meal.name}</td>
        <td>${meal.calories}</td>
        <td>${meal.protein}g</td>
        <td>${meal.carbs}g</td>
        <td>${meal.fats}g</td>
        <td>
          <a href="index.php?page=meals-edit&id=${meal.id}" class="btn btn-sm btn-dark">
            <i class="fas fa-edit"></i>
          </a>
          <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      `;
        tbody.appendChild(tr);
      });

      updatePaginationInfo();
    }

    function updatePaginationInfo() {
      const totalPages = Math.ceil(filteredMeals.length / itemsPerPage);
      document.getElementById('pagination-info').textContent = `Page ${currentPage} of ${totalPages || 1}`;
      document.getElementById('prevPage').disabled = currentPage === 1;
      document.getElementById('nextPage').disabled = currentPage === totalPages || totalPages === 0;
    }

    document.getElementById('prevPage').addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        renderTablePage(currentPage);
      }
    });

    document.getElementById('nextPage').addEventListener('click', () => {
      const totalPages = Math.ceil(filteredMeals.length / itemsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        renderTablePage(currentPage);
      }
    });

    spinnerOverlay.style.display = 'block'; // Show spinner immediately

    // Initial fetch
    fetch("http://127.0.0.1:8000/api/admin/meals")
      .then(res => res.json())
      .then(meals => {
        mealsData = meals;
        filteredMeals = [...meals]; // Start with all meals
        renderTablePage(currentPage);
      })
      .catch(err => {
        console.error('Failed to load meals:', err);
      })
      .finally(() => {
        spinnerOverlay.style.display = 'none';
      });

    // Search handling
    document.getElementById('meal-search-form').addEventListener('submit', function(e) {
      e.preventDefault();

      const keyword = this.keyword.value.trim().toLowerCase();

      if (!keyword) {
        filteredMeals = [...mealsData];
      } else {
        filteredMeals = mealsData.filter(meal =>
          meal.name.toLowerCase().includes(keyword) ||
          meal.calories.toString().includes(keyword) ||
          meal.protein.toString().includes(keyword) ||
          meal.carbs.toString().includes(keyword) ||
          meal.fats.toString().includes(keyword)
        );
      }

      currentPage = 1;
      renderTablePage(currentPage);
    });
  </script>

</body>

</html>