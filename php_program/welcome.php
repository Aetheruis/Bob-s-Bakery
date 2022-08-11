<?php
// Initialize the session
session_start();
 
require_once "config.php"; // Hello there
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