<?php
        include("../admin/db/dbase.php");
        if(isset($_POST['claim'])){
          $fname=$_POST['fname'];
          $lname=$_POST['lname'];
          $reg=$_POST['reg'];
          $course=$_POST['course'];
          $reason=$_POST['reason'];
         
          $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
            $max_file_size = 3000 * 4496; #4MB
            $nw = 400; # image with
            $nh = 400; # image height
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            	if ( isset($_FILES['image']) ) {
            		if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
            			$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            			if (in_array($ext, $valid_exts)) {
            					$path = '../images/' . uniqid() . '.' . $ext;
            					$size = getimagesize($_FILES['image']['tmp_name']);
            
            					$x = (int) $_POST['x'];
            					$y = (int) $_POST['y'];
            					$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
            					$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
            
            					$data = file_get_contents($_FILES['image']['tmp_name']);
            					$vImg = imagecreatefromstring($data);
            					$dstImg = imagecreatetruecolor($nw, $nh);
            					imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
            					imagejpeg($dstImg, $path);
            					imagedestroy($dstImg);
                                  //storind the data in your database
                                     $sql=$con->prepare("INSERT INTO claim(regnum,ccode,lid,level,reason,status,bankslip) values('$reg','$course',(SELECT lid from courses where ccode='$course'),(SELECT level from courses where ccode='$course'),'$reason','0','$path')");
                                     $sql->execute();
                                     ?>
                                      <div class="alert alert-success">
                                      <strong>Thanks You Claim Accepted!</strong> 
                                      </div>
                                     <?php
            					     echo "<img src='$path' />";
            				} else {
            					echo 'unknown problem!';
            				}
            		} else {
            			echo 'file is too small or large';
            		}
            	} else {
            		echo 'file not set';
            	}
            } else {
            	echo 'bad request!';
            }

           echo "<meta http-equiv='refresh' content='3;url=studenthome.php'>";
            }
         ?>