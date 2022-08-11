<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password1');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
define('DB_NAME', 'client_Database');
mysqli_select_db($link,'client_Database');

if($_GET['Submit1'] == 'New Product'){
    $_SESSION['itemsrc'] = $_GET['item_src1'];
    $item_name = $_GET['item_name1'];
    $_SESSION['itemName'] = $item_name;
    $item_price = $_GET['item_price1'];
    $quantity = $_GET['item_quantity1'];
    $sql = "INSERT INTO items (itemName, itemPrice, itemQuantity) VALUES ('$item_name', '$item_price', '$quantity')";
    if(mysqli_query($link, $sql)){
        echo "New record created successfully";
    } else {
        echo "There is a problem";
    }
    header("Location: http://localhost/php_program/admin.php");
}
if($_GET['Submit2'] == 'Delete Product'){
    $src = $_GET['item_src2'];
    $item_name = $_GET['item_name2'];
    $sql = "DELETE FROM items WHERE itemName = '$item_name';";
    if(mysqli_query($link, $sql)){
        echo "New record created successfully";
    } else {
        echo "There is a problem";
    }
    unlink($src);
    header("Location: http://localhost/php_program/admin.php");
}
if ($_GET['Submit3'] == 'Change Price') {
    $item_name = $_GET['item_name3'];
    $item_price = $_GET['item_price3'];
    $sql = "UPDATE items SET itemPrice = '$item_price' WHERE itemName = '$item_name';";
    if(mysqli_query($link, $sql)){
        echo "New record changed successfully";
    } else {
        echo "There is a problem";
    }
    header("Location: http://localhost/php_program/admin.php");
}
?>

