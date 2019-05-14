<?php
   session_start();
   error_reporting(0);
   if(isset($_SESSION['uname'])){
include('db/dbase.php');
$Lname=$_SESSION['uname'];
$sql = $con -> prepare("SELECT l.lid,l.fname,l.lname,l.email,c.cname,c.ccode FROM lecture as l,courses as c where fname='$Lname' and l.lid=c.lid limit 1");
$sql -> execute();
$event = $sql ->fetchAll();
foreach ($event as $row);
$fname=$row['fname'];
$lname=$row['lname'];
$course=$row['cname'];
$email=$row['email'];
$lecid=$row['lid'];

?>
<html>
<head>
	<title>Dashboard</title>
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
  height: 160px;
  background: url('../images/convas1.jpg');
  border-bottom: 12px solid #00386d;
  border-top: 30px solid #00509b;
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
  background: linear-gradient(180deg,#833471,#833471,#2980b9,#2980b9, #f39c12,#833471,#833471); 
}
.modal-content{
  background: rgba(40,10,0,0.3);
  color: #fff;
}
.sidebar{
  width: 250px;
  margin-top: 14px;
  background: linear-gradient(180deg,#833471,#833471,#2980b9,#2980b9, #f39c12,#833471,#833471);
  float: left;
}
.content{
  width: auto;
  margin-left: 250px;
  height: 100%;
  background-color: #95a5a6;
  padding: 15px;
  padding-bottom: 120px;
  overflow: scroll;
}
ul#nav{

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
background-color: #030303;
color: #fff;
padding-left: 30px;
text-decoration: none;
}
ul#nav li a.selected{
  background-color: #030303;
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
  background: linear-gradient(15deg,#833471,#2980b9,#2980b9, #f39c12,#833471,#833471);
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
		<li><a href="#" class="selected"><?php echo $row['lname']; ?><span> <?php echo $row['fname']; ?></span></a></li>
        <li data-toggle="modal" data-target="#chpass"><a href="#">Change Password</a></li>
        <li><a href="../logout.php">Logout</a></li>
	</ul>
	</div>
	<div class="content">
	<div id="box">
		<div class="box-top">ADMIN DASHBOARD</div>
		 <div class="box-panel">
		 <div class="btn-group btn-group-justified" style="min-height: 80%;">
   
     <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">DASHBOARD</a></li>
    <li><a data-toggle="tab" href="#stdtmarks">STUDENT MARKS</a></li>
      <?php
          $sql = $con ->prepare("SELECT COUNT(annid) as an FROM lectureannouncement where lid='$lecid' and status='0'");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['an'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#ann" aria-expanded="false">ANNOUNCEMENT<i class="fa fa-bell-o"></i></a></li>
            <?php }else{


         ?>

        <li><a data-toggle="tab" href="#ann" aria-expanded="false">ANNOUNCEMENT<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['an']; ?></span></a></li><?php } ?>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane  fade in active">
        
        <?php 
           if(isset($_POST['npass'])){
          $oldpass=$_POST['oldpass'];
          $newpass=$_POST['newpass'];
          $sql=$con->prepare("UPDATE lecture SET password='$newpass' where password='$oldpass' and fname='$Lname'");
          $sql->execute();
          ?>
           <div class="alert alert-success">
            <strong>Password was Changed!</strong>
           </div>
           
           <?php
           echo "<meta http-equiv='refresh' content='3;url=lecturehome.php'>";
      }
        if (isset($_POST['upload'])){
              $ccode=$_POST['course'];

            //Import uploaded file to Database
            $file_CSV = fopen($_FILES['filename']['tmp_name'], "r");

            while (($data = fgetcsv($file_CSV, 1000, ",")) !== FALSE) {
              if($data[1]>10){
                 ?>
           <div class="alert alert-warning">
            <strong><?php echo $data[0];?>'s Assignment Over!</strong> 10Marks!.
           </div>
           
           <?php
              }else if($data[2]>10){
                 ?>
           <div class="alert alert-warning">
            <strong><?php echo $data[0];?>'s Assignment Marks Over!</strong> 10Marks!.
           </div>
           
           <?php
              }else if($data[3]>20){
                 ?>
           <div class="alert alert-warning">
            <strong><?php echo $data[0];?>'s CAT Marks Over!</strong> 20 Marks!.
           </div>
           
           <?php
              }else if($data[4]>20){
                 ?>
           <div class="alert alert-warning">
            <strong><?php echo $data[0];?>'s CAT Marks Over!</strong> 20 Marks!.
           </div>
           
           <?php
              }else if($data[5] >40){
                  ?>
           <div class="alert alert-warning">
            <strong><?php echo $data[0];?>'s Exam marks is Over!</strong> 40Marks!.
           </div>
           
           <?php
              }else{
                 $sql = $con ->prepare("SELECT COUNT(mid) from marks where sid=(SELECT sid from student WHERE regnum='$data[0]') and level=(SELECT DISTINCT(l.level) from courses as c,studentsesslevel as stl,sesslevel as sl,level as l where c.ccode='$ccode' and l.level=c.level and stl.seslevid=sl.seslevid) and cid=(SELECT cid from courses WHERE ccode='$ccode')");
                                                      $sql -> execute();
                                                      $count = $sql->fetchColumn();
                                                    if($count == "1"){
                 $im=$con->prepare("UPDATE marks SET ass1='$data[1]',ass2='$data[2]',cat1='$data[3]',cat2='$data[4]',exam='$data[5]',status='0' where sid=(SELECT sid from student WHERE regnum='$data[0]') and cid=(SELECT cid from courses WHERE ccode='$ccode')");
                 $im->execute();

              }else{
                 $im=$con->prepare("INSERT into marks (cid, sid, ass1,ass2,cat1,cat2,exam,level,status,date_added)
              values((SELECT cid from courses WHERE ccode='$ccode'), (SELECT sid FROM student where regnum='$data[0]'), '$data[1]','$data[2]','$data[3]','$data[4]','$data[5]',(SELECT DISTINCT(l.level) from courses as c,studentsesslevel as stl,sesslevel as sl,level as l where c.ccode='$ccode' and l.level=c.level and stl.seslevid=sl.seslevid and stl.sid=(SELECT sid from student WHERE regnum='$data[0]')),'0',NOW())");  
              $im->execute();
              }
            
                ?>
           <div class="alert alert-success">
            <strong>Good!</strong>Marks was Uploaded successfull!.
           </div>
           
           <?php
            }
            //print "Import done";
        
        }
        fclose($file_CSV);
        echo "<meta http-equiv='refresh' content='4;url=lecturehome.php'>";
            }

        ?>
     <div class="page-header">
 
  <div style="width:100%;">
  
  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingOne">
      <h2 class="panel-title">
      UPLOAD STUDENT MARKS
      </h2>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
      <form  method="post" name="upload_excel" enctype="multipart/form-data">
      <div>
        <div class="col-xs-6">
         <div class="form-group">
      <label for="title">COURSE:</label> 
      <select class="form-control" id="email" name="course">
      <?php 
       $sql = $con -> prepare("SELECT l.lid,l.fname,l.lname,l.email,c.cname,c.ccode,c.level FROM lecture as l,courses as c where fname='$Lname' and l.lid=c.lid");
       $sql -> execute();
       $event = $sql ->fetchAll();
       foreach ($event as $row){
       $fname=$row['fname'];
       $lname=$row['lname'];
       $course=$row['cname'];
       $email=$row['email'];
       ?><option value="<?php echo $row['ccode']; ?>">
     <?php echo $row['cname'];?>
      </option>
<?php }?>
  </select>
    </div>
        <label>IMPORT MARKS:</label>
          <input type="file" class="form-control" multiple name="filename" id="filename">
        <br />
        <button type="submit" id="submit" class="btn btn-primary" name="upload" data-loading-text="Loading...">UPLOAD</button>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>

  </div>
  
  </div>
    </div>
    <div id="ann" class="tab-pane fade">
        <?php
            $sql=$con->prepare("SELECT la.lannid,a.annid,a.title,a.body,a.pdate from annoucement as a,lectureannouncement as la where a.annid=la.annid and la.lid='$lecid' ORDER BY a.annid DESC");
            $sql->execute();
            $rem=$sql->fetchAll();
          foreach ($rem as $row) {
              $anid=$row['annid'];
            ?><div class="alert alert-info"  data-toggle="collapse" data-target="#d<?php echo $row['lannid']; ?>">
  <strong><?php echo $row['title']; ?>.</strong><span style="float: right;color: #e50606;">posted <?php echo $row['pdate']; ?></span>
</div>
  <div id="d<?php echo $row['lannid']; ?>" class="collapse">
    Hey <?php echo $fname.", ".$row['body']; ?>
  </div>

        <?php

          $sql=$con->prepare("UPDATE lectureannouncement SET status='1' where lid='$lecid' and annid='$anid'");
            $sql->execute();

        } ?>
      </form>
    </div>
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
    <div id="stdtmarks" class="tab-pane">
          <?php
    include("db/dbase.php");
   $sql = $con->prepare("SELECT c.cname,l.fname,l.lname from lecture as l,courses as c where l.lid=c.lid and c.lid='$lecid'");
          $sql->execute();
          $rem=$sql->fetchAll();
         foreach($rem as $row){
             $course=$row['cname'];
          $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,m.level,c.cname,m.marks FROM student as s,courses as c,marks as m where s.regnum=m.regnum and c.ccode=m.ccode and c.cname='$course'");
          $sql->execute();
          $rem=$sql->fetchAll();
         ?>
    <div class="box-top"><?php echo $course; ?></div>
<table class="table table-striped">
    <thead>
      <tr>
        <th>REG No</th>
        <th>FIRSTNAME</th>
        <th>LASTNAME</th>
        <th>YEAR</th>
          <th>COURSE</th>
        <th>MARKS</th>
       
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
            $marks=$row['marks'];
            $lev=$row['level'];
    
     ?>
      <tr>
        <td><?php echo $regnum; ?></td>
        <td><?php echo $fname; ?></td>
        <td><?php echo $lname; ?></td>
        <td><?php echo $lev; ?></td>
        <td><?php echo $course; ?></td>
        <td><?php echo $marks; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
       <?php  }
  ?>
   
  </div>
		</div>
	</div>

<?php }else{
  header('Location:../index.php');
}?>
</body>
</html>
