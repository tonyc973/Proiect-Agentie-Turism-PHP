-- Create the users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100),
    role VARCHAR(20),
    created_at DATETIME
);

-- Create the tours table
CREATE TABLE tours (
    tour_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    price DECIMAL(10, 2),
    destination VARCHAR(100),
    created_at DATETIME,
    tour_date DATE
);

-- Create the bookings table with foreign keys
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(100) NOT NULL,
    tour_id INT NOT NULL,
    participants INT NOT NULL,
    booking_date DATETIME NOT NULL,
    status VARCHAR(20) NOT NULL,
    FOREIGN KEY (user_email) REFERENCES users(email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insert data into the users table
INSERT INTO users (first_name, last_name, email, password, role, created_at) VALUES
('John', 'Doe', 'john.doe@example.com', '123456', 'admin', '2024-11-08 21:17:13'),
('Jane', 'Smith', 'jane.smith@example.com', 'abcdef', 'user', '2024-11-08 21:17:13'),
('Michael', 'Johnson', 'michael.johnson@example.com', 'password123', 'user', '2024-11-08 21:17:13'),
('Emily', 'Davis', 'emily.davis@example.com', 'qwerty', 'user', '2024-11-08 21:17:13'),
('Chris', 'Brown', 'chris.brown@example.com', 'letmein', 'user', '2024-11-08 21:17:13');

-- Insert data into the tours table
INSERT INTO tours (title, description, price, destination, created_at, tour_date) VALUES
('Grand Canyon Adventure', 'Experience the breathtaking views of the Grand Canyon', 299.99, 'Grand Canyon, USA', '2024-11-08 21:17:24', '2024-12-15'),
('Paris City Tour', 'Explore the iconic landmarks of Paris, including the Eiffel Tower', 499.99, 'Paris, France', '2024-11-08 21:17:24', '2024-11-20'),
('Safari in Kenya', 'Embark on an unforgettable safari experience in the African savannah', 999.99, 'Nairobi, Kenya', '2024-11-08 21:17:24', '2025-01-10'),
('Tokyo Food Tour', 'Discover the best street food and local delicacies in Tokyo', 399.99, 'Tokyo, Japan', '2024-11-08 21:17:24', '2024-12-05'),
('Italian Wine Tasting', 'Enjoy a day of wine tasting in the vineyards of Tuscany', 199.99, 'Tuscany, Italy', '2024-11-08 21:17:24', '2025-02-25'),
('Trip in Romania', 'A wonderful trip in Romanian mountains', 599.99, 'Sinaia, Romania', '2024-11-09 15:46:59', '2024-11-13');

-- Insert data into the bookings table
INSERT INTO bookings (user_email, tour_id, participants, booking_date, status) VALUES
('john.doe@example.com', 1, 2, '2024-11-08 21:17:33', 'confirmed'),
('jane.smith@example.com', 2, 1, '2024-11-08 21:17:33', 'pending'),
('michael.johnson@example.com', 3, 4, '2024-11-08 21:17:33', 'confirmed'),
('emily.davis@example.com', 4, 3, '2024-11-08 21:17:33', 'cancelled'),
('chris.brown@example.com', 5, 2, '2024-11-08 21:17:33', 'confirmed');
