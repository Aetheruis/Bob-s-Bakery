<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password1');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
define('DB_NAME', 'client_Database');
 
/* Attempt to connect to MySQL database */

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = 'CREATE DATABASE IF NOT EXISTS client_Database;';
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
$sql2 = 'CREATE TABLE IF NOT EXISTS users( '.
      'id INT NOT NULL AUTO_INCREMENT, '.
      'client_name VARCHAR(50) NOT NULL, '.
      'client_Surname  VARCHAR(50) NOT NULL, '.
      'phoneNum   TEXT NOT NULL, '.
      'email    VARCHAR(255) NOT NULL, '.
      'password    VARCHAR(255) NOT NULL, '.
      'client_address     VARCHAR(255) NOT NULL,'.
      'primary key ( id ))';
   mysqli_select_db($link,'client_Database');
   $retval = mysqli_query( $link,$sql2 );
   
   if(! $retval ) {
      die('Could not create table: ' . mysql_error());
   }
   $adminPassword = password_hash("admin1234", PASSWORD_DEFAULT);

$q = mysqli_query( $link,"SELECT client_name FROM client_Database.users WHERE client_name='admin'");
    if (mysqli_num_rows($q) == 0) { 
        $sql2_1 = 'INSERT INTO client_Database.users (client_name,client_Surname,phoneNum,email,password ,client_address)VALUES(?, ?, ?, ?, ?, ?);';
        if($stmt = mysqli_prepare($link, $sql2_1)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_client_name,$param_client_Surname,$param_phoneNum,$param_email, $param_password, $param_client_address);
            $param_client_name = 'Admin';
            $param_client_Surname = 'Baker';
            $param_phoneNum = '0833554533';
            $param_email = 'bobsbakinggoods@gmail.com';
            $param_password = password_hash('adminbaker1', PASSWORD_DEFAULT);
            $param_client_address = '25 GoodWood Ave, Durbanville, Eversdal, 7550';
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_select_db($link,'client_Database');
        $retval = mysqli_query( $link,$sql2_1 );
        
        if(! $retval ) {
           die('Could not create table: ' . mysql_error());
        } 

     }
$sql3 = 'CREATE TABLE IF NOT EXISTS client_Database.items( '.
   'itemId INT NOT NULL AUTO_INCREMENT, '.
   'itemName VARCHAR(50) NOT NULL, '.
   'itemPrice  INT(50) NOT NULL, '.
   'itemQuantity INT(50) NOT NULL,'.
   'primary key ( itemId ))';
mysqli_select_db($link,'client_Database');
$retval = mysqli_query( $link,$sql3 );

if(! $retval ) {
   die('Could not create table: ' . mysql_error());
}
$sqlCheck = 'SELECT * FROM client_Database.items ;';
mysqli_select_db($link,'client_Database');
$retval = mysqli_query( $link,$sqlCheck );
$quantity = mysqli_num_rows( $retval );


if($quantity <= 15 ){
    $sql3_0 = 'DROP TABLE IF EXISTS client_Database.items;';
    mysqli_select_db($link,'client_Database');
    $retval = mysqli_query( $link,$sql3_0 );
    $sql3 = 'CREATE TABLE IF NOT EXISTS client_Database.items( '.
   'itemId INT NOT NULL AUTO_INCREMENT, '.
   'itemName VARCHAR(50) NOT NULL, '.
   'itemPrice  INT(50) NOT NULL, '.
   'itemQuantity INT(50) NOT NULL,'.
   'primary key ( itemId ))';
mysqli_select_db($link,'client_Database');
$retval = mysqli_query( $link,$sql3 );

if(! $retval ) {
   die('Could not create table: ' . mysql_error());
}

$sql3_2 = "INSERT INTO client_Database.items (itemName,itemPrice,itemQuantity)
VALUES(
        'Milktart',
        24.99,
        20
    ),
    (
        'Koeksuster',
        30.00,
        15
    ),(
        'Vanilla SwissRoll',
        64.99,
        35
    ),(
        'Pancake',
        24.99,
        13
    ),(
        'Choc SwissRoll',
        64.99,
        9
    ),(
        'Choc Cake',
        69.99,
        6
    ),(
        'Croissant',
        19.49,
        35
    ),(
        'Plain Muffin',
        10.99,
        5
    ),(
        'Blackforest Cake',
        79.99,
        6
    ),(
        'Appletart',
        35.99,
        6
    ),(
        'BananaBread',
        24.99,
        40
    ),(
        'Choc Muffin',
        15.99,
        55
    ),(
        'Choc Eclair',
        8.99,
        29
    ),(
        'Blueberry Muffin',
        16.99,
        3
    ),(
        'Choc Cookie',
        9.99,
        12
    );";
    mysqli_select_db($link,'client_Database');
    $retval = mysqli_query( $link,$sql3_2 );
    
    if(! $retval ) {
       die('Could not create table: ' . mysql_error());
    }
}

$sql4 = 'CREATE TABLE IF NOT EXISTS orders( '.
   'orderID INT NOT NULL AUTO_INCREMENT, '.
   'customer_name VARCHAR(50) NOT NULL, '.
   'orderTime  VARCHAR(50) NOT NULL, '.
   'orderDescription  VARCHAR(255) DEFAULT "defaultVal" NOT NULL, '.
   'primary key ( orderID ))';
mysqli_select_db($link,'client_Database');
$retval = mysqli_query( $link,$sql4 );

if(! $retval ) {
   die('Could not create table: ' . mysql_error());
}
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

?>