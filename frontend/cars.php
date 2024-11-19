<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EliteWheels - Car Listings</title>
  <link rel="stylesheet" href="./assets/css/cars.css">
</head>
<style>
  /* General Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
}

/* Filter Section */
.filter-section {
  text-align: center;
  padding: 2rem 0;
  background-color: #f4f6f9;
}

.filter-section h1 {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.filter-section p {
  color: #555;
  margin-bottom: 1.5rem;
}

.filter-section form {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.filter-section select,
.filter-section input {
  padding: 0.8rem;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.filter-section button {
  padding: 0.8rem 1.5rem;
  font-size: 1rem;
  border: none;
  background-color: #ffcd3c;
  color: #0d0d63;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
}

.filter-section button:hover {
  background-color: #d4a514;
}

/* Cars Listing Section */
.cars-listing {
  padding: 2rem 0;
  background-color: #fff;
}

.cars-listing .grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.car-card {
  background-color: #f4f6f9;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  text-align: center;
  padding: 1rem;
}

.car-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.car-card h3 {
  font-size: 1.2rem;
  margin: 0.5rem 0;
}

.car-card p {
  color: #555;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.car-card button {
  padding: 0.8rem;
  font-size: 1rem;
  border: none;
  background-color: #ffcd3c;
  color: #0d0d63;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
}

.car-card:hover {
  transform: translateY(-5px);
}

.car-card button:hover {
  background-color: #d4a514;
}

</style>
<body>

<?php include('./navbar.php'); ?>

<!-- Filter/Search Section -->
<section class="filter-section">
  <div class="container">
    <h1>Our Vehicles</h1>
    <p>Find the perfect car for your journey.</p>
    <form id="filterForm">
      <select name="category" id="category">
        <option value="all">All Categories</option>
        <option value="economy">Economy</option>
        <option value="luxury">Luxury</option>
        <option value="suv">SUV</option>
        <option value="electric">Electric</option>
      </select>
      <input type="text" placeholder="Search by name..." id="search">
      <button type="submit">Filter</button>
    </form>
  </div>
</section>

<!-- Cars Listing Section -->
<section class="cars-listing">
  <div class="container">
    <div class="grid">
      <!-- Dynamic Car Cards -->
      <div class="car-card">
        <img src="./assets/images/car1.jpg" alt="Car 1">
        <h3>Luxury Sedan</h3>
        <p>Seats: 5 | Transmission: Automatic | Price: $120/day</p>
        <button>View Details</button>
      </div>

      <div class="car-card">
        <img src="./assets/images/car2.jpg" alt="Car 2">
        <h3>Compact SUV</h3>
        <p>Seats: 7 | Transmission: Manual | Price: $95/day</p>
        <button>View Details</button>
      </div>

      <!-- Add more car cards as needed -->
    </div>
  </div>
</section>

<?php include('./footer.php'); ?>

<script>
  document.addEventListener("DOMContentLoaded", () => {
  const filterForm = document.getElementById("filterForm");
  const categorySelect = document.getElementById("category");
  const searchInput = document.getElementById("search");
  const carGrid = document.querySelector(".grid");

  // Example Car Data (Replace with API/Database Call)
  const cars = [
    { name: "Luxury Sedan", category: "luxury", seats: 5, transmission: "Automatic", price: 120, image: "./assets/images/car1.jpg" },
    { name: "Compact SUV", category: "suv", seats: 7, transmission: "Manual", price: 95, image: "./assets/images/car2.jpg" },
    { name: "Luxury Sedan", category: "luxury", seats: 5, transmission: "Automatic", price: 120, image: "./assets/images/car1.jpg" },
    { name: "Compact SUV", category: "suv", seats: 7, transmission: "Manual", price: 95, image: "./assets/images/car3.jpg" },
    { name: "Luxury Sedan", category: "luxury", seats: 5, transmission: "Automatic", price: 120, image: "./assets/images/car1.jpg" },
    { name: "Compact SUV", category: "suv", seats: 7, transmission: "Manual", price: 95, image: "./assets/images/car4.jpg" },
    { name: "Luxury Sedan", category: "luxury", seats: 5, transmission: "Automatic", price: 120, image: "./assets/images/car1.jpg" },
    // Add more cars here...
  ];

  const displayCars = (filteredCars) => {
    carGrid.innerHTML = filteredCars.map(car => `
      <div class="car-card">
        <img src="${car.image}" alt="${car.name}">
        <h3>${car.name}</h3>
        <p>Seats: ${car.seats} | Transmission: ${car.transmission} | Price: $${car.price}/day</p>
        <button>View Details</button>
      </div>
    `).join("");
  };

  filterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const category = categorySelect.value;
    const search = searchInput.value.toLowerCase();

    const filteredCars = cars.filter(car => 
      (category === "all" || car.category === category) &&
      car.name.toLowerCase().includes(search)
    );

    displayCars(filteredCars);
  });

  // Initial Display
  displayCars(cars);
});

</script>

</body>
</html>
