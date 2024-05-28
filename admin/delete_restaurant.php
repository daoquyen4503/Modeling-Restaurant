
                <?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM category WHERE c_id = '".$_GET['c_id']."'");
header("location:all_restaurant.php");  

?>
