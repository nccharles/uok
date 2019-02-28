<?php
try{
  $con = new PDO ("mysql:host=localhost;dbname=claim","root","");
}catch(PDOException $e)
{
  echo "error".$e->getMessage();
}

?>
