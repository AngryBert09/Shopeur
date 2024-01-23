<?php
session_start();

require "db.php";

// Pagination settings
$productsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

// Query to retrieve products for the current page
$sql = "SELECT * FROM products LIMIT $offset, $productsPerPage";
$result = $conn->query($sql);

// Fetch and display products
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Page <?php echo $page; ?></title>
</head>
<body>
    <h1>Product List - Page <?php echo $page; ?></h1>
    
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['productName']} - {$row['productPrice']}</li>";
        }
        ?>
    </ul>

    <?php
    // Determine whether to show a "Next Page" link
    $nextPage = $page + 1;
    $sqlNextPage = "SELECT COUNT(*) as count FROM products LIMIT $nextPage, 1";
    $resultNextPage = $conn->query($sqlNextPage);
    $hasNextPage = $resultNextPage->fetch_assoc()['count'] > 0;

    if ($hasNextPage) {
        echo "<a href=\"index.php?page={$nextPage}\">Next Page</a>";
    }
    
    $conn->close();
    ?>
</body>
</html>
