<?php
// Database connection settings
$localhost = 'localhost'; 
$username = 'root';
$password = '';
$dbname = 'test';

// Establish the connection to the database
$conn = mysqli_connect($localhost, $username, $password, $dbname);

// Check if the connection failed and display error
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>
    <div class="content">
        <h1>You need an account to use our service</h1>
        <div class="btns">
            <!-- Login and Signup buttons -->
            <button id="loginBtn" href="#login">Login</button>
            <button id="signupBtn" href="#signup">Sign Up</button>
        </div>

        <!-- Login Section -->
        <div class="login" id="login">
            <?php
            // Handle login request
            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Prepare and execute the query to find the user by username or email
                $stmt = $conn->prepare("SELECT * FROM account WHERE username = ? OR email = ?");
                $stmt->bind_param("ss", $username, $username);
                $stmt->execute();
                $result = $stmt->get_result();

                // If a matching user is found
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Verify if the entered password matches the hashed password
                    if (password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        header('Location: looby.html'); // Redirect to the lobby page
                        exit;
                    } else {
                        echo '<p style="color:red">Invalid username or password</p>';
                    }
                } else {
                    echo '<p style="color:red">Invalid username or password</p>';
                }
                $stmt->close(); // Close the statement
            }
            ?>
            <!-- Login form -->
            <form method="post">
                <input type="text" name="username" placeholder="Username or Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <!-- Signup Section -->
        <div id="signup" class="signup" style="display: none;">
            <?php
            // Handle signup request
            if (isset($_POST['signup'])) {
                $username = $_POST['username'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['Cpassword'];

                // Check if passwords match
                if ($password !== $confirmPassword) {
                    echo '<p>Passwords do not match</p>';
                    exit;
                }

                // Check if username or email already exists in the database
                $stmt = $conn->prepare("SELECT * FROM account WHERE username = ? OR email = ?");
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Display an error if the username or email is already in use
                    echo '<p>Username or email is already in use. Please choose a different one.</p>';
                } else {
                    // Hash the password before storing it in the database
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the new user's data into the database
                    $stmt = $conn->prepare("INSERT INTO account (username, surname, email, password) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $username, $surname, $email, $hashedPassword);

                    if ($stmt->execute()) {
                        session_start();
                        $_SESSION['username'] = $username;
                        header('Location: looby.php'); // Redirect to the lobby page after successful signup
                        exit;
                    } else {
                        echo '<p>Something went wrong. Please try again.</p>';
                    }
                }
                $stmt->close(); // Close the statement
            }
            ?>
            <!-- Signup form -->
            <form method="post">
                <input type="text" name="username" placeholder="Your Name" minlength="3" maxlength="30" required><br>
                <input type="text" name="surname" placeholder="Your Surname" minlength="2" maxlength="30" required><br>
                <input type="email" name="email" placeholder="Entry your email" minlength="11" maxlength="50" required><br>
                <input type="password" name="password" placeholder="Password" minlength="8" required><br>
                <input type="password" name="Cpassword" placeholder="Confirm Password" minlength="8" required><br>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
    </div>
    
    <script src="script.js"></script> <!-- Link to external JavaScript file -->
</body>
</html>
