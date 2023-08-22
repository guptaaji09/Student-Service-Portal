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

// Check if the delete form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
  // Get the request ID from the POST data
  $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);

  // Delete the LOR request from the database
  mysqli_query($conn, "DELETE FROM requests_for_lor WHERE id = '$request_id'");

  // Display a success alert
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          LOR request was deleted successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

// Get the LOR requests and corresponding student emails from the database
$lor_requests = mysqli_query($conn, "SELECT r.*, s.email FROM requests_for_lor r 
                                      JOIN student_profile s ON r.roll_number = s.roll_number
                                      JOIN teacher_profile t ON r.professor_identifier = t.username
                                      WHERE t.id = '{$_SESSION['user_id']}'");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Teacher Dashboard</title>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<style>
		.table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  background-color: #ffffff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.table thead th {
  text-align: center;
  padding: 12px 16px;
  font-weight: 600;
  border-bottom: 2px solid #f0f0f0;

}

.table tbody td {
  padding: 12px 16px;
  border-bottom: 1px solid #f0f0f0;
}

.table tbody tr:last-child td {
  border-bottom: none;
}

.table tbody td:last-child {
  text-align: center;
}

.table tbody tr:hover {
  background-color: #f9f9f9;
}

.table .btn {
  padding: 8px 12px;
  border-radius: 4px;
}

.table .btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.table .btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

	</style>
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
                            <a class="nav-link" href="manage_teacher4.php" ">Manage Profile</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
	<div class="container">

		<h2 style="color:#fff; font-family: 'Montserrat', sans-serif;" class="text-center mt-5">LOR Requests</h2>


    <table class="table">
	<thead>
		<tr>
			<th>Student's Full Name</th>
			<th>Student's <br> Email <br> ID</th>
			<th>Student's Roll Number</th>
			<th>Student's University</th>
			<th>Student's Department</th>
			<th style="cursor: pointer;" onclick="sortTable(4)">Deadline &#8645;</th>
			<th>Additional Information</th>
			<th>Action</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($request = mysqli_fetch_assoc($lor_requests)) { ?>
			<tr>
				<td><?php echo $request['full_name']; ?></td>
				<td>
        <a href="mailto:<?php echo $request['email']; ?>?subject=Here's the LOR requested by you!&body=Hey, I have attached the requested LOR with this email. If you have any queries, email me anytime!"><?php echo $request['email']; ?></a>
        </td>
				<td><?php echo $request['roll_number']; ?></td>
				<td><?php echo $request['university_name']; ?></td>
				<td><?php echo $request['department_name']; ?></td>
				<td><?php echo $request['deadline']; ?></td>
				<td><?php echo $request['purpose']; ?></td>
				<td>
					<a href="new_lor_generate.php" target="_blank" class="btn btn-primary">Generate</a>
				</td>
				<td>
					<form method="post" action="lor_admin_delete.php" onsubmit="return confirm('Are you sure you want to delete it?')">
						<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
						<input type="hidden" name="action" value="delete">
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<br>


<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementsByClassName("table")[0];
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
  // Reset the switchcount after each iteration:
    switchcount = 0;
// Add/remove arrows based on sorting direction:
var arrow = document.getElementById("arrow");
if (dir == "asc") {
arrow.classList.remove("fa-arrow-down");
arrow.classList.add("fa-arrow-up");
} else if (dir == "desc") {
arrow.classList.remove("fa-arrow-up");
arrow.classList.add("fa-arrow-down");
}
}
</script>

	<!-- Include Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-Tofv49boZIC9a4n4UWhMu6UerN6yAbVlH+ia6U60V7PTbi3qZdTw7ZuZNHNF8aAXCCP3oPLfVJpv1AnEe1W+tA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
