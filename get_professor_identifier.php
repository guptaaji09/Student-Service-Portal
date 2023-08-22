<?php
// Include the database connection file
include('database.php');

// Get the professor name and department from the request
$professor_name = $_GET['professor_name'];
$professor_name_parts = explode('(', $professor_name);
$professor_fullname = trim($professor_name_parts[0]);
$professor_department = trim(str_replace(')', '', $professor_name_parts[1]));

// Get the professor identifier from the teacher_profile table
$stmt = $conn->prepare("SELECT username FROM teacher_profile WHERE full_name = ? AND department = ?");
$stmt->bind_param("ss", $professor_fullname, $professor_department);
$stmt->execute();
$stmt->bind_result($professor_identifier);
$stmt->fetch();
$stmt->close();

// Return the professor identifier as JSON
header('Content-Type: application/json');
echo json_encode(array('professor_identifier' => $professor_identifier));
?>
