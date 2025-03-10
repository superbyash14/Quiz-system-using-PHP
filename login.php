<?php
include 'config.php'; // Include the database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create the SQL query
    $sql = "SELECT * FROM users WHERE username = '$username'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if a user was found
    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Invalid credentials! Please try again.";
        }
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to top, #a9d4ff, #b6f1a8);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Go To The Main Page Link Outside the Box */
        .go-to-main-page {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
        }

        .go-to-main-page a {
            color: #007bff;
            text-decoration: none;
        }

        .go-to-main-page a:hover {
            text-decoration: underline;
        }

        .container {
            width: 400px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 40px; /* Add margin to make space for the link */
        }

        .container h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }

        .social-login {
            margin: 20px 0;
            text-align: center;
        }

        .social-login button {
            border: none;
            margin: 0 10px;
            cursor: pointer;
            background: transparent;
            font-size: 24px;
        }

        .social-login button:hover {
            opacity: 0.8;
        }

        .text-link {
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        .text-link a {
            color: #007bff;
            text-decoration: none;
        }

        .text-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Go to Main Page Link Outside the Box -->
    <div class="go-to-main-page">
        <a href="mainpage.php">Go To The Main Page</a>
    </div>

    <div class="container">
        <h2>Log In</h2>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Passowrd" required>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn">Log In</button>
        </form>
        <div class="social-login">
            <span>Or continue with</span>
            <button><img src="https://img.icons8.com/color/48/google-logo.png" alt="Google"></button>
            <button><img src="https://img.icons8.com/color/48/windows-10.png" alt="Windows"></button>
        </div>
        <div class="text-link">
            <span>Don't have an account? <a href="register.php">Sign up</a></span>
        </div>
    </div>
</body>
</html>
