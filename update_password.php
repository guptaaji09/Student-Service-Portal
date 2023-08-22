<?php
    // Include the database connection file
    require_once('database.php');

    // Check if the email, token, and password parameters are set in the form
    if (isset($_POST['email']) && isset($_POST['token']) && isset($_POST['password'])) {
        // Get the email, token, and password values from the form
        $email = $_POST['email'];
        $token = $_POST['token'];
        $password = $_POST['password'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       // Query the database to check if the email and token combination is valid
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_token = ?");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Update the user's password in the database
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();

            // Redirect the user to the login page
            header("Location: index.php?password_reset_successful");
            exit;
        } else {
            // Invalid email and token combination
            echo "Invalid email and token combination.";
            exit;
        }
    } else {
        // Form data not set
        echo "Form data not set.";
        exit;
    }
?>
