<head>
  <link rel="stylesheet" href="css/auction_log.scss">
</head>
<body>
  <div class="container">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
      <h2>Bid.it</h2>
      <form action="" method="post"> <!-- Form submission to login.php -->
        <input class="input" type="text" name="name" placeholder="Bid.it Username">
        <input class="input" type="number" name="farmer_id" placeholder="farmer-id">
        <input class="input" type="num" name="phone_number" placeholder="phone number">
        <center><button class="button-86" type="submit" role="button">Log in</button></center>
      </form>
    </div>
  </div>
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $entered_farmer_id = $_POST["farmer_id"];
  $entered_phone_number = $_POST["phone_number"];
  $entered_name = $_POST["name"];

  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'kk') or die("Could not connect to mysql" . mysqli_error($con));

  // Check if the entered credentials exist in both tables
  $query = "SELECT * FROM auction_log WHERE farmer_id = '$entered_farmer_id' AND number = '$entered_phone_number'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    // Check if the entered name exists in the users table
    $user_query = "SELECT * FROM users WHERE username = '$entered_name'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
      // Login successful, redirect to index.php
      header("Location: index.php?page=user_prod");
      exit;
    } else {
      echo "Invalid name or credentials. Please try again.";
    }
  } else {
    // Login failed, display an error message or handle it accordingly
    echo "Invalid credentials. Please try again.";
  }

  // Close the database connection
  $conn->close();
}

?>

