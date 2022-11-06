var attempt = 3;
var isLogin = true;
function validate() {
  var username = document.getElementById("USERNAME").value;
  var password = document.getElementById("PASSWORD").value;

  if (username == "Admin" && password == "Password") {
    alert("LOGIN SUCCESSFULLY");
    window.location = "inside.html";
    return false;
  } else {
    username = document.getElementById("USERNAME").value = "";
    password = document.getElementById("PASSWORD").value = "";
    attempt--; // Decrementing by one.
    alert("YOU HAVE ONLY " + attempt + " ATTEMPTS");

    if (attempt == 0) {
      window.location = "forgot.html";
      return false;
    }
  }
}
function define() {
  if (isLogin == true) {
    // SELL PAGE
    document.getElementById("insell").href = "inside.html";
    document.getElementById("sellhome").href = "inside.html";
    // TRACK HOME PAGE
    document.getElementById("intrack").href = "inside.html";
  }
}
