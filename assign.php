<?php
 $con = mysqli_connect("localhost","root","root","timetable");
 if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 
   $a = $_GET['assign'];
    $out=$_GET['user'];

    $check="select sub1 from esub where staff='root'";
        $me = mysqli_query($con,$check);
        while($w = $me->fetch_assoc()){
            $ws = $w['sub1'];
          }
          if($ws=="odd")
          {
              $t='subject';
          }
          else
          {
              $t='esub';
          }

    $query="UPDATE $t SET sub1='$a' WHERE staff='$out'";
    $change="UPDATE `paper` SET `rank`=1 where `subject`='$a'";
    $con->query($change);
    if($con->query($query)==TRUE)
      header("Location: sep.php");
    else
      echo 'fail';  
?>