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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $currentPassword = $_POST["currentPassword"] ?? '';
  $newPassword1 = $_POST["newPassword1"] ?? '';
  $newPassword2 = $_POST["newPassword2"] ?? '';
  $currentPasswordAccount = $_POST["currentPasswordAccount"] ?? '';

  require_once 'connection.php';

  // Write a query to get users from the database
  $query1 = "SELECT Password FROM User WHERE Email = '$email'";

  // Execute the query
  $result = mysqli_query($mysqli, $query1);

  // Check if the query executed successfully
  if ($result) {
    // Fetch the password hash from the result
    $row = mysqli_fetch_assoc($result);
    $hashedPasswordFromDB = $row['Password'];

    // Verify the current password
    if (password_verify($currentPassword, $hashedPasswordFromDB)) {
      // Password is correct
      if ($newPassword1 == $newPassword2) {
        $hashedPassword = password_hash($newPassword1, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE User SET Password = '$hashedPassword' WHERE Email = '$email';";
        $updateResult = mysqli_query($mysqli, $updateQuery);

        if ($updateResult) {
          $isDataSubmitted = true;
          $alertText = "Password updated successfully";
        } else {
          echo "Error updating password: " . mysqli_error($mysqli);
        }
      } else {
        $isDataSubmitted = true;
        $alertText = "Password does not match";
      }
    } else {
      // Password is incorrect
      $isDataSubmitted = true;
      $alertText = "Incorrect Current Password";
    }
  } else {
    // Error executing the query
    echo "Error: " . $query1 . "<br>" . mysqli_error($mysqli);
  }

  // Close the database connection
  // mysqli_close($mysqli);
}


if (isset($_POST["currentPasswordAccount"])) {
  if (password_verify($_POST["currentPasswordAccount"], $hashedPasswordFromDB)) {
    $query2 = "SELECT User_ID FROM User WHERE Email = '$email'";
    $result2 = mysqli_query($mysqli, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $userId2 = $row2['User_ID'];



    $query3 = "DELETE FROM BLOGS WHERE User_ID = '$userId2'";
    $result3 = mysqli_query($mysqli, $query3);

    if ($result3) {
      if (mysqli_affected_rows($mysqli) > 0) {
        // Deletion successful
        echo "Blogs deleted successfully";
      } else {
        // No rows deleted (maybe no matching blog found)
        echo "No blogs deleted. No matching blogs found.";
      }
    } else {
      // Error executing the query
      echo "Error deleting blogs: " . mysqli_error($mysqli);
    }


    $query4 = "DELETE FROM EXPERIENCE WHERE email = '$email'";
    $result4 = mysqli_query($mysqli, $query4);
    if ($result4) {
      if (mysqli_affected_rows($mysqli) > 0) {
        // Deletion successful
        echo "Reviews deleted successfully";
      } else {
        // No rows deleted (maybe no matching blog found)
        echo "No Reviews deleted. No matching Reviews found.";
      }
    } else {
      // Error executing the query
      echo "Error deleting Reviews: " . mysqli_error($mysqli);
    }


    $query5 = "DELETE FROM User WHERE email = '$email'";
    $result5 = mysqli_query($mysqli, $query5);
    if ($result5) {
      if (mysqli_affected_rows($mysqli) > 0) {
        // Deletion successful
        echo "user deleted successfully";
      } else {
        // No rows deleted (maybe no matching blog found)
        echo "userdeleted. No matching Reviews found.";
      }
    } else {
      // Error executing the query
      echo "Error deleting user: " . mysqli_error($mysqli);
    }

    $_SESSION = array();

    // // Destroy the session
    // session_destroy();
    // header("Location: Task2.php");
exit;
  }
}
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
        <a class="nav-item nav-link" href="Task2.php">Home</a>
        <a class="nav-item nav-link" href="AddBlog.php">Add Blog</a>
        <a class="nav-item nav-link" href="Review.php">Reviews</a>
        <a class="nav-item nav-link" href="Signin.php">Register</a>
        <a class="nav-item nav-link active" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="myBlog.php">My Account<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="logout.php">Log Out</a>

      </div>
    </div>
  </nav>


  <h1 class=" text-center" style="margin-top:8rem">My Blogs</h1>



  <div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php


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
          echo "No user found with that email.";
        }
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
      }

      // Close the database connection
      mysqli_close($mysqli);
      ?>

    </div>
  </div>













  <h1 class=" text-center" style="margin-top:8rem">Change Password</h1>
  <div class="card text-center mx-auto my-4" style="width: 300px;">
    <div class="card-header h5 text-white" style="background:#6C0345">Password Reset</div>
    <div class="card-body px-5">
      <p class="card-text py-1">
        Enter your Current Password.
      </p>
      <form action="myBlog.php" method="POST">
        <input style="border: 1px solid #9BB0C1" type="password" name="currentPassword" class="form-control my-3  " placeholder="Enter Cuurent Password" />
        <input style="border: 1px solid #9BB0C1" type="password" name="newPassword1" class="form-control my-3  " placeholder="Enter New Password" />
        <input style="border: 1px solid #9BB0C1" type="password" name="newPassword2" class="form-control my-3  " placeholder="Enter New Password" />

        <button type="submit" class="btn btn-primary" style="background:#6C0345">Submit</button>
      </form>



    </div>
  </div>


  <h1 class=" text-center" style="margin-top:8rem">Delete Account</h1>
  <div class="card text-center mx-auto my-4" style="width: 300px;">
    <div class="card-header h5 text-white" style="background:#6C0345">Delete Account</div>
    <div class="card-body px-5">
      <p class="card-text py-1">
        Enter your Current Password.
      </p>
      <form action="myBlog.php" method="POST">
        <input style="border: 1px solid #9BB0C1" type="password" name="currentPasswordAccount" class="form-control my-3  " placeholder="Enter Cuurent Password" />

        <button type="submit" class="btn btn-primary" style="background:#6C0345">Submit</button>
      </form>



    </div>
  </div>


  <div aria-live="polite" aria-atomic="true" style="position: absolute; min-width: 20rem; z-index: 100;margin-top: 70px;right:10px;top:2px;background:green;">
    <div class="toast mt-4" style="position: absolute; top: 0; right: 0; display: <?= $isDataSubmitted ? 'block' : 'none'; ?>;" data-autohide="false">
      <div class="toast-header bg-secondary bg-gradient">
        <strong class="mr-auto">Women Camping</strong>
        <small>Just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="toast-body bg-success">
        <?php
        echo $alertText;
        ?>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.toast').toast({
        delay: 1500 // Specify the delay in milliseconds (e.g., 5000 milliseconds = 5 seconds)
      }).toast('show');
    });
  </script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
</body>