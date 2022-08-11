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
    <a href='orders.php'>Click here for all the orders</a>
    
    </h2>
    </div>
    <div class="mixed2">
    <form method="get" action="changes.php">
    <p> You can only delete new items that have been added as the other items are a staple to the bussiness.</p>

    <p>Enter item description here to add a new item </p>
    <label for='item_src1'>URL to item: </label>
    <input type="text" id="item_src1" name="item_src1"></br>
    <label for='item_name1'>Item Name: </label>
    <input type='text' id="item_name1" name="item_name1"></br>
    <label for='item_price1'>Item Price: </label>
    <input type='text' id="item_price1" name="item_price1"></br>
    <label for='item_quantity1'>Item Quantity: </label>
    <input type='text' id="item_quantity1" name="item_quantity1"></br>
    <input type ="submit" id="btn1" name="Submit1" value = 'New Product'></br>

    <p> What item do you want to remove from the gallery, note you can only remove newly added items.</p>
    <label for='item_src2'>URL to item: </label>
    <input type="text" id="item_src2" name="item_src2"></br>
    <label for='item_name2'>Item Name: </label>
    <input type="text" id="item_name2" name="item_name2"></br>
    <input type ="submit" id="btn2" name="Submit2" value = 'Delete Product'></br>

    <p> What item price do you want to change?</p>
    <label for='item_name3'>Item Name: </label>
    <input type='text' id="item_name3" name="item_name3"></br>
    <label for='item_price3'>New Item Price: </label>
    <input type='text' id="item_price3" name="item_price3"></br>
    <input type ="submit" id="btn3" name="Submit3" value = 'Change Price'></br>
    </form>
    
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
