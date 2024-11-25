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

        /* General Body Styles */
        .book-section {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Booking Form Container */
        .booking-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px;
            text-align: center;
        }

        /* Form Title */
        .booking-form h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Form Labels */
        .booking-form label {
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
            display: block;
        }

        /* Form Input Fields */
        .booking-form input[type="date"],
        .booking-form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        /* Focused Input Fields */
        .booking-form input[type="date"]:focus,
        .booking-form textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Textarea */
        .booking-form textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Buttons */
        .booking-form button {
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
        }

        /* Hover effect for buttons */
        .booking-form button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Conditional Button for Logged Out Users */
        .booking-form button[type="submit"][onclick] {
            background-color: #e74c3c;
            transition: background-color 0.3s ease;
        }

        .booking-form button[type="submit"][onclick]:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .booking-form {
                padding: 20px;
                width: 90%;
            }

            .booking-form h2 {
                font-size: 1.6em;
            }

            .booking-form label {
                font-size: 1em;
            }

            .booking-form input[type="date"],
            .booking-form textarea {
                font-size: 0.9em;
            }

            .booking-form button {
                font-size: 1em;
            }
        }
    </style>
</head>

<body>
    <?php include('./navbar.php'); ?>

    <div class="container">
        <!-- Carousel -->
        <div class="carousel" id="carousel">
            <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image1']) ?>" alt="Car Image 1">
            <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image2']) ?>" alt="Car Image 2">
            <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image3']) ?>" alt="Car Image 3">
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
        <!-- <div class="book-section"> -->
            <div class="booking-form">
                <form action="../Backend/process-booking.php" method="POST">
                    <input type="hidden" name="car_id" value="<?php echo $vehicle['id']; ?>">

                    <h2>Book Your Car</h2>

                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message"></textarea>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <button type="submit" onclick="window.location.href='login.html'">Login to Book</button>
                    <?php else: ?>
                        <button type="submit">Book Now</button>
                    <?php endif; ?>

                </form>
            </div>
        <!-- </div> -->
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