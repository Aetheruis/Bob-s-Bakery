<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SESSION['client_name'] == 'Admin'){
    header("location: admin.php");
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
        input[type=submit]{
            background-color: MediumSpringGreen;
            border: none;
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
<div class="topnav">
    <a href="welcome.php">Home</a>
    <a href="orderingpage.php">Ordering</a>
    <a href="cart.php">Cart</a>
    <a href="" class="split">Contact Us</a>
</div>
    <div class="top">
    <h2 class="my-5">Hello, <b>
        <?php 
        echo htmlspecialchars($_SESSION["client_name"]);
        echo htmlspecialchars(" ".$_SESSION["client_Surname"]);
        echo "<br>";
    ?>
    </b>
    </br>Choose from our diverse and delicious collection of cakes, sweets, and pastries.
    </br> If you want to access cart please click <a href='http://localhost/php_program/cart.php'>here</a>
    </h2>
    </div>

    <div>
    <form method="post" action="addtocart.php">
    <table align="center">
        <tr>
            <td>      
                <img id="Milktart" src="./images/download.jpg" /> </br>
                <input type="submit" name='btn' value='Milktart'>
            </td>
            <td>
                <img id="Koeksuster" src="./images/koeksuster-recipe-20Mar13-043451.jpg"/>
                <input type="submit" name='btn' value='Koeksuster'>
            </td>
            <td>
                <img id="Vanilla SwissRoll" src="./images/swiss-roll_1-81df467.jpg"/>
                <input type="submit" name='btn' value='Vanilla SwissRoll'>
            </td>
            <td>
                <img id="Pancake" src="./images/Pancake-Recipe-2-1200.jpg"/>
                <input type="submit" name='btn' value='Pancake'>
            </td>
        </tr>
        <tr>
            <td>
                <img id="Choc SwissRoll" src="./images/62a049b9-8382-4746-90f7-94841334b4f0.jpg"/>
                <input type="submit" name='btn' value='Choc SwissRoll'>
            </td>
            <td>
                <img id="Choc Cake" src="./images/DoubleDhocolateLayerCake_RECIPE_012622_26397.webp" />
                <input type="submit" name='btn' value='Choc Cake'>
            </td>
            <td>
                <img id="Croissant" src="./images/croissant-pic-4.webp"/>
                <input type="submit" name='btn' value='Croissant'>
            </td>
            <td>
                <img id="Plain Muffin" src="./images/basic-muffins.webp"/>
                <input type="submit" name='btn' value='Plain Muffin'>
            </td>
        </tr>
        <tr>
            <td>
                <img id="Blackforest Cake" src="./images/merlin_165684495_6689b1a0-42b5-4228-b871-37bb983d797e-articleLarge.jpg"/>
                <input type="submit" name='btn' value='Blackforest Cake'>
            </td>
            <td>
                <img id="Appletart" src="./images/1382375917751.jpeg"/>
                <input type="submit" name='btn' value='Appletart'>
            </td>
            <td>
                <img id="BananaBread" src="./images/Healthy-Banana-Bread-3.jpg" />
                <input type="submit" name='btn' value='BananaBread'>
            </td>
            <td>
                <img id="Choc Muffin" src="./images/double-chocolate-chip-muffins.jpg"/>
                <input type="submit" name='btn' value='Choc Muffin'>
            </td>
        </tr>
        <tr>
            <td>
                <img id="Choc Eclair" src="./images/chocolate-eclairs-2.jpg"/>
                <input type="submit" name='btn' value='Choc Eclair'>
            </td>
            <td>
                <img id="Blueberry Muffin" src="./images/blueberry-muffins-ca1.jpg"/>
                <input type="submit" name='btn' value='Blueberry Muffin'>
            </td>
            <td>
                <img id="Choc Cookie" src="./images/download (1).jpg"/>
                <input type="submit" name='btn' value='Choc Cookie'>
            </td>
            <td>

            <div id="myDIV" style = 'display: none;'> 
            <script>
            var gettingSrc = localStorage.getItem("key");  
            document.writeln("<img id='addedimg' src='"+gettingSrc+"'/>");
            </script>
            <?php   
            $sql = "SELECT itemName FROM items WHERE itemId=(SELECT max(itemId) FROM items);";
            $retval = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($retval);
            $rowresult = $row['itemName'];
            ?>
                <input type="submit" name='btn' value=<?php echo $rowresult?>>
            </td>
            </div>
            <?php
                $sqlCheck = 'SELECT * FROM items ;';
                mysqli_select_db($link,'client_Database');
                $retval = mysqli_query( $link,$sqlCheck );
                $quantity = mysqli_num_rows( $retval );
                if ($quantity> 15) {
                    echo "<script>document.getElementById('myDIV').style.display = 'block';</script>";
                }
            ?>
            
        </tr>
    </table>
</form>
</div>
    <p>
        <script>
            function sending(){
            window.location.href = "logout.php";
            }
        </script>
        <button type="button" onclick = 'sending()'>Click here to sign out</button>
    </p>
</body>

</html>


