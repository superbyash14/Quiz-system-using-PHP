<?php
include 'config.php'; // Include the database connection
session_start();

$registrationSuccess = false; // Flag to check if registration is successful
$registrationError = ''; // Variable to store error message

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Check if the username or email already exists in the database
    $check_user_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_user_result = mysqli_query($conn, $check_user_sql);
    
    if (mysqli_num_rows($check_user_result) > 0) {
        $registrationError = "Username or Email already exists. Please try again."; // Set error message
    } else {
        // Create the SQL query to insert the new user
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $registrationSuccess = true; // Set success flag
        } else {
            $registrationError = "Error: " . mysqli_error($conn); // Set generic error message
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to top, #18caf1, #0068fa);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            width: 400px;
            background: #f0efef41;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(51, 50, 50, 0.303);
            padding: 20px;
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
            color: #f8faf8;
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

        .form-group .checkbox {
            display: flex;
            align-items: center;
        }

        .form-group .checkbox input {
            margin-right: 10px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background: #28a745;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background: #218838;
        }

        .public-login {
            margin: 20px 0;
            text-align: center;
        }

        .public-login button {
            border: none;
            margin: 0 10px;
            cursor: pointer;
            background: transparent;
            font-size: 24px;
        }

        .public-login button:hover {
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

        /* Success Message Styling */
        .success-message {
            text-align: center;
            font-size: 16px;
            color: #28a745;
            margin-top: 20px;
        }

        /* Error Message Styling */
        .error-message {
            text-align: center;
            font-size: 16px;
            color: #dc3545;
            margin-top: 20px;
        }

        /* Go to Main Page Link Styling */
        .go-to-main-page {
            text-align: center;
            margin-top: 20px;
        }

        .go-to-main-page a {
            font-size: 16px;
            color: yellow;
            text-decoration: none;
        }

        .go-to-main-page a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Go to Main Page Link at the top -->
    <div class="go-to-main-page">
        <a href="mainpage.php">Go To The Main Page</a>
    </div>

    <div class="container">
        <h2>Create Account</h2>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn">Create a new account</button>
        </form>

        <!-- Display Error message if there is any -->
        <?php if ($registrationError): ?>
            <div class="error-message">
                <?php echo $registrationError; ?>
            </div>
        <?php endif; ?>

        <?php if ($registrationSuccess): ?>
            <div class="success-message">
                Registration successful! <a href="login.php">Login here</a>
            </div>
        <?php endif; ?>

        <div class="public-login">
            <span>Or continue with</span>
            <button onclick="window.location.href='https://accounts.google.com/o/oauth2/v2/auth/oauthchooseaccount?client_id=1095600231293-ih62cdtmregosipj9cbasor4tpb632mr.apps.googleusercontent.com&scope=openid%20email%20profile&response_type=id_token&gsiwebsdk=gis_attributes&redirect_uri=https%3A%2F%2Fwww.dailymotion.com&response_mode=form_post&origin=https%3A%2F%2Fwww.dailymotion.com&display=popup&prompt=select_account&gis_params=ChtodHRwczovL3d3dy5kYWlseW1vdGlvbi5jb20SG2h0dHBzOi8vd3d3LmRhaWx5bW90aW9uLmNvbRgHKitTTjVtVlFmU0hZTCs3WWw0TUhMNm1vY2JONmdhbzBXZENGdGRZTUNvOXdzMkkxMDk1NjAwMjMxMjkzLWloNjJjZHRtcmVnb3NpcGo5Y2Jhc29yNHRwYjYzMm1yLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tOAFCQDY2MDQ4ZTEwYmM4OWZjZmQ2YzgwMjA4MmRlNDY5MjZlNmMxMDkyY2ZiOGI4M2U2ZTE1MmNkNGI4NTVhODJhZGU&service=lso&o2v=1&ddm=1&flowName=GeneralOAuthFlow'"><img src="https://img.icons8.com/color/48/google-logo.png" alt="Google"></button>
            <button><img src="https://img.icons8.com/color/48/windows-10.png" alt="Windows"></button>
        </div>
        <div class="text-link">
            <span>Already have an account? <a href="login.php">Log in</a></span>
        </div>
    </div>
</body>
</html>
