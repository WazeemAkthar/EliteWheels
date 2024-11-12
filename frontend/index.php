<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EliteWheels - Home</title>
  <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
  <?php include('./navbar.php'); ?>

  <!-- Hero Carousel Section -->
  <section class="hero-carousel">
    <video autoplay muted loop>
      <source src="./assets/images/Herovideo.mp4" type="video/mp4">
      Your browser does not support HTML video.
    </video>
  </section>


  <!-- Gallery Section -->
  <section class="gallery">
    <div class="car-image oval">
      <img src="./assets/images/car1.jpg" alt="Car 1" />
    </div>
    <div class="car-image circle">
      <img src="./assets/images/car2.jpg" alt="Car 2" />
    </div>
    <div class="car-image hexagon">
      <img src="./assets/images/car3.jpg" alt="Car 3" />
    </div>
    <div class="car-image rectangle">
      <img src="./assets/images/car4.jpg" alt="Car 4" />
    </div>
  </section>

  <?php include('./footer.php'); ?>
  <!-- <script src="./assets/js/carousel.js"></script> -->
  <script>
    const navLinks = document.querySelector(".nav-links");
    const hamburger = document.querySelector(".hamburger");
    const hamburgerIcon = document.querySelector(".hamburger-icon");
    const closeIcon = document.querySelector(".close-icon");

    hamburger.addEventListener("click", function () {
      if (navLinks.classList.contains("show")) {
        navLinks.classList.remove("show");
        navLinks.classList.add("hide"); // Slide out with ease-out

        // Toggle icons
        hamburgerIcon.style.display = "inline";
        closeIcon.style.display = "none";
      } else {
        navLinks.classList.remove("hide");
        navLinks.classList.add("show"); // Slide in with ease-in

        // Toggle icons
        hamburgerIcon.style.display = "none";
        closeIcon.style.display = "inline";
      }
    });
  </script>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            alert('Login successful');
            // Redirect based on role
            if (data.role === 'admin') {
              window.location.href = 'admin/dashboard.html';
            } else if (data.role === 'staff') {
              window.location.href = 'staff/staff-dashboard.html';
            } else if (data.role === 'customer') {
              window.location.href = 'homepage.html';
            }
          } else {
            alert('Login failed');
          }
        });
    });
  </script>

</body>

</html>