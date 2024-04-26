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

    /* Form styles */
    form {
      max-width: 20rem;
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
        <a class="nav-item nav-link active" href="myBlog.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="AddBlog.php">Add Blog</a>
        <a class="nav-item nav-link" href="Review.php">Reviews</a>
        <a class="nav-item nav-link" href="Signin.php">Login</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="myBlog.php">My Blog</a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="logout.php">Log Out</a>

      </div>
    </div>
  </nav>
  <div class="container" style="margin-top:10rem">
        <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
session_start(); // Start the session

// Initialize variables
$username = "";
$email = "";
$isLoggedIn = false;

// Check if session key is set
if (isset($_SESSION['username'], $_SESSION['email'])) {
    // Access the stored variables
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $isLoggedIn = true;
}

require_once 'connection.php'; // Include the file with MySQLi connection

// Step 1: Retrieve User_ID based on the email
$query = "SELECT User_ID FROM User WHERE Email = '$email'";

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
                    <h5 class="card-title">'.$blogRow['likes'].'</h5>
                    <p class="card-text">'.$blogRow['blogText'].'</p>
                  </div>
                </div>
              </div>


                ';


            }
        } else {
            echo "Error fetching blogs: " . mysqli_error($mysqli);
        }
    } else {
        echo "No user found with that email.";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}

// Close the database connection
mysqli_close($mysqli);
?>

</div> </div>



</html>
</body>





