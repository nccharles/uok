<?php
        include("db/dbase.php");
         if($_GET['eid']){
         $id=$_GET['eid'];
          $sql = $con->prepare("SELECT seslevid FROM studentsesslevel WHERE sid=$id and Ystatus=1");
          $sql->execute();
          $get=$sql->fetchAll();
          foreach($get as $row);
          $lev=$row['seslevid'];
          $sql = $con->prepare("DELETE  FROM studentsesslevel WHERE sid=$id and seslevid=$lev");
          $sql->execute();
          if($lev==1){
          
          $sql = $con->prepare("DELETE  FROM student WHERE sid=$id");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE sid=$id");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM marks WHERE sid=$id");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM claim WHERE sid=$id");
          $sql->execute();
          }else if($lev==2){
           $sql = $con->prepare("DELETE  FROM studentsesslevel WHERE sid=$id and seslevid=2");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM marks WHERE sid=$id and level='level 2'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE sid=$id and seslevid=2");
          $sql->execute(); 
          $sql = $con->prepare("UPDATE studentsesslevel SET Ystatus='1' WHERE sid=$id and seslevid='1'");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM claim WHERE sid=$id and level='level 2'");
          $sql->execute();
          } else{
          $sql = $con->prepare("DELETE  FROM studentsesslevel WHERE sid=$id");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM marks WHERE sid=$id and level='level 3'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE sid=$id");
          $sql->execute(); 
          $sql = $con->prepare("UPDATE studentsesslevel SET Ystatus='1' WHERE sid=$id and seslevid=2");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM claim WHERE sid=$id and level='level 3'");
          $sql->execute();
          }
        }
        if($_GET['rid']){
        $id=$_GET['rid'];
        $sql = $con->prepare("DELETE  FROM registrar WHERE rid=$id");
        $sql->execute();

        }
        if($_GET['hid']){
        $id=$_GET['hid'];
        $sql = $con->prepare("DELETE  FROM department WHERE hid=$id");
        $sql->execute();

        }
        if($_GET['lid']){
                $id=$_GET['lid'];
                $sql = $con->prepare("DELETE  FROM lecture WHERE lid=$id");
                $sql->execute();
                
                }
          header("Location:index.php");
 ?>