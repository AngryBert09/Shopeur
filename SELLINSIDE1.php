<?php
require_once "db.php";

// Pagination settings
$productsPerPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

// Query to retrieve products for the current page
$sql = "SELECT * FROM products ORDER BY pid LIMIT $offset, $productsPerPage";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Title> Sell on Shopeur </Title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="SELLINSIDECSS.css">
    <link rel="stylesheet" href="loading.css">
    <link id="homeicon" rel="shortcut icon" type="home-icon" href="images/tablogo3.ico" />
    <script src="login.JS"></script>
    <script src="SELLFUNCTION.js" defer></script>
</head>
<body>
    <div id="preloader">
        <img src="images/loadinglogo.png" alt="" />
    </div>
    <script>
        window.addEventListener("load", function () {
            var loader = document.getElementById("preloader");
            loader.style.display = "none";
            loader.delay(10).fadeOut("10");
        });
    </script>

    <section class="main">
        <header>
            <a href="inside.php"><img src="images/logo.png" class="logo"></a>
            <div class="toggle"></div>
            <ul class="navigation">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="SEARCH">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <li><img src="images/Sell Shop Images/cart.png" alt="" id="cart"></li>
            </ul>
        </header>

        <div class="container">
            <?php
            while ($r = mysqli_fetch_array($result)) {
            ?>
                <div class="card">
                    <div class="imgBx">
                        <img src="products/<?php echo $r['img'] ?>">
                        <ul class="action">
                            <li><i id="heart" class="fa fa-heart" aria-hidden="true"></i>
                                <span>Add to Wishlist</span>
                            </li>
                            <li><i id="1st item" class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>Add to Cart</span>
                            </li>
                            <li><i class="fa fa-eye" aria-hidden="true"></i>
                                <span>View Details</span>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div class="productName">
                            <h3><?php echo $r['productName'];  ?></h3>
                        </div>
                        <div class="price_rating">
                            <h2><?php echo $r['productPrice'] ?></h2>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa grey fa-star" aria-hidden="true"></i>
                                <i class="fa grey fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <body2>
        <ul2 class="pagination">
            <?php
            // Display pagination links
            $totalProducts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
            $totalPages = ceil($totalProducts / $productsPerPage);
        

            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class=\"pageNumber " . ($page == $i ? 'active' : '') . "\"><a href=\"?page={$i}\">{$i}</a></li>";
            }
            ?>
            <!-- Add next and previous links if needed -->
            <?php
            if ($page > 1) {
                echo "<li><a href=\"?page=" . ($page - 1) . "\" class=\"prev\">&lt;</a></li>";
            }

            if ($page < $totalPages) {
                echo "<li><a href=\"?page=" . ($page + 1) . "\" class=\"next\">&gt;</a></li>";
            }
            ?>
        </ul2>
    </body2>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
