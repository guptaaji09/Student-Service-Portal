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

// Get default values for form fields from student_profile table
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM student_profile WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$full_name = $row['full_name'];
$roll_number = $row['roll_number'];
$academic_year = $row['academic_year'];
$start_date = $row['start_year'] . '-01-01';
$end_date = $row['end_year'] . '-12-31';
$institute_name = $row['institute_name'];
$university_name = $row['university_name'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medical Certificate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/resumee.css" />
    <link rel="stylesheet" href="css/forms.css">
    
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

<div class="container my-5">
  <div class="card p-4 shadow">
    <h1 class="card-title text-center">Medical Certificate Form</h1>
    <form method="POST" action="gen_med_cer2.php">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $full_name ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="doctor_name" class="form-label">Doctor's Name:</label>
        <input type="text" class="form-control" name="doctor_name" id="doctor_name" required>
      </div>
      <div class="mb-3">
        <label for="suffering_from" class="form-label">Suffering From:</label>
        <input type="text" class="form-control" name="suffering_from" id="suffering_from" required>
      </div>
      <div class="mb-3">
        <label for="period_of_recovery" class="form-label">Period of Recovery:</label>
        <input type="text" class="form-control" name="period_of_recovery" id="period_of_recovery" placeholder="1 week, 2 months, etc." required>
      </div>
      <div class="mb-3">
      <label for="issue_date" class="form-label">Issue Date:</label>
      <input value="<?php echo date('Y-m-d'); ?>" type="date" class="form-control" name="issue_date" id="issue_date" required>
      </div>

      <br>
      <center><button type="submit" class="btn btn-primary" onclick="showSuccessAlert()">Generate Certificate</button></center>
    <br>
    <div id="alert-container"></div>
  </form>
</div>
</div>

<script>
  function showSuccessAlert() {
  const alert = document.createElement('div');
  alert.className = 'alert alert-success alert-dismissible fade show';
  alert.role = 'alert';
  alert.innerHTML = 'The requested certificate was generated successfully.';
  
  const alertContainer = document.getElementById('alert-container');
  alertContainer.appendChild(alert);
  
  setTimeout(() => {
    alertContainer.removeChild(alert);
  }, 5000);
}
</script>

<footer style="padding: 0% 15% 0% 15%;" id="footer">
        <i class="footer-icon fa-brands fa-facebook"></i>
        <i class="footer-icon fa-brands fa-twitter"></i>
        <i class="footer-icon fa-brands fa-instagram"></i>
        <a style="color:white;" href="contactp.php"><i class="footer-icon fa-regular fa-envelope"></i></a>
    
        <p>© Copyright 2023 College-Portal</p>
      </footer>

      <?php include 'mscbot/index.php'; ?>

<script src="mscbot/static/scripts/rest.js"></script>
<script src="mscbot/static/scripts/chat.js"></script>

    // <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
        </script>
</body>

</html>
<?php
$conn->close();
?>
