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
    attempt--; // Decrementing by one
    alert("YOU HAVE ONLY " + attempt + " ATTEMPTS");

    if (attempt == 0) {
      window.location = "forgot.html";
      return false;
    }
  }
}
//DETECTS IF THE WINDOW IS IN DARK MODE THEN IT WILL DISPLAY AN WHITE VERSION
// OF THE LOGO
let matched = window.matchMedia("(prefers-color-scheme: dark)").matches;
if (matched) {
  document.getElementById("homeicon").href = "images/whitelogo.ico";
}

document.addEventListener("click", test);
function test() {
  document.getElementsById("heart").href = "login.html";
}
