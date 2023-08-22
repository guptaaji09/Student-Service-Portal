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

// Get full name and roll number from student_profile table
$stmt = $conn->prepare("SELECT full_name, roll_number, institute_name, department_name, university_name FROM student_profile WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($full_name, $roll_number, $institute_name, $department_name, $university_name);
$stmt->fetch();
$stmt->close();

// Get list of professors from the teacher_profile table
$stmt = $conn->prepare("SELECT full_name, department FROM teacher_profile");
$stmt->execute();
$stmt->bind_result($professor_fullname, $professor_department);
$professor_names = array();
while ($stmt->fetch()) {
    $professor_names[] = $professor_fullname . ' (' . $professor_department . ')';
}
$stmt->close();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $student_id = $_SESSION['user_id'];
    $professor_name = $_POST['professor_name'];
    $professor_name_parts = explode('(', $professor_name);
    $professor_fullname = trim($professor_name_parts[0]);
    $professor_department = trim(str_replace(')', '', $professor_name_parts[1]));
    $deadline = $_POST['deadline'];
    $purpose = $_POST['purpose'];
  
    // Get the professor identifier from the teacher_profile table
    $stmt = $conn->prepare("SELECT username FROM teacher_profile WHERE full_name = ? AND department = ?");
    $stmt->bind_param("ss", $professor_fullname, $professor_department);
    $stmt->execute();
    $stmt->bind_result($professor_identifier);
    $stmt->fetch();
    $stmt->close();
  
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO requests_for_lor (student_id, professor_identifier, professor_name, full_name, roll_number, university_name, department_name, deadline, purpose) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $student_id, $professor_identifier, $professor_name, $full_name, $roll_number, $university_name, $department_name, $deadline, $purpose);
    $stmt->execute();   
    $stmt->close();
  
    // Redirect to success page
    header('Location: lor_request_success.php');
    exit();
}
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Bonafide Certificate</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
          rel="stylesheet" />

      <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

      <link rel="stylesheet" href="css/lorform.css" />
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

<div style="color:black;" class="container">
  <div style="color:black;" class="bg-white p-3 rounded">
    <h1 class="text-center mb-4">Request for Letter of Recommendation</h1>
    <form method="POST">
      <div style="color:black;" class="form-group">
        <label for="professor_name" class="form-label">Professor's Name</label>
        <select name="professor_name" id="professor_name" class="form-control" required>
          <option value="" selected disabled>Select Option:</option>
          <?php foreach ($professor_names as $name) { ?>
            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
          <?php } ?>
        </select>
      </div>

      <div style="color:black; display:none;" class="form-group">
  <label for="professor_identifier" class="form-label">Professor Identifier</label>
  <input type="text" name="professor_identifier" id="professor_identifier" class="form-control" readonly>
</div>

<div style="color:black;" class="form-group">
        <label for="full_name" class="form-label">Student Full Name</label>
        <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $full_name; ?>" readonly>
      </div>

      <div style="color:black;" class="form-group">
        <label for="roll_number" class="form-label">Student Roll Number</label>
        <input type="text" name="roll_number" id="roll_number" class="form-control" value="<?php echo $roll_number; ?>" readonly>
      </div>


      <div style="color:black;" class="form-group">
        <label for="university_name" class="form-label">University Name</label>
        <input type="text" name="university_name" id="university_name" class="form-control" value="<?php echo $university_name; ?>" readonly>
      </div>

      <div style="color:black;" class="form-group">
        <label for="department_name" class="form-label">Department Name</label>
        <input type="text" name="department_name" id="department_name" class="form-control" value="<?php echo $department_name; ?>" readonly>
      </div>

      <div style="color:black;" class="form-group">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control" required>
      </div>

      <div style="color:black;" class="form-group">
        <label for="purpose" class="form-label">Additional Information</label>
        <textarea name="purpose" id="purpose" class="form-control" placeholder="Mention the Concerned Authority's details like Name, Designation, Address..." rows="5" required></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Submit Request</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Listen for changes in the professor name field
  $('#professor_name').change(function() {
    // Get the selected professor name
    var professor_name = $(this).val();

    // Extract the professor full name and department from the selected value
    var parts = professor_name.split('(');
    var professor_fullname = parts[0].trim();
    var professor_department = parts[1].replace(')', '').trim();

    // Get the professor identifier from the server using AJAX
    $.ajax({
      url: 'get_professor_identifier.php',
      data: { fullname: professor_fullname, department: professor_department },
      type: 'POST',
      dataType: 'json',
      success: function(response) {
        // Update the professor identifier field with the response value
        $('#professor_identifier').val(response.professor_identifier);
      }
    });
  });
</script>


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
</body>
</html>