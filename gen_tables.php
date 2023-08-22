<?php
// Start the session
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: login.php');
  exit();
}

// Include the database connection file
include('database.php');

// Define variables for success and error messages
$success_msg = '';
$error_msg = '';

// Check if the form has been submitted
if (isset($_POST['delete_user'])) {
  // Get the user id from the form
  $user_id = $_POST['user_id'];

  // Prepare and execute the SQL query to delete the user
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  if ($stmt->execute()) {
    $success_msg = 'User deleted successfully.';
  } else {
    $error_msg = 'Error deleting user.';
  }
  $stmt->close();
}

// Get the list of all users from the database
$stmt = $conn->prepare("SELECT * FROM users where id!=18");
$stmt->execute();
$result = $stmt->get_result();

// Separate the users into two arrays: teachers and students
$teachers = array();
$students = array();
while ($row = $result->fetch_assoc()) {
  if ($row['role'] === 'teacher') {
    $teachers[] = $row;
  }
  if ($row['role'] === 'student') {
    $students[] = $row;
  } 
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/resumee.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th,td {
      background-color: #f5f5f5;
      font-weight: bold;
    }

  </style>
</head>
<body class="hero-image">



<div class="container mt-5">
    <?php if ($success_msg !== '') : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success_msg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <?php if ($error_msg !== '') : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error_msg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>


<div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="admin_dashboard.php">Welcome, <?php echo $_SESSION['username']; ?>!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="gen_tables.php">Manage Users</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>


    <h1 style="color:#fff">Teachers</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($teachers as $teacher) : ?>
            <tr>
      <td style="font-weight:normal"><?php echo $teacher['id']; ?></td>
      <td style="font-weight:normal"><?php echo $teacher['username']; ?></td>
      <td style="font-weight:normal"><?php echo $teacher['email']; ?></td>
      <td>
        <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
          <input type="hidden" name="user_id" value="<?php echo $teacher['id']; ?>">
          <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<h1 style="color:#fff" class="mt-5">Students</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $student) : ?>
      <tr>
        <td style="font-weight:normal"><?php echo $student['id']; ?></td>
        <td style="font-weight:normal"><?php echo $student['username']; ?></td>
        <td style="font-weight:normal"><?php echo $student['email']; ?></td>
        <td>
          <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
            <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
            <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<footer id="footer">
        <i class="footer-icon fa-brands fa-facebook"></i>
        <i class="footer-icon fa-brands fa-twitter"></i>
        <i class="footer-icon fa-brands fa-instagram"></i>
        <a style="color:white;" href="contactp.php"><i class="footer-icon fa-regular fa-envelope"></i></a>

        <p>© Copyright 2023 College-Portal</p>
    </footer>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>
