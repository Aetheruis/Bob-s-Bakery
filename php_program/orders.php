<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SESSION['client_name'] == 'admin'){
    header("location: admin.php");
    exit;
}
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password1');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
define('DB_NAME', 'client_Database');
mysqli_select_db($link,'client_Database');
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
        .top{background-color: white;display: inline-block;}
        .mixed{background-color: lightgreen;}
        .mixed2{background-color: lightgreen;display: inline-block;}
        input{font: 25px}
        input[type=submit]{
            background-color: ForestGreen;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;}
        button{
            background-color: Red;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
    
    
</head>
<body>
    <div class = 'mixed'>
    <h1 style='padding-top: 25px; font-size: 60px'> Bob's Baking Goods</h1>
</div>
    <div class="top">
    <h2 class="my-5">Hello, <b>
        <?php 
        echo htmlspecialchars($_SESSION["client_name"]);
        echo htmlspecialchars(": ".$_SESSION["client_Surname"]);
        echo "<br>";
    ?>
    </b>Welcome to the admin site. 
    <a href='admin.php'>Click here to change database values</a>
    </h2>
    </div><br/>
    <div class="mixed2">
    <?php 
    $sql ="SELECT orderDescription, customer_name FROM orders WHERE orderDescription != 'defaultVal' ORDER BY orderID DESC ;";
    $result = mysqli_query($link, $sql);
    $total = 0;
    if (mysqli_num_rows($result) > 0 ) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $parameter=$row["orderDescription"];
            $str_arr = explode (", ", $parameter); 
            $parameter2 = $row["customer_name"];
            echo $parameter2.": ";
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
                    }
                }
        }}}
      } else {
        echo "You have not added any items to cart yet";
      }
    ?>
      <p>
        <script>
            function sending(){
            window.location.href = "logout.php";
            }
        </script>
        <button type="button" onclick = 'sending()'>Click here to sign out</button>
    </p>
        </div>
    
</body>

</html>