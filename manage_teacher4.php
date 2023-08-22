<?php
// Start the session
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
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

// Check if the user has already created a profile
$stmt = $pdo->prepare('SELECT COUNT(*) FROM teacher_profile WHERE id = ?');
$stmt->execute([$user_id]);
$count = $stmt->fetchColumn();

// If no profile exists, insert a new row with default values
if ($count == 0) {
  $stmt = $pdo->prepare('INSERT INTO teacher_profile (id, email, username, full_name, phone_number, qualification, department, date_of_joining) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute([$user_id, $email, $username, '', '', '', '', '']);
}

// Get teacher profile data from the database
$stmt = $pdo->prepare('SELECT * FROM teacher_profile WHERE id = ?');
$stmt->execute([$user_id]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize form fields with default values from the teacher_profile table
$full_name = $profile['full_name'] ?? '';
$phone_number = $profile['phone_number'] ?? '';
$qualification = $profile['qualification'] ?? '';
$department = $profile['department'] ?? '';
$date_of_joining = $profile['date_of_joining'] ?? '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize input values
  $full_name = htmlspecialchars($_POST['full_name']);
  $phone_number = htmlspecialchars($_POST['phone_number']);
  $qualification = htmlspecialchars($_POST['qualification']);
  $department = htmlspecialchars($_POST['department']);
  $date_of_joining = htmlspecialchars($_POST['date_of_joining']);

  // Update form data into teacher_profile table
  $stmt = $pdo->prepare('UPDATE teacher_profile SET email = ?, username = ?, full_name = ?, phone_number = ?, qualification = ?, department = ?, date_of_joining = ? WHERE id = ?');
  $stmt->execute([$email, $username, $full_name, $phone_number, $qualification, $department, $date_of_joining, $user_id]);

  // Redirect to the teacher profile page
  header('Location: manage_teacher4.php?message=success');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Profile</title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/teacherr.css" />
    <link rel="stylesheet" href="css/forms.css">

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
                            <a class="nav-link" href="teacher_dashboard3.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="manage_teacher4.php" ">Manage Profile</a>
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
  <h1>Manage Profile</h1>
  <form method="post">
    <div class="form-group">
      <label for="username" class="form-label">Username:</label>
      <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>" readonly>
    </div>
    <div class="form-group">
  <label for="email" class="form-label">Email:</label>
  <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" readonly>
</div>

<div class="form-group">
  <label for="full_name" class="form-label">Full Name:</label>
  <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $full_name; ?>">
</div>

<div class="form-group">
  <label for="phone_number" class="form-label">Phone Number:</label>
  <input type="tel" name="phone_number" id="phone_number" class="form-control" value="<?php echo $phone_number; ?>">
</div>

<div class="form-group">
  <label for="qualification" class="form-label">Qualification:</label>
  <input type="text" name="qualification" id="qualification" class="form-control" value="<?php echo $qualification; ?>">
</div>

<div class="form-group">
  <label for="department" class="form-label">Department:</label>
  <input type="text" name="department" id="department" class="form-control" value="<?php echo $department; ?>">
</div>

<div class="form-group">
  <label for="date_of_joining" class="form-label">Date of Joining:</label>
  <input type="date" name="date_of_joining" id="date_of_joining" class="form-control" value="<?php echo $date_of_joining; ?>">
</div>

<div class="text-center">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
</div>
</div>
<br>

</body>
</html>