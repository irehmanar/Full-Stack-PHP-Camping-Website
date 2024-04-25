<?php
echo "helli";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"] ?? '';
  $lastName = $_POST["lastName"] ?? '';
  $email = $_POST["email"] ?? '';
  $password = $_POST["password"] ?? '';
  $name = $firstName . " " . $lastName;

  require_once 'connection.php';

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement using prepared statements
  $query = "INSERT INTO User (Username, Email, Password, firstName , lastName) VALUES ('$name', '$email', '$password', '$firstName', '$lastName')";
  $statement = mysqli_prepare($mysqli, $query);

  // Bind parameters and execute the statement
  // Execute the query
  $result = mysqli_query($mysqli, $query);


  // Perform database operations
  // Assuming you have already established a database connection

  // Insert data into the BLOGS table


  // Execute the SQL statement
  if ($result) {
    echo 'Entered';
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }

  // Close the database connection
  mysqli_close($mysqli);
}
?>