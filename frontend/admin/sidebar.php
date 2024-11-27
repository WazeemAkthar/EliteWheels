<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/admin.css" />
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <img src="../assets/images/logo.png" alt="Logo" class="logo-img" />
      <h2>EliteWheels</h2>
    </div>
    <nav class="menu">
      <button class="accordion" onclick="navigateToDashboard()">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </button>
      <button class="accordion">
        <i class="fas fa-car"></i> Manage Cars
      </button>
      <div class="panel">
        <a href="brands.php">Brands</a>
        <a href="post-a-vehicle.php">Post a vehicle</a>
        <a href="manage-cars.php">Manage Cars</a>
        <a href="luxury-cars.php">Luxury Cars</a>
      </div>
      <button class="accordion">
        <i class="fas fa-calendar-check"></i> Manage Rentals
      </button>
      <div class="panel">
        <a href="manage-rentals.php">All Rentals</a>
      </div>
      <button class="accordion">
        <i class="fas fa-users"></i> Manage Users
      </button>
      <div class="panel">
        <a href="manage-users.php">All Users</a>
        <a href="ManageAccount.php">Manage Account</a>
      </div>
      <button class="accordion">
        <i class="fas fa-chart-line"></i> Reports
      </button>
      <div class="panel">
        <a href="contact_messages.php">Massages</a>
        <a href="reports.html">View Reports</a>
      </div>

      <!-- Gold Gradient Button with Sub-Buttons -->
      <button class="accordion gold-button">
        <i><img src="../assets/icons/car.png" style="width: 30px;" alt=""></i> Luxury Cars
      </button>
      <div class="panel">
        <a href="luxury-cars.php">Mange Luxury Cars</a>
        <a href="#">Sub Feature 2</a>

      </div>

      <button class="accordion">
        <i class="fas fa-user"></i> Account
      </button>
      <div class="panel">
        <a href="../../Backend/logout.php">Logout</a>
      </div>
    </nav>
  </aside>
  <script>
    // Accordion functionality for sidebar menu
    document.addEventListener("DOMContentLoaded", function () {
      const accordions = document.querySelectorAll(".accordion");

      accordions.forEach((accordion) => {
        accordion.addEventListener("click", function () {
          this.classList.toggle("active");
          const panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          }
        });
      });
    });

    function navigateToDashboard() {
      // Replace 'your-page.html' with the desired URL or page path
      window.location.href = './dashboard.php';
    }

  </script>
</body>

</html>