<?php
$servername = "localhost:3306";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE quiz_system";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("quiz_system");

$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option1 VARCHAR(255) NOT NULL,
    option2 VARCHAR(255) NOT NULL,
    option3 VARCHAR(255) NOT NULL,
    option4 VARCHAR(255) NOT NULL,
    correct_answer INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE scores (
    user_id INT NOT NULL,
    score INT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO questions (question_text, option1, option2, option3, option4, correct_answer) VALUES
('What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 3),
('Who developed the theory of relativity?', 'Isaac Newton', 'Albert Einstein', 'Nikola Tesla', 'Galileo Galilei', 2),
('Which planet is known as the Red Planet?', 'Venus', 'Mars', 'Earth', 'Jupiter', 2),
('What is the largest mammal in the world?', 'Elephant', 'Blue Whale', 'Giraffe', 'Shark', 2),
('Which gas do plants absorb from the atmosphere during photosynthesis?', 'Oxygen', 'Nitrogen', 'Carbon Dioxide', 'Hydrogen', 3),
('What is the square root of 64?', '6', '7', '8', '9', 3),
('What is the smallest country in the world by land area?', 'Monaco', 'Vatican City', 'San Marino', 'Liechtenstein', 2),
('Who wrote the play: Romeo and Juliet?', 'William Shakespeare', 'Mark Twain', 'Charles Dickens', 'Jane Austen', 1),
('What is the longest river in the world?', 'Nile', 'Amazon', 'Yangtze', 'Mississippi', 1),
('In which year did World War II end?', '1945', '1939', '1918', '1950', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Values inserted successfully";
} else {
    echo "Error" . $conn->error;
}

// Close connection
$conn->close();
?>