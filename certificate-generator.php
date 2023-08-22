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

// Get the student's assignments from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM assignments WHERE student_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$assignments = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Certificate Generator</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
    rel="stylesheet" />

  <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="style.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script>
      var TxtType = function (el, toRotate, period) {
          this.toRotate = toRotate;
          this.el = el;
          this.loopNum = 0;
          this.period = parseInt(period, 10) || 2000;
          this.txt = '';
          this.tick();
          this.isDeleting = false;
      };

      TxtType.prototype.tick = function () {
          var i = this.loopNum % this.toRotate.length;
          var fullTxt = this.toRotate[i];

          if (this.isDeleting) {
              this.txt = fullTxt.substring(0, this.txt.length - 1);
          } else {
              this.txt = fullTxt.substring(0, this.txt.length + 1);
          }

          this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

          var that = this;
          var delta = 200 - Math.random() * 100;

          if (this.isDeleting) { delta /= 2; }

          if (!this.isDeleting && this.txt === fullTxt) {
              delta = this.period;
              this.isDeleting = true;
          } else if (this.isDeleting && this.txt === '') {
              this.isDeleting = false;
              this.loopNum++;
              delta = 500;
          }

          setTimeout(function () {
              that.tick();
          }, delta);
      };

      window.onload = function () {
          var elements = document.getElementsByClassName('typewrite');
          for (var i = 0; i < elements.length; i++) {
              var toRotate = elements[i].getAttribute('data-type');
              var period = elements[i].getAttribute('data-period');
              if (toRotate) {
                  new TxtType(elements[i], JSON.parse(toRotate), period);
              }
          }
          // INJECT CSS
          var css = document.createElement("style");
          css.type = "text/css";
          css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
          document.body.appendChild(css);
      };
  </script>

</head>

<body>

  <body class="hero-image">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">Certificate Generator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                            <a class="nav-link active" href="features.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactp.php">Contact Us</a>
                        </li>
                </ul>
            </div>
        </nav>
    </div>

    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <h1>
      <p class="typewrite" data-period="2000"
          data-type='[ "This is Certificate Generator", "First, Enter your name.", "Then, click Generate to download it."]'>
          <span class="wrap"></span>
  </h1>

  <div style="text-align: center;" class="container">
    <form action="bonifide_generate.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <br>
      <br>
      <input type="submit" value="Generate Certificate">
    </form>
  </div>

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