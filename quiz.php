<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "quiz_system", 3306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch quiz questions
$result = mysqli_query($conn, "SELECT * FROM questions");
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle quiz submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        if (isset($_POST['answer_' . $question['id']]) &&
            $_POST['answer_' . $question['id']] == $question['correct_answer']) {
            $score++;
        }
    }

    // Save score in database
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO scores (user_id, score) VALUES ('$user_id', '$score')";
    mysqli_query($conn, $query);

    // Display the score in the center of the page
    $resultDisplay = "<div class='result'>
                        <h3>Your Score: $score</h3>
                        <p>Well done! You've completed the quiz.</p>
                        <a href='index.php' class='home-link'>Go to Home</a>
                      </div>";
    echo $resultDisplay;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
            overflow: auto;
            height: 100vh;
        }
        #vanta-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
        }
        .quiz-container {
            width: 50%;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.85); /* Slight transparency */
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
            z-index: 1;
        }
        h2 {
            color: #333;
        }
        .question {
            text-align: left;
            padding: 10px;
            margin-bottom: 10px;
            background: rgba(227, 242, 253, 0.85);
            border-radius: 5px;
        }
        input[type="radio"] {
            display: none; /* Hide the radio buttons */
        }
        label {
            display: block;
            margin: 5px 0;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        label:hover {
            background-color: #e0e0e0;
        }
        input[type="radio"]:checked + label {
            background-color: #007bff;
            color: white;
            border: 2px solid #0056b3;
        }
        .submit-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background: #0056b3;
        }
        .result {
            background: rgba(212, 237, 218, 0.85);
            color: #155724;
            padding: 40px;
            margin-top: 50px;
            border-radius: 8px;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            width: 60%;
            margin: 50px auto;
            background-color: #28a745;
            color: white;
        }
        .result h3 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .home-link {
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 18px;
        }
        .home-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div id="vanta-bg"></div> <!-- Background animation container -->

<div class="quiz-container">
    <h2>Take the Quiz</h2>
    <form method="post" action="quiz.php">
        <?php foreach ($questions as $question): ?>
            <div class="question">
                <p><?php echo $question['question_text']; ?></p>

                <input type="radio" id="answer_<?php echo $question['id']; ?>_1" name="answer_<?php echo $question['id']; ?>" value="1">
                <label for="answer_<?php echo $question['id']; ?>_1"><?php echo $question['option1']; ?></label>

                <input type="radio" id="answer_<?php echo $question['id']; ?>_2" name="answer_<?php echo $question['id']; ?>" value="2">
                <label for="answer_<?php echo $question['id']; ?>_2"><?php echo $question['option2']; ?></label>

                <input type="radio" id="answer_<?php echo $question['id']; ?>_3" name="answer_<?php echo $question['id']; ?>" value="3">
                <label for="answer_<?php echo $question['id']; ?>_3"><?php echo $question['option3']; ?></label>

                <input type="radio" id="answer_<?php echo $question['id']; ?>_4" name="answer_<?php echo $question['id']; ?>" value="4">
                <label for="answer_<?php echo $question['id']; ?>_4"><?php echo $question['option4']; ?></label>
            </div>
        <?php endforeach; ?>
        
        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

<!-- Vanta.js Background Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
<script>
    VANTA.BIRDS({
        el: "#vanta-bg",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color1: 0x89ff
    });
</script>

</body>
</html>
