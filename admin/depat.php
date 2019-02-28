<div id="rgstrd" class="tab-pane fade">
 <div class="panel panel-primary">
     <div class="panel-heading"><h5>All Student registered in Information Communication & Technology(ICT)</h5></div>
     <div class="panel-body">
   <ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#y1">YEAR 1</a></li>
   <li><a data-toggle="tab" href="#y2">YEAR 2</a></li>
   <li><a data-toggle="tab" href="#y3">YEAR 3</a></li>
 </ul>

     </div>


 <div class="tab-content">
   <div id="y1" class="tab-pane fade in active">
        <div class="row">
<?php
  $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentlevel as sl where s.regnum=sl.regnum and sl.lid=1 and sl.Ystatus='1' Group by sl.regnum");
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
       <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
       <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
     </tr>
     <?php } ?>
     <tr>
     <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
     </tr>
   </tbody>
 </table>
   </div>

 </div>

 </div>
   <div id="y2" class="tab-pane fade">
     <div class="row">
  <?php
  $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentlevel as sl where s.regnum=sl.regnum and sl.lid=2 and sl.Ystatus='1' Group by sl.regnum");
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
       <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
       <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
     </tr>
     <?php } ?>
     <tr>
     <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
     </tr>
   </tbody>
 </table>
   </div>

 </div>

   </div>
   <div id="y3" class="tab-pane fade">
     <div class="row">
   <?php
  $sql = $con->prepare("SELECT s.sid,s.regnum,s.fname,s.lname,s.gender,s.email,s.phone FROM student as s,level as l,studentlevel as sl where s.regnum=sl.regnum and sl.lid=3 and sl.Ystatus='1' Group by sl.regnum");
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
       <td> <button type="button" class="btn btn-warning" data-toggle="modal" name="sedit" data-target="#myModal"><a href='studentedit.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-edit"></span></a></button></td>
       <td><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete This Student?');"><a href='deletestudent.php?eid=<?php echo $sid;?>'><span class="glyphicon glyphicon-trash"></span></a></button></td>
     </tr>
     <?php } ?>
     <tr>
     <td colspan="8"><button type="button" class="btn btn-primary" data-toggle="tab" href="#stdtreg">ADD NEW STUDENT</span></button></td>
     </tr>
   </tbody>
 </table>
   </div>

 </div>

   </div>
 </div></div></div>
