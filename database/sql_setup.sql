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

/* Cars Table */
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


/* Rentals Table */
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

