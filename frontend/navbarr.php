<!-- navbar.html -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>
<style>
  /* General Navbar Styles */
  .navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #0a1f44;
    color: #fff;
  }

  .navbar .logo {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
  }

  .navbar .nav-links {
    display: flex;
    gap: 20px;
    list-style: none;
  }

  .navbar .nav-links li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    border-radius: 5px;
    padding: 10px 15px;
    transition: color 0.3s ease, background-color 0.3s ease;
  }

  .navbar .nav-links li a:hover {
    color: #0e1a35;
    background-color: #00bfff;
    border-radius: 5px;
    transition: color 0.3s;
  }

  /* Hamburger Button */
  .hamburger {
    display: none;
    background: none;
    border: none;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
  }

  /* Mobile Styles */
  @media (max-width: 768px) {
    .nav-links {
      list-style: none;
      position: fixed;
      top: 10px;
      right: -110%;
      /* Start off-screen to the right */
      height: 100%;
      width: 100%;
      background-color: #0a2239;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: right 0.5s ease;
      /* Transition for sliding effect */
      z-index: 10;
    }

    .nav-links.show {
      right: 0;
      /* Slide into view */
    }

    .nav-links.hide {
      right: -110%;
      /* Slide out of view */
    }

    /* Hamburger and Close Icons */
    .hamburger-icon,
    .close-icon {
      font-size: 24px;
      color: #fff;
      cursor: pointer;
    }

    /* Hide close icon initially */
    .close-icon {
      display: none;
    }

    /* Styling each link */
    .nav-links li {
      margin: 15px 0;
    }

    .nav-links li a {
      color: #fff;
      text-decoration: none;
      font-size: 18px;
    }

    .hamburger {
      display: block;
      background: none;
      border: none;
      font-size: 24px;
      color: #fff;
      cursor: pointer;
    }
  }

  /* Hover effect */
  .nav-links a:hover {
    color: #0e1a35;
    background-color: #00bfff;
    border-radius: 5px;
  }

  /* Special Style for Luxury Cars Button */
  .luxury-btn {
    background-color: #f39c12;
    /* Luxury button color (gold) */
    color: white;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  .navbar .nav-links .luxury-btn:hover {
    background-color: #d35400;
    color: white;
    transform: scale(1.05);
  }

  .hero h2 {
    font-size: 2.5rem;
    color: #00bfff;
  }

  /* General Theme */
  body {
    font-family: Arial, sans-serif;
    background-color: #1b2a49;
    /* Dark blue background */
    color: white;
    margin: 0;
  }

  .header {
    padding: 10px;
    background-color: #0e1a35;
    /* Darker shade for header */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
</style>

<body>
  <!-- Navigation Bar -->
  <header class="header">
    <nav class="navbar">
      <div class="logo"><a href="#"><img src="./assets/images/logo.png" alt="logo" style="width: 100px; height: 50px;"></a></div>
      <ul class="nav-links" id="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#">Rent a Car</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#">Login</a></li>
        <li><a href="#">Register</a></li>
        <li><a href="#luxury" class="luxury-btn">Luxury Cars</a></li>
      </ul>
      <div class="hamburger">
        <span class="hamburger-icon">&#9776;</span>
        <!-- Hamburger Icon -->
        <span class="close-icon" style="display: none">&times;</span>
        <!-- Close Icon -->
      </div>
    </nav>
  </header>
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
</body>

</html>