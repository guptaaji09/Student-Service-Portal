<?php
// Start the session
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
  header('Location: login.php');
  exit();
}

// Include the database connection file
include('database.php');

// Retrieve the teacher's profile data from the database
$stmt = $pdo->prepare('SELECT full_name, phone_number, email, qualification, department FROM teacher_profile WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$profile = $stmt->fetch();

// Set default values for the form fields based on the teacher's profile data
$default_full_name = $profile['full_name'];
$default_phone_number = $profile['phone_number'];
$default_email = $profile['email'];
$default_qualification = $profile['qualification'];
$default_department = $profile['department'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Generate LOR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/resumee.css" />
    <link rel="stylesheet" href="css/lor_form.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<body class="hero-image">
<div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="teacher_dashboard3.php">Welcome, <?php echo $_SESSION['username']; ?>!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="teacher_dashboard3.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_teacher4.php">Manage Profile</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> 


<div class="container">
  <div class="bg-white p-3 rounded">
    <h1>Generate LOR</h1>
    <form action="gen_new_lor.php" method="POST">
    <br>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="full_name" class="form-label">Name:</label>
          <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo $default_full_name; ?>">
        </div>
        <div class="form-group">
          <label for="phone_number" class="form-label">Phone No:</label>
          <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $default_phone_number; ?>">
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Mail ID:</label>
          <input type="email" id="email" name="email" class="form-control" value="<?php echo $default_email; ?>">
        </div>
        <div class="form-group">
          <label for="qualification" class="form-label">Qualification:</label>
          <input type="text" id="qualification" name="qualification" class="form-control" value="<?php echo $default_qualification; ?>">
        </div>
        <div class="form-group">
          <label for="department" class="form-label">Department:</label>
          <input type="text" id="department" name="department" class="form-control" value="<?php echo $default_department; ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="student_name" class="form-label">Student Name:</label>
          <input type="text" id="student_name" name="student_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="student_roll_number" class="form-label">Student Roll Number:</label>
          <input type="text" id="student_roll_number" name="student_roll_number" class="form-control">
        </div>
        <div class="form-group">
          <label for="authority_name" class="form-label">Concerned Authority Name:</label>
          <input type="text" id="authority_name" name="authority_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="authority_designation" class="form-label">Concerned Authority Designation:</label>
          <input type="text" id="authority_designation" name="authority_designation" class="form-control">
        </div>
        <div class="form-group">
          <label for="authority_address" class="form-label">Concerned Authority Address:</label>
          <input type="text" id="authority_address" name="authority_address" class="form-control">
        </div>
      </div>
      <br>
      <div class="col-md-12 text-center">
        <input type="submit" value="Generate" class="btn btn-primary">
      </div>
    </div>
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


        <footer id="footer">
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

<?php
$conn->close();
?>
