function myfunction() {
  let username = document.getElementById("fname").value;
  let password = document.getElementById("lname").value;

  if (username == "Albert" && password == "cute") {
    alert("LOGIN SUCCESS");
  } else {
    alert("ERROR DETAILS");
  }
}
