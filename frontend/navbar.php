<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./assets/css/test.css" />
  <title>Web Design Mastery | RENTAL</title>
</head>
<style>
  /* Page Content Blur */
  #pageContent {
    transition: filter 0.5s ease;
  }

  #pageContent.blurred {
    filter: blur(8px);
    /* Apply blur */
    pointer-events: none;
    /* Disable interactions with blurred content */
  }

  /* Login and Register Sections */
  .login-section,
  .register-section {
    position: fixed;
    top: -100%;
    left: 0;
    width: 100%;
    /* Semi-transparent dark blue */
    color: #fff;
    padding: 2rem;
    transition: top 0.5s ease, opacity 0.5s ease;
    z-index: 1000;
  }

  .login-section.hidden,
  .register-section.hidden {
    opacity: 0;
    pointer-events: none;
  }

  .login-section.visible,
  .register-section.visible {
    top: 10%;
    opacity: 1;
    pointer-events: all;
  }

  .login-section form,
  .register-section form {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    color: #000;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
  }

  .login-section form input,
  .register-section form input {
    display: block;
    width: 100%;
    padding: 0.8rem;
    margin: 1rem 0;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .login-section form button,
  .register-section form button {
    padding: 0.8rem 1.5rem;
    background: linear-gradient(45deg, #d4a514, #ffcd3c);
    /* Gold gradient */
    border: none;
    border-radius: 5px;
    color: #0d0d63;
    font-size: 1rem;
    cursor: pointer;
  }

  .login-section form button:hover,
  .register-section form button:hover {
    background: linear-gradient(45deg, #ffcd3c, #d4a514);
  }

  .login-section p,
  .register-section p {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #fff;
  }

  .login-section p a,
  .register-section p a {
    color: #ffcd3c;
    text-decoration: underline;
    cursor: pointer;
  }

  .login-section p a:hover,
  .register-section p a:hover {
    color: #d4a514;
  }
</style>

<body>

  <header>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="#">RENTAL</a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./RentCar.php">Rent</a></li>
        <li><a href="#ride">Ride</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php if (!isset($_SESSION['user_id'])): ?>
          <!-- Show these links if the user is NOT logged in -->
          <li><a href="./login.html">Login</a></li>
          <li><a href="./Register.html">Register</a></li>
        <?php else: ?>
          <!-- Show these links if the user is logged in -->
          <li><a href="./profile.php">Profile</a></li>
          <li><a href="../Backend/logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  </div>


  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./assets/js/main.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const loginTrigger = document.getElementById("loginTrigger");
      const loginSection = document.getElementById("loginSection");
      const closeLogin = document.getElementById("closeLogin");

      const registerTrigger = document.getElementById("registerTrigger");
      const registerSection = document.getElementById("registerSection");
      const closeRegister = document.getElementById("closeRegister");

      const pageContent = document.getElementById("pageContent");

      const goToRegister = document.getElementById("goToRegister");
      const goToLogin = document.getElementById("goToLogin");

      // Show login form
      loginTrigger.addEventListener("click", (e) => {
        e.preventDefault();
        loginSection.classList.remove("hidden");
        loginSection.classList.add("visible");
        pageContent.classList.add("blurred");
      });

      // Close login form
      closeLogin.addEventListener("click", () => {
        loginSection.classList.remove("visible");
        loginSection.classList.add("hidden");
        pageContent.classList.remove("blurred");
      });

      // Show register form
      registerTrigger.addEventListener("click", (e) => {
        e.preventDefault();
        registerSection.classList.remove("hidden");
        registerSection.classList.add("visible");
        pageContent.classList.add("blurred");
      });

      // Close register form
      closeRegister.addEventListener("click", () => {
        registerSection.classList.remove("visible");
        registerSection.classList.add("hidden");
        pageContent.classList.remove("blurred");
      });

      // Switch from Login to Register
      goToRegister.addEventListener("click", (e) => {
        e.preventDefault();
        loginSection.classList.remove("visible");
        loginSection.classList.add("hidden");
        registerSection.classList.remove("hidden");
        registerSection.classList.add("visible");
      });

      // Switch from Register to Login
      goToLogin.addEventListener("click", (e) => {
        e.preventDefault();
        registerSection.classList.remove("visible");
        registerSection.classList.add("hidden");
        loginSection.classList.remove("hidden");
        loginSection.classList.add("visible");
      });
    });

  </script>
</body>

</html>