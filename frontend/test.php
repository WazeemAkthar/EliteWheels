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

// Google Maps integration (latitude and longitude display)
$latitude = isset($vehicle['latitude']) ? $vehicle['latitude'] : 0;
$longitude = isset($vehicle['longitude']) ? $vehicle['longitude'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book <?= htmlspecialchars($vehicle['vehicle_title']) ?></title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzSkKnwBl3zqRDhFF3AoO62D57I0CUG5w&callback=initMap"
        async defer></script>
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

        #map {
            height: 400px;
            /* Adjust the height based on the screen size */
            width: 100%;
        }

        @media (max-width: 768px) {
            #map {
                height: 300px;
                /* Smaller height for mobile screens */
            }
        }

        /* Car Details Section */
        .car-details {
            display: flex;
            gap: 2rem;
            margin: 2rem auto;
            max-width: 1200px;
            padding: 0 1rem;
        }

        .gallery {
            flex: 1;
        }

        #current-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .thumbnails {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .thumbnails img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: border 0.3s;
        }

        .thumbnails img:hover {
            border-color: #f4b400;
        }

        .car-info {
            flex: 1;
            padding: 1rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 1rem;
            align-self: start;
        }

        .car-info h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .car-info .price {
            font-size: 1.5rem;
            color: #f4b400;
            margin-bottom: 0.5rem;
        }

        .car-info .location {
            margin-bottom: 1rem;
            font-style: italic;
            color: #555;
        }

        .car-info .specs {
            list-style: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .car-info .specs li {
            margin-bottom: 0.5rem;
        }

        .contact-btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .contact-btn:hover {
            background: #f4b400;
        }

        /* Contact Form Section */
        .contact-form {
            margin: 2rem auto;
            max-width: 800px;
            text-align: center;
            padding: 1rem;
        }

        .contact-form h2 {
            margin-bottom: 1rem;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .contact-form button {
            padding: 0.8rem 1.5rem;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .contact-form button:hover {
            background: #f4b400;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .car-details {
                flex-direction: column;
            }
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

        <section class="car-details">
            <div class="gallery">
                <img id="current-image" src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image1']) ?>"
                    alt="Car Image" />
                <div class="thumbnails">
                    <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image2']) ?>" alt="Car Thumbnail"
                        onclick="changeImage('<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image2']) ?>')" />
                    <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image3']) ?>" alt="Car Thumbnail"
                        onclick="changeImage('<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image3']) ?>')" />
                    <img src="<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image4']) ?>" alt="Car Thumbnail"
                        onclick="changeImage('<?= '../Backend/uploads/' . htmlspecialchars($vehicle['image4']) ?>')" />
                </div>
            </div>
            <div class="car-info">
                <h1><?= htmlspecialchars($vehicle['vehicle_title']) ?></h1>
                <p class="price">Price: Rs.<?= htmlspecialchars($vehicle['price_per_day']) ?>/day</p>
                <p class="location">Location: Los Angeles, USA</p>
                <ul class="specs">
                    <li><strong>Fuel Type:</strong> <?= htmlspecialchars($vehicle['fuel_type']) ?></li>
                    <li><strong>Seats:</strong> <?= htmlspecialchars($vehicle['seating_capacity']) ?></li>
                    <li>Registration Year:</strong> <?= htmlspecialchars($vehicle['model_year']) ?></li>
                </ul>
                <button class="contact-btn" onclick="">Ask a Question</button>
            </div>
        </section>
        <div id="map"></div>

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
                    <button type="submit" onclick="window.location.href='login.php'">Login to Book</button>
                <?php else: ?>
                    <button type="submit">Book Now</button>
                <?php endif; ?>

            </form>
        </div>
        <!-- </div> -->
    </div>
    <?php include('./footer.php'); ?>
    <script>
        function changeImage(imageSrc) {
            document.getElementById("current-image").src = imageSrc;
        }
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

        function initMap() {
            const latitude = <?php echo $latitude; ?>;
            const longitude = <?php echo $longitude; ?>;

            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: latitude, lng: longitude },
                zoom: 12, // Adjust zoom level
            });

            const marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: "<?php echo $vehicle['vehicle_title']; ?>"
            });
        }
    </script>
</body>

</html>