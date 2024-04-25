<?php
// Include the index.php file to establish a database connection
require_once 'connection.php';

// Write a query to get users from the database
$query = "SELECT * FROM user";

// Execute the query
$result = mysqli_query($mysqli, $query);

// Check if the query executed successfully
if ($result) {
    echo "Blog post submitted successfully!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}

// Close the connection
mysqli_close($mysqli);
?>
