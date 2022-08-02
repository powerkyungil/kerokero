<?php
  include "./config.php";
  include "./db_con.php";

  $name = $userid;
  $date = date('Y-m-d');
  $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  if(isset($_POST['lockpost'])) {
      $lo_post = '1';
  } else {
      $lo_post = '0';
  }


  dbConnect("
    INSERT
      board
   SET
      name = '".$name."',
      pw = '".$userpw."',
      title = '".$title."',
      content = '".$content."',
      date = '".$date."',
      lock_post = '".$lo_post."'
  ");

  dbConnect("
    ALTER TABLE board AUTO_INCREMENT = 1
  ");
?>
<script>
  alert("글쓰기 완료되었습니다.");
  location.href = 'list.php';
</script>
