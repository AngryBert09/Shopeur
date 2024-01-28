<?php
session_start();
require_once "db.php";

// Set $linkURL based on login status
if (isset($_SESSION['user_id'])) {
  $linkURL = "catalog.php";
} else {
  $linkURL = "login.php";
}

// Pagination settings
$productsPerPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

// Query to retrieve products for the current page
$sql = "SELECT * FROM products ORDER BY pid LIMIT $offset, $productsPerPage";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html locale_get_primary_language>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/view-cart.css">
  <title>Document</title>
</head>

<body>
  <div class="card">
    <div class="row">
      <div class="col-md-8 cart">
        <div class="title">
          <div class="row">
            <div class="col">
              <h4><b>Shopping Cart</b></h4>
            </div>
            <div class="col align-self-center text-right text-muted">3 items</div>
          </div>
        </div>
        <?php
        while ($r = mysqli_fetch_array($result)) {
        ?>
          <div class="row border-top border-bottom">
            <div class="row main align-items-center">
              <div class="col-2"><img class="img-fluid" src=products/<?php echo $r['img'] ?>></div>
              <div class="col">
                <div class="row text-muted">Shirt</div>
                <div class="row"><?php echo $r['productName'] ?></div>
              </div>
              <div class="col">
                <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a>
              </div>
              <div class="col">&euro; <?php echo $r['productPrice'] ?> <span class="close">&#10005;</span></div>
            </div>
          </div>
        <?php } ?>
        <div class="back-to-shop"><a href="catalog.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
      </div>
      <div class="col-md-4 summary">
        <div>
          <h5><b>Summary</b></h5>
        </div>
        <hr>
        <div class="row">
          <div class="col" style="padding-left:16px;">ITEMS 3</div>
          <div class="col text-right">&euro; 132.00</div>
        </div>
        <form>
          <p>SHIPPING</p>
          <select>
            <option class="text-muted">Standard-Delivery- &euro;5.00</option>
          </select>
          <p>GIVE CODE</p>
          <input id="code" placeholder="Enter your code">
        </form>
        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
          <div class="col">TOTAL PRICE</div>
          <div class="col text-right">&euro; 137.00</div>
        </div>
        <button class="btn">CHECKOUT</button>
      </div>
    </div>

  </div>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>