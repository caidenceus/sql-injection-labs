<!--
=============== PROBLEM ===============
Problem: 
  Retrieve all usernames and passwords from the user table.
  (Solution is at bottom of this page)

Difficulty: 
  Easy
=============== PROBLEM ===============
-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Where clause injection</title>
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>

    <div class="form-container">
      <form method="post">
        <label for="filter">Product name filter:</label><br>
        <input type="text" id="filter" name="filter"><br>
        <input type="submit" value="Submit">
      </form>
    </div>

<?php

$db = mysqli_connect("localhost", "sql_inject", "sql_inject", "sql_injection_labs");

/* check connection */
if (mysqli_connect_errno()) {
    echo "Connect failed: " . mysqli_connect_error();
    exit();
}

function data_row(string $product_name, string $product_price) {
    echo '<div class="data-container">';
    echo "<p>$product_name</p>";
    echo "<p>$product_price</p>";
    echo '</div>';
}

data_row('Product name', 'Product Price');

if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    $query = "SELECT * FROM product WHERE name = '$filter'";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)) {
        data_row($row['name'], $row['price']);
    }
    
    $_POST = array();
}
else {
    $query = "SELECT * FROM product";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)) {
        data_row($row['name'], $row['price']);
    }
}
?>

  </body>
</html>

<?php mysqli_close($db); ?>


<!--
=============== SOLUTION ===============
' union select * from user#

-->