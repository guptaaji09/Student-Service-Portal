<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    require("PHPMailer-master/src/PHPMailer.php");
    require("PHPMailer-master/src/SMTP.php");
    require("PHPMailer-master/src/Exception.php");

    // Include the database connection file
    require_once('database.php');

    // Check if the email and token parameters are set in the URL
    if (isset($_GET['email']) && isset($_GET['token'])) {
        // Get the email and token values from the URL
        $email = $_GET['email'];
        $token = $_GET['token'];

        // Query the database to check if the email and token combination is valid
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_token = ?");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // The email and token combination is valid, so display the password reset form
            echo '
            <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style>
        .container {
            background-color: #1D1B26;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: none;
            background: #f1f1f1;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 15px;
            text-align: center;
        }

        a {
            color: #2196F3;
        }
    </style>
</head>
            <body>
                <div class="container">
                    <h1>Reset Password</h1>
                    <form method="post" action="update_password.php">
                        <input type="hidden" name="email" value="' . $email . '">
                        <input type="hidden" name="token" value="' . $token . '">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </form>
                </div>
                <br>
                <footer id="footer">
                    <i class="footer-icon fa-brands fa-facebook"></i>
                    <i class="footer-icon fa-brands fa-twitter"></i>
                    <i class="footer-icon fa-brands fa-instagram"></i>
                    <a href="contactp.php"><i class="footer-icon fa-regular fa-envelope"></i></a>
                    <p>© Copyright 2023 College-Portal</p>
                  </footer>

                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                      crossorigin="anonymous"></script>
            </body>
            </html>';
        } else {
            // The email and token combination is not valid, so display an error message
            echo $email;
            echo $token;
            echo "Invalid email and token combination.";
        }
    } else {
        // The email and token parameters are not set in the URL, so display an error message
        echo "Email and token parameters are missing.";
    }
?>

