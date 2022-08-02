<?php
  include "./db_con.php";
  $bno = $_GET['idx'];
  dbConnect("
    DELETE FROM
               board
    WHERE
        idx = '$bno'
  ");
?>
<script>
  alert("삭제되었습니다.");
</script>
<meta http-equiv="refresh" content="0; url=/board/list.php">