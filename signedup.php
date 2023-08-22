<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Service Portal</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="css/signedup.css">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
        .container {
            background-color: #1D1B26;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: none;
            background: #f1f1f1;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 15px;
            text-align: center;
        }

        a {
            color: #2196F3;
        }
    </style>
</head>
<body>
	<div class="container">
		<h1>Sign Up</h1>
		<form method="post" action="register.php">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
			</div>
			<div class="form-group">
				<label for="role">Role:</label>
				<select  class="form-control" id="role" name="role" required>
					<option value="" selected disabled style="color:grey;" value="">Select role:</option>
					<option style="color:black;" value="student">Student</option>
					<option style="color:black;"  value="teacher">Teacher</option>
					<!-- <option style="color:black;" value="admin">Admin</option> -->
				</select>
                <br>
			</div>
			<button type="submit" class="btn btn-primary"> Sign Up</button>
		</form>
		<p>Already have an account? <a href="index.php">Login</a></p>
	</div>
    <br>
	<footer id="footer">
        <i class="footer-icon fa-brands fa-facebook"></i>
        <i class="footer-icon fa-brands fa-twitter"></i>
        <i class="footer-icon fa-brands fa-instagram"></i>
        <a href="contactp.php"><i class="footer-icon fa-regular fa-envelope"></i></a>
    
        <p>© Copyright 2023 College-Portal</p>
      </footer>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>