<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Simonetta&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>Time table</title>
        <style>
            .header
            {
                background:#1664D1;
                display: block;
                width: 100%;
            }
            .innerheader
            {
                width:80%;
                height:100%;
                display:block;
                padding-left:15%;
                padding-right:20%;    
            }
            body
            {
                overflow-x:hidden;
            }
            .text
            {
                height:100%;
                display:table;
            }
            .text h1
            {
                color:white;
                height:100%;
                display:table-cell;
                vertical-align:middle;
                font-family: 'Simonetta';
                font-size:32px;    
            } 
            h3,h4
            {
                color:#10376D;
                text-align:center;
                font-family: 'Simonetta';
                font-size:25px;
            }
            h5
            {
                color:#10376D;
                text-align:left;
                font-family:'Simonetta';
                font-size:18px;
            }
            #result
            {
                color:black;
                text-align:center;
                font-family:cursive;
                font-size:20px;
            }
            input,select
            {
                width:40vw;
                height:30px;
                border: 1px solid #1664D1;
                border-radius:10px;
                margin-top: 30px;
                padding-left:20px;
            }
            button
            {
                margin-top: 20px;
                background-color:#1664D1;
                color:white;
                width:15vw;
                height:30px;
                border: 1px solid #1664D1;
                border-radius:10px;
                font-family:'Simonetta';
            }
            button:disabled
            {
                background-color:#000;
            }
            marquee
            {
                font-family:'Simonetta';
                font-size:25px;
                color:#10376D;
            }
            .text img
            {
            height: 70px;
            background-size: cover;
            }
            #page2
            {
            display:none;
            }
            #page3
            {
            display:none;
            }
            @media screen and (max-width:630px)
            {
                .text h1
                {
                    font-size:20px;
                }
                page1 input
                {
                    width:60vw;
                }
                page1 button
                {
                    width: 30vw;
                }
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="innerheader">
                <div class="text"><img src="logo.png"></img><h1>DEPARTMENT OF COMPUTER SCIENCE AND ENGINEERING</h1></div>
            </div>
        </div>
        <center><h3>STAFF-SUBJECT SELECTOR</h3></center>
        <page3 id="page3">
        <center>
            <form action="swap.php">
                <button type="submit" >ODD SEMESTER</button>
            </form>
            <form action="eswap.php">
                <button type="submit" >EVEN SEMESTER</button>
            </form>
            <div id="result" style="display:none">
                <?php 
                    $con = mysqli_connect("localhost","root","root","timetable");
                    $check="select sub1 from esub where staff='root'";
                    $me = mysqli_query($con,$check);
                    while($w = $me->fetch_assoc())
                    {
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
                    $table1="select* from $t where staff!='root' order by staff";
                    $table2="select* from login order by username";
                    echo "<h3>SUBJECT 1</h3>";
                    $snt = mysqli_query($con,$table1);
                    while($valt = $snt->fetch_assoc())
                    {
                        echo $valt['staff'].'&emsp;';
                        echo $valt['sub1'].'<br>';
                    }
                    echo "<h3>SUBJECT 2</h3>";
                    $snt2 = mysqli_query($con,$table2);
                    while($valt2 = $snt2->fetch_assoc())
                    {
                        echo $valt2['username'].'&emsp;';
                        echo $valt2['sub2'].'<br>';
                    }
                    echo "<h3>LABORATORY</h3>";
                    $snt2 = mysqli_query($con,$table1);
                    while($valt2 = $snt2->fetch_assoc())
                    {
                        echo $valt2['staff'].'&emsp;';
                        echo $valt2['subl'].'<br>';
                    }
                ?>
            </div>
            <button onclick="document.querySelector('#result').style.display='block'">VIEW RESULTS</button>
            <button onclick=log()>BACK</button>
        </center>
        </page3>
        <page1 id="page1">
        <center>
            <input type="text" id="username" placeholder="Username"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <button onclick="login()">LOGIN</button>
        </center>
            <?php
                $read="select staff from $t where rank=1";
                $sn = mysqli_query($con,$read);
                while($val = $sn->fetch_assoc())
                {
                    $out = $val['staff'];
                }
                echo "<br><br><marquee direction=right>The priority staff for the current $ws semester is '$out'</marquee>";
            ?>
        </page1>
        <page2 id="page2">
        <form action="sep.php">
            <div align="left"><h5><p id="demo"></p></h5></div>
            <div align="right"> <button type="submit" >LOGOUT</button></div>
        </form>
        <h4 style="background-color:Violet;">SUBJECT 1<h4> 
            <?php 
                    $con = mysqli_connect("localhost","root","root","timetable");
                    $query="select * from paper where rank=0";
                    $result=mysqli_query($con,$query);
                    $subjects=[];
                    $i=0;
                    while($row1=mysqli_fetch_array($result))
                    {
                        $subjects[$i]=$row1[1];
                        $i+=1;
                    }
                    for ($x = 1; $x <= 5; $x++)
                    {
                        $read="select * from $t where rank=$x";
                        $sn = mysqli_query($con,$read);
                        while($val = $sn->fetch_assoc())
                        {
                            $out = $val['staff'];
                            $kla = $val['sub1'];
                            $ra = $val['rank'];
                        }
                        echo "<form action='assign.php' ><input type='text' name=user value=$out hidden>";
                        echo "<p>".$out."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select name='assign' id=sone".$ra." class=clone".$ra." disabled>
                        <option selected disabled>".$kla."</option>";
                        for($i=0;$i<8;$i+=1)
                        {
                                echo "<option> ".$subjects[$i]."</option>";
                        }
                        echo "</select>&emsp;<button class=clone".$ra." onclick='predef(event,this)' disabled>Submit</button></form><br>".$kla."</p>";   
            
                    }
            ?>
        <h4 style="background-color:Tomato;">SUBJECT 2<h4>
            <?php
                $con = mysqli_connect("localhost","root","root","timetable");
                if($ws=="odd")
                {
                    for ($y=5; $y>=1;$y--)
                    {
                        $ready="select * from login where seniority=$y";
                        $sny = mysqli_query($con,$ready);
                        while($valy = $sny->fetch_assoc())
                        {
                            $outy = $valy['username'];
                            $klay = $valy['sub2'];
                            $ray = $valy['seniority'];
                        }
                        echo "<form action='assign2.php' ><input type='text' name=user value=$outy hidden>";
                        echo "<p>".$outy."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select id=stwo".$ray." name='assign2' class=cltwo".$ray." disabled >
                        <option selected disabled>".$klay."</option>";
                        for($i=0;$i<8;$i+=1)
                        {
                            echo "<option> ".$subjects[$i]."</option>";
                        }
                        echo "</select>&emsp;<button class=cltwo".$ray." onclick='predef(event,this)' disabled>Submit</button></form><br>".$klay."</p>";
                    }
                }
                else
                {
                    for ($y=1; $y<=5;$y++) 
                    {
                        $ready="select * from login where seniority=$y";
                        $sny = mysqli_query($con,$ready);
                        while($valy = $sny->fetch_assoc())
                        {
                            $outy = $valy['username'];
                            $klay = $valy['sub2'];
                            $ray = $valy['seniority'];
                        }
                        echo "<form action='assign2.php' ><input type='text' name=user value=$outy hidden>";
                        echo "<p>".$outy."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select id=stwo".$ray." name='assign2' class=cltwo".$ray." disabled >
                        <option selected disabled>".$klay."</option>";
                        for($i=0;$i<8;$i+=1)
                        {
                            echo "<option> ".$subjects[$i]."</option>";
                        }
                        echo "</select>&emsp;<button class=cltwo".$ray." onclick='predef(event,this)' disabled>Submit</button></form><br>".$klay."</p>";
                    }
                }
            ?>
        <h4 style="background-color:MediumSeaGreen;">LABORATORY<h4> 
            <?php 
                $con = mysqli_connect("localhost","root","root","timetable");
                $query="select * from lab where rank=0";
                $result=mysqli_query($con,$query);
                $subjectsz=[];
                $i=0;
                while($row1=mysqli_fetch_array($result))
                {
                    $subjectsz[$i]=$row1[1];
                    $i+=1;
                }
                for ($y=1; $y<=5;$y++) 
                {
                    $ready="select * from login where seniority=$y";
                    $sny = mysqli_query($con,$ready);
                    while($valy = $sny->fetch_assoc())
                    {
                        $outy = $valy['username'];
                        $klay = $valy['sub2'];
                        $ray = $valy['seniority'];
                    }
                    echo "<form action='assign2.php' ><input type='text' name=user value=$outy hidden>";
                    echo "<p>".$outy."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select id=lab".$ray." name='assign2' class=lab".$ray." disabled >
                    <option selected disabled>".$klay."</option>";
                    for($i=0;$i<8;$i+=1)
                    {
                        echo "<option> ".$subjectsz[$i]."</option>";
                    }
                    echo "</select>&emsp;<button class=lab".$ray." onclick='predef(event,this)' disabled>Submit</button></form><br>".$klay."</p>";
                }
            ?>
        </page2>
    </body>
    <script>
    let theory_over=false;
    <?php
            $lala="select* from $t where staff!='root'";
            $lal = mysqli_query($con,$lala);
            $jar='let staffs={';
            while($la = $lal->fetch_assoc())
            {
                $name=$la['staff'];
                $rankk = $la['rank'];
                $jar .= "'".$name."':['".$name."',".$rankk."],";
            }
            $jar.="};";
            echo $jar;
    ?>
    <?php
            $lala="select* from login";
            $lal = mysqli_query($con,$lala);
            $jar='let staffs2={';
            while($la = $lal->fetch_assoc())
            {
                $name=$la['username'];
                $rankk = $la['seniority'];
                $jar .= "'".$name."':['".$name."',".$rankk."],";
            }
            $jar.="};";
            echo $jar;
    ?>
    <?php
            $lala="select* from esub where staff='root'";
            $lal = mysqli_query($con,$lala);
            while($la = $lal->fetch_assoc())
            {
                $name=$la['sub1'];
            }  
            echo "let sem='".$name."'; ";
    ?>
    <?php
            $lala="select* from paper where rank=0";
            $lal = mysqli_query($con,$lala);
            if(!$lal->fetch_assoc())
            {
                echo 'theory_over=true;';
            }  
    ?>
        
        function log()
        {
        page3.style.display="none";
        page2.style.display="none";
        page1.style.display="block";
        window.location.reload();
        }
        function login()
        {
            document.getElementById("demo").innerHTML = "LOGINED AS "+username.value; 
            if(username.value=="admin" && password.value=="admin")
            {
            document.getElementById("page1").style.display="none";
            document.getElementById("page3").style.display="block";
            }
            else if(staffs[username.value][0]==password.value)
            {
                var a=staffs[username.value];
                document.getElementById("page1").style.display="none";
                document.getElementById("page2").style.display="block";
                if(document.querySelector('#sone'+5).value == 'nil')
                {
                    let rank = staffs[username.value][1]-1;
                    if(rank != 0)
                    {
                        if((document.querySelector('#sone'+rank).value != 'nil') && (document.querySelector('#sone'+(rank+1)).value == 'nil'))
                        {
                            document.querySelectorAll('.clone'+(rank+1)).forEach((i)=>
                            {
                                i.disabled=false
                            })
                        }
                        else
                            alert("Previous staff has not selected")
                    }
                    else
                    {
                        if( (document.querySelector('#sone'+(rank+1)).value == 'nil'))
                        {
                            document.querySelectorAll('.clone'+1).forEach((i)=>
                            {
                                i.disabled=false
                            })
                        }
                    }
                }
                else
                {
                    if((sem=='odd' && document.querySelector('#stwo'+1).value != 'nil') ||
                      (sem=='even' && document.querySelector('#stwo'+5).value != 'nil') || 
                      (theory_over==true))
                    {
                        document.querySelectorAll('.lab'+staffs2[username.value][1]).forEach((i)=>{i.disabled=false;})
                        console.log('.lab'+staffs2[username.value][1]);
                    //    document.querySelectorAll("[class*='lab']").forEach((i)=>{
                    //        i.disabled=false;
                    //    })
                       return;
                    }

                    if(sem=='odd')
                    {
                        let rank = staffs2[username.value][1]+1;
                        if(rank != 6)
                        {
                            if(document.querySelector('#stwo'+rank).value != 'nil' &&  (document.querySelector('#stwo'+(rank-1)).value == 'nil'))
                            {
                                document.querySelectorAll('.cltwo'+(rank-1)).forEach((i)=>
                                {
                                    i.disabled=false
                                })
                            }
                            else
                                alert("Previous staff has not selected")
                        }
                        else
                        {
                            if(document.querySelector('#stwo'+5).value == 'nil')
                            document.querySelectorAll('.cltwo'+5).forEach((i)=>
                            {
                                i.disabled=false
                            })
                        }    
                    }
                    else
                    {
                        let rank = staffs2[username.value][1];
                        if(document.querySelector('#stwo'+rank).value == 'nil')
                        {
                            if(rank != 1)
                            {
                                if((document.querySelector('#stwo'+(rank-1)).value != 'nil'))
                                {
                                    document.querySelectorAll('.cltwo'+rank).forEach((i)=>
                                    {
                                        i.disabled=false
                                    })
                                }
                                else
                                    alert("Previous staff has not selected")
                            }
                            else
                            {
                                document.querySelectorAll('.cltwo'+1).forEach((i)=>
                                {
                                    i.disabled=false
                                })
                            }
                        }
                        else
                        {
                            alert("You have already selected")
                        }     
                    }           
                }
            }
            else
            {
            alert("invalid");
            }   
        } 
        function predef(evt,elt)
        {
            if(document.querySelector('.'+elt.classList.value).value == "nil")
            {
                evt.preventDefault();
                alert("please choose a subject")
            }
        }
    </script>
</html>
