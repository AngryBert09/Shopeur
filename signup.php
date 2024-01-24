<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $password = $_POST['password'];

  // Check if email already exists
  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM user_accounts WHERE Email = ?");
  $checkStmt->bind_param("s", $email);
  $checkStmt->execute();
  $checkStmt->bind_result($emailCount);
  $checkStmt->fetch();
  $checkStmt->close();

  if ($emailCount > 0) {
    echo json_encode(["error" => "Email already exists, please try again with another email"]);
  } else {
    // Use prepared statements to prevent SQL injection
    $insertStmt = $conn->prepare("INSERT INTO user_accounts (Fullname, Email, Phonenum, Password) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $fullname, $email, $phone_number, $passwordHash);

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if ($insertStmt->execute()) {
      echo json_encode(["success" => ""]);
      header("Location: login.php");
      exit; // Ensure no further output before the redirect
    } else {
      error_log("Database Error: " . $insertStmt->error);
      echo json_encode(["error" => "An error occurred, please try again later"]);
    }

    // Close the prepared statement
    $insertStmt->close();
  }

  // Close the database connection
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="css/signup.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="loading.css" />
  <script src="script/validate.js"></script>
  <title>Sign up and shop more!</title>
  <link id="homeicon" rel="shortcut icon" type="home-icon" href="images/tablogo3.ico" />
  <script src="login.JS"></script>
</head>

<body>
  <div id="preloader">
    <img src="images/loadinglogo.png" alt="" />
  </div>
  <script>
    window.addEventListener("load", function() {
      var loader = document.getElementById("preloader");
      loader.style.display = "none";
      loader.delay(10).fadeOut("10");
    });
  </script>
  <div class="container">
    <div class="title">Register to Shopeur</div>
    <div class="content">
      <h5 id='error-message' style='color: red'> <i class="fa-solid fa-bug-slash"></i></h5>

      <form action="signup.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" required name="fullname" />
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required name="email" id="email" />
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required name="phone_number" id="phone_number" />
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" required name="password" id="password" />
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" required name="confirm_password" id="confirm_password" />
          </div>
        </div>
        <div class="button">
          <input type="submit" value="SIGN UP" onclick="return validateRegistration()" />
        </div>
      </form>
    </div>
  </div>
</body>

</html>