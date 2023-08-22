<?php
// Start the session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header('Location: login.php');
  exit();
}

// Include the database connection file
include('database.php');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $student_id = $_SESSION['user_id'];
  $professor_name = $_POST['professor_name'];
  $university_name = $_POST['university_name'];
  $department_name = $_POST['department_name'];
  $deadline = $_POST['deadline'];
  $purpose = $_POST['purpose'];
  
  // Insert data into database
  $stmt = $conn->prepare("INSERT INTO lor_request (student_id, professor_name, university_name, department_name, deadline, purpose) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("isssss", $student_id, $professor_name, $university_name, $department_name, $deadline, $purpose);
  $stmt->execute();
  $stmt->close();
  
  // Redirect to success page
  header('Location: lor_request_success.php');
  exit();
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
  <style>*{color:#fff;}</style>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Request Sent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/resumee.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<body class="hero-image">
<div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="student_dashboard.php">Welcome, <?php echo $_SESSION['username']; ?>!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="student_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update_p3.php">Manage Profile</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> 
  <div class="container my-4">
    <h1 class="text-center mb-4">Request for Letter of Recommendation</h1>
    <div class="alert alert-success" role="alert">
      Your request has been submitted successfully. You will receive an email once your letter of recommendation is ready. Thank you.
    </div>
    <center><a href="student_dashboard.php" class="btn btn-primary">Go back to Dashboard</a></center>
    
  </div>
  <footer id="footer" style="margin-top:180px">
        <i class="footer-icon fa-brands fa-facebook"></i>
        <i class="footer-icon fa-brands fa-twitter"></i>
        <i class="footer-icon fa-brands fa-instagram"></i>
        <i class="footer-icon fa-regular fa-envelope"></i>
    
        <p>© Copyright 2023 College-Portal</p>
      </footer>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>