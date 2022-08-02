<?php
  include "./db_con.php";
  include "./config.php";

  $bno = $_POST['idx'];
  $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
  $date = date('Y-m-d');
  dbConnect("
          UPDATE 
              board
          SET
              date = '".$date."',
              pw = '".$userpw."',
              title = '".$_POST['title']."',
              content = '".$_POST['content']."'
          WHERE
              idx = '".$bno."'
      ");
?>
<script>
  alert("수정되었습니다.");
</script>
<meta http-equiv="refresh" content="0; url=/board/read.php?idx=<?=$bno?>">