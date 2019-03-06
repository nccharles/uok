<?php
        include("../admin/db/dbase.php");
        if(isset($_POST['claim'])){
          $fname=$_POST['fname'];
          $lname=$_POST['lname'];
          $reg=$_POST['reg'];
          $course=$_POST['course'];
          $reason=$_POST['reason'];
         
          //storind the data in your database
		  $sql=$con->prepare("INSERT INTO claim(regnum,ccode,lid,level,reason,status) values('$reg','$course',(SELECT lid from courses where ccode='$course'),(SELECT level from courses where ccode='$course'),'$reason','0')");
		  $sql->execute();
		  ?>
		   <div class="alert alert-success">
		   <strong>Thanks, Your Claim was Accepted!</strong> 
		   </div>
            <?php
           echo "<meta http-equiv='refresh' content='3;url=studenthome.php'>";
            }
         ?>