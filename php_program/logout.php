<?php
// Initialize the session
session_start();
$src=null;
$src = $_SESSION['itemsrc'];
if ($src==null) {
    header("location: index.php");
}
// Unset all of the session variables
$srcEncode = json_encode($src);
$_SESSION = array();
session_destroy();
 echo '<script>var src ='.$srcEncode.';
 localStorage.setItem("key", src);
 window.location.replace("index.php");
</script>';
// Destroy the session.


// Redirect to login page
//header("location: login.php");
exit;
?>

