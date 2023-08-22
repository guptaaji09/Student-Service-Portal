<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Service Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/contactpage.css">
    <link rel="stylesheet" href="css/forms.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body class="">
<div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">Student Service Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contactp.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

<div class="container my-4">
  <div class="bg-white p-3 rounded">
    <h2 style="text-align: center;"><strong>Contact Us</strong></h2>
    <form action="mailto:info@gmail.com" method="post">
      <div class="form-group">
        <label for="exampleFormControlInput1"><b>Email address</b> </label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="form-group">
    <label for="exampleFormControlTextarea1"><b>Tell us about yourself</b></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea2"><b>Elaborate Your Concern</b></label>
    <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
  </div>

  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
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