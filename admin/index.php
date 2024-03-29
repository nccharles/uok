<?php
   session_start();
   if(isset($_SESSION['uname'])){
include('db/dbase.php');
$uname=$_SESSION['uname'];
$sql = $con -> prepare("SELECT * FROM department where fname='$uname' limit 1");
$sql -> execute();
$event = $sql ->fetchAll();
foreach ($event as $row);
$fname=$row['fname'];
$role=$row['type'];
$lname=$row['lname'];
$gender=$row['gender'];
$email=$row['email'];
?>
<html>
<head>
  <title><?php echo $role==1?'ADMIN':'HOD' ?> | DASHBOARD</title>
  <meta name="viewport" content="width=device-width,initial-scale: 1.0, user-scalabe=0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/general.js"></script>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:700,800');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
   overflow: hidden;
}

body{
  font-family: 'Time new roman';
  background-color: #95a5a6;
}
a {
  text-decoration: none;
}
div#header{
  width: 100%;
  height: 150px;
  background: url('../images/convas1.jpg');
  border-bottom: 10px solid #4f0b1c;
  border-top: 10px solid #4f0b1c;
  padding: 12px;
}

.logo{
  float: left;
  margin-top: 10px;
  margin-left: 15px;
}
.logo a{
  font-size: 1.6em;
  color: #fff;
}
.logo a span{
  font-weight: 300;
}
div#container{
  width: 100%;
  margin: 0 auto;
}
#chpass{
  background: #2980b9; 
}
.modal-content{
  background: rgba(40,10,0,0.3);
  color: #fff;
}
.sidebar{
  width: 250px;
  margin-top: 14px;
  background: linear-gradient(180deg,#4f0b1c,#4f0b1c,#2980b9,#2980b9, #f39c12,#4f0b1c,#4f0b1c);
  float: left;
}
.content{
  width: auto;
  margin-left: 250px;
  height: 100%;
  background-color: #95a5a6;
  padding: 15px;
  padding-bottom: 120px;
  overflow: auto;
}

ul#nav li{
  list-style: none;
}
ul#nav li a{
  color: #ccc;
  display: block;
  padding: 10px;
  font-size: 1.8em;
  border-bottom: 1px solid #0a0a0a;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  transition: 0.2s;
}
ul#nav a:hover{
background-color: #2980b9;
color: #fff;
padding-left: 30px;
text-decoration: none;
}
ul#nav li a.selected{
  background-color: #2980b9;
  color: #fff;
}

.content p {
  color: #424242;
  font-size: 0.73em;
}
div#box {
  margin-top: 0px;
  border-bottom: 12px solid #2980b9;
}

div#box .box-top {
  color: #fff;
  text-shadow: 0px 1px #000;
  background: linear-gradient(15deg,#4f0b1c,#2980b9,#2980b9, #f39c12,#4f0b1c,#4f0b1c);
  padding: 5px;
  padding-left: 15px;
  font-weight: 300;
}
div#box .box-panel{
  padding: 5px;
  background: url('../images/convas1.jpg');
  color: #333;

}
a.mobile{
display: block;
color: #fff;
background-color: #000;
text-align: center;
padding: 7px;

}
a.mobile:active {
background-color: #4a4a4a;
}
@media only screen and (max-width: 450px){
.sidebar{
  width: 100%;
  display: none;
}
.content{
  margin-left: 0px;
}
}
@media only screen and (min-width: 450px){
a.mobile{
  display: none;
}
.sidebar{
  height: 100%;
  display: block;
}
.tab-pane{
  padding: 6px;
}
#corse{
  text-decoration: none;
  font-size: 50px;
}

#panel{
  font-size: 20px;
  color: #6b158e;
}
}
  </style>

</head>
<body >
<div id="header">
  <div class="logo"><a href="#"><img src="../images/header1.png" class="img-responsive" alt="Logo"></a></div>
 </div>
 <a class="mobile" href="#">MENU</a>
