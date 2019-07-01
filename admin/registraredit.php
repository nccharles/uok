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
  width: 60%;
  margin: 0 auto;
  height: 100%;
  background-color: #95a5a6;
  padding: 15px;
  padding-bottom: 120px;
  overflow: hidden;
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

<div id="container">
  <div class="content">
  <div id="box">
    <div class="box-top">EDIT REGISTRAR</div>
     <div class="box-panel">
     <div class="btn-group btn-group-justified" style="min-height: 80%;">
   
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

           <?php
          $id=$_GET['rid'];
          $sql = $con->prepare("SELECT * FROM registrar where rid=$id");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
           $rid=$row['rid'];
            $fname=$row['fname'];
           $lname=$row['lname'];
            $gender=$row['gender'];
            $email=$row['email'];
            $tel=$row['phone'];
         ?>
        <div class="modal-body">
        <form method="POST" class="form-signin" action="getdata.php">
         <div class="form-group">
     
      <input type="text" class="form-control" id="email" value="<?php echo $rid; ?>" name="rid" style="display: none">
     </div>
     <div class="form-group">
      <input type="text" class="form-control" id="email" pattern="[a-zA-Z ]{1,50}" title="First Name should be letters" value="<?php echo $fname; ?>" name="fname" required>
    </div>
    <div class="form-group">
      <label for="title">LAST NAME:</label>
      <input type="text" class="form-control" id="email" pattern="[a-zA-Z ]{1,50}" title="Last Name should be letters"  placeholder="Enter your last name" value="<?php echo $lname; ?>" name="lname" required>
    </div>
    <div class="form-group">
      <label for="title">GENDER:</label> 
      <select class="form-control" id="email" name="sgender" value="<?php echo $gender; ?>">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
  </select></div>
     <div class="form-group">
      <label for="title">Email:</label>
      <input type="email" class="form-control" id="email" title="Email should contain `@`" placeholder="Type your Email" name="email" value="<?php echo $email; ?>" required>
    </div>
    <div class="form-group">
      <label for="title">Password:</label>
      <input type="password" class="form-control" id="email" placeholder="set password for <?php echo $fname;?>" name="password" required>
    </div>
    <div class="form-group">
      <label for="title">Telephone:</label>
      <input type="text" class="form-control" id="email" pattern="[0-9]{10}" title="Phone number must start with 078 or 073,072 Ex: 0781234567" placeholder="Ex: 078*******" name="phone" value="<?php echo $tel; ?>" required>
    </div>
   <input type="submit" name="rsavec" class="btn btn-primary" value="SAVE CHANGES" />
   </form>
   
    </div>
        </div>
    
<?php }else{
  header('Location:../index.php');
}?>

</body>
</html>
