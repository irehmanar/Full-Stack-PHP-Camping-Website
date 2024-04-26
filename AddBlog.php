<?php
$username = "";
$email = "";
$isLoggedIn = false;

// Check if session key is set
if (isset($_SESSION['username'])) {
    // Access the stored variables
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $isLoggedIn = true;
}

$isDataSubmitted = false; // Initialize the variable to false

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $title = $_POST["title"] ?? ''; // Use null coalescing operator to avoid undefined index notices
  $Image = $_POST["Image"] ?? '';
  $blog_text = $_POST["blog_text"] ?? '';


  require_once 'connection.php';

  $query3 = "SELECT User_ID FROM User WHERE Email = '$email'";
  $result3 = mysqli_query($mysqli, $query3);
  $row3 = mysqli_fetch_assoc($result3);
  $userId3 = $row3['User_ID'];

  // Write a query to get users from the database
  $query = "INSERT INTO blogs (Picture, blogText, date, User_ID ,Title) VALUES ('$Image', '$blog_text', CURDATE(), '$userId3','$title')";

  // Execute the query
  $result = mysqli_query($mysqli, $query);



  // Execute the SQL statement
  if ($result) {
    $isDataSubmitted = true;
    
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

  <style>
    * {
      /* overflow-x: hidden; */
    }
  </style>
</head>

<body>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 140px; z-index: 100;margin-top: 70px">
    <div class="toast mt-4" style="position: absolute; top: 0; right: 0; display: <?= $isDataSubmitted ? 'block' : 'none'; ?>;" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto">Women Camping</strong>
            <small>Just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="toast-body">
            Blog post submitted successfully!
        </div>
    </div>
</div>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="Task2.php">Women Camping</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="Task2.php">Home </a>
        <a class="nav-item nav-link  active" href="AddBlog.php">Add Blog<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="Review.php">Reviews</a>
        <a class="nav-item nav-link" href="Signin.php">Register</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="myBlog.php">My Account</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="logout.php">Log Out</a>
      </div>
    </div>
  </nav>
  
  <script>
$(document).ready(function() {
  $('.toast').toast({
    delay: 2000 // Specify the delay in milliseconds (e.g., 5000 milliseconds = 5 seconds)
  }).toast('show');
});
</script>




  <section class="container bg-dark w-100 text-light p-5 mx-auto " style="margin-bottom: 70px">
    <form class="row g-3 p-3" action="AddBlog.php" method="POST">

      <div class="col-md-6">
        <label for="validationDefaultTitle" class="form-label text-light">Choose a title</label>
        <input type="text" class="form-control" name="title" id="validationDefaultTitle" placeholder="Title" required>
      </div>
      <div class="col-md-6">
        <label for="validationDefaultAuthor" class="form-label text-light">Image Source</label>
        <input type="text" name="Image" class="form-control" id="validationDefaultAuthor" placeholder="Author" required>
      </div>
      <div class="col-md-12 h-100">
        <label for="inputBlog" class="form-label text-light">Blog Description</label>
        <div class="input-group">
          <textarea style="height: 200px;" class="form-control" id="inputBlog" name="blog_text" rows="14"  required></textarea>
        </div>
      </div>


      <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>

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