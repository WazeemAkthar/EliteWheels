-- admin Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'customer') NOT NULL
);

INSERT INTO users (username, password, role) VALUES
('admin_user', MD5('12345'), 'admin'),
('staff_user', MD5('staff123'), 'staff'),
('customer_user', MD5('customer123'), 'customer');


-- Cars Table
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    brand VARCHAR(50),
    model VARCHAR(50),
    year INT,
    price DECIMAL(10, 2),
    location VARCHAR(100),
    availability BOOLEAN DEFAULT TRUE
);


-- Rentals Table
CREATE TABLE rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    car_id INT,
    rental_start DATE,
    rental_end DATE,
    status ENUM('booked', 'returned') DEFAULT 'booked',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
);