<div id="container">
  <div class="sidebar">
  <ul id="nav">
    <li><a  data-toggle="tab" href="#home" class="selected"><?php echo $row['lname']; ?><span> <?php echo $row['fname']; ?></span></a></li>
   <?php echo $role==1?'<li><a data-toggle="tab" href="#hod">HOD</a></li>':'' ?>
    <?php echo $role==1?'<li><a data-toggle="tab" href="#registrar">Registrar</a></li>':'' ?>
       <li><a data-toggle="tab" href="#addanouc">Send Anoucements</a></li>
            <?php
        include("db/dbase.php");
          $sql = $con ->prepare("SELECT distinct(c.ccode),COUNT(c.cname) as m,m.status FROM courses as c,marks as m WHERE m.status='0' and c.cid=m.cid");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['m'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#home" aria-expanded="false">Approve<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: green;"><?php echo $row['m']; ?></span></a></li>
            <?php }else{


         ?>

        <li><a data-toggle="tab" href="#home"  aria-expanded="false">Approve<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['m']; ?></span></a></li><?php }?>
        <?php
          $sql = $con ->prepare("SELECT COUNT(claimid) as cl FROM claim where status='0'");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['cl'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#claim" aria-expanded="false">Claim<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: green;"><?php echo $row['cl']; ?></span></a></li>
            <?php }else{


         ?>

        <li><a data-toggle="tab" href="#claim" aria-expanded="false">Claim<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['cl']; ?></span></a></li><?php }?>

         <li data-toggle="modal" data-target="#chpass"><a href="#">Change Password</a></li>
        <li><a href="../logout.php">Logout</a></li>
  </ul>
  </div>
  <div class="content">
  <div id="box">
    <div class="box-top"><?php echo $role==1?'ADMIN':'HOD' ?> | DASHBOARD</div>
     <div class="box-panel">
     <div class="btn-group btn-group-justified" style="min-height: 100%;">

     <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#rgstrd">VIEW REGISTERED STUDENTS</a></li>
    <li><a data-toggle="tab" href="#stdtreg">REGISTER STUDENT</a></li>
    <li><a data-toggle="tab" href="#addanouc">ADD ANNOUNCEMENT</a></li>
    <li><a data-toggle="tab" href="#rgstlec">LECTURERS</a></li>
    <li><a data-toggle="tab" href="#lectreg">ADD LECTURER</a></li>
    <?php echo $role==1?'<li><a data-toggle="tab" href="#hodreg">ADD NEW STAFF</a></li>':'' ?>
     
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade">
      <div class="row">
    <div class="col-sm-12">
        <?php

         if(isset($_POST['ssave'])){
           $regnum=$_POST['regnum'];
           $fname=$_POST['fname'];
           $lname=$_POST['lname'];
           $email=$_POST['email'];
           $sessl=$_POST['sessl'];
           $phone=$_POST['phone'];
           $sgender=$_POST['sgender'];
          $sql = $con ->prepare("SELECT COUNT(seslevid) FROM studentsesslevel WHERE sid=(SELECT sid from student WHERE regnum='$regnum')");
           $sql -> execute();
           $count = $sql->fetchColumn();
           if($count == "0"){
          $sql=$con->prepare("INSERT INTO student(regnum,fname,lname,gender,email,phone,password)values('$regnum','$fname','$lname','$sgender','$email','$phone','pass')");
          $sql->execute();
          $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'$sessl','1')");
          $sql->execute();
            ?>
           <script>
              window.alert("Student was registered in 1st year!");
             </script>
           <?php
         }else{
           $sql = $con ->prepare("SELECT MAX(seslevid) as deplevel FROM studentsesslevel WHERE sid=(SELECT sid from student WHERE regnum='$regnum') and Ystatus='1'");
            $sql -> execute();
            $rem=$sql->fetchAll();
            foreach ($rem as $row);
            $lid=$row['deplevel'];
            if($lid == "1"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'2','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='2'");
              $sql->execute();
              ?>
              <script>
              window.alert("Student was registered in 2nd year Day Program!");
             </script>
              <?php
            }else if($lid == "2"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'3','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='3'");
              $sql->execute();
              ?>
              <script>
              window.alert("Student was registered in 3rd year Day Program!");
             </script>
              <?php
            }else if($lid == "4"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'5','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='5'");
              $sql->execute();
              ?>
              <script>
              window.alert("Student was registered in 2nd year Evening Program!");
             </script>
              <?php
            }else if($lid == "5"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'6','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='6'");
              $sql->execute();
              ?>
              <script>
              window.alert("Student was registered in 3rd year Evening Program!");
             </script>
              <?php
            }else if($lid == "7"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'8','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='8'");
              $sql->execute();
              ?>
              <script>
              window.alert("Student was registered in 2nd Weekend Program!");
              </script>
                <?php
            }else if($lid == "8"){
              $sql=$con->prepare("INSERT INTO studentsesslevel(sid,seslevid,Ystatus)values((SELECT sid from student WHERE regnum='$regnum'),'9','1')");
              $sql->execute();
              $sql=$con->prepare("UPDATE studentsesslevel SET Ystatus='0' where sid=(SELECT sid from student WHERE regnum='$regnum') and seslevid!='9'");
              $sql->execute();
              ?>
              <script>
        window.alert("Student was registered in 3rd year Weekend Programm!");
        </script>
              <?php
            }else{
              ?>
              <script>
        window.alert("Student Already registered in 3rd year!.");
        </script>
              <?php
            }
        }
      }
      if(isset($_POST['npass'])){
          $oldpass=$_POST['oldpass'];
          $newpass=$_POST['newpass'];
          $sql=$con->prepare("UPDATE department SET password='$newpass' where password='$oldpass' and fname='$uname'");
          $sql->execute();
          ?>
           <script>
        window.alert("Password was Changed!");
        </script>
           <?php
           echo "<meta http-equiv='refresh' content='3;url=index.php'>";
      }
      if(isset($_POST['addhodreg'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $gender=$_POST['gender'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $role=$_POST['type'];
        if($role==1){
        $sql=$con->prepare("SELECT COUNT(hid) from department where (fname='$fname' or lname='$lname') and email='$email'");
      $sql->execute();
      $count=$sql->fetchColumn();
      if($count=='0'){
                 $sql=$con->prepare("INSERT INTO department(fname,lname,gender,email,phone,type,password) values('$fname','$lname','$gender','$email','$phone','2','pass')");
                 $sql->execute();
                ?>
           <script>
        window.alert("HOD Registered!");
        </script>
           <?php
      }else{
           ?>
             <script>
        window.alert("HOD Already Registered!");
        </script>
           <?php
      }
      }else{
      $sql=$con->prepare("SELECT COUNT(rid) from registrar where (fname='$fname' or lname='$lname') and email='$email'");
      $sql->execute();
      $count=$sql->fetchColumn();
      if($count=='0'){
                 $sql=$con->prepare("INSERT INTO registrar(fname,lname,gender,email,phone,password) values('$fname','$lname','$gender','$email','$phone','pass')");
                 $sql->execute();
                ?>
           <script>
        window.alert("Registered!");
        </script>
           <?php
      }else{
           ?>
             <script>
        window.alert("This user Already Registered!");
        </script>
           <?php
      }
      }
    }
      if(isset($_POST['addlec'])){
      $lfname=$_POST['lfname'];
      $llname=$_POST['llname'];
      $lcname=$_POST['lcname'];
      $lgender=$_POST['lgender'];
      $lccode=$_POST['lccode'];
      $lphone=$_POST['lphone'];
      $llevel=$_POST['llevel'];
       $lemail=$_POST['lemail'];
      $sql=$con->prepare("SELECT COUNT(lid) from lecture where (fname='$lfname' or lname='$llname') and email='$lemail'");
      $sql->execute();
      $count=$sql->fetchColumn();
      if($count=='0'){
              $sql=$con->prepare("SELECT COUNT(cid) from courses where cname='$lcname' or ccode='$lccode'");
              $sql->execute();
              $count=$sql->fetchColumn();
              if($count=='0'){
                 $sql=$con->prepare("INSERT INTO lecture(fname,lname,gender,email,phone,password) values('$lfname','$llname','$lgender','$lemail','$lphone','pass')");
                 $sql->execute();
                 $sql=$con->prepare("INSERT INTO lecturesesslevel(lid,slevid,ccode) values((SELECT lid from lecture where email='$lemail'),'$llevel','$lccode')");
                 $sql->execute();
                 $sql=$con->prepare("INSERT INTO courses(lid,ccode,cname,level) values((SELECT lid from lecture where email='$lemail'),'$lccode','$lcname',(SELECT level from level where levid='$llevel'))");
                 $sql->execute();
                 $sql=$con->prepare("INSERT INTO courselevel(cid,levid) values((SELECT cid from courses where ccode='$lccode'),'$llevel')");
                 $sql->execute();
              }else{
                ?>
                <script>
             window.alert("This Course already in database!");
             </script>
                <?php
              }
                ?>
           <script>
        window.alert("Lecturer Was Inserted!");
        </script>
           <?php
      }else{
           ?>
             <script>
        window.alert("Lecturer Already Registered!");
        </script>
           <?php
      }
  }

        if(isset($_POST['ssavec'])){
          $id=$_POST['sid'];
           $regnum=$_POST['regnum'];
           $fname=$_POST['fname'];
           $lname=$_POST['lname'];
           $email=$_POST['email'];
           $phone=$_POST['phone'];
           $sgender=$_POST['sgender'];
           $level=$_POST['slevel'];
           $sql=$con->prepare("UPDATE student SET regnum='$regnum',fname='$fname',lname='$lname',gender='$sgender',email='$email',phone='$phone' where sid=$id");
          try{
          $sql->execute();
          echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }catch(PDOException $e)
         {
           echo "error".$e->getMessage();
         }
        }
         if(isset($_POST['asend'])){
         $pos=$_POST['postitle'];
         $tit=$_POST['tit'];
         $ann=$_POST['Annoucement'];
         if($pos=='student'){
            $slev=$_POST['slevel'];
            if($slev=="level 1"){
              $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
            $sq->execute();
            $levid=1;
            $sql = $con->prepare("SELECT s.sid,s.phone,s.fname,l.levid FROM student as s,level as l,sesslevel as sl, Session as ss,studentsesslevel as stl where s.sid=stl.sid and (stl.seslevid='1' or stl.seslevid='4' or stl.seslevid='7') and sl.sID=ss.sID and l.level='level 1' and stl.Ystatus='1' GROUP BY s.sid");
             $sql->execute();
            
             ?>
           <script>
        window.alert("Announcement was sent to the 1st year Students!");
        </script>
           <?php
           echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }else if($slev=="level 2"){
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
            $sq->execute();
            $levid=2;
            $sql = $con->prepare("SELECT s.sid,s.phone,s.fname,l.levid FROM student as s,level as l,sesslevel as sl, Session as ss,studentsesslevel as stl where s.sid=stl.sid and (stl.seslevid='2' or stl.seslevid='5' or stl.seslevid='8') and sl.sID=ss.sID and l.level='level 2' and stl.Ystatus='1' GROUP BY s.sid");
             $sql->execute();
            ?>
           <script>
        window.alert("Announcement was sent to the 2nd year Students!");
        </script>
           <?php
           echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }else if($slev=="level 3"){
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
            $sq->execute();
            $levid=3;
            $sql = $con->prepare("SELECT s.sid,s.phone,s.fname,l.levid FROM student as s,level as l,sesslevel as sl, Session as ss,studentsesslevel as stl where s.sid=stl.sid and (stl.seslevid='3' or stl.seslevid='6' or stl.seslevid='9') and sl.sID=ss.sID and l.level='level 3' and stl.Ystatus='1' GROUP BY s.sid");
             $sql->execute();
             
           ?>
           <script>
        window.alert("Announcement was sent to the 3rd year Student!");
        </script>
           <?php
            echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }
            else if($slev=="all"){
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
            $sq->execute();
            $levid=1;
            $sql = $con->prepare("SELECT s.sid,s.phone,s.fname,l.levid FROM student as s,level as l,sesslevel as sl, Session as ss,studentsesslevel as stl where s.sid=stl.sid and sl.sID=ss.sID and stl.Ystatus='1' GROUP BY s.sid");
             $sql->execute();
            
           ?>
           <script>
        window.alert("Announcement was sent to All Student!");
        </script>
           <?php
            echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }else{
                 ?>
           <script>
        window.alert("Please Select a Students level!");
        </script>
           <?php
            echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }

        }else if($pos=='lecture'){
               $kid=2;
              $slev=$_POST['slevel'];
            if($slev=="level 1"){
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
            $sq->execute();
            ?>
           <script>
        window.alert("Announcement was sent to the 1st year Lecturers!");
        </script>
           <?php
            $sql = $con->prepare("SELECT lec.phone,lec.fname,l.levid FROM lecture as lec,level as l where l.level='level 1' GROUP by l.levid");
             $sql->execute();
             
            }else if($slev=="level 2"){
             
            $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
           $sq->execute();
           $sql = $con->prepare("SELECT lec.phone,lec.fname,l.levid FROM lecture as lec,level as l where l.level='level 2' GROUP by l.levid");
           $sql->execute();
           $levid=2;
            ?>
           <script>
        window.alert("Announcement was sent to the 2nd year Lecturers!");
        </script>
           <?php
            }else if($slev=="level 3"){
             
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
          $sq->execute();
          $sql = $con->prepare("SELECT lec.phone,lec.fname,l.levid FROM lecture as lec,level as l where l.level='level 3' GROUP by l.levid");
             $sql->execute();
           ?>
           <script>
        window.alert("Announcement was sent to the 3rd year Lecturers!");
        </script>
           <?php
            }
            else if($slev=="all"){
             
             $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('$tit','$ann',now())");
          $sq->execute();
          $sql = $con->prepare("SELECT lec.phone,lec.fname,l.levid FROM lecture as lec,level as l GROUP by l.levid");
             $sql->execute();
          $levid=0;
           ?>
           <script>
        window.alert("Announcement was sent to All Lecturers!");
        </script>
           <?php
            }
            }else{

           ?>
           <script>
        window.alert("Please, Select a receiver!");
        </script>
           <?php
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
        $res = $sql-> fetchAll();
             foreach ($res as $row) {
                $telephone=$row['phone'];
                $fname=$row['fname'];
               $sq=$con->prepare("INSERT INTO studentannoucement(sid,annid,status) values((SELECT sid from student where phone='$telephone'),(SELECT max(annid) from annoucement),'0')");
              $sq->execute();
              $sql=$con->prepare("INSERT INTO lectureannouncement(lid,annid,status) values((SELECT lid from lecture where phone='$telephone'),(SELECT max(annid) from annoucement limit 1),'0')");
              $sql->execute();
              $data = array(
              "sender"=>"UOKUPDATE",
              "recipients"=>$telephone,
              "message"=>"Dear ".$fname.", ".$ann,
            );

            $url = "https://www.intouchsms.co.rw/api/sendsms/.json";

            $data = http_build_query ($data);

            $username="CharlesGeek";
            $password="gsschool12";

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

            //execute post
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //close connection
            curl_close($ch);
             }

          }

        ?>
   <div class="well well-lg">
     <?php
   $sql = $con->prepare("SELECT DISTINCT(c.cname),COUNT(c.cid) as s,c.cid,m.status FROM courses as c,marks as m WHERE m.status='0' and c.cid=m.cid GROUP by c.ccode");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row) {
         ?>
   <a href='#' data-toggle="collapse" data-target="#<?php echo $row['cid']; ?>" id='corse'><?php echo $row['cname']; ?><i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;font-size: 30px;"><?php echo $row['s']; ?></span></a>

<div id="<?php echo $row['cid']; ?>" class="collapse">
      <?php
   $courseid=$row['cid'];
   $sql = $con->prepare("SELECT c.ccode,s.sid,s.regnum,s.fname,s.lname,m.level,c.cname,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as TOT FROM student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and c.level=m.level and c.cid='$courseid' and m.status='0' GROUP by m.sid ORDER By SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) DESC ");
          $sql->execute();
          $rem=$sql->fetchAll();
         ?>
    <div class="box-top">STUDENTS MARKS</div>

<table class="table table-striped">
    <thead>
      <tr>
        <th>REG No</th>
        <th>FIRSTNAME</th>
        <th>LASTNAME</th>
        <th>MARKS(%)</th>
        <th>GRADE</th>
      </tr>
    </thead>
    <tbody>
    <?php
 foreach ($rem as $row) {
            $sid=$row['sid'];
            $regnum=$row['regnum'];
            $fname=$row['fname'];
            $lname=$row['lname'];
            $course=$row['cname'];
            $marks=$row['TOT'];
            $tot=$row['TOT'];
            $lev=$row['level'];
            if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }

     ?>
      <tr>
        <td><?php echo $regnum; ?></td>
        <td><?php echo $fname; ?></td>
        <td><?php echo $lname; ?></td>
        <td><?php echo $marks; ?></td>
        <td><?php echo $grade; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
     <div class="panel panel-default" id="panel">
    <div class="panel-heading">YEAR: <?php echo $lev; ?></div>
    <div class="panel-body">COURSE NAME: <?php echo $course; ?></div>
    <div class="panel-footer">
    <div class="btn-group btn-group-justified">
    <a href='aprroved.php?ccode=<?php echo $row['ccode'];?>' class="btn btn-primary">Approve</a>
  </div>
  </div>
  </div>
  </div>
   <?php } ?>
   </div>

  </div>
  </div>
  </div>

 <div id="rgstrd" class="tab-pane fade in active">
  <div class="panel panel-primary">
      <div class="panel-heading"><h5>All registered Students</h5></div>
      <div class="panel-body">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Day">Day</a></li>
    <li><a data-toggle="tab" href="#Evening">Evening</a></li>
    <li><a data-toggle="tab" href="#Weekend">Weekend</a></li>
  </ul>

      </div>


  <div class="tab-content">
    <div id="Day" class="tab-pane fade in active">
         <div class="row">
         <div class="panel panel-primary">
             <div class="panel-body">
           <ul class="nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#i1">YEAR 1</a></li>
           <li><a data-toggle="tab" href="#i2">YEAR 2</a></li>
           <li><a data-toggle="tab" href="#i3">YEAR 3</a></li>
         </ul>

             </div>


         <div class="tab-content">
           <div id="i1" class="tab-pane fade in active">
                <div class="row">
         <?php
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=1 and sl.Ystatus='1' Group by sl.sid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>REG No</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>MARKS</th>
                <th>EDIT</th>
               <th>REMOVE</th>
             </tr>
           </thead>
           <tbody>
           <?php
         foreach ($rem as $row) {
                  $sid=$row['sid'];
                   $regnum=$row['regnum'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $regnum; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 1' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
             <tr>
             <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
             </tr>
           </tbody>
         </table>
           </div>

         </div>

         </div>
           <div id="i2" class="tab-pane fade">
             <div class="row">
          <?php
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=2 and sl.Ystatus='1' Group by sl.sid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>REG No</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
                <th>MARKS</th>
                <th>EDIT</th>
               <th>REMOVE</th>
             </tr>
           </thead>
           <tbody>
           <?php
         foreach ($rem as $row) {
                  $sid=$row['sid'];
                   $regnum=$row['regnum'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $regnum; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark2" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 2' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
             <tr>
             <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
             </tr>
           </tbody>
         </table>
           </div>

         </div>

           </div>
           <div id="i3" class="tab-pane fade">
             <div class="row">
           <?php
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=3 and sl.Ystatus='1' Group by sl.sid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>REG No</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>MARKS</th>
                <th>EDIT</th>
               <th>REMOVE</th>
             </tr>
           </thead>
           <tbody>
           <?php
         foreach ($rem as $row) {
                  $sid=$row['sid'];
                   $regnum=$row['regnum'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $regnum; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark3" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 3' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
             <tr>
             <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
             </tr>
           </tbody>
         </table>
           </div>

         </div>

           </div>
         </div></div>

  </div>

  </div>
    <div id="Evening" class="tab-pane fade">
      <div class="row">
      <div class="panel panel-primary">
          <div class="panel-body">
        <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#ev1">YEAR 1</a></li>
        <li><a data-toggle="tab" href="#ev2">YEAR 2</a></li>
        <li><a data-toggle="tab" href="#ev3">YEAR 3</a></li>
      </ul>

          </div>


      <div class="tab-content">
      <div id="ev1" class="tab-pane fade in active">
                <div class="row">
         <?php
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=4 and sl.Ystatus='1' Group by sl.sid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>REG No</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>MARKS</th>
                <th>EDIT</th>
               <th>REMOVE</th>
             </tr>
           </thead>
           <tbody>
           <?php
         foreach ($rem as $row) {
                  $sid=$row['sid'];
                   $regnum=$row['regnum'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $regnum; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 1' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
             <tr>
             <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
             </tr>
           </tbody>
         </table>
           </div>

         </div>

         </div>
           <div id="ev2" class="tab-pane fade">
             <div class="row">
          <?php
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=5 and sl.Ystatus='1' Group by sl.sid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>REG No</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
                <th>MARKS</th>
                <th>EDIT</th>
               <th>REMOVE</th>
             </tr>
           </thead>
           <tbody>
           <?php
         foreach ($rem as $row) {
                  $sid=$row['sid'];
                   $regnum=$row['regnum'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $regnum; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark2" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 2' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
             <tr>
             <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
             </tr>
           </tbody>
         </table>
           </div>

         </div>

           </div>
        <div id="ev3" class="tab-pane fade">
          <div class="row">
        <?php
       $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=6 and sl.Ystatus='1' Group by sl.sid");
              $sql->execute();
              $rem=$sql->fetchAll();

             ?>
        <div class="col-sm-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>REG No</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>GENDER</th>
             <th>E-MAIL</th>
            <th>PHONE</th>
            <th>MARKS</th>
             <th>EDIT</th>
            <th>REMOVE</th>
          </tr>
        </thead>
        <tbody>
        <?php
      foreach ($rem as $row) {
               $sid=$row['sid'];
                $regnum=$row['regnum'];
                $fname=$row['fname'];
               $lname=$row['lname'];
                $gender=$row['gender'];
                $email=$row['email'];
                $tel=$row['phone'];
         ?>
          <tr>
            <td><?php echo $regnum; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $gender; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $tel; ?></td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 3' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
          <tr>
          <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
          </tr>
        </tbody>
      </table>
        </div>

      </div>

        </div>
      </div></div>

  </div>

    </div>
    <div id="Weekend" class="tab-pane fade">
      <div class="row">
      <div class="panel panel-primary">
          <div class="panel-body">
        <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#e1">YEAR 1</a></li>
        <li><a data-toggle="tab" href="#e2">YEAR 2</a></li>
        <li><a data-toggle="tab" href="#e3">YEAR 3</a></li>
      </ul>

          </div>


      <div class="tab-content">
        <div id="e1" class="tab-pane fade in active">
             <div class="row">
      <?php
       $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=7 and sl.Ystatus='1' Group by sl.sid");
              $sql->execute();
              $rem=$sql->fetchAll();

             ?>
        <div class="col-sm-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>REG No</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>GENDER</th>
             <th>E-MAIL</th>
            <th>PHONE</th>
            <th>MARKS</th>
             <th>EDIT</th>
            <th>REMOVE</th>
          </tr>
        </thead>
        <tbody>
        <?php
      foreach ($rem as $row) {
               $sid=$row['sid'];
                $regnum=$row['regnum'];
                $fname=$row['fname'];
               $lname=$row['lname'];
                $gender=$row['gender'];
                $email=$row['email'];
                $tel=$row['phone'];
         ?>
          <tr>
            <td><?php echo $regnum; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $gender; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $tel; ?></td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 1' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
          <tr>
          <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
          </tr>
        </tbody>
      </table>
        </div>

      </div>

      </div>
        <div id="e2" class="tab-pane fade">
          <div class="row">
       <?php
       $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=8 and sl.Ystatus='1' Group by sl.sid");
              $sql->execute();
              $rem=$sql->fetchAll();

             ?>
        <div class="col-sm-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>REG No</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>GENDER</th>
             <th>E-MAIL</th>
            <th>PHONE</th>
            <th>MARKS</th>
             <th>EDIT</th>
            <th>REMOVE</th>
          </tr>
        </thead>
        <tbody>
        <?php
      foreach ($rem as $row) {
               $sid=$row['sid'];
                $regnum=$row['regnum'];
                $fname=$row['fname'];
               $lname=$row['lname'];
                $gender=$row['gender'];
                $email=$row['email'];
                $tel=$row['phone'];
         ?>
          <tr>
            <td><?php echo $regnum; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $gender; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $tel; ?></td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 2' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
          <tr>
          <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
          </tr>
        </tbody>
      </table>
        </div>

      </div>

        </div>
        <div id="e3" class="tab-pane fade">
          <div class="row">
        <?php
       $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentsesslevel as sl where s.sid=sl.sid and sl.seslevid=9 and sl.Ystatus='1' Group by sl.sid");
              $sql->execute();
              $rem=$sql->fetchAll();

             ?>
        <div class="col-sm-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>REG No</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>GENDER</th>
             <th>E-MAIL</th>
            <th>PHONE</th>
            <th>MARKS</th>
             <th>EDIT</th>
            <th>REMOVE</th>
          </tr>
        </thead>
        <tbody>
        <?php
      foreach ($rem as $row) {
               $sid=$row['sid'];
                $regnum=$row['regnum'];
                $fname=$row['fname'];
               $lname=$row['lname'];
                $gender=$row['gender'];
                $email=$row['email'];
                $tel=$row['phone'];
         ?>
          <tr>
            <td><?php echo $regnum; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $gender; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $tel; ?></td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#m<?php echo $sid;?>"><span class="glyphicon glyphicon-info-sign"></span></button></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
             </tr>
             <div class="modal fade" id="m<?php echo $sid;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $fname; ?>'s marks</h4>
        </div>
        <div class="modal-body">
        
  <div id="mark1" class="collapse in active">
 <div class="table">
 <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 3' and s.regnum='$regnum' GROUP BY c.cid");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $tot=$row['tot'];
            if($tot){
             if($tot>=80){
              $grade='A';
            }else if($tot>=70){
              $grade='B';
            }else if($tot>=60){
              $grade='C';
            }else if($tot>=50){
              $grade='D';
            }else{
              $grade='F';
            }
            
         ?>
 <div>
        <div class="alert alert-info">
  <strong><?php echo $row['cname']; ?> GRADE: <?php echo $grade; ?></strong>
</div>
        <label>A1:<?php echo $row['ass1']; ?></label>
        <label>A2: <?php echo $row['ass2']; ?></label>
        <label>CAT1: <?php echo $row['cat1']; ?></label>
        <label>CAT2: <?php echo $row['cat2']; ?></label>
        <label>EXAM: <?php echo $row['exam']; ?></label>
        <label><b>TOT: <?php echo $row['tot']; ?></b></label>
      </div>
          <?php } } ?>
          </div>
  </div>
    <div class="panel panel-danger">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
             <?php } ?>
          <tr>
          <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
          </tr>
        </tbody>
      </table>
        </div>

      </div>

        </div>
      </div></div>
  </div>

    </div>
  </div></div></div>
  <!-- Modal -->
  <div class="modal fade" id="chpass" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
      <div class="form-group">
      <label for="pwd">Old Password:</label>
      <input type="password" name="oldpass" class="form-control" id="usr" required>
      </div>
    <div class="form-group">
      <label for="pwd">New Password:</label>
      <input type="password" name="newpass" class="form-control" id="pwd" required>
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="pwd" required>
    </div>

        </div>
        <div class="modal-footer">
          <input type="submit" name="npass" class="btn btn-info" value="Change">
        </div>
      </div>
       </form>
    </div>
  </div>
  <div id="claim" class="tab-pane fade">

    <div class="box-top">STUDENTS CLAIMED</div>

     <div class="panel panel-default" id="panel">
       <?php
   $sql = $con->prepare("SELECT cl.claimid,s.regnum,c.level,cl.reason,s.fname as sfname,s.lname as slname,c.cname,c.ccode,m.exam,l.fname,l.lname from claim as cl,student as s,courses as c,marks as m,lecture as l where cl.status='0' and c.cid=m.cid and s.sid=cl.sid and l.lid=cl.lid and cl.ccode=c.ccode and m.status='1' GROUP BY s.regnum");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row) {
         ?>
    <div class="panel-body">
 <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?php echo $row['claimid']; ?>"><?php echo $row['slname']; ?> <?php echo $row['sfname']; ?></button>

  <div id="<?php echo $row['claimid']; ?>" class="collapse">
      <h2>Claiming  Details</h2>
            <div class="panel-group">

    <div class="panel panel-primary">
      <div class="panel-heading">COURSE NAME:</div>
      <div class="panel-body"><?php echo $row['cname']; ?></div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading">LECTURE:</div>
      <div class="panel-body"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></div>
    </div>

    <div class="panel panel-info">
      <div class="panel-heading">YEAR:</div>
      <div class="panel-body"><?php echo $row['level']; ?></div>
    </div>

    <div class="panel panel-warning">
      <div class="panel-heading">Reason of claiming:</div>
      <div class="panel-body"><?php echo $row['reason']; ?></div>
    </div>

    <div class="panel panel-danger">
      <div class="panel-heading">current Marks</div>
      <div class="panel-body">
      <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $row['marks']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row['exam']; ?>%">
     <?php echo $row['exam']; ?>%
    </div>
  </div>
  <a href='response.php?clid=<?php echo $row['claimid'];?>' class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> RESPOND</a>
  </div>
    </div>
  </div>
  </div>
    </div>
    <div class="panel-footer">
    <div class="btn-group btn-group-justified">
  </div>
  </div>
  <?php } ?>
  </div>
  </div>

    <div id="stdtreg" class="tab-pane fade">

          <div class="box-top">REGISTER STUDENT</div>
         <div class="form-group">
         <form method="POST" class="form-signin" name='stdform'>
      <label for="title">REG NUM:</label>
      <input type="text" class="form-control" title="ex: W/BIT/15/05/2019"  placeholder="ex: W/BIT/15/05/2017" name="regnum" required />
    </div>
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="First name should be letters"  placeholder="Enter your first name" name="fname" required >
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="Last name should be letters" placeholder="Enter your last name" name="lname" required >
    </div>
    <div class="form-group">
      <label for="title">GENDER:</label>
      <select class="form-control"  name="sgender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select></div>
    <div class="form-group">
      <label for="title">Programm:</label>
      <select class="form-control"  name="sessl">
      <option value="1">Day</option>
      <option value="4">Evening</option>
      <option value="7">Weekend</option>
  </select>
    </div>
     <div class="form-group">
      <label for="title">Email:</label>
      <input type="email" class="form-control" title="Email should be contains `@`,`.`" placeholder="Type your Email" name="email" required >
    </div>
    <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" pattern="[0-9]{10}" title="Phone number must start with 078 or 073,072 Ex: 0781234567" placeholder="Ex: 078*******" name="phone" required>
    </div>
   <input type="submit" name="ssave" class="btn btn-primary" value="SAVE" />
   </form>
    </div>
    <div id="addanouc" class="tab-pane fade">
      <div class="box-top">ADD ANNOUNCEMENT</div>

        <div class="modal-body">
         <div class="box-panel">
        <form method="POST" class="form-signin">
              <div class="form-group">
                <label for="email">Annouce for:</label>
                <select class="form-control" id="email" name="postitle">
            <option value="all">Select a Receiver</option>
            <option value="student">Students</option>
            <option value="lecture">Lecturer</option>
          </select>
              </div>
              <div class="form-group">
                  <label for="title">CLASS LEVEL:</label>
                  <select class="form-control"  name="slevel">
                  <option value="select">Select a Level</option>
                  <option value="all">All</option>
                  <option value="level 1">level 1</option>
                  <option value="level 2">level 2</option>
                  <option value="level 3">level 3</option>
             </select>
              </div>
              <div class="form-group">
                <label for="pwd">Title</label>
                <input type="text" name="tit" pattern="[a-zA-Z ]{1,50}" title="Title should be letters" class="form-control"/>
              </div>
              <div class="form-group">
                <label for="pwd">Announcement</label>
                <textarea class="form-control" id="pwd" rows="5" name="Annoucement"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="asend"><span class="glyphicon glyphicon-send"></span> SEND ANNOUNCEMENT</button>
        </form>
  </div>
  </div>
    </div>

    
           <div id="rgstlec" class="tab-pane fade">
           <div class="box-top">REGISTERED LECTURERS</div>
                <div class="row">
         <?php
          $sql = $con->prepare("SELECT * FROM lecture as l,courses as c WHERE l.lid=c.lid GROUP by c.cid");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>ID</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>COURSE</th>
               <th>LEVEL</th>
               <th>EDIT</th>
               <th>DELETE</th>
             </tr>
           </thead>
           <tbody>
           <?php
           $id=0;
         foreach ($rem as $row) {
                   $id=$id+1;
                   $lid=$row['lid'];
                   $fname=$row['fname'];
                   $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
                   $cname=$row['cname'];
                   $lev=$row['level'];
            ?>
             <tr>
               <td><?php echo $id; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td><?php echo $cname; ?></td>
               <td><?php echo $lev; ?></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="ledit" data-target="#myModal"><a href='lectureredit.php?lid=<?php echo $lid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Lecturer?');"><a href='deletestudent.php?lid=<?php echo $lid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
            
              </tr>
            
  </div>
        </div>
       
      </div>
             <?php } ?>
           </tbody>
         </table>
           </div>

         </div>

         </div>
         <div id="hod" class="tab-pane fade">
           <div class="box-top">HOD</div>
                <div class="row">
         <?php
          $sql = $con->prepare("SELECT * FROM department WHERE type=2");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>ID</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>EDIT</th>
               <th>DELETE</th>
             </tr>
           </thead>
           <tbody>
           <?php
           $id=0;
         foreach ($rem as $row) {
                  $id=$id+1;
                  $hid=$row['hid'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $id; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="hedit" data-target="#myModal"><a href='hodedit.php?hid=<?php echo $hid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This HOD?');"><a href='deletestudent.php?hid=<?php echo $hid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
            
              </tr>
            
  </div>
        </div>
       
      </div>
             <?php } ?>
           </tbody>
         </table>
           </div>

         </div>

         </div>
         <div id="registrar" class="tab-pane fade">
           <div class="box-top">REGISTRAR</div>
                <div class="row">
         <?php
          $sql = $con->prepare("SELECT * FROM registrar");
                 $sql->execute();
                 $rem=$sql->fetchAll();

                ?>
           <div class="col-sm-12">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>ID</th>
               <th>FIRSTNAME</th>
               <th>LASTNAME</th>
               <th>GENDER</th>
                <th>E-MAIL</th>
               <th>PHONE</th>
               <th>EDIT</th>
               <th>DELETE</th>
             </tr>
           </thead>
           <tbody>
           <?php
           $id=0;
         foreach ($rem as $row) {
                  $id=$id+1;
                  $rid=$row['rid'];
                   $fname=$row['fname'];
                  $lname=$row['lname'];
                   $gender=$row['gender'];
                   $email=$row['email'];
                   $tel=$row['phone'];
            ?>
             <tr>
               <td><?php echo $id; ?></td>
               <td><?php echo $fname; ?></td>
               <td><?php echo $lname; ?></td>
               <td><?php echo $gender; ?></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $tel; ?></td>
               <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='registraredit.php?rid=<?php echo $rid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
               <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Registrar?');"><a href='deletestudent.php?rid=<?php echo $rid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
            
              </tr>
            
  </div>
        </div>
       
      </div>
             <?php } ?>
           </tbody>
         </table>
           </div>

         </div>

         </div>
    <div id="lectreg" class="tab-pane fade">

          <div class="box-top">REGISTER LECTURER</div>
          <form method="POST" class="form-signin">
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="First Name should be letters" placeholder="Enter your first name" name="lfname" required>
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="Last Name should be letters" placeholder="Enter your last name" name="llname" required>
    </div>
     <div class="form-group">
      <label for="title">Course NAME:</label>
      <input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="CourseName should be letters" placeholder="Enter Course name" name="lcname" required>
    </div>
     <div class="form-group">
      <label for="title">GENDER:</label>
      <select class="form-control"  name="lgender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select></div>
   <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" pattern="[0-9]{10}" title="Phone number must start with 078 or 073,072 Ex: 0781234567" placeholder="Ex: 078*******" name="lphone" required>
    </div>
    <div class="form-group">
      <label for="title">Email:</label>
      <input type="email" class="form-control"  title="Email should contain `@`" placeholder="Ex: name@gmail.com" name="lemail">
    </div>
     <div class="form-group">
      <label for="title">Course CODE:</label>
      <input type="text" class="form-control" id="email" pattern="[A-Z0-9]{1,5}" title="caurse code should only contain two capital letters and three numbers Ex: AB123" placeholder="AB123" name="lccode" required>
    </div>

    <div class="form-group">
      <label for="title">CLASS LEVEL:</label>
      <select class="form-control"  name="llevel">
      <option value="1">level 1</option>
      <option value="2">level 2</option>
      <option value="3">level 3</option>
  </select>
    </div>

    <input type="submit" name="addlec" class="btn btn-primary" class="glyphicon glyphicon-save" value="save" />
      </form>
    </div>
    <div id="hodreg" class="tab-pane fade">

<div class="box-top">ADD NEW STAFF</div>
<form method="POST" class="form-signin">
<div class="form-group">
<label for="title">FIRST NAME:</label>
<input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="First Name should be letters" placeholder="Enter your first name" name="fname" required>
</div>
<div class="form-group">
<label for="title">LAST NAME:</label>
<input type="text" class="form-control" pattern="[a-zA-Z ]{1,50}" title="Last name should be letters" placeholder="Enter your last name" name="lname" required>
</div>
<div class="form-group">
<label for="title">GENDER:</label>
<select class="form-control"  name="gender">
<option value="Male">Male</option>
<option value="Female">Female</option>
</select></div>
<div class="form-group">
<label for="title">Telephone:</label>
<input type="text" class="form-control" pattern="[0-9]{10}" title="Phone number must start with 078 or 073,072 Ex: 0781234567" placeholder="Ex: 078*******" name="phone" required>
</div>
<div class="form-group">
<label for="title">Email:</label>
<input type="email" class="form-control"  id="email" title="Email should contain `@`,`.`" placeholder="Ex: name@gmail.com" name="email" required>
</div>

<div class="form-group">
<label for="title">ROLE:</label>
<select class="form-control"  name="type">
<option value="1">HOD</option>
<option value="2">Registrar</option>
</select>
</div>
<input type="submit" name="addhodreg" class="btn btn-primary" class="glyphicon glyphicon-save" value="save" />
</form>
</div>
  </div>
  </div>
    </div>
  </div>

<?php
   }else{
  header('Location:../index.php');
}?>
</body>
</html>
