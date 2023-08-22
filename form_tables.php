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
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();

// Separate the users into two arrays: teachers and students
$teachers = array();
$students = array();
while ($row = $result->fetch_assoc()) {
  if ($row['role'] === 'teacher') {
    $teachers[] = $row;
  } else {
    $students[] = $row;
  }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <?php if ($success_msg !== '') : ?>
      <div class="alert alert-success"><?php echo $success_msg; ?></div>
    <?php endif; ?>
    <?php if ($error_msg !== '') : ?>
      <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    <?php endif; ?>
    <h1>Teachers</h1>
    <table class="table">
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
            <td><?php echo $teacher['id']; ?></td>
            <td><?php echo $teacher['username']; ?></td>
            <td><?php echo $teacher['email']; ?></td>
            <td>
              <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                <input type="hidden" name="user_id" value="<?php echo $teacher['id']; ?>">
                <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h1>Students</h1>
    <table class="table">
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
        <td><?php echo $student['id']; ?></td>
        <td><?php echo $student['username']; ?></td>
        <td><?php echo $student['email']; ?></td>
        <td>
          <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
            <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
            <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
  </div>
</body>
</html>
