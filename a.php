<?php 


    echo '
    <h1 class="mt-5 mb-4 text-center">Your Search Result2</h1>  <div class="container" style="margin-top:10rem">
    <div class="row row-cols-1 row-cols-md-3 g-4">';

    require_once 'connection.php'; // Include the file with MySQLi connection

            // Step 2: Fetch all blogs written by this user
            $blogQuery = "SELECT * FROM BLOGS";
            $blogResult = mysqli_query($mysqli, $blogQuery);
            if ($blogResult) {
                // Fetch and display all blogs
                while ($blogRow = mysqli_fetch_assoc($blogResult) && $count < 5) {
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
                    $count--;
                }
            } else {
              echo "<h2 style='color:red';>No blog found.</h2>";
            }
    
    // Close the database connection
    mysqli_close($mysqli);


    ?>

