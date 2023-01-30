<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Where clause injection</title>
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>

    <div class="form-container">
      <form method="get">
        <label for="filter">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <input type="submit" value="Submit">
      </form>
    </div>

<?php
$db = mysqli_connect("localhost", "sql_inject", "sql_inject", "sql_injection_labs");

// check connection
if (mysqli_connect_errno()) {
    echo "Connect failed: " . mysqli_connect_error();
    exit();
}

if (isset($_GET['username'])) {     
    $username = $_GET['username'];

    // Database is not queried if the prefix is not SIL- defined in the HTML
    if (preg_match('/SIL-/', $username)) {
        $username = str_replace("-SIL", "", $username);
        $query = "SELECT first_name, last_name FROM username_id_tbl WHERE username = '$username'";
        $result = mysqli_query($db, $query);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            echo '<h2>User exists!</h2>';
        } else {
            echo '<h2>Unknown user!</h2>';  
        }
    }
}
?>

  </body>
</html>