<?php
session_start(); // Start the session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "check";
}

// Initialize variables
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

// Now you can use $username and $email as needed
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta information -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Title -->
  <title>Camping for Women</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e136085353.js" crossorigin="anonymous"></script>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
  <!-- Custom Styles -->
  <style>
    /* Jumbotron styles */
    .jumbotron {
      background-image: url(https://images.pexels.com/photos/618848/pexels-photo-618848.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      text-align: center;
      padding: 100px 0;
      color: #fff;
      margin-bottom: 30px;
    }

    /* Card image styles */
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="#">Women Camping</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="AddBlog.php">Add Blog</a>
        <a class="nav-item nav-link" href="Review.php">Reviews</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="myBlog.php">My Account</a>
        <a class="nav-item nav-link" href="Signin.php">Register</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="logout.php">Log Out</a>
      </div>
    </div>
  </nav>





  <div class="jumbotron mt-5">
    <h1 class="display-4">The Home for Women Outdoor Adventurers</h1>
    <p class="lead">
      What are you looking for today? Let's explore the World.
    </p>
  </div>


  <form action="Task2.php" method="GET">
    <div class="container">
      <div class="row">
        <div class="col input-group">
          <span class="input-group-text"><i class="fas fa-location-dot"></i></span>
          <input type="text" class="form-control" name="emailSearch" placeholder="Search By Username" />

        </div>
        <div class="col input-group">
          <span class="input-group-text"><i class="fas fa-location-dot"></i></span>
          <input type="text" class="form-control" name="titleSearch" placeholder="Search By Title" />

        </div>
        <div class="col input-group">
          <span class="input-group-text"><i class="fas fa-calendar-days"></i></span>
          <input type="date" class="form-control" name="dateSearch" style="height: 38px" placeholder="Enter Date" />

        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>


      </div>
    </div>

  </form>




  <?php

  if (!empty($_GET["emailSearch"])) {
    $emailSearch = $_GET["emailSearch"] ?? '';
    echo '
    <h1 class="mt-5 mb-4 text-center">Your Search Result </h1>  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">';
    require_once 'connection.php'; // Include the file with MySQLi connection
    // Step 1: Retrieve User_ID based on the email
    $query = "SELECT User_ID FROM User WHERE Email = '$emailSearch'";

    $result = mysqli_query($mysqli, $query);

    if ($result) {
      // Fetch the result row as an associative array
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        $userId = $row['User_ID'];

        // Step 2: Fetch all blogs written by this user
        $blogQuery = "SELECT * FROM BLOGS WHERE User_ID = $userId";
        $blogResult = mysqli_query($mysqli, $blogQuery);

        if ($blogResult) {
          // Fetch and display all blogs
          while ($blogRow = mysqli_fetch_assoc($blogResult)) {
            echo '
                    <div class="col">
                    <div class="card h-100">
                      <img src="img-1.jpg" class="card-img-top" alt="Web 1" />
                      <div class="card-body">
                        <h5 class="card-title">' . $blogRow['likes'] . '</h5>
                        <p class="card-text">' . $blogRow['blogText'] . '</p>
                      </div>
                    </div>
                  </div>
    
    
                    ';
          }
        } else {
          echo "Error fetching blogs: " . mysqli_error($mysqli);
        }
      } else {
        echo "<h2 style='color:red';>No user found.</h2>";
      }
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    // Close the database connection
    // mysqli_close($mysqli);
  } 
  
  elseif (!empty($_GET["titleSearch"])) {
    // $emailSearch = $_GET["emailSearch"] ?? '';
    $titleSearch = $_GET["titleSearch"] ?? '';
    // $dateSearch = $_GET["dateSearch"] ?? '';
    echo '
    <h1 class="mt-5 mb-4 text-center">Your Search Result</h1>  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">';

    require_once 'connection.php'; // Include the file with MySQLi connection

    // Step 2: Fetch all blogs written by this user
    $blogQuery = "SELECT * FROM BLOGS WHERE blogText = '$titleSearch'";
    $blogResult = mysqli_query($mysqli, $blogQuery);
    if ($blogResult) {
      // Fetch and display all blogs
      while ($blogRow = mysqli_fetch_assoc($blogResult)) {
        echo '
                    <div class="col">
                    <div class="card h-100">
                      <img src="img-1.jpg" class="card-img-top" alt="Web 1" />
                      <div class="card-body">
                        <h5 class="card-title">' . $blogRow['likes'] . '</h5>
                        <p class="card-text">' . $blogRow['blogText'] . '</p>
                      </div>
                    </div>
                  </div>
                    ';
      }
    } else {
      echo "<h2 style='color:red';>No blog found.</h2>";
    }

    // Close the database connection
    // mysqli_close($mysqli);
  } 
  
  
  
  
  elseif (!empty($_GET["dateSearch"])) {
    // $emailSearch = $_GET["emailSearch"] ?? '';
    // $titleSearch = $_GET["titleSearch"] ?? '';
    $dateSearch = $_GET["dateSearch"] ?? '';
    echo '
    <h1 class="mt-5 mb-4 text-center">Your Search Result</h1>  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">';

    require_once 'connection.php'; // Include the file with MySQLi connection

    // Step 2: Fetch all blogs written by this user
    $blogQuery = "SELECT * FROM BLOGS WHERE date = '$dateSearch'";
    $blogResult = mysqli_query($mysqli, $blogQuery);
    if ($blogResult) {
      // Fetch and display all blogs
      while ($blogRow = mysqli_fetch_assoc($blogResult)) {
        echo '
                    <div class="col">
                    <div class="card h-100">
                      <img src="img-1.jpg" class="card-img-top" alt="Web 1" />
                      <div class="card-body">
                        <h5 class="card-title">' . $blogRow['likes'] . '</h5>
                        <p class="card-text">' . $blogRow['blogText'] . '</p>
                      </div>
                    </div>
                  </div>
                    ';
      }
    } else {
      echo "<h2 style='color:red';>No blog found.</h2>";
    }

    // Close the database connection
    // mysqli_close($mysqli);
  }







  ?>
  </div>
  </div>




  <?php

  echo '
<h1 class="mt-5 mb-4 text-center">Most Recent</h1>  
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">';

  require_once 'connection.php'; // Include the file with MySQLi connection

  // Step 2: Fetch the most recent 5 blogs
  $blogQuery = "SELECT * FROM BLOGS ORDER BY date DESC LIMIT 5";
  $blogResult = mysqli_query($mysqli, $blogQuery);
  if ($blogResult) {
    // Fetch and display all blogs
    while ($blogRow = mysqli_fetch_assoc($blogResult)) {
      echo '
        <div class="col">
            <div class="card h-100">
                <img src="img-1.jpg" class="card-img-top" alt="Web 1" />
                <div class="card-body">
                    <h5 class="card-title">' . $blogRow['likes'] . '</h5>
                    <p class="card-text">' . $blogRow['blogText'] . '</p>
                </div>
            </div>
        </div>
        ';
    }
  } else {
    echo "<h2 style='color:red;'>No blogs found.</h2>";
  }

  // Close the database connection
  mysqli_close($mysqli);

  ?>
  </div>
  </div>















  <h1 class="mt-5 mb-4 text-center">Explore Some Journeys</h1>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card h-100">
          <img src="img-1.jpg" class="card-img-top" alt="Web 1" />
          <div class="card-body">
            <h5 class="card-title">Information on getting the best experience in the great outdoors</h5>
            <p class="card-text">
              Browse articles written by women adventurers on everything from camping to hiking, fishing to RVs,
              children to cooking and everything in between.
            </p>
            <p class="card-text">
              Select and click on categories listed in the right-hand column which most interest you.
            </p>
            <p class="card-text">
              Alternatively, use the search bar to find articles/posts containing your search words.
            </p>
            <p class="card-text">
              <small class="text-muted">Last updated 9 mins ago</small>
            </p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col">
        <div class="card h-100">
          <img src="img-2.jpg" loading="lazy" class="card-img-top" alt="Web 2" />
          <div class="card-body">
            <h5 class="card-title">Feeling a bit more adventurous?</h5>
            <p class="card-text">
              Check out our Travel and Adventure section where some pretty rad women show you some fabulous, exciting
              and fulfilling outdoor locations all around the globe.
            </p>
            <p class="card-text">
              Dive into crystal-clear waters and explore vibrant coral reefs teeming with marine life.
            </p>
            <p class="card-text">
              Book now and experience the ultimate beach getaway!
            </p>
            <p class="card-text">
              <small class="text-muted">Last updated 3 mins ago</small>
            </p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col">
        <div class="card h-100">
          <img src="img-3.jpg" class="card-img-top" alt="Web 3" />
          <div class="card-body">
            <h5 class="card-title">Interested in outdoors-related content across the web?</h5>
            <p class="card-text">
              Every day, Camping for Women publishes many posts from diverse channels to many thousands of its social
              media followers.
            </p>
            <p class="card-text">
              Journey through vast savannas and dense jungles in search of elusive wildlife.
            </p>
            <p class="card-text">
              Check out and follow us on Facebook and Twitter to receive all the latest published content each day.
            </p>
            <p class="card-text">
              <small class="text-muted">Last updated 15 mins ago</small>
            </p>
          </div>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="col">
        <div class="card h-100">
          <img src="img-4.jpg" class="card-img-top" alt="Web 4" />
          <div class="card-body">
            <h5 class="card-title">Want some free resources?</h5>
            <p class="card-text">

              If some handy checklists might help for activities like hiking, camping, RVing, children in the outdoors
              or even a routine for packing up, this would be a good place to start. Also, download the free safety
              P.I.N. resource, a subscription to Camping for Women and other free stuff is all here.
            </p>
            <p class="card-text">
              Immerse yourself in local traditions, taste authentic cuisine, and interact with friendly locals.
            </p>
            <p class="card-text">
              Our guided tours will take you on a journey through time, from ancient civilizations to modern societies.
            </p>
            <p class="card-text">
              Join us and embark on a cultural adventure that will broaden your horizons and enrich your soul.
            </p>
            <p class="card-text">
              <small class="text-muted">Last updated 31 mins ago</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Additional Features -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Additional Features</h2>

    <!-- Carousel -->
    <h3>Featured Destinations</h3>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item">
          <img src="https://images.pexels.com/photos/1371360/pexels-photo-1371360.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" style="height: 28rem;" alt="Destination 2">
        </div>
        <div class="carousel-item">
          <img src="https://images.pexels.com/photos/547116/pexels-photo-547116.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" loading="lazy" class="d-block w-100" style="height: 28rem;" alt="Destination 3">
        </div>
        <div class="carousel-item">
          <img src="https://images.pexels.com/photos/632522/pexels-photo-632522.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" loading="lazy" class="d-block w-100" style="height: 28rem;" alt="Destination 4">
        </div>
        <div class="carousel-item active">
          <img src="https://images.pexels.com/photos/552785/pexels-photo-552785.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" loading="lazy" class="d-block w-100" style="height: 28rem;" alt="Destination 1">
        </div>
        <div class="carousel-item">
          <img src="https://images.pexels.com/photos/2259184/pexels-photo-2259184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" loading="lazy" class="d-block w-100" style="height: 28rem;" alt="Destination 5">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>

  <h1 class="mt-5 mb-4 text-center">Explore Some Journeys</h1>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card h-100">
          <img class="rounded-circle m-auto" src="res-3.jpg" alt="Generic placeholder image" width="140" height="140">
          <div class="card-body">
            <h5 class="card-title">Need gear for your next outdoor adventure?</h5>
            <p class="card-text">
              Check out our Global Outdoor Adventure Store in conjunction with our partners Amazon..
            </p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col">
        <div class="card h-100">
          <img class="rounded-circle m-auto" src="res-2.jpg" alt="Generic placeholder image" width="140" height="140">
          <div class="card-body">
            <h5 class="card-title"> Interested in joining the Camping for Women contributor team?</h5>
            <p class="card-text">


              Find out more here and lets us know so we can get you more information.
            </p>

          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col">
        <div class="card h-100">
          <img class="rounded-circle m-auto" src="res-1.png" alt="Generic placeholder image" width="140" height="140">
          <div class="card-body">
            <h5 class="card-title">Like to check out our publications?</h5>
            <p class="card-text">
              You'll find these here, what's available and what's in the pipeline…
            </p>

          </div>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="col">
        <div class="card h-100">
          <img class="rounded-circle m-auto" src="res-4.jpg" alt="Generic placeholder image" width="140" height="140">
          <div class="card-body">
            <h5 class="card-title">Want to know more about Camping for Women?</h5>
            <p class="card-text">
              You can read all about our story, founder, strategic direction, team, awards, Media offering…it's all
              here.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="col">
        <div class="card h-100">
          <img class="rounded-circle m-auto" src="res-5.jpg" alt="Generic placeholder image" width="140" height="140">
          <div class="card-body">
            <h5 class="card-title">Want to see our latest reviews on stuff?
            </h5>
            <p class="card-text">

              Read up the latest tried and tested products and hear the good, the bad and the ugly right here.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>













  <!-- Accordion -->
  <h3 class="mt-5">Frequently Asked Questions</h3>
  <div class="accordion mt-3" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Question 1: Are there bathrooms at campsites?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body ">
          Varies by location, research beforehand (campgrounds usually have them).
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Question 2: Are pets allowed at your campsites?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Yes, we are pet-friendly! You can bring your furry friends along on your camping trip. Just make sure to
          follow our pet policies to ensure a safe and enjoyable experience for everyone.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Question 3: What are essentials for women campers?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Pack usual gear + toiletries, headlamp & personal safety items (whistle, pepper spray).
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Question 4: What should women wear camping?
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Layers for weather changes, sturdy shoes, consider sun protection clothing.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Question 5: Do you offer guided tours?
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Yes, we offer guided tours led by experienced and knowledgeable guides. Our tours cover a wide range of
          activities and destinations, allowing you to explore and discover new places with ease.
        </div>
      </div>
    </div>
  </div>

  <!-- Additional Features -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Additional Features</h2>

    <!-- Contact Form -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Contact Us</h3>
            <form>
              <div class="form-group m-3">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Name">
              </div>
              <div class="form-group m-3">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="Your Email">
              </div>

              <div class="form-group  m-3">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    // Initialize Bootstrap toast
    var toastElList = [].slice.call(document.querySelectorAll(".toast"));
    var toastList = toastElList.map(function(toastEl) {
      return new bootstrap.Toast(toastEl);
    });

    // Show the toast
    toastList.forEach(function(toast) {
      toast.show();
    });
  </script>
</body>

</html>