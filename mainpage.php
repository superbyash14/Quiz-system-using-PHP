<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 10px;
        }
        h2, h3 {
            color: #333;
        }
        a {
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            margin: 20px 0;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><u>Welcome to Online Quiz System Website</u></h1>

    <a href="login.php">Login</a>
    <a href="register.php">Registration</a>

    <h2>Generate Report</h2>
    <form method="POST">
        <input type="text" name="report_username" required placeholder="Enter Username">
        <button type="submit" name="generate_report">Generate Report</button>
    </form>

    <?php
    if (isset($_POST['generate_report'])) {
        $report_username = $_POST['report_username'];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "quiz_system", 3306);
        if (!$conn) {
            die("<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>");
        }

        // Fetch user ID from users table
        $query = "SELECT id FROM users WHERE username = '$report_username'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $user_id = $user['id'];

            // Fetch scores for the user
            $query = "SELECT score, date FROM scores WHERE user_id = '$user_id' ORDER BY date DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<h3>Score Report for $report_username</h3>";
                echo "<table><tr><th>Score</th><th>Date</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['score']} / 10</td><td>{$row['date']}</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color:red;'>No records found for $report_username.</p>";
            }
        } else {
            echo "<p style='color:red;'>User not found.</p>";
        }
    }
    ?>
</div>

</body>
</html>

