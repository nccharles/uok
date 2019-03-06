<?php
   session_start();
   if(isset($_SESSION['regnum'])){
include('../admin/db/dbase.php');
$regnum=$_SESSION['regnum'];
$sql = $con -> prepare("SELECT * FROM student where regnum='$regnum' limit 1");
$sql -> execute();
$event = $sql ->fetchAll();
foreach ($event as $row);
$fname=$row['fname'];
$sid=$row['sid'];
$lname=$row['lname'];
$gender=$row['gender'];
$email=$row['email'];
$regnum=$row['regnum'];
$tel=$row['phone'];
?>
<html>
<head>
	<title>STUDENT|DASHBOARD</title>
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
  background-color: #dfe6e9;
}
a {
	text-decoration: none;
}
.modal-content{
  background: linear-gradient(180deg,#833471,#2980b9,#2980b9,#833471);
  color: #fff;
}
div#header{
  width: 100%;
  height: 150px;
  background: url('../images/convas1.jpg');
  border-bottom: 12px solid #833471;
  border-top: 0px solid #833471;
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

.content{
	width: auto;
	background-color: #dfe6e9;
	padding: 1px;
  overflow: hidden;
}

.content p {
	color: #424242;
	font-size: 0.73em;
}
div#box {
  width: 60%;
  margin: 0 auto;
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
	min-height: 500px;
	background-color: #fff;
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
@media only screen and (max-width: 320px){

.content{
	margin-left: 0px;
}
}
@media only screen and (max-width: 450px){
  div#box {
  width: 100%;
  margin: 0 auto;
	margin-top: 0px;
  border-bottom: 12px solid #2980b9;
}
}
@media only screen and (min-width: 450px){
a.mobile{
	display: none;
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
  <div class="logo"><a href="#"><img src="../images/header1.png" class="img-responsive" alt="Bralirwa Logo"></a></div>
 </div>
<div id="container">
	<div class="content">
	<div id="box">
		<div class="box-top"><?php echo $lname.' '.$fname; ?></div>
		 <div class="box-panel">
		 <div class="btn-group btn-group-justified" style="height: 50%;">
   
     <ul class="nav nav-tabs">
        <li><a data-toggle="tab" class="active" href="#vmarks" aria-expanded="false">MARKS</a></li>
        <li><a data-toggle="tab" class="active" href="#chpass" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a></li>
          <?php
          $sql = $con ->prepare("SELECT COUNT(annid) as an FROM studentannoucement where sid=(SELECT sid from student WHERE regnum='$regnum') and status='0'");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['an'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#ann" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span><i class="fa fa-bell-o"></i></a></li>
            <?php }else{
             
        
         ?>

        <li><a data-toggle="tab" href="#ann" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span><i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['an']; ?></span></a></li><?php }?>
        <li><a href="stdlgout.php"><span class="glyphicon glyphicon-off"></span></a></li>
    </ul>
    <?php if(isset($_POST['claim'])){
          $fname=$_POST['fname'];
          $lname=$_POST['lname'];
          $reg=$_POST['reg'];
          $course=$_POST['course'];
          $reason=$_POST['reason'];
         
          //storind the data in your database
		  $sql=$con->prepare("INSERT INTO claim(sid,ccode,lid,level,reason,status) values('$sid','$course',(SELECT lid from courses where ccode='$course'),(SELECT level from courses where ccode='$course'),'$reason','0')");
		  $sql->execute();
		  ?>
		   <div class="alert alert-success">
		   <strong>Thanks, Your Claim was Accepted!</strong> 
		   </div>
            <?php
           echo "<meta http-equiv='refresh' content='3;url=studenthome.php'>";
            }
            ?>
  <div class="tab-content">

  <div id="vmarks" class="tab-pane fade in active">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#y1">YEAR 1</a></li>
    <li><a data-toggle="tab" href="#y2">YEAR 2</a></li>
    <li><a data-toggle="tab" href="#y3">YEAR 3</a></li>
  </ul>
  <div class="tab-content">
    <div id="y1" class="tab-pane fade in active">
        <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam)/5 as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 1' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
         ?>
               <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="collapse" data-target="#mark1">View Marks</button>

  <div id="mark1" class="collapse in active">
       <h5>THIS IS YOUR MARKS</h5>
 <table class="table table-striped">
   <thead>
      <tr>
        <th>CRSE</th>
        <th>ASS1</th>
        <th>ASS2</th>
        <th>CAT1</th>
        <th>CAT2</th>
        <th>FE</th>
        <th>TOT</th>
      </tr>
    </thead>
    <tbody>
    <?php
 foreach ($rem as $row) {
            $cname=$row['cname'];
            $ass1=$row['ass1'];
            $ass2=$row['ass2'];
            $cat1=$row['cat1'];
            $cat2=$row['cat2'];
            $exam=$row['exam'];
            $tot=$row['tot'];
 
     ?>
      <tr>
        <td><?php echo $cname; ?></td>
        <td><?php echo $ass1; ?></td>
        <td><?php echo $ass2; ?></td>
        <td><?php echo $cat1; ?></td>
        <td><?php echo $cat2; ?></td>
        <td><?php echo $exam; ?></td>
        <td><?php echo round($tot,1); ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
    <div class="panel panel-danger">
      <div class="panel-heading">AVERAGE</div>
      <div class="panel-body">
      <div class="progress">
           <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam)/5 as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 1' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
          $tot=$row['tot'];
         ?>
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($tot,1); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($tot,1); ?>%">
     <?php echo round($tot,1); ?>%
    </div>
  </div>
  </div>
    </div>
    <button type="button" class="btn btn-warning btn-sm btn-block" ><a data-toggle="tab" href="#claim">CLAIM</a></button>
  </div>

    </div>
    <div id="y2" class="tab-pane fade">
        <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam)/5 as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 2' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
         ?>
               <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="collapse" data-target="#mark2">View Marks</button>

  <div id="mark2" class="collapse">
       <h5>THIS IS YOUR MARKS</h5>
 
           <table class="table table-striped">
    <thead>
      <tr>
        <th>CRSE</th>
        <th>ASS1</th>
        <th>ASS2</th>
        <th>CAT1</th>
        <th>CAT2</th>
        <th>FE</th>
        <th>TOT</th>
      </tr>
    </thead>
    <tbody>
    <?php
 foreach ($rem as $row) {
            $cname=$row['cname'];
            $ass1=$row['ass1'];
            $ass2=$row['ass2'];
            $cat1=$row['cat1'];
            $cat2=$row['cat2'];
            $exam=$row['exam'];
            $tot=$row['tot'];
 
     ?>
      <tr>
        <td><?php echo $cname; ?></td>
        <td><?php echo $ass1; ?></td>
        <td><?php echo $ass2; ?></td>
        <td><?php echo $cat1; ?></td>
        <td><?php echo $cat2; ?></td>
        <td><?php echo $exam; ?></td>
        <td><?php echo round($tot,1); ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
    <div class="panel panel-danger">
      <div class="panel-heading">AVERAGE</div>
      <div class="panel-body">
      <div class="progress">
           <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam)/5 as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 2' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
          $tot=$row['tot'];
         ?>
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($tot,1); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($tot,1); ?>%">
     <?php echo round($tot,1); ?>%
    </div>
  </div>
  </div>
    </div>
    <button type="button" class="btn btn-warning btn-sm btn-block" ><a data-toggle="tab" href="#claim">CLAIM</a></button>
  </div>

    </div>
    <div id="y3" class="tab-pane fade">
        <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.exam from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 3' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
         ?>
               <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="collapse" data-target="#mark3">View Marks</button>

  <div id="mark3" class="collapse">
       <h5>THIS IS YOUR MARKS</h5>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>CRSE</th>
        <th>ASS1</th>
        <th>ASS2</th>
        <th>CAT1</th>
        <th>CAT2</th>
        <th>FE</th>
        <th>TOT</th>
      </tr>
    </thead>
    <tbody>
    <?php
 foreach ($rem as $row) {
            $cname=$row['cname'];
            $ass1=$row['ass1'];
            $ass2=$row['ass2'];
            $cat1=$row['cat1'];
            $cat2=$row['cat2'];
            $exam=$row['exam'];
            $tot=$row['tot'];
 
     ?>
      <tr>
        <td><?php echo $cname; ?></td>
        <td><?php echo $ass1; ?></td>
        <td><?php echo $ass2; ?></td>
        <td><?php echo $cat1; ?></td>
        <td><?php echo $cat2; ?></td>
        <td><?php echo $exam; ?></td>
        <td><?php echo $tot; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
    <div class="panel panel-danger">
      <div class="panel-heading">AVERAGE</div>
      <div class="panel-body">
      <div class="progress">
           <?php
   $sql = $con->prepare("SELECT s.regnum,s.fname,s.lname,m.level,c.cname,c.ccode,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam)/5 as tot from student as s,courses as c,marks as m where s.sid=m.sid and c.cid=m.cid and m.status='1' and m.level='level 3' and s.regnum='$regnum'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
          $tot=$row['tot'];
         ?>
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($tot,1); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($tot,1); ?>%">
     <?php echo round($tot,1); ?>%
    </div>
  </div>
  </div>
    </div>
    <button type="button" class="btn btn-warning btn-sm btn-block" ><a data-toggle="tab" href="#claim">CLAIM</a></button>
  </div>

    </div>
 
    </div>
  </div>
  <!-- Modal -->
  <div class="tab-pane fade" id="chpass" role="dialog">
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
   
          <div class="box-top">FILL REQUIRED TO CLAIM</div>
          <form method="POST" class="form-signin"  enctype="multipart/form-data">
          <div class="form-group">
      <label for="title">REG NUMBER:</label>
      <input type="text" class="form-control" id="email" name="reg" value="<?php echo $regnum; ?>" placeholder="Ex: 078*******" name="email">
    </div>
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" id="email" name="fname" value="<?php echo $fname; ?>" placeholder="Enter your first name" name="email">
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" id="email" name="lname" value="<?php echo $lname; ?>" placeholder="Enter your last name" name="email">
    </div>
    <?php
        $sql = $con->prepare("SELECT c.ccode,c.cname from courses as c,student as s,studentsesslevel as stl,sesslevel as sl,level l,marks as m where l.level=c.level and stl.seslevid=sl.seslevid and stl.Ystatus='1' and s.sid=stl.sid and c.cid=m.cid and m.status='1' and s.regnum='$regnum' group by c.ccode");
          $sql->execute();
          $rem=$sql->fetchAll();
         ?>

     <div class="form-group">
      <label for="title">Course:</label>
       <select class="form-control"  name="course">
       <?php foreach ($rem as $row) {
        $cname=$row['cname'];
        $ccode=$row['ccode'];
        ?>
        <option value="<?php echo $ccode; ?>"><?php echo $cname; ?></option>
       <?php } ?>
     </select>
    </div>
    <div class="form-group">
                <label for="pwd">Reason:</label>
                <textarea class="form-control" id="pwd" rows="5" name="reason" required></textarea>
            
                 <div class='content_picture'>

																			 </div>
        <br />
              </div>
              
             <div class="form-group">
    <input type="submit" name="claim" class="btn btn-primary btn-sm btn-block" value="CLAIM"/>
      </div>
      </form>
    </div>
    <div id="ann" class="tab-pane fade">
        <?php
            $sql=$con->prepare("SELECT a.annid,a.title,a.body,a.pdate from annoucement as a,studentannoucement as sa where a.annid=sa.annid and sa.sid=(SELECT sid from student WHERE regnum='$regnum') ORDER BY a.annid DESC");
            $sql->execute();
            $rem=$sql->fetchAll();
          foreach ($rem as $row) {
              $anid=$row['annid'];
            ?><div class="alert alert-info"  data-toggle="collapse" data-target="#d<?php echo $row['annid']; ?>">
  <strong><?php echo $row['title']; ?>.</strong><span style="float: right;color: #e50606;">posted <?php echo $row['pdate']; ?></span> 
</div>
  <div id="d<?php echo $row['annid']; ?>" class="collapse">
    Hey <?php echo $fname.", ".$row['body']; ?>
  </div>

        <?php 
        
          $sql=$con->prepare("UPDATE studentannoucement SET status='1' where sid=(SELECT sid from student WHERE regnum='$regnum') and annid='$anid'");
            $sql->execute();  
      
        } ?> 
      </form>
    </div>
  </div>
  </div>
  </div>
		</div>
	</div>

<?php }else{
  header('Location:../studentlog.php');
}?>
</body>
</html>
