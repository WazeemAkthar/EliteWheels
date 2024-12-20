<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']); // Clear the error after displaying it
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  @import url("https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    height: 100vh;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    background-image: url("./assets/images/Login.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    margin-left: 150px;
  }

  @media (max-width: 767px) {
    body {
      margin-left: 0px;
    }

  }

  .container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
  }

  .login-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .login-box h2 {
    margin: 0 0 15px;
    padding: 0;
    color: #333;
    text-align: center;
    text-transform: uppercase;
  }

  .user-box {
    position: relative;
    margin-bottom: 30px;
  }

  .user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #333;
    border: none;
    outline: none;
    background: transparent;
  }

  .user-box label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #333;
    pointer-events: none;
    transition: 0.5s;
  }

  .user-box input:focus~label,
  .user-box input:valid~label {
    transform: translateY(-20px);
    font-size: 14px;
    color: #333;
  }

  button {
    display: inline-block;
    background: linear-gradient(104deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 32%, rgba(0, 212, 255, 1) 100%);
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    text-transform: uppercase;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    transition: 0.5s;
    letter-spacing: 2px;
    border-radius: 5px;
    width: -webkit-fill-available;
    border: none !important;
    margin-bottom: 20px;
  }

  button:hover {
    background: linear-gradient(110deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 32%, rgba(0, 212, 255, 1) 100%);
    color: #ffffff;
    cursor: pointer;
  }

  .password-toggle-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .email-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
  }

  .email-icon i {
    font-size: 18px;
    line-height: 1;
    color: #333;
  }

  .password-toggle-icon i {
    font-size: 18px;
    line-height: 1;
    color: #333;
    transition: color 0.3s ease-in-out;
  }

  .password-toggle-icon i:hover {
    color: #000;
  }

  .container form .underline::before {
    content: "";
    position: absolute;
    height: 2px;
    width: 100%;
    background: #ccc;
    left: 0;
    bottom: 0;
  }

  .container form .underline::after {
    content: "";
    position: absolute;
    height: 2px;
    width: 100%;
    background: linear-gradient(to right, #295fb3 0%, #7a8eb0 100%);
    left: 0;
    bottom: 0;
    transform: scaleX(0);
    transform-origin: left;
    transition: all 0.3s ease;
  }

  .container form .user-box input:focus~.underline::after,
  .container form .user-box input:valid~.underline::after {
    transform: scaleX(1);
    transform-origin: left;
  }

  a {
    text-decoration: none;
  }

  @media (max-width: 767px) {
    .je2-sign-up-dialog__content__separator {
      margin-top: 0;
      margin-bottom: 20px;
    }
  }

  .je2-sign-up-dialog__content__separator {
    height: 10px;
    margin: 10px 0 35px;
    text-align: center;
    border-bottom: 1px solid #E0E0E0;
  }

  .je2-sign-up-dialog__content__separator span {
    font-size: 14px;
    line-height: 22px;
    letter-spacing: 1px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 0 20px;
    background-color: #fff;
    text-align: center;
    color: #717171;
  }

  .je2-button {
    display: inline-flex;
    color: #151515;
    outline-color: #151515;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    text-align: center;
    align-items: center;
    justify-content: center;
    transition: color 80ms ease, background-color 80ms ease, border-color 80ms ease;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 14px;
    font-family: inter, Arial, sans-serif;
    cursor: pointer;
    box-sizing: border-box;
    position: relative;
    padding: 10px 15px;
    white-space: nowrap;
  }

  a,
  a:hover {
    text-decoration: none;
  }

  @media (max-width: 767px) {
    .je2-sign-up-dialog__content .je2-button {
      margin-bottom: 12px;
    }
  }

  .je2-sign-up-dialog__content .je2-button {
    width: 100%;
    height: 48px;
    margin-bottom: 16px;
    padding: 12px 14px;
    justify-content: space-around;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    position: relative;
  }

  .je2-button>span>svg,
  .je2-button>svg {
    min-width: 20px;
    width: 20px;
    height: 20px;
    pointer-events: none;
  }

  .error-message {
    color: red;
    font-size: 14px;
    margin-top: 10px;
  }
</style>
</head>

<body>
  <div class="container">
    <div class="login-box">

      <h2>Login</h2>
      <form id="loginForm" action="../Backend/login.php" method="post">
        <div class="user-box">
          <input type="email" id="loginEmail" name="loginEmail" required />
          <div class="underline"></div>
          <label>Email</label>
          <span class="email-icon"><i class="fa fa-envelope"></i></span>
        </div>
        <div class="user-box">
          <input type="password" id="loginPassword" name="loginPassword" required />
          <div class="underline"></div>
          <label>Password</label>
          <span class="password-toggle-icon"><i class="fas fa-eye-slash"></i></span>
        </div>
        <?php if ($error): ?>
          <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <button type="submit">
          Sing in
        </button>

      </form>
      <span>don't have an account? <a href="Register.html"> Sing up here</a></span>
      </a>

      <div class="je2-sign-up-dialog__content__separator">
        <span>or</span>
      </div>
      <div class="je2-sign-up-dialog__content">
        <div class="je2-sign-up-dialog__content__first-step _visible">
          <a href="#" class="je2-button ">

            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <g clip-path="url(#clip0_201_8131)">
                <path
                  d="M19.9997 10.2297C19.9997 9.54995 19.9434 8.8665 19.8235 8.19775H10.2002V12.0486H15.711C15.4823 13.2905 14.7475 14.3892 13.6716 15.0873V17.586H16.9593C18.89 15.8443 19.9997 13.2722 19.9997 10.2297Z"
                  fill="#4285F4"></path>
                <path
                  d="M10.2002 20C12.9518 20 15.2723 19.1145 16.963 17.5859L13.6753 15.0873C12.7606 15.6973 11.5797 16.0427 10.2039 16.0427C7.54224 16.0427 5.28545 14.2826 4.4757 11.9163H1.08301V14.492C2.81497 17.8689 6.34262 20 10.2002 20Z"
                  fill="#34A853"></path>
                <path
                  d="M4.47227 11.9163C4.04491 10.6743 4.04491 9.32947 4.47227 8.0875V5.51172H1.08333C-0.363715 8.33737 -0.363715 11.6664 1.08333 14.4921L4.47227 11.9163Z"
                  fill="#FBBC04"></path>
                <path
                  d="M10.2002 3.95732C11.6547 3.93527 13.0605 4.47174 14.1139 5.45649L17.0268 2.60145C15.1824 0.903855 12.7344 -0.0294541 10.2002 -5.85336e-05C6.34261 -5.85336e-05 2.81497 2.13112 1.08301 5.51161L4.47195 8.08739C5.27795 5.71738 7.53849 3.95732 10.2002 3.95732Z"
                  fill="#EA4335"></path>
              </g>
              <defs>
                <clipPath id="clip0_201_8131">
                  <rect width="20" height="20" fill="white"></rect>
                </clipPath>
              </defs>
            </svg>



            <span>
              Continue with Google
            </span>







          </a>
          <a href="#" class="je2-button ">

            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 22.773 22.773">
              <path
                d="M15.769 0h.162c.13 1.606-.483 2.806-1.228 3.675-.731.863-1.732 1.7-3.351 1.573-.108-1.583.506-2.694 1.25-3.561C13.292.879 14.557.16 15.769 0zM20.67 16.716v.045c-.455 1.378-1.104 2.559-1.896 3.655-.723.995-1.609 2.334-3.191 2.334-1.367 0-2.275-.879-3.676-.903-1.482-.024-2.297.735-3.652.926h-.462c-.995-.144-1.798-.932-2.383-1.642-1.725-2.098-3.058-4.808-3.306-8.276v-1.019c.105-2.482 1.311-4.5 2.914-5.478.846-.52 2.009-.963 3.304-.765.555.086 1.122.276 1.619.464.471.181 1.06.502 1.618.485.378-.011.754-.208 1.135-.347 1.116-.403 2.21-.865 3.652-.648 1.733.262 2.963 1.032 3.723 2.22-1.466.933-2.625 2.339-2.427 4.74.176 2.181 1.444 3.457 3.028 4.209z">
              </path>
            </svg>



            <span>
              Continue with Apple
            </span>







          </a>
          <a href="#" class="je2-button je3-sign-up-with-linkedin__button">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
              <g fill="none" fill-rule="evenodd">
                <path fill="#007EBB" d="M8 72h56a8 8 0 0 0 8-8V8a8 8 0 0 0-8-8H8a8 8 0 0 0-8 8v56a8 8 0 0 0 8 8Z">
                </path>
                <path fill="#FFF"
                  d="M62 62H51.316V43.802c0-4.99-1.896-7.777-5.845-7.777-4.296 0-6.54 2.901-6.54 7.777V62H28.632V27.333H38.93v4.67s3.096-5.729 10.453-5.729c7.353 0 12.617 4.49 12.617 13.777V62ZM16.35 22.794c-3.508 0-6.35-2.864-6.35-6.397C10 12.864 12.842 10 16.35 10c3.507 0 6.347 2.864 6.347 6.397 0 3.533-2.84 6.397-6.348 6.397ZM11.032 62h10.736V27.333H11.033V62Z">
                </path>
              </g>
            </svg>



            <span>
              Continue with LinkedIn
            </span>

          </a>


        </div>


      </div>
    </div>

  </div>

  <script>const passwordField = document.getElementById("loginPassword");
    const togglePassword = document.querySelector(".password-toggle-icon i");

    togglePassword.addEventListener("click", function () {
      if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
      } else {
        passwordField.type = "password";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
      }
    });
  </script>

</body>

</html>