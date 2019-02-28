<?php
  include('admin/db/dbase.php');
 session_start();?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login</title>


  <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $(function(){
        $('#btnload').click(function(){
            $(this).html('<img src="http://www.bba-reman.com/images/fbloader.gif"/>');
            return false;
        });

    });
</script>
<body style="background-color: #d1cfc6;">

  <div class="login-card"  style="background: url('images/convas1.jpg');margin-top:150px;">
    <div><img src="images/header1.png" alt="Logo" style="width:100%;"></div>
  <form method="POST" name="login">
    <?php

                                    if(isset($_POST['login'])){
                                        $pos=$_POST['position'];
                                        $uname=$_POST['uname'];
                                        $password=$_POST['password'];
                                        if($pos=='reg'){
                                          $sql = $con ->prepare("SELECT COUNT(rid) FROM registrar WHERE fname='$uname' and password='$password'");
                                          $sql -> execute();
                                           $count = $sql->fetchColumn();
                                        if($count == "1"){
                                          $_SESSION['uname'] =$uname;
                                           echo "<meta http-equiv='refresh' content='1;url=admin/registrar.php'>";
                                       }else{
                                      echo "<div style='color:darkred;border: 1px solid darkred;border-radius:12px;'><h4>! Invalid Username Or password</h4></div>";
                                       }

                                }
                                  elseif($pos=='hod'){
                                          $sql = $con ->prepare("SELECT COUNT(hid) FROM department WHERE fname='$uname' and password='$password'");
                                          $sql -> execute();
                                           $count = $sql->fetchColumn();
                                        if($count == "1"){
                                          $_SESSION['uname'] =$uname;
                                           echo "<meta http-equiv='refresh' content='1;url=admin/index.php'>";
                                       }else{
                                      echo "<div style='color:darkred;border: 1px solid darkred;border-radius:12px;'><h4>! Invalid Username Or password</h4></div>";
                                       }

                                }
                                  elseif($pos=='lecture'){
                                          $sql = $con ->prepare("SELECT COUNT(lid) FROM lecture WHERE fname='$uname' and password='$password'");
                                          $sql -> execute();
                                           $count = $sql->fetchColumn();
                                        if($count == "1"){
                                          $_SESSION['uname'] =$uname;
                                           echo "<meta http-equiv='refresh' content='1;url=admin/lecturehome.php'>";
                                       }else{
                                      echo "<div style='color:darkred;border: 1px solid darkred;border-radius:12px;'><h4>! Invalid Username Or password</h4></div>";
                                       }

                                }else{
                                  echo "<div style='color:darkred;border: 1px solid darkred;border-radius:12px;'><h4>! Select a User First</h4></div>";
                                }
                                        }


                                   ?>
         <select class="select"  name="position" style="width: 100%;margin-bottom: 10px;height: 44px;font-size: 16px;">
            <option value="no">Select User</option>
            <option value="hod">HOD</option>
            <option value="lecture">LECTURER</option>
            <option value="reg">REGISTRAR</option>
          </select>
    <input type="text" name="uname" placeholder="User Name">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="login"  class="login login-submit" value="login">
    <div>Are you a Student? <a href="student/studentlog.php"><span class="glyphicon glyphicon-education"></span><b>Click Here to Login</b></a></div> 
  </form>
</div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

  <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

</body>

</html>
