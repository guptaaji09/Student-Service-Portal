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
    <title>Student Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <script src="https://kit.fontawesome.com/fb0938d157.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/features.css" />
    <link rel="stylesheet" href="mscbot/static/css/chat.css">
<link rel="stylesheet" href="mscbot/static/css/home.css">

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

        <h4 style="text-align:center;color:#fff; font-family: 'Ubuntu', sans-serif;margin-bottom:30px;" class="typewrite" data-period="2000"
                data-type='[ "First, select the certificate to generate..", "Require Bonafide?", "Medical?"," or Study?"]'>
                <span class="wrap"></span></h4>

		<div class="container">
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow">
                        <a href="bon_cer2.php"><img src="imgs/bon.png" class="card-img-top" alt="..."></a>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0"><b>Bonafide Certificate</b></h5>
                            <div style="font-size: 15px;" class="card-text text-black-50">A bonafide certificate is a document to certify the authenticity of a student's claims.</div>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow ">
                        <a href="med_cer.php"><img src="imgs/med.png" class="card-img-top" alt="..."></a>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0"><b>Medical Certificate</b></h5>
                            <div style="font-size: 15px;" class="card-text text-black-50">It confirms a student's health status and may be required in cases of extended absences or illness-related academic accommodations.</div>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow">
                        <a href="study_cer.php"><img src="imgs/stud.png" class="card-img-top" alt="..."></a>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0"> <b>Course Certificate</b></h5>
                            <div style="font-size: 15px;" class="card-text text-black-50">It refers to the document that verifies a student has successfully finished a course.</div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include 'mscbot/index.php'; ?>

<script src="mscbot/static/scripts/rest.js"></script>
<script src="mscbot/static/scripts/chat.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                crossorigin="anonymous"></script>
    </body>
</html>
