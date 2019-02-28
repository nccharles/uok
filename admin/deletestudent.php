<?php
        include("db/dbase.php");
         $id=$_GET['eid'];
         $sql = $con->prepare("SELECT regnum  FROM student WHERE sid='$id'");
          $sql->execute();
          $get=$sql->fetchAll();
          foreach($get as $row);
          $reg=$row['regnum'];
          $sql = $con->prepare("SELECT levid FROM studentlevel WHERE regnum='$reg' and Ystatus='1'");
          $sql->execute();
          $get=$sql->fetchAll();
          foreach($get as $row);
          $lev=$row['levid'];
          if($lev=='1'){
          $sql = $con->prepare("DELETE  FROM studentlevel WHERE regnum='$reg' and levid='1'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM student WHERE sid='$id'");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE regnum='$reg' and (levid='1' or levid='0')");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM marks WHERE regnum='$reg' and level='level 1'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM claim WHERE regnum='$reg' and level='level 1'");
          $sql->execute();
          }else if($lev=='2'){
           $sql = $con->prepare("DELETE  FROM studentlevel WHERE regnum='$reg' and levid='2'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM marks WHERE regnum='$reg' and level='level 2'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE regnum='$reg' and levid='2'");
          $sql->execute(); 
          $sql = $con->prepare("UPDATE studentlevel SET Ystatus='1' WHERE regnum='$reg' and levid='1'");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM claim WHERE regnum='$reg' and level='level 2'");
          $sql->execute();
          } else{
          $sql = $con->prepare("DELETE  FROM studentlevel WHERE regnum='$reg' and levid='3'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM marks WHERE regnum='$reg' and level='level 3'");
          $sql->execute();
          $sql = $con->prepare("DELETE  FROM studentannoucement WHERE regnum='$reg' and levid='3'");
          $sql->execute(); 
          $sql = $con->prepare("UPDATE studentlevel SET Ystatus='1' WHERE regnum='$reg' and levid='2'");
          $sql->execute(); 
          $sql = $con->prepare("DELETE  FROM claim WHERE regnum='$reg' and level='level 3'");
          $sql->execute();
          }
          header("Location:index.php");
 ?>