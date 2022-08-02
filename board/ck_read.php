<?php
  include_once "./db_con.php";
?>

<?php
  $bno = $_GET['idx'];
  $sql = dbConnect("SELECT * FROM board WHERE idx='".$bno."' ");
  $board = $sql->fetch_array();
?>

<?php
  $bpw = $board['pw'];
  if (isset($_POST['pw_chk'])) {
    $pwk = $_POST['pw_chk'];
    if(password_verify($pwk, $bpw)) {
      $pwk == $bpw;
?>
  <script>
    location.replace("read.php?idx=<?=$board['idx']?>");
  </script>
<?php } else { ?>
  <script>
    alert('비밀번호가 틀립니다.');
  </script>
<?php }
  } ?>