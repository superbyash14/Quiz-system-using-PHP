<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "quiz_system", 3306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the user's quiz scores from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM scores WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

$scores = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Show the Start Quiz button if the user is logged in -->
        <a href="quiz.php" class="btn">Start Quiz</a> | 
        <a href="logout.php" class="btn">Logout</a>

        <h2>Your Quiz Reports</h2>
        <table>
            <tr>
                <th>Score</th>
                <th>Date</th>
            </tr>
            <?php foreach ($scores as $score): ?>
                <tr>
                    <td><?php echo $score['score']."/10"; ?></td>
                    <td><?php echo $score['date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>



