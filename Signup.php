<?php
session_start(); // Start the session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"] ?? '';
    $lastName = $_POST["lastName"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $name = $firstName . " " . $lastName;

    require_once 'connection.php';

    // Check if email already exists
    $checkQuery = "SELECT * FROM User WHERE Email = '$email'";
    $checkResult = mysqli_query($mysqli, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Email already exists, inform the user
        echo "Email is already registered.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement using prepared statements
        $query = "INSERT INTO User (Username, Email, Password, firstName , lastName) VALUES (?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($mysqli, $query);

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($statement, "sssss", $name, $email, $hashedPassword, $firstName, $lastName);
        $result = mysqli_stmt_execute($statement);

        // Check if the insertion was successful
        if ($result) {
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email;
            header("Location: Task2.php");
            exit; // Ensure no further code execution after the redirection
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }

        // Close the statement
        mysqli_stmt_close($statement);
    }

    // Close the database connection
    mysqli_close($mysqli);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Title -->
  <title>Resigter</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e136085353.js" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="Task2.php">Women Camping</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="Task2.php">Home </a>
        <a class="nav-item nav-link" href="AddBlog.php">Add Blog</a>
        <a class="nav-item nav-link" href="Review.php">Reviews</a>
        <a class="nav-item nav-link active" href="Signin.php">Login<span class="sr-only">(current)</span></a>
      </div>
    </div>
  </nav>



  <div>
    <section class="vh-90">

      <div class="container py-1 mx-auto m-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem; margin-top: 3.5rem;">
              <div class="row" style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.25);">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form action="Signup.php" method="POST">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Women Caming </span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register your account</h5>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" />
                        <label class="form-label" for="firstName">First Name</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" />
                        <label class="form-label" for="lastName">Last Name</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="email">Email Address</label>
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                      </div>

                      <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>

                      <!-- <a class="small text-muted" href="#!">Forgot password?</a> -->
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="Signin.php" style="color: #A85681;">Login Here</a></p>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>







  <footer class="bg-dark text-center text-lg-start text-white">
    <!-- Grid container -->
    <div class="container-fluid p-4">
      <!--Grid row-->
      <div class="row mt-4">
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Content</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="Signin.php" class="text-white">LOGIN</a>
            </li>
            <li>
              <a href="Signup.php" class="text-white">SIGNUP</a>
            </li>
            <li>
              <a href="AddBlog.php" class="text-white">ADD BLOG</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Services</h5>

          <ul class="list-unstyled">
            <li>
              MERN Stack
            </li>
            <li>
              Laraval
            </li>
            <li>
              Power BI
            </li>
            <li>
              Computer Vision
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Software house</h5>

          <ul class="list-unstyled">
            <li>
              The Ghazali Hostel
            </li>
            <li>
              Bolan Road
            </li>
            <li>
              H-12 Islamabad
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Write to us</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!" class="text-white"><i class="fa fa-linkedin" aria-hidden="true" style="padding-right: 5px;"></i> LinkedIn</a>

            </li>
            <li>
              <a href="#!" class="text-white"><i class="fa fa-github" aria-hidden="true" style="padding-right: 5px;"></i> Github</a>

            </li>
            <li>
              <a href="#!" class="text-white"><i class="fa fa-instagram" aria-hidden="true" style="padding-right: 5px;"></i> Instagram</a>

            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2024 Copyright:
      <a class="text-white" href="#">Wayne Tech</a>
    </div>
    <!-- Copyright -->
  </footer>









  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

</body>

</html>