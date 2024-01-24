<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Login to shopeur and shop now!!</title>

  <link id="homeicon" rel="shortcut icon" type="home-icon" href="images/tablogo3.ico" />
</head>

<body>
  <div id="preloader">
    <img src="images/loadinglogo.png" alt="" />
  </div>
  <div class="logo">
    <img src="images/11.20SALE IMAGE.png" />
  </div>
  <div class="box">
    <form autocomplete="off" action="login.php" method="post">
      <h2>Sign in</h2>
      <h4 id="error-teller"></h4>
      <script>
        // console.log("HELLO");
        window.addEventListener("load", function() {
          var loader = document.getElementById("preloader");
          setTimeout(function() {
            loader.style.display = "none";
          }, 100); // Delayed for 1000 milliseconds (1 second)
        });

        function displayErrorMessage(message) {

          const errorMessage = document.getElementById('error-teller');
          errorMessage.innerHTML = '<h5 style="color: red; font-weight:normal; margin-bottom: -20px;  margin-top: 10px">' + message + '</h5>';

        }
      </script>
      <link rel="stylesheet" href="css/login.css" />
      <link rel="stylesheet" href="loading.css" />
      <div class="inputBox">
        <input type="text" required="required" name="email" />
        <span>Email</span>
        <i></i>
      </div>
      <div class="inputBox">
        <input type="password" required="required" name="password" />
        <span>Password</span>
        <i></i>
      </div>
      <div class="links">
        <a href="forgot.html">Forgot Password ?</a>
        <a href="signup.php">Signup</a>
      </div>
      <input type="submit" value="LOGIN" />
    </form>
  </div>


</body>

</html>

<?php
session_start(); // Start the session

// Include your database connection file
require_once "db.php";
define("SUCCESS_LOGIN_URL", "inside.php?success_login=1");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Retrieve user information based on email
  $selectStmt = $conn->prepare("SELECT Email, Password FROM user_accounts WHERE Email = ?");
  $selectStmt->bind_param("s", $email);
  $selectStmt->execute();
  $selectStmt->bind_result($userID, $hashedPassword);
  $selectStmt->fetch();
  $selectStmt->close();
  // Verify the password and handle user not found
  if ($userID) {
    if (password_verify($password, $hashedPassword)) {
      $_SESSION['user_id'] = $userID;
      header("Location: " . SUCCESS_LOGIN_URL);
      exit();
    } else {
      echo "<script>
        
        displayErrorMessage('Incorrect Password ⚠');
       
    </script>";
    }
  } else {
    echo "<script>
      displayErrorMessage('User not found ⚠');
      </script>";
  }

  // Close the database connection
  $conn->close();
}

?>