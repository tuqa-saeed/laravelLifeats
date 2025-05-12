<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

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
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>User Subscriptions</h1>
            <!-- Generate Report Button -->
            <div>
              <button onclick="generatePDF()" class="btn btn-danger">
                <i class="fas fa-file-download"></i> PDF
              </button>
              <button onclick="generateCSV()" class="btn btn-success">
                <i class="fas fa-file-download"></i> CSV
              </button>
            </div>
          </div>

          <div class="mb-3">
            <form id="user-subscription-search-form" class="form-inline d-flex">
              <input type="text" name="keyword" class="form-control" placeholder="Search by user name, subscription, or status">
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
          </div>

          <table class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Subscription Plan</th>
                <th>Status</th>
                <th>Time Left</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="subscription-table-body">
              <!-- JS will populate rows here -->
            </tbody>
          </table>
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
    const spinnerOverlay = document.getElementById('spinner-overlay');
    spinnerOverlay.style.display = 'block';
    fetch("http://127.0.0.1:8000/api/admin/user-subscriptions")
      .then(res => {
        if (!res.ok) throw new Error("Failed to load subscriptions");
        return res.json();
      })
      .then(data => {
        const tbody = document.getElementById("subscription-table-body");

        data.forEach(sub => {
          const tr = document.createElement("tr");

          const days = getDaysRemaining(sub.end_date);

          tr.innerHTML = `
          <td>${sub.id}</td>
          <td>${sub.user?.name || 'N/A'}</td>
          <td>${sub.user?.email || 'N/A'}</td>
          <td>${sub.subscription?.name || 'N/A'}</td>
          <td>${formatStatus(sub.status)}</td>
          <td>${days} days</td>
          <td>
           <a href="index.php?page=user-subscriptions/view&id=${sub.id}" class="btn btn-sm btn-dark">
            <i class="fas fa-info-circle"></i>
            </a>
            <form onsubmit="return deleteSubscription(event, ${sub.id})" style="display:inline;">
              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        `;

          tbody.appendChild(tr);
        });
      })
      .catch(err => {
        document.getElementById("subscription-table-body").innerHTML = `
        <tr><td colspan="7" class="text-danger text-center">${err.message}</td></tr>
      `;
      }).finally(() => {
        spinnerOverlay.style.display = 'none'; // Hide spinner
      });

    function formatStatus(status) {
      let badge = 'bg-dark';
      if (status === 'active') badge = 'bg-success';
      else if (status === 'cancelled') badge = 'bg-danger';
      else if (status === 'paused') badge = 'bg-warning';
      return `<span class="badge ${badge}">${status}</span>`;
    }

    function getDaysRemaining(endDateString) {
      const end = new Date(endDateString);
      const now = new Date();

      // Calculate time difference in milliseconds
      const diffTime = end - now;

      // Convert to days
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      return diffDays > 0 ? `${diffDays} days left` : 'Expired';
    }

    function deleteSubscription(event, id) {
      event.preventDefault();
      if (!confirm("Are you sure you want to delete this subscription?")) return;
      spinnerOverlay.style.display = 'block';
      fetch(`http://127.0.0.1:8000/api/admin/user-subscriptions/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(res => {
          if (!res.ok) throw new Error('Failed to delete subscription');
          alert("Subscription deleted!");
          window.location.reload();
        })
        .catch(err => {
          alert("Error: " + err.message);
        }).finally(() => {
          spinnerOverlay.style.display = 'none'; // Hide spinner
        });
    }
    
    document.getElementById('user-subscription-search-form').addEventListener('submit', function(e) {
      e.preventDefault(); // stop regular form submission

      const keyword = this.querySelector('[name="keyword"]').value.trim().toLowerCase();
      const tbody = document.getElementById("subscription-table-body");
      tbody.innerHTML = ""; // clear previous results
      spinnerOverlay.style.display = 'block';

      fetch("http://127.0.0.1:8000/api/admin/user-subscriptions")
        .then(res => res.json())
        .then(data => {
          const filtered = data.filter(sub => {
            const name = sub.user?.name?.toLowerCase() || '';
            const email = sub.user?.email?.toLowerCase() || '';
            const subscription = sub.subscription?.name?.toLowerCase() || '';
            const status = sub.status?.toLowerCase() || '';
            return name.includes(keyword) || email.includes(keyword) || subscription.includes(keyword) || status.includes(keyword);
          });

          if (filtered.length === 0) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">No results found.</td></tr>`;
          } else {
            filtered.forEach(sub => {
              const tr = document.createElement("tr");
              const days = getDaysRemaining(sub.end_date);
              tr.innerHTML = `
            <td>${sub.id}</td>
            <td>${sub.user?.name || 'N/A'}</td>
            <td>${sub.user?.email || 'N/A'}</td>
            <td>${sub.subscription?.name || 'N/A'}</td>
            <td>${formatStatus(sub.status)}</td>
            <td>${days}</td>
            <td>
              <a href="index.php?page=user-subscriptions/view&id=${sub.id}" class="btn btn-sm btn-dark">
                <i class="fas fa-info-circle"></i>
              </a>
              <form onsubmit="return deleteSubscription(event, ${sub.id})" style="display:inline;">
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          `;
              tbody.appendChild(tr);
            });
          }
        })
        .catch(err => {
          tbody.innerHTML = `<tr><td colspan="7" class="text-danger text-center">${err.message}</td></tr>`;
        })
        .finally(() => {
          spinnerOverlay.style.display = 'none';
        });
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script src="services/orderReport/order_report.js"></script>
  <script src="services/orderReport/order_report_csv.js"></script>



</body>

</html>