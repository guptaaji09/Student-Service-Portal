<?php
// Start the session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header('Location: login.php');
  exit();
}

// Include the database connection
require_once 'database.php';

// Get the user's email and username from the users table
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT email, username FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $user['email'];
$username = $user['username'];

$full_name = '';
$roll_number = '';
$date_of_birth = '';
$street_address = '';
$city = '';
$state = '';
$zip_code = '';
$phone_number = '';
$institute_name = '';
$department_name = '';
$university_name = '';
$academic_year = '';
$start_year = '';
$end_year = '';

// Check if the user has already created a profile
$stmt = $pdo->prepare('SELECT COUNT(*) FROM student_profile WHERE user_id = ?');
$stmt->execute([$user_id]);
$count = $stmt->fetchColumn();

if ($count == 0) {
  // If no profile exists, insert a new row with default values
  $stmt = $pdo->prepare('INSERT INTO student_profile (user_id, email, username, full_name, roll_number, date_of_birth, street_address, city, state, zip_code, phone_number, institute_name, department_name, university_name, academic_year, start_year, end_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute([$user_id, $email, $username, '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
} else {
  // If profile exists, get the user's profile data from the student_profile table
  $stmt = $pdo->prepare('SELECT * FROM student_profile WHERE user_id = ?');
  $stmt->execute([$user_id]);
  $profile = $stmt->fetch(PDO::FETCH_ASSOC);

  // Set the default values for the profile data
  $full_name = $profile['full_name'] ?? '';
  $roll_number = $profile['roll_number'] ?? '';
  $date_of_birth = $profile['date_of_birth'] ?? '';
  $street_address = $profile['street_address'] ?? '';
  $city = $profile['city'] ?? '';
  $state = $profile['state'] ?? '';
  $zip_code = $profile['zip_code'] ?? '';
  $phone_number = $profile['phone_number'] ?? '';
  $institute_name = $profile['institute_name'] ?? '';
  $department_name = $profile['department_name'] ?? '';
  $university_name = $profile['university_name'] ?? '';
  $academic_year = $profile['academic_year'] ?? '';
  $start_year = $profile['start_year'] ?? '';
  $end_year = $profile['end_year'] ?? '';
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $full_name = $_POST['full_name'] ?? '';
  $roll_number = $_POST['roll_number'] ?? '';
  $date_of_birth = $_POST['date_of_birth'] ?? '';
  $street_address = $_POST['street_address'] ?? '';
  $city = $_POST['city'] ?? '';
  $state = $_POST['state'] ?? '';
  $zip_code = $_POST['zip_code'] ?? '';
  $phone_number = $_POST['phone_number'] ?? '';
  $institute_name = $_POST['institute_name'] ?? '';
$department_name = $_POST['department_name'] ?? '';
$university_name = $_POST['university_name'] ?? '';
$academic_year = $_POST['academic_year'] ?? '';
$start_year = $_POST['start_year'] ?? '';
$end_year = $_POST['end_year'] ?? '';

// Update the user's profile data in the student_profile table
// Update the user's profile data in the student_profile table
$stmt = $pdo->prepare('UPDATE student_profile SET email = ?, username = ?, full_name = ?, roll_number = ?, date_of_birth = ?, street_address = ?, city = ?, state = ?, zip_code = ?, phone_number = ?, institute_name = ?, department_name = ?, university_name = ?, academic_year = ?, start_year = ?, end_year = ? WHERE user_id = ?');
$stmt->execute([$email, $username, $full_name, $roll_number, $date_of_birth, $street_address, $city, $state, $zip_code, $phone_number, $institute_name, $department_name, $university_name, $academic_year, $start_year, $end_year, $user_id]);


// Redirect the user to their updated profile page
header('Location: update_p3.php?success');
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Profile</title>

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
                            <a class="nav-link" href="student_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="update_p3.php">Manage Profile</a>
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
    <h1 class="my-5">Update Profile</h1>
    <form method="POST">
      <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly />
      </div>
      <div class="form-group">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" readonly />
      </div>
      <div class="form-group">
        <label for="full_name" class="form-label">Full Name:</label>
        <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo $full_name; ?>" required />
      </div>
      <div class="form-group">
        <label for="roll_number" class="form-label">Roll Number:</label>
        <input type="text" id="roll_number" name="roll_number" class="form-control" value="<?php echo $roll_number; ?>" required />
      </div>
      <div class="form-group">
        <label for="date_of_birth" class="form-label">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth; ?>" required />
      </div>
      <div class="form-group">
        <label for="street_address" class="form-label">Street Address:</label>
        <input type="text" id="street_address" name="street_address" class="form-control" value="<?php echo $street_address; ?>" required />
      </div>
      <div class="form-group">
        <label for="city" class="form-label">City:</label>
        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city; ?>" required />
      </div>
      <div class="form-group">
        <label for="state" class="form-label">State:</label>
        <input type="text" id="state" name="state" class="form-control" value="<?php echo $state; ?>" required />
      </div>
      <div class="form-group">
        <label for="zip_code" class="form-label">Zip Code:</label>
        <input type="text" id="zip_code" name="zip_code" class="form-control" value="<?php echo $zip_code; ?>" required />
      </div>
      <div class="form-group">
        <label for="phone_number" class="form-label">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>" required />
      </div>
      <div class="form-group">
        <h2 class="mt-4">Institute Details</h2>
      </div>
      <div class="form-group">
        <label for="institute_name" class="form-label">Institute Name:</label>
        <input type="text" id="institute_name" name="institute_name" class="form-control" value="<?php echo $institute_name; ?>" required />
      </div>
      <div class="form-group">
      <label for="department_name" class="form-label">Department Name:</label>
<input type="text" id="department_name" name="department_name" class="form-control" value="<?php echo $department_name; ?>" required />
</div>
<div class="form-group">
<label for="university_name" class="form-label">University Name:</label>
<input type="text" id="university_name" name="university_name" class="form-control" value="<?php echo $university_name; ?>" required />
</div>
<div class="form-group">
<label for="academic_year" class="form-label">Academic Year:</label>
<input type="text" id="academic_year" name="academic_year" class="form-control" value="<?php echo $academic_year; ?>" required />
</div>
<div class="form-group">
<label for="start_year" class="form-label">Start Year:</label>
<input type="date" id="start_year" name="start_year" class="form-control" value="<?php echo $start_year; ?>" required />
</div>
<div class="form-group">
<label for="end_year" class="form-label">End Year:</label>
<input type="date" id="end_year" name="end_year" class="form-control" value="<?php echo $end_year; ?>" required />
</div>
<br>
<center><button type="submit" class="btn btn-primary">Update</button></center>

</form>

  </div>
</div>

<br>    
  
<?php include 'mscbot/index.php'; ?>

<script src="mscbot/static/scripts/rest.js"></script>
<script src="mscbot/static/scripts/chat.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-J8pzvU6xCmU6Og1LEAnmtw8pCwe6O/HO/Mo0zhxI7P8i0BiTzF1TEpRgeNz/aW8M" crossorigin="anonymous"></script>
</body>
</html>
