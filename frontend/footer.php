<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $email = $data['email'];

  // Database configuration
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'car_rental_system';

  $conn = new mysqli($host, $user, $password, $database);

  if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["message" => "Database connection failed"]);
    exit();
  }

  $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");
  $stmt->bind_param("s", $email);

  if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(["message" => "Subscription successful"]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Failed to save subscription"]);
  }

  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  .footer-link {
    text-decoration: none;
    color: #fff;
    position: relative;
  }

  .footer-link::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #f4b400;
    left: 0;
    bottom: -2px;
    transition: width 0.3s ease-in-out;
  }

  .footer-link:hover::after {
    width: 100%;
  }

  li {
    padding: 5px;
  }
</style>

<body>
  <!-- footer.html -->
  <footer style="
    background-color: #0a1f44;
    padding: 40px 20px;
    color: #fff;
  ">
    <div style="
      display: flex;
      justify-content: space-between;
      align-items: start;
      flex-wrap: wrap;
      gap: 20px;
      align-items: stretch;
    ">
      <!-- Left Section: Subscribe -->
      <div style="flex: 1;  flex-basis: min-content;">
        <h3>Subscribe to our Newsletter</h3>
        <form id="subscribeForm" style="margin-top: 10px;">
          <input type="email" name="email" placeholder="Enter your email" required style="
            padding: 10px;
            width: 80%;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
          " />
          <button type="submit" style="
            padding: 10px 20px;
            background-color: #f4b400;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
          ">
            Subscribe
          </button>
        </form>
      </div>

      <!-- Center Section: Links -->
      <div style="flex: 1;">
        <h3>Quick Links</h3>
        <ul style="list-style: none; padding: 0; margin: 20px 0;">
          <li>
            <a href="#" class="footer-link" style="
              text-decoration: none;
              color: #fff;
              position: relative;
            ">
              Home
            </a>
          </li>
          <li>
            <a href="#" class="footer-link">About Us</a>
          </li>
          <li>
            <a href="#" class="footer-link">Services</a>
          </li>
          <li>
            <a href="#" class="footer-link">Contact</a>
          </li>
        </ul>
      </div>
    </div>
    <hr />
    <!-- Right Section: Copyright -->
    <div style="flex: 1; text-align: right;">
      <p>&copy; 2024 EliteWheels. All Rights Reserved.</p>
    </div>

  </footer>

  <script>
    document.getElementById("subscribeForm").addEventListener("submit", async function (event) {
      event.preventDefault();
      const email = event.target.email.value;

      // Post email to server
      try {
        const response = await fetch("http://localhost/save_subscription.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ email }),
        });

        if (response.ok) {
          alert("Subscription successful!");
        } else {
          alert("Failed to subscribe. Please try again.");
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Error while subscribing. Please try again later.");
      }
    });
  </script>


</body>

</html>