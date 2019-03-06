 <?php
        include("db/dbase.php");
        if(isset($_POST['ssave'])){
           $regnum=$_POST['regnum'];
           $fname=$_POST['fname'];
           $lname=$_POST['lname'];
           $email=$_POST['email'];
           $phone=$_POST['phone'];
           $sgender=$_POST['sgender'];

           $sql = $con ->prepare("SELECT COUNT(sid) FROM student WHERE regnum='$regnum'");
           $sql -> execute();
           $count = $sql->fetchColumn();
           if($count == "0"){
          $sql=$con->prepare("INSERT INTO student(regnum,fname,lname,gender,email,phone,password)values('$regnum','$fname','$lname','$sgender','$email','$phone','pass')");
          $sql->execute();
          $sql = $con ->prepare("SELECT COUNT(stlevid) FROM studentlevel WHERE regnum='$regnum'");
           $sql -> execute();
           $count = $sql->fetchColumn();
           if($count == "0"){
          $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','1')");
          $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }else if($count == "1"){
           $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','2')");
           $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";

         }else if($count == "2"){

          $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','3')");
          $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";

         }else{
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }
      
        }else{
         
          $sql = $con ->prepare("SELECT COUNT(stlevid) FROM studentlevel WHERE regnum='$regnum'");
           $sql -> execute();
           $count = $sql->fetchColumn();
           if($count == "0"){
          $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','1')");
          $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }else if($count == "1"){
           $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','2')");
           $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";

         }else if($count == "2"){

          $sql=$con->prepare("INSERT INTO studentlevel(regnum,levid)values('$regnum','3')");
          $sql->execute();
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";

         }else{
           header("Location:index.php");
         }

        }
      }
        if(isset($_POST['ssavec'])){
          $id=$_POST['sid'];
           $regnum=$_POST['regnum'];
           $fname=$_POST['fname'];
           $lname=$_POST['lname'];
           $email=$_POST['email'];
           $phone=$_POST['phone'];
           $sgender=$_POST['sgender'];
           $sql=$con->prepare("UPDATE student SET regnum='$regnum',fname='$fname',lname='$lname',gender='$sgender',email='$email',phone='$phone' where sid=$id");
          try{
          $sql->execute();
          echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }catch(PDOException $e)
         {
           echo "error".$e->getMessage();
         }
        }
         if(isset($_POST['asend'])){
         $pos=$_POST['postitle'];
         $ann=$_POST['Annoucement'];
         if($pos=='lecture'){
          $sql = $con->prepare("SELECT phone,fname FROM lecture");
          $sql->execute();
        }elseif($pos=='student'){
         $sql = $con->prepare("SELECT phone,fname FROM student");
          $sql->execute(); 
        }else{
        
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
          $rem=$sql->fetchAll();
          foreach ($rem as $row) {
            $telephone=$row['phone'];
            $fname=$row['fname'];
            
              $data = array(    
              "sender"=>"UOKUPDATE",
              "recipients"=>$telephone,
              "message"=>"Hey ".$fname.", ".$ann,    
            );

            $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
            
            $data = http_build_query ($data);

            $username="CharlesGeek"; 
            $password="gsschool12";
            
            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

            //execute post
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //close connection
            curl_close($ch);
          
          }
           echo "<meta http-equiv='refresh' content='1;url=index.php'>";
          }
          if (isset($_POST['upload'])){
              $ccode=$_POST['course'];

            //Import uploaded file to Database
            $file_CSV = fopen($_FILES['filename']['tmp_name'], "r");

            while (($data = fgetcsv($file_CSV, 1000, ",")) !== FALSE) {
                 $sql = $con ->prepare("SELECT COUNT(mid) from marks where regnum='$data[0]' and level=(SELECT DISTINCT(l.level) from courses as c,studentlevel as sl,level as l where c.ccode='$ccode' and l.level=c.level and sl.levid=l.levid and sl.regnum='$data[0]') and ccode='$ccode'");
                                                      $sql -> execute();
                                                      $count = $sql->fetchColumn();
                                                    if($count == "1"){
                 $im=$con->prepare("UPDATE marks SET marks='$data[1]',status='0' where regnum='$data[0]' and ccode='$ccode'");
                 $im->execute();

              }else{
                 $im=$con->prepare("INSERT into marks (ccode, regnum, marks,level,status,date_added)
              values('$ccode', (SELECT regnum FROM student where regnum='$data[0]'), '$data[1]',(SELECT DISTINCT(l.level) from courses as c,studentlevel as sl,level as l where c.ccode='$ccode' and l.level=c.level and sl.levid=l.levid and sl.regnum='$data[0]'),'0',NOW())");  
              $im->execute();
                echo "<meta http-equiv='refresh' content='0;url=lecturehome.php'>";
              }
            }

            fclose($file_CSV);

            //print "Import done";
            echo "<meta http-equiv='refresh' content='0;url=lecturehome.php'>";

            }

          
         ?>