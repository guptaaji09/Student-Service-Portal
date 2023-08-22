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

// Get student profile data from the database
$stmt = $pdo->prepare('SELECT * FROM student_profile WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$profile = $stmt->fetch();

$full_name = $profile['full_name'];
$roll_number = $profile['roll_number'];
$date_of_birth = $profile['date_of_birth'];
$street_address = $profile['street_address'];
$city = $profile['city'];
$state = $profile['state'];
$zip_code = $profile['zip_code'];
$phone_number = $profile['phone_number'];
$institute_name = $profile['institute_name'];
$department_name = $profile['department_name'];
$university_name = $profile['university_name'];
$academic_year = $profile['academic_year'];
$start_year = $profile['start_year'];
$end_year = $profile['end_year'];
$email = $profile['email'];
$username = $profile['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Resume Form</title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/resumee.css" />
    <link rel="stylesheet" href="css/resume_forms.css">
    <link rel="stylesheet" href="mscbot/static/css/chat.css">
<link rel="stylesheet" href="mscbot/static/css/home.css">

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
  <!-- Center the form in a container -->
  <div class="container mt-5">
  <div class="card p-4">
    <h1 class="text-center mb-4">Resume Form</h1>
    <form method="POST" action="gen_res_cer3.php">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Full Name:</label>
          <input type="text" name="name" id="name" class="form-control" value="<?php echo $full_name ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label">Street Address:</label>
          <input type="text" name="address" id="address" class="form-control" value="<?php echo $street_address ?>" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="city" class="form-label">City:</label>
          <input type="text" name="city" id="city" class="form-control"value="<?php echo $city ?>" required>
        </div>
        <div class="col-md-6">
          <label for="state" class="form-label">State:</label>
          <input type="text" name="state" id="state" class="form-control" value="<?php echo $state ?>" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="zip" class="form-label">Zip Code:</label>
          <input type="text" name="zip" id="zip" class="form-control" value="<?php echo $zip_code ?>" required>
        </div>
        <div class="col-md-6">
          <label for="phone" class="form-label">Phone Number:</label>
          <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone_number ?>" required>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>" required>
      </div>
      <div class="mb-3">
        <label for="objective" class="form-label">Objective:</label>
        <textarea name="objective" id="objective" class="form-control" rows="5" required></textarea>
      </div>
      <hr>
      <h2 class="mb-3">Education</h2>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="college" class="form-label">Institute Name:</label>
          <input type="text" name="college" id="college" class="form-control" value="<?php echo $institute_name ?>" required>
        </div>
        <div class="col-md-6">
          <label for="major" class="form-label">Major</label>
          <input type="text" name="major" id="major" class="form-control" value="<?php echo $department_name ?>" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="college_city" class="form-label">City:</label>
          <input type="text" name="college_city" id="college_city" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="graduation_date" class="form-label">GPA Score:</label>
          <input type="text" name="gpa" id="gpa" class="form-control" required>
        </div>
      </div>
      <hr>
      <h2 class="mb-3">Experience</h2>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="company" class="form-label">Company Name:</label>
          <input type="text" name="company" id="company" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="company_location" class="form-label">Company Location:</label>
          <input type="text" name="company_location" id="company_location" class="form-control" required>
        </div>
      </div>
      <hr>
      <h2 class="mb-3">Skills</h2>
      <div class="row mb-3">
        <div class="col-md-12">
          <label for="skills" class="form-label">List your skills:</label>
          <input type="text" name="skills" id="skills" class="form-control" required>
        </div>
      </div>
      <hr>
      <h2 class="mb-3">Awards and Acknowledgements</h2>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="achievement1" class="form-label">Achievement 1:</label>
          <input type="text" name="achievement1" id="achievement1" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="achievement2" class="form-label">Achievement 2:</label>
          <input type="text" name="achievement2" id="achievement2" class="form-control" required>
        </div>
      </div>

      <center><button type="submit" class="btn btn-primary">Generate Resume</button></center>
    </form>
  </div>
</div>

<br>

  <!-- Add Bootstrap 5.3.0 and Popper.js 2.10.1 JavaScript -->
  <footer id="footer">
        <i class="footer-icon fa-brands fa-facebook"></i>
        <i class="footer-icon fa-brands fa-twitter"></i>
        <i class="footer-icon fa-brands fa-instagram"></i>
        <a style="color:white;" href="contactp.php"><i class="footer-icon fa-regular fa-envelope"></i></a>
    
        <p>© Copyright 2023 College-Portal</p>
      </footer>

      <?php include 'mscbot/index.php'; ?>

<script src="mscbot/static/scripts/rest.js"></script>
<script src="mscbot/static/scripts/chat.js"></script>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>