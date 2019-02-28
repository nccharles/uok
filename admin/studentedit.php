<?php
   session_start();
   if(isset($_SESSION['uname'])){
include('db/dbase.php');
$uname=$_SESSION['uname'];
$sql = $con -> prepare("SELECT * FROM hod where fname='$uname' limit 1");
$sql -> execute();
$event = $sql ->fetchAll();
foreach ($event as $row);
$fname=$row['fname'];
$lname=$row['lname'];
$gender=$row['gender'];
$email=$row['email'];
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
.sidebar{
  width: 250px;
  margin-top: 14px;
  background-color: #094947;
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
  background-color: #2980b9;
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
@media only screen and (max-width: 320px){
.sidebar{
  width: 100%;
  display: none;
}
.content{
  margin-left: 0px;
}
}
@media only screen and (min-width: 320px){
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
        <li><a data-toggle="tab" href="#addanouc">Send Anoucements</a></li>
            <?php
        include("db/dbase.php");
          $sql = $con ->prepare("SELECT distinct(c.ccode),COUNT(c.cname) as m,m.status FROM courses as c,marks as m WHERE m.status='0' and c.ccode=m.ccode");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['m'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#home" aria-expanded="false">Approve<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: green;"><?php echo $row['m']; ?></span></a></li>
            <?php }else{
             
        
         ?>

        <li><a data-toggle="tab" href="#home"  aria-expanded="false">Approve<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['m']; ?></span></a></li><?php }?>
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
    <li><a data-toggle="tab" href="#stdtreg">REGISTER STUDENT</a></li>
    <li><a data-toggle="tab" href="#rgstrd">VIEW REGISTERED STUDENTS</a></li>
    <li><a data-toggle="tab" href="#addanouc">ADD ANNOUCEMENT</a></li>
    <li><a data-toggle="tab" href="#lectreg">ADD LECTURER</a></li>

     <?php
          $sql = $con ->prepare("SELECT COUNT(claimid) as cl FROM claim where status='0'");
              $sql -> execute();
             $count = $sql->fetchAll();
             foreach ($count as $row);
              $num=$row['cl'];
             if($num == "0"){?>
          <li><a data-toggle="tab" href="#claim" aria-expanded="false">CLAIM<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: green;"><?php echo $row['cl']; ?></span></a></li>
            <?php }else{
             
        
         ?>

        <li><a data-toggle="tab" href="#claim" aria-expanded="false">CLAIM<i class="fa fa-bell-o"></i> <span class="badge" style="background-color: red;"><?php echo $row['cl']; ?></span></a></li><?php }?>

  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

        <div class="box-top">EDIT STUDENT</div>
           <?php
         include("db/dbase.php");
          $id=$_GET['eid'];
          $sql = $con->prepare("SELECT * FROM student where sid=$id");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
           $sid=$row['sid'];
            $regnum=$row['regnum'];
            $fname=$row['fname'];
           $lname=$row['lname'];
            $gender=$row['gender'];
            $email=$row['email'];
            $tel=$row['phone'];
         ?>
        <div class="modal-body">
        <form method="POST" class="form-signin" action="getdata.php">
         <div class="form-group">
     
      <label for="title">REG NUM:</label>
      <input type="text" class="form-control" id="email" value="<?php echo $sid; ?>" name="sid" style="display: none">
      <input type="text" class="form-control" id="email" value="<?php echo $regnum; ?>" name="regnum">
    </div>
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" id="email" value="<?php echo $fname; ?>" name="fname">
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" id="email"  placeholder="Enter your last name" value="<?php echo $lname; ?>" name="lname">
    </div>
    <div class="form-group">
      <label for="title">GENDER:</label> 
      <select class="form-control" id="email" name="sgender" value="<?php echo $gender; ?>">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select></div>
     <div class="form-group">
      <label for="title">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Type your Email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" id="email" placeholder="Ex: 078*******" name="phone" value="<?php echo $tel; ?>">
    </div>
   <input type="submit" name="ssavec" class="btn btn-primary" value="SAVE CHANGES" />
   </form>
   
    </div>
        </div>
    <div id="stdtreg" class="tab-pane fade">
     
          <div class="box-top">REGISTER STUDENT</div>
         <div class="form-group">
         <form method="POST" class="form-signin" action="getdata.php">
      <label for="title">REG NUM:</label>
      <input type="text" class="form-control" id="email" placeholder="ex: GS/2015/0527" name="regnum">
    </div>
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your first name" name="fname">
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your last name" name="lname">
    </div>
    <div class="form-group">
      <label for="title">GENDER:</label> 
      <select class="form-control" id="email" name="sgender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select></div>
    <div class="form-group">
      <label for="title">CLASS:</label> 
      <select class="form-control" id="email" name="slevel">
      <option value="leva">level 1</option>
      <option value="levb">level 2</option>
      <option value="levc">level 3</option>
  </select>
    </div>
     <div class="form-group">
      <label for="title">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Type your Email" name="email">
    </div>
    <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" id="email" placeholder="Ex: +250781234567" name="phone">
    </div>
   <input type="submit" name="ssave" class="btn btn-primary" value="SAVE" />
   </form>
   
    </div>
<!-- 
    <div id="message" class="tab-pane fade">
      
     <div class="alert alert-success">
       <strong>Success!</strong> Indicates a successful or positive action.
    </div>

    </div> -->
    <div id="addanouc" class="tab-pane fade">
      <div class="box-top">ADD ANOUCEMENT</div>

        <div class="modal-body">
         <div class="box-panel">
        <form method="POST" class="form-signin" action="getdata.php">
              <div class="form-group">
                <label for="email">Annouce for:</label>
                <select class="form-control" id="email" name="email">
            <option value="all">All</option>
            <option value="lect">Lectures</option>
            <option value="stud">Students</option>
          </select>
              <label for="email">Level:</label>
                <select class="form-control" id="email" name="email">
            <option value="all">All</option>
            <option value="leva">level 1</option>
            <option value="levb">level 2</option>
            <option value="levc">level 3</option>
          </select>
              </div>
              <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="email" placeholder="anoucement Title" name="aemail">
              </div>
              <div class="form-group">
                <label for="pwd">Annoucement</label>
                <textarea class="form-control" id="pwd" name="Annoucement"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="asend"><span class="glyphicon glyphicon-send"></span> SEND ANNOUCEMENT</button>
      </form>
  </div>
  </div>
      
    </div>

    <div id="lectreg" class="tab-pane fade">
       <div id="box">
          <div class="box-top">REGISTER LECTURER</div>
          <form method="POST" class="form-signin" action="getdata.php">
     <div class="form-group">
      <label for="title">FIRST NAME:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your first name" name="email">
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your last name" name="email">
    </div>
    <div class="form-group">
      <label for="title">CLASS:</label> 
      <select class="form-control" id="email" name="email">
      <option value="leva">level 1</option>
      <option value="levb">level 2</option>
      <option value="levc">level 3</option>
  </select>
    </div>
    <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" id="email" placeholder="Ex: +250781234567" name="email">
    </div>
    <input type="submit" class="btn btn-primary" class="glyphicon glyphicon-save" value="save" />
      </form></div>
    </div>

  </div>
  </div>
		</div>
	</div>
<?php }else{
  header('Location:../index.php');
}?>

</body>
</html>
