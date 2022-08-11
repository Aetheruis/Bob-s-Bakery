<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

    require_once "config.php";
    $description=$_POST['btn'];
    $name = mysqli_real_escape_string($link, $_SESSION['client_name']);
    $sql = "INSERT INTO orders (customer_name, orderTime, orderDescription) VALUES ('$name', NOW(), '$description')";
    if(mysqli_query($link, $sql)){
        echo "New record created successfully";
    } else {
        echo "There is a problem";
    }
    $sql3 ="SELECT * FROM orders ORDER BY orderID DESC LIMIT 1;";
    $result03= mysqli_query($link,$sql3);
    $row02 = mysqli_fetch_assoc($result03);
    $newNum = $row02['orderID'];

    $filter = $_SESSION["client_name"];
    $sql0 = "SELECT orderDescription FROM orders WHERE customer_name = '$filter';";
    $newrecord = mysqli_query($link,$sql0);
    
if (mysqli_num_rows($newrecord) > 1 ) {
    
    $sql2="SELECT orderDescription FROM orders WHERE orderID = '$newNum' AND customer_name = '$filter';";
    $result01= mysqli_query($link,$sql2);
    $row01 = mysqli_fetch_assoc($result01);
    $newStr = $row01['orderDescription'];
    echo $newStr;
    
    $sql4="DELETE FROM orders WHERE orderID = '$newNum' AND customer_name = '$filter';";
    if(mysqli_query($link, $sql4)){
        echo "New record deleted successfully";
    } else {
        echo "There is a problem";
    }
    $sql3 ="SELECT * FROM orders ORDER BY orderID DESC LIMIT 1;";
    $result03= mysqli_query($link,$sql3);
    $row02 = mysqli_fetch_assoc($result03);
    $oldNum = $row02['orderID'];

    $sql2="SELECT orderDescription FROM orders WHERE orderID = '$oldNum' AND customer_name = '$filter';";
    $result01= mysqli_query($link,$sql2);
    $row01 = mysqli_fetch_assoc($result01);
    $oldStr = $row01['orderDescription'];
    echo $oldStr;
    $newDesc = $oldStr.", ".$newStr;
    $sql1="UPDATE orders SET orderDescription = '$newDesc' WHERE orderID = '$oldNum' AND customer_name = '$filter';";
    if(mysqli_query($link, $sql1)){
        echo "Altered Record Successfully";
    } else {
        echo "There is a problem";
    }
        }
    header('Location: http://localhost/php_program/cart.php');
    exit();
   
?>