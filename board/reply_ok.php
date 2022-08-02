<?php
  include "./db_con.php";
  include "./config.php";

  $bno = $_POST['bno'];
  $date = date('Y-m-d');
  $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
  $sql = dbConnect("
  INSERT 
    reply
  SET
    con_num = '".$bno."',
    name = '".$_POST['dat_user']."',
    pw = '".$userpw."',
    content = '".$_POST['rep_con']."',
    `date` = '".$date."',
    `lock` = '".$_POST['dat_lock']."'
  ");
?>

