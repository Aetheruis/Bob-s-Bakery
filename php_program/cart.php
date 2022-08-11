<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 30px sans-serif; text-align: center; background-color: green;}
        img {width: 300px;height: 300px;}
        .top{background-color: white;display: inline-block;width:75%}
        .mixed{background-color: lightgreen;display: inline-block;width:75%}
        input{font: 25px}
        .mixed2{margin: auto;background-color: lightgreen;display: block;width:75%}
        input[type=submit]{
            background-color: Red;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;}
            .topnav {
            background-color: #333;
            overflow: hidden;
            width: 75%;
            align: center;
            margin: auto;
            }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
/* Change the color of links on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.split {
            float: right;
            background-color: #04AA6D;
            color: white;
        }
            
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class = 'mixed'>
    <h1 style='padding-top: 25px; font-size: 60px'> Bob's Baking Goods</h1>
    </div>
    <div class="topnav">
    <a href="welcome.php">Home</a>
    <a href="orderingpage.php">Ordering</a>
    <a href="cart.php">Cart</a>
    <a href="" class="split">Contact Us</a>
</div>
    
     <div class='mixed2'>
     </br>This is what is in your cart so far:
        </h2>
    
    <?php
    $filter = $_SESSION["client_name"];
    $sql3 ="SELECT * FROM orders ORDER BY orderID DESC LIMIT 1;";
    $result03= mysqli_query($link,$sql3);
    $row02 = mysqli_fetch_assoc($result03);
    $newNum = null;
    if ($newNum == null) {
        echo"<br>You have not added anything to your cart. Yet...";
    }else{
        $newNum = $row02['orderID'];
        $sql0="SELECT orderDescription FROM orders WHERE customer_name = '$filter' AND orderID='$newNum' AND orderDescription != 'defaultVal';";
        $result = mysqli_query($link, $sql0);
        $total = 0;
        if (mysqli_num_rows($result) > 0 ) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $parameter=$row["orderDescription"];
                $str_arr = explode (", ", $parameter); 
                $counter=count($str_arr);
                while($counter >0){
                $x = $counter-1;
                if ($x != 0 ) {
                    $sql01 = "SELECT itemPrice FROM items WHERE itemName='$str_arr[$x]';";
                $result01= mysqli_query($link,$sql01);
                if (mysqli_num_rows($result01) > 0 ) {
                // output data of each row
                    while($row01 = mysqli_fetch_assoc($result01)){
                        echo "Product: ".$str_arr[$x]."<br>";
                        echo "Product Cost: R".$row01['itemPrice']."<br>";
                        $total = $total + $row01['itemPrice'];
                        echo "<b>The total is: R".$total."</b><br>"."<br>";
                    }
                $counter = $counter-1;
                }
                
                }else{
                    if ($str_arr[0] == 'defaultVal'){
                        break;
                    }else{
                        $sql01 = "SELECT itemPrice FROM items WHERE itemName='$str_arr[$x]';";
                        $result01= mysqli_query($link,$sql01);
                        if (mysqli_num_rows($result01) > 0 ) {
                        // output data of each row
                
                        while($row01 = mysqli_fetch_assoc($result01)){
                            echo "Product: ".$str_arr[$x]."<br>";
                            echo "Product Cost: R".$row01['itemPrice']."<br>";
                            $total = $total + $row01['itemPrice'];
                            echo "<b>The total is: R".$total."</b><br>"."<br>";
                        }
                        $counter = $counter-1;
                    }}}}}}}
      
      if(isset($_POST['button1'])) { 
        echo "Your order has been processed"; 
        $name = mysqli_real_escape_string($link, $_SESSION['client_name']);
        $sql = "INSERT INTO orders (customer_name, orderTime) VALUES ('$name', NOW())";
        if(mysqli_query($link, $sql)){
            header('http://localhost/php_program/welcome.php');
        } else {
            echo "There is a problem";
            }

        } 
        
    mysqli_close($link);
    ?>
    
    <form method="post"> 
		<input type="submit" name="button1"
				value="Click Here to finish your Order"/> 
	</form> 
    </div>
</body>

</html>
