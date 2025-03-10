<?php
// Include the database connection file
include 'config.php';

// Define an array of questions and their answers
$questions = [
    ['What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 3],
    ['Who developed the theory of relativity?', 'Isaac Newton', 'Albert Einstein', 'Nikola Tesla', 'Galileo Galilei', 2],
    ['Which planet is known as the Red Planet?', 'Venus', 'Mars', 'Earth', 'Jupiter', 2],
    ['What is the largest mammal in the world?', 'Elephant', 'Blue Whale', 'Giraffe', 'Shark', 2],
    ['Which gas do plants absorb during photosynthesis?', 'Oxygen', 'Nitrogen', 'Carbon Dioxide', 'Hydrogen', 3],
    ['What is the square root of 64?', '6', '7', '8', '9', 3],
    ['What is the smallest country in the world?', 'Monaco', 'Vatican City', 'San Marino', 'Liechtenstein', 2],
    ['Who wrote "Romeo and Juliet"?', 'William Shakespeare', 'Mark Twain', 'Charles Dickens', 'Jane Austen', 1],
    ['What is the longest river in the world?', 'Nile', 'Amazon', 'Yangtze', 'Mississippi', 2],
    ['In which year did World War II end?', '1945', '1939', '1918', '1950', 1]
];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "quiz_system", 3306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert each question into the database
foreach ($questions as $q) {
    $sql = "INSERT INTO questions (question_text, option1, option2, option3, option4, correct_answer) 
            VALUES ('$q[0]', '$q[1]', '$q[2]', '$q[3]', '$q[4]', '$q[5]')";
    
    mysqli_query($conn, $sql);
}

echo "Questions inserted successfully!";
?>

