<?php
 $con = mysqli_connect("localhost","root","root","timetable");
 if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 
   $a = $_GET['assign'];
    $out=$_GET['user'];
    $query="UPDATE subject SET sub1='$a' WHERE staff='$out'";
    $change="UPDATE `paper` SET `rank`=1 where `subject`='$a'";
    $con->query($change);
    if($con->query($query)==TRUE)
      header("Location: sep.php");
    else
      echo 'fail';  
?>