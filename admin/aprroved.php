<?php 
 include("db/dbase.php");
  $coursecode=$_GET['ccode'];
   $sql=$con->prepare("SELECT COUNT(mid) FROM marks where status='0' and level='level 1'");
   $sql->execute();
   $count=$sql->fetchColumn();
   if($count>='1'){
          $sql = $con->prepare("SELECT s.phone,s.fname,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as TOT,c.cname FROM student as s,studentsesslevel as stl,courses as c,marks as m where s.sid=stl.sid and s.sid=m.sid and c.cid=m.cid and (stl.seslevid='1' or stl.seslevid='4' or stl.seslevid='7') and stl.Ystatus='1' and m.status='0' GROUP By m.exam");
          $sql->execute(); 
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $telephone=$row['phone'];
            $fname=$row['fname'];
            $marks=$row['TOT'];
            $cname=$row['cname'];
            $tot=$row['TOT'];
            if($tot>=90){
              $grade='A';
            }elseif($tot>=80){
              $grade='B';
            }elseif($tot>=70){
              $grade='C';
            }elseif($tot>=60){
              $grade='D';
            }elseif($tot>=50){
              $grade='E';
            }else{
              $grade='F';
            }
              $data = array(    
              "sender"=>"UOKUPDATE",
              "recipients"=>$telephone,
              "message"=>"Dear ".$fname.", This is Your Marks::\n".$cname.": ".$marks."\n Grade::".$grade."\n",    
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
          }  
            $sql=$con->prepare("SELECT COUNT(mid) FROM marks where status='0' and level='level 2'");
   $sql->execute();
   $count=$sql->fetchColumn();
   if($count>='1'){
          $sql = $con->prepare("SELECT s.phone,s.fname,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as TOT,c.cname FROM student as s,studentsesslevel as stl,courses as c,marks as m where s.sid=stl.sid and s.sid=m.sid and c.cid=m.cid and (stl.seslevid='2' or stl.seslevid='5' or stl.seslevid='8') and stl.Ystatus='1' and m.status='0' GROUP By m.exam");
          $sql->execute(); 
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $telephone=$row['phone'];
            $fname=$row['fname'];
            $marks=$row['TOT'];
            $cname=$row['cname'];
            $tot=$row['TOT'];
            if($tot>=90){
              $grade='A';
            }elseif($tot>=80){
              $grade='B';
            }elseif($tot>=70){
              $grade='C';
            }elseif($tot>=60){
              $grade='D';
            }elseif($tot>=50){
              $grade='E';
            }else{
              $grade='F';
            }
              $data = array(    
              "sender"=>"UOKUPDATE",
              "recipients"=>$telephone,
              "message"=>"Dear ".$fname.", This is Your Marks::\n".$cname.": ".$marks."\n Grade::".$grade."\n",    
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
          } 
            $sql=$con->prepare("SELECT COUNT(mid) FROM marks where status='0' and level='level 3'");
   $sql->execute();
   $count=$sql->fetchColumn();
   if($count>='1'){
          $sql = $con->prepare("SELECT s.phone,s.fname,m.ass1,m.ass2,m.cat1,m.cat2,m.exam,SUM(m.ass1+m.ass2+m.cat1+m.cat2+m.exam) as TOT,c.cname FROM student as s,studentsesslevel as stl,courses as c,marks as m where s.sid=stl.sid and s.sid=m.sid and c.cid=m.cid and (stl.seslevid='3' or stl.seslevid='6' or stl.seslevid='9') and stl.Ystatus='1' and m.status='0' GROUP By m.exam");
          $sql->execute(); 
          $rem=$sql->fetchAll();
          foreach ($rem as $row){
            $telephone=$row['phone'];
            $fname=$row['fname'];
            $marks=$row['TOT'];
            $cname=$row['cname'];
            $tot=$row['TOT'];
            if($tot>=90){
              $grade='A';
            }elseif($tot>=80){
              $grade='B';
            }elseif($tot>=70){
              $grade='C';
            }elseif($tot>=60){
              $grade='D';
            }elseif($tot>=50){
              $grade='E';
            }else{
              $grade='F';
            }
              $data = array(    
              "sender"=>"UOKUPDATE",
              "recipients"=>$telephone,
              "message"=>"Dear ".$fname.", This is Your Marks::\n".$cname.": ".$marks."\n Grade::".$grade."\n",    
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
          } 
           $sql=$con->prepare("UPDATE marks set status='1' where cid=(SELECT cid from courses where ccode='$coursecode')");
          try{
          $sql->execute();
         }catch(PDOException $e)
         {
           echo "error".$e->getMessage();
         }
          echo "<meta http-equiv='refresh' content='1;url=index.php'>";

?>