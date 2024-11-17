<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Register Animation with Blur</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    /* Navigation */
    .nav {
      display: flex;
      justify-content: flex-end;
      background-color: #0d0d63;
      padding: 1rem;
    }

    .nav li {
      list-style: none;
    }

    .nav a {
      color: #ffcd3c;
      text-decoration: none;
      margin-right: 1rem;
      font-weight: bold;
    }

    .nav a:hover {
      color: #d4a514;
    }

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
      background: rgba(13, 13, 99, 0.9);
      /* Semi-transparent dark blue */
      color: #fff;
      padding: 2rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
      max-width: 400px;
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
  </style>

  <div id="pageContent">
    <!-- Navigation -->
    <ul class="nav">
      <li><a href="#" id="loginTrigger">Login</a></li>
      <li><a href="#" id="registerTrigger">Register</a></li>
    </ul>

    <!-- Main Content -->
    <section>
      <h1>Welcome to EliteWheels</h1>
      <p>Your trusted luxury car rental service.</p>
    </section>
  </div>

  <!-- Login Section -->
  <div id="loginSection" class="login-section hidden">
    <form id="loginForm">
      <h2>Login</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <button type="button" id="closeLogin">Close</button>
    </form>
  </div>

  <!-- Register Section -->
  <div id="registerSection" class="register-section hidden">
    <form id="registerForm">
      <h2>Register</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
      
      <button type="button" id="closeRegister">Close</button>
    </form>
  </div>

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