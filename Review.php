<?php
session_start(); // Start the session
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

$isDataSubmitted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameReview = $_POST['nameReview'];
    $emailReview = $_POST['emailReview'];
    $destination = $_POST['destination'];
    $dateVisted = $_POST['dateVisted'];
    $image = $_POST['image'];
    $review = $_POST['review'];



    require_once 'connection.php';
    // Write a query to get users from the database
    $query = "INSERT INTO EXPERIENCE (email, name, Destination, date,Picture,review) VALUES ('$emailReview', '$nameReview', '$destination','$dateVisted','$image','$review')";

    // Execute the query
    $result = mysqli_query($mysqli, $query);
    // Execute the SQL statement
    if ($result) {
        $isDataSubmitted = true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    // Close the database connection
    // mysqli_close($mysqli);
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/e136085353.js" crossorigin="anonymous"></script>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <!-- Custom Styles -->
    <style>
        .testimonial-card .card-up {
            height: 120px;
            overflow: hidden;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .testimonial-card .avatar {
            width: 110px;
            margin-top: -60px;
            overflow: hidden;
            border: 3px solid #fff;
            border-radius: 50%;
        }
    </style>
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
                <a class="nav-item nav-link active" href="#">Reviews</a>
                <a class="nav-item nav-link" href="Signin.php">Register</a>
                <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="myBlog.php">My Account</a>
                <a class="nav-item nav-link" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" href="logout.php">Log Out</a>

            </div>
        </div>
    </nav>
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
                Review submitted successfully!
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

    <form action="Review.php" method="POST" style="width: 35rem; margin-top:8rem;border:1px solid #6d5b98;padding:1.9rem 5rem" class="mx-auto">
        <h3 class="mb-4 mx-auto">Add Reviews</h3>
        <!-- Name input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="emailReview" class="form-control" />
            <label class="form-label">Email</label>
        </div>
        <!-- Name input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="nameReview" class="form-control" />
            <label class="form-label">User Name</label>
        </div>

        <!-- destination input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="destination" class="form-control" />
            <label class="form-label">Destination</label>
        </div>


        <!-- destination input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="date" class="form-control" name="dateVisted" placeholder="Visted Date" />
            <label class="form-label">Visted Date</label>
        </div>

        <!-- Image input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="image" class="form-control" />
            <label class="form-label">Image Source</label>
        </div>

        <!-- Message input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" name="review" rows="4"></textarea>
            <label class="form-label">Review</label>
        </div>



        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>



    <section class="mt-5 mx-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4">Testimonials</h3>
            </div>
        </div>

        <div class="row text-center d-flex align-items-stretch">
            <?php
            require_once 'connection.php'; // Include the file with MySQLi connection

            // Step 2: Fetch all blogs written by this user
            $blogQuery = "SELECT * FROM EXPERIENCE";
            $blogResult = mysqli_query($mysqli, $blogQuery);

            if ($blogResult) {
                // Fetch and display all blogs
                while ($blogRow = mysqli_fetch_assoc($blogResult)) {
                    $random_color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    echo '
                <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
                <div class="card testimonial-card">
                    <div class="card-up" style="background-color: ' . $random_color . ';"></div>
                    <div class="avatar mx-auto bg-white">
                        <img src="' . $blogRow['Picture'] . '" class="rounded-circle img-fluid" />
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">' . $blogRow['Destination'] . '</h4>
                        <hr />
                        <p class="dark-grey-text mt-4">
                            <i class="fas fa-quote-left pe-2"></i>
                            ' . $blogRow['review'] . '
                        </p>
                        <p class="dark-grey-text mt-4 font-italic fw-bold">
                            (' . $blogRow['name'] . ')
                        </p>

                    </div>
                </div>
            </div>

                  ';
                }
            } else {
                echo "<h2 style='color:red';>No review found.</h2>";
            }

            // Close the database connection
            mysqli_close($mysqli);


            ?>








        </div>
    </section>




    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>

</html>