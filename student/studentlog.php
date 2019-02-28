<?php 
  include('../admin/db/dbase.php');
session_start();
   if(isset($_SESSION['regnum'])){
echo "<meta http-equiv='refresh' content='1;url=studenthome.php'>"; 
}else{
?>
<html>
<head>
  <title>Student Login</title>
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
}

body{
  font-family: 'time news roman';
}
a {
  text-decoration: none;
}
div#header{
  width: 100%;
  height: 150px;
  background: url('../images/convas1.jpg');
  border-bottom: 12px solid #00386d;
  border-top: 0px solid #00509b;
  padding: 12px;
  position: fixed;
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
  margin-left: 0px;
  height: 100%;
  background: url('../images/convas1.jpg');
  padding: 15px;
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
.form-control{
  min-height: 50px;
}

.content p {
  color: #424242;
  font-size: 0.73em;
}
div#box {
  margin-top: 160px;
  height: 60px;
}

div#box .box-top {
  color: #fff;
  text-shadow: 0px 1px #000;
  background-color: #000000;
  padding: 10px;
  padding-left: 15px;
  font-weight: 300;
}
div#box .box-panel{
  padding: 2px;
  background-color: transparent;
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

}
#log{
  background-color: #fff;
  min-width: 30%;
  float: right;
  border: 5px solid green;
  border-radius: 12px;
  padding: 5px;
}


  </style>

</head>
<body >

<div id="header">
  <div class="logo"><a href="#"><img src="../images/header1.png" class="img-responsive" alt="Logo"></a></div>
 </div>
<div id="container">
  <div class="content">
  <div id="box">
<div class="box-top"></div>
     <div class="box-panel">

 <?php
                          
                                    if(isset($_POST['login'])){
                                        $regnum=$_POST['reg'];
                                        $password=$_POST['psw'];
                                          $sql = $con ->prepare("SELECT COUNT(sid) FROM student WHERE regnum='$regnum' and password='$password'");
                                          $sql -> execute();
                                           $count = $sql->fetchColumn();
                                        if($count == "1"){
                                          $_SESSION['regnum'] =$regnum;
                                          echo "<meta http-equiv='refresh' content='1;url=studenthome.php'>";
                                       }else{
                                      echo "<center><div style='color:red;'><h3>FAILED TO LOGIN</h3></div></center>";
                                       }
                                        }
                                          ?>
  <form method="POST" >
  <div class="form-group">
    <label for="email">REG NUM:</label>
    <input type="text" name="reg" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="psw" class="form-control" id="pwd">
  </div>
  <div class="checkbox">
  </div>
  <input type="submit" name="login" class="btn btn-primary btn-lg btn-block" value="LOGIN"/>
</form>
 
  </div>
    </div>
  </div>

</div>
</body>
</html>
<?php } ?>
