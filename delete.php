<?php 

include("conn.php");

    $id = $_GET['deleteid'];
    $result = mysqli_query($conn, "DELETE FROM `list` WHERE sno = $id");
    header("Location:list.php");

?>