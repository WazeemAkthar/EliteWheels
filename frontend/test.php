<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "car_rental_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch car details based on vhid parameter
if (isset($_GET['vhid'])) {
    $vhid = intval($_GET['vhid']); // Prevent SQL injection
    $query = "SELECT * FROM vehicles WHERE id = $vhid";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $vehicle = mysqli_fetch_assoc($result); // Fetch car data
    } else {
        echo "Vehicle not found.";
        exit;
    }
} else {
    echo "No vehicle selected.";
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book <?= htmlspecialchars($vehicle['vehicle_title']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .carousel {
            display: flex;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .carousel img {
            max-width: 100%;
            transition: transform 0.5s ease;
        }

        .details,
        .booking-form {
            margin: 20px 0;
        }

        .form-group {
            margin: 15px 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
<?php include('./navbar.php'); ?>

    <div class="container">
        <!-- Carousel -->
        <div class="carousel" id="carousel">
            <img src="<?= htmlspecialchars($vehicle['image1']) ?>" alt="Car Image 1">
            <img src="<?= htmlspecialchars($vehicle['image2']) ?>" alt="Car Image 2">
            <img src="<?= htmlspecialchars($vehicle['image3']) ?>" alt="Car Image 3">
        </div>

        <!-- Car Details -->
        <div class="details">
            <h1><?= htmlspecialchars($vehicle['vehicle_title']) ?></h1>
            <h2>Rs.<?= htmlspecialchars($vehicle['price_per_day']) ?>/day</h2>
            <p><strong>Fuel Type:</strong> <?= htmlspecialchars($vehicle['fuel_type']) ?></p>
            <p><strong>Seats:</strong> <?= htmlspecialchars($vehicle['seating_capacity']) ?></p>
            <p><strong>Registration Year:</strong> <?= htmlspecialchars($vehicle['model_year']) ?></p>
        </div>

        <!-- Booking Form -->
        <div class="booking-form">
            <form id="bookingForm">
                <input type="hidden" name="vhid" value="<?= $vhid ?>">
                <div class="form-group">
                    <label for="from_date">From Date:</label>
                    <input type="date" id="from_date" name="from_date" required>
                </div>
                <div class="form-group">
                    <label for="to_date">To Date:</label>
                    <input type="date" id="to_date" name="to_date" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5"></textarea>
                </div>
                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
    <?php include('./footer.php'); ?>
    <script>
        // Carousel functionality
        const carousel = document.getElementById('carousel');
        const images = carousel.getElementsByTagName('img');
        let currentIndex = 0;

        setInterval(() => {
            images[currentIndex].style.transform = 'translateX(-100%)';
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].style.transform = 'translateX(0)';
        }, 3000);

        // Booking Form Submission
        const bookingForm = document.getElementById('bookingForm');
        bookingForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(bookingForm);
            const response = await fetch('../Backend/process-booking.php', {
                method: 'POST',
                body: formData,
            });

            const result = await response.text();
            alert(result);
            if (response.ok) {
                window.location.href = 'thank-you.php';
            }
        });
    </script>
</body>

</html>