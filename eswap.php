<?php
        $con = mysqli_connect("localhost","root","root","timetable");
        $read = "select rank from esub where staff='root'";
        $sn = mysqli_query($con,$read);
        $reqrank=0;
        $swapvar="";
        $var1="";
        while($val = $sn->fetch_assoc()){
            $reqrank = $val['rank'];
        }
        $reqrank=$reqrank+1;
        if($reqrank==6)
        {

            $sql="update esub set rank=rank-1 ";
            $con->query($sql);
            $sql="update esub set rank=(select rank from esub where staff='root')+1 where rank=0 ";
            $con->query($sql);
            $sql="update esub set rank=1 where staff='root'";
            $con->query($sql);
        }
else{
            $read="select staff from esub where rank='$reqrank' and sub!='abc'";
        $sn = mysqli_query($con,$read);
        while($val = $sn->fetch_assoc()){
            $swapvar = $val['staff'];
          }
        $read="select staff from esub where rank=1 and sub!='abc'";
        $sn = mysqli_query($con,$read);
        while($val = $sn->fetch_assoc()){
            $var1 = $val['staff'];
        }
        $sql="update esub set staff='$swapvar' where rank=1 and sub!='abc'";
        $con->query($sql);
        $sql="update esub set staff='$var1' where rank='$reqrank' and sub!='abc'";
        $con->query($sql);
        $sql="update esub set rank='$reqrank' where staff='root'";
        $con->query($sql);
}
$reset="update paper set rank=0 where 1";
$con->query($reset);
$reset1="update esub set sub1='nil' where 1";
$con->query($reset1);
$reset2="update login set sub2='nil' where 1";
$con->query($reset2);
$sem="update esub set sub1='even' where staff='root'";
$con->query($sem);
header ("Location: sep.php")
?>