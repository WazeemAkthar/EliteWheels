/* Roles */
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

/* users */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);


/* Insert roles */
INSERT INTO roles (role_name) VALUES ('user'), ('staff'), ('admin');

/* Primary Admin */
INSERT INTO users (name, email, password, role_id) VALUES ('Sahee', 'Sahee@gmail.com', PASSWORD('1234'), 3);

/* brands */
CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/* Cars Table */
CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_title VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    overview TEXT NOT NULL,
    price_per_day DECIMAL(10, 2) NOT NULL,
    fuel_type VARCHAR(50) NOT NULL,
    model_year INT NOT NULL,
    seating_capacity INT NOT NULL,
    car_type ENUM('Regular', 'Luxury') NOT NULL,
    address TEXT NOT NULL,
    latitude DECIMAL(10, 6),
    longitude DECIMAL(10, 6),
    image1 VARCHAR(255) NOT NULL,
    image2 VARCHAR(255) NOT NULL,
    image3 VARCHAR(255) NOT NULL,
    image4 VARCHAR(255),
    image5 VARCHAR(255),
    air_conditioner TINYINT(1) DEFAULT NULL,
    power_door_locks TINYINT(1) DEFAULT NULL,
    abs TINYINT(1) DEFAULT NULL,
    brake_assist TINYINT(1) DEFAULT NULL,
    power_steering TINYINT(1) DEFAULT NULL,
    passenger_airbag TINYINT(1) DEFAULT NULL,
    driver_airbag TINYINT(1) DEFAULT NULL,
    leather_seats TINYINT(1) DEFAULT NULL;
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



/* Rentals Table */
CREATE TABLE rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    car_id INT,
    user_name VARCHAR(255),
    vehicle_name VARCHAR(255),
    rental_start DATE,
    rental_end DATE,
    message TEXT,
    status ENUM('booked', 'returned') DEFAULT 'booked',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES vehicles(id) ON DELETE CASCADE
);


/* booking details */
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    user_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    rating INT CHECK(rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE luxury_cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    body_type VARCHAR(100) NOT NULL,
    fuel_type VARCHAR(100) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price_per_day DECIMAL(10, 2) NOT NULL,
    model_year YEAR NOT NULL,
    seating_capacity INT NOT NULL,
    image1 VARCHAR(255) NOT NULL,
    image2 VARCHAR(255) NOT NULL,
    image3 VARCHAR(255) NOT NULL,
    image4 VARCHAR(255) NOT NULL,
    air_conditioner TINYINT(1) DEFAULT NULL,
    power_door_locks TINYINT(1) DEFAULT NULL,
    abs TINYINT(1) DEFAULT NULL,
    brake_assist TINYINT(1) DEFAULT NULL,
    power_steering TINYINT(1) DEFAULT NULL,
    passenger_airbag TINYINT(1) DEFAULT NULL,
    driver_airbag TINYINT(1) DEFAULT NULL,
    leather_seats TINYINT(1) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);





