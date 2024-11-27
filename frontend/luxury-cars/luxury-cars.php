<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Cars</title>
    <link rel="stylesheet" href="luxury-cars.css">
</head>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f9f9f9;
    }

    /* Navbar Styling */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #111;
        color: #fff;
        padding: 1rem 2rem;
    }

    .nav-links {
        display: flex;
        list-style: none;
    }

    .nav-links li {
        margin: 0 1rem;
    }

    .nav-links a {
        text-decoration: none;
        color: #fff;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #f4b400;
    }

    /* Section: Luxury Cars Listing */
    .luxury-cars-list {
        padding: 2rem;
        text-align: center;
    }

    .car-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .car-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.3s;
    }

    .car-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .car-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .car-card h3 {
        font-size: 1.2rem;
        margin: 1rem 0;
        color: #333;
    }

    .car-card p {
        font-size: 1rem;
        color: #666;
    }

    .car-card button {
        background-color: #111;
        color: #fff;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
        margin-bottom: 1rem;
    }

    .car-card button:hover {
        background-color: #f4b400;
    }

    /* Footer */
    footer {
        background-color: #111;
        color: #fff;
        padding: 1rem;
        text-align: center;
    }

    .footer-links a {
        color: #fff;
        text-decoration: none;
        margin: 0 0.5rem;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .nav-links {
            flex-direction: column;
            align-items: center;
        }

        .car-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">EliteWheels</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Luxury Cars</a></li>
            <li><a href="#">Popular Makes</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Luxury Cars List -->
    <section class="luxury-cars-list">
        <h1>Luxury Cars</h1>
        <div class="car-grid">
            <div class="car-card">
                <img src="car1.jpg" alt="Car Image">
                <h3>2024 Rolls-Royce Cullinan</h3>
                <p>Price On Request</p>
                <button>View Details</button>
            </div>
            <!-- Repeat the car card for other luxury cars -->
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Privacy Policy</a>
        </div>
    </footer>
</body>

</html>