<?php 
 include("db/dbase.php");
  $claimid=$_GET['clid'];
          $sql = $con->prepare("SELECT s.phone,s.fname,s.regnum FROM student as s,claim as cl where cl.claimid=$claimid and s.regnum=cl.regnum and status='0'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row) {
            $telephone=$row['phone'];
            $fname=$row['fname'];
             $regnum=$row['regnum'];
            
              $data = array(    
              "sender"=>"0784603404",
              "recipients"=>$telephone,
              "message"=>"Hey ".$fname.", Twabonye ikibazo cyawe ihangane tugiye kukigaho tuzagusubiza vuba bidatinze.Urakoze kwihangana!",    
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
            
            // echo $result;
            // echo $httpcode;
            
          }
          $sms="Hey ".$fname.", Twabonye ikibazo cyawe ihangane tugiye kukigaho tuzagusubiza vuba bidatinze.Urakoze kwihangana!";
          $sq=$con->prepare("INSERT INTO annoucement(title,body,pdate) values('Feedback','$sms',now())");
          $sq->execute();
          $sql=$con->prepare("INSERT INTO studentannoucement(regnum,levid,annid,status) values((SELECT regnum from student where phone='$telephone'),(SELECT levid from studentlevel where regnum='$regnum' and Ystatus='1'),(SELECT max(annid) from annoucement limit 1),'0')");
            $sql->execute();
          $sql=$con->prepare("UPDATE claim set status='1' where claimid='$claimid'");
          try{
          $sql->execute();
          echo "<meta http-equiv='refresh' content='1;url=index.php'>";
         }catch(PDOException $e)
         {
           echo "error".$e->getMessage();
         }
 
?>