# Online Quiz System

This is an online quiz system built with PHP and MySQL. Users can register, log in, take quizzes, and view their scores.

## Project Structure

```
config.php
connection.php
index.php
insert_questions.php
login.php
logout.php
mainpage.php
quiz.php
register.php
style.css
```

## Prerequisites

- PHP (version 7.4 or higher)
- MySQL (version 5.7 or higher)
- A web server (e.g., Apache)
- XAMMP Prefered
## Setup Instructions

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
   ```

2. **Create a MySQL database:**
   ```sql
   CREATE DATABASE quiz_system;
   ```

3. **Update the database connection details:**
   - Open `config.php` and `connection.php`.
   - Update the database host, username, password, and database name if necessary.

4. **Run the database setup script:**
   - Open your web browser and navigate to `http://localhost/your-repo-name/connection.php`.
   - This will create the necessary tables and insert sample questions into the database.

5. **Start the PHP server:**
   ```sh
   php -S localhost:8000
   ```

6. **Access the application:**
   - Open your web browser and navigate to `http://localhost:8000/mainpage.php`.

## Files Description

- **config.php**: Contains the database connection configuration.
- **connection.php**: Creates the database and tables, and inserts sample questions.
- **index.php**: The main page after login, showing the user's quiz scores.
- **insert_questions.php**: Inserts predefined questions into the database.
- **login.php**: Handles user login.
- **logout.php**: Logs out the user and redirects to the main page.
- **mainpage.php**: The landing page with options to log in or register.
- **quiz.php**: Displays the quiz questions and handles quiz submission.
- **register.php**: Handles user registration.
- **style.css**: Contains the CSS styles for the application.

## Features

- User registration and login.
- Quiz with multiple-choice questions.
- Score tracking and display.
- Responsive design.

## Usage

1. Register a new account or log in with an existing account.
2. Start the quiz from the main page.
3. Answer the questions and submit the quiz.
4. View your score and quiz history on the main page.
