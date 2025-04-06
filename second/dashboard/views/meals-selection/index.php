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
    <style>
        .pagination-dot {
            width: 12px;
            height: 12px;
            background-color: black;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            opacity: 0.4;
            transition: opacity 0.3s ease;
        }

        .pagination-dot.active,
        .pagination-dot:hover {
            opacity: 1;
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
                    <h1>Meals Selections List</h1>

                    <form id="form-search-selections" class="form-inline my-2 d-flex gap-2 flex-wrap">
                        <input type="text" name="keyword" class="form-control" placeholder="Search by date (e.g. 04-04)">
                        <div class="form-check form-check-inline align-self-center ms-2">
                            <input class="form-check-input" type="radio" name="selected" id="all" value="all" checked>
                            <label class="form-check-label" for="all">All</label>
                        </div>
                        <div class="form-check form-check-inline align-self-center">
                            <input class="form-check-input" type="radio" name="selected" id="selected-true" value="true">
                            <label class="form-check-label" for="selected-true">Selected</label>
                        </div>
                        <div class="form-check form-check-inline align-self-center">
                            <input class="form-check-input" type="radio" name="selected" id="selected-false" value="false">
                            <label class="form-check-label" for="selected-false">Not Selected</label>
                        </div>
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>

                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Selected</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="meals-table-body">
                            <!-- Meals will be inserted here -->
                        </tbody>
                    </table>

                    <div id="paginationContainer" class="d-flex justify-content-center mt-4"></div>
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
        document.addEventListener('DOMContentLoaded', () => {
            const spinnerOverlay = document.getElementById('spinner-overlay');
            const tbody = document.getElementById('meals-table-body');
            // const paginationDots = document.getElementById('paginationDots');
            const searchForm = document.getElementById('form-search-selections');
            const keywordInput = searchForm.querySelector('input[name="keyword"]');
            const selectedRadios = searchForm.querySelectorAll('input[name="selected"]');

            const pageSize = 7;
            let currentPage = 0;
            let allData = [];
            let filteredData = [];

            function normalizeDate(dateString) {
                return dateString.replace(/-/g, '').slice(4); // "2025-04-04" => "0404"
            }

            function filterData(keyword, selectedValue) {
                return allData.filter(selection => {
                    const dateStr = selection.meal_schedule.date;
                    const dateMatch = !keyword || normalizeDate(dateStr).includes(keyword.replace(/-/g, ''));

                    const isSelected = selection.selected === 1;
                    const selectedMatch =
                        selectedValue === 'all' ||
                        (selectedValue === 'true' && isSelected) ||
                        (selectedValue === 'false' && !isSelected);

                    return dateMatch && selectedMatch;
                });
            }

            function renderTablePage(data, page) {
                const start = page * pageSize;
                const paginated = data.slice(start, start + pageSize);
                tbody.innerHTML = '';

                if (paginated.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">No results found.</td></tr>`;
                    return;
                }

                paginated.forEach(selection => {
                    const meal = selection.meal;
                    const date = selection.meal_schedule.date;
                    const isSelected = selection.selected === 1 ? 'True' : 'False';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
          <td>${meal.id}</td>
          <td><img src="${meal.image_url}" alt="${meal.name}" style="width: 70px; border-radius: 6px;"></td>
          <td>${meal.name}</td>
          <td>${meal.description}</td>
          <td>${date}</td>
          <td><span class="badge bg-${isSelected === 'True' ? 'success' : 'secondary'}">${isSelected}</span></td>
          <td>
            <a href="index.php?page=meals-selection/show&id=${selection.id}" class="btn btn-sm btn-info">
              <i class="fas fa-eye"></i>
            </a>
          </td>
        `;
                    tbody.appendChild(tr);
                });
            }

            function renderPagination(dataLength) {
                const totalPages = Math.ceil(dataLength / pageSize);
                const pagination = document.getElementById('paginationContainer');
                pagination.innerHTML = '';

                if (totalPages <= 1) return;

                const prevBtn = document.createElement('button');
                prevBtn.className = 'btn btn-outline-secondary btn-sm me-1';
                prevBtn.textContent = 'Previous';
                prevBtn.disabled = currentPage === 0;
                prevBtn.onclick = () => {
                    currentPage--;
                    renderTablePage(filteredData, currentPage);
                    renderPagination(filteredData.length);
                };
                pagination.appendChild(prevBtn);

                const range = 2;
                const start = Math.max(0, currentPage - range);
                const end = Math.min(totalPages, currentPage + range + 1);

                for (let i = start; i < end; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.className = `btn btn-sm mx-1 ${i === currentPage ? 'btn-primary' : 'btn-outline-secondary'}`;
                    pageBtn.textContent = i + 1;
                    pageBtn.onclick = () => {
                        currentPage = i;
                        renderTablePage(filteredData, currentPage);
                        renderPagination(filteredData.length);
                    };
                    pagination.appendChild(pageBtn);
                }

                const nextBtn = document.createElement('button');
                nextBtn.className = 'btn btn-outline-secondary btn-sm ms-1';
                nextBtn.textContent = 'Next';
                nextBtn.disabled = currentPage >= totalPages - 1;
                nextBtn.onclick = () => {
                    currentPage++;
                    renderTablePage(filteredData, currentPage);
                    renderPagination(filteredData.length);
                };
                pagination.appendChild(nextBtn);
            }


            // Initial fetch
            spinnerOverlay.style.display = 'block';
            fetch('http://127.0.0.1:8000/api/admin/meal-selections')
                .then(res => res.json())
                .then(data => {
                    allData = data;
                    filteredData = allData;
                    renderTablePage(filteredData, currentPage);
                    renderPagination(filteredData.length);
                })
                .catch(err => {
                    console.error('Failed to load meal selections:', err);
                    tbody.innerHTML = '<tr><td colspan="7">Error loading data.</td></tr>';
                })
                .finally(() => {
                    spinnerOverlay.style.display = 'none';
                });

            // Search/filter handling
            searchForm.addEventListener('submit', e => {
                e.preventDefault();
                const keyword = keywordInput.value.trim();
                const selectedValue = [...selectedRadios].find(r => r.checked)?.value || 'all';

                filteredData = filterData(keyword, selectedValue);
                currentPage = 0;
                renderTablePage(filteredData, currentPage);
                renderPagination(filteredData.length);
            });
        });
    </script>

</body>

</html>