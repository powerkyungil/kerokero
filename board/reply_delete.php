<?php
  include "./config.php";
  include "./db_con.php";

  //댓글번호
  $rno = $_POST['rno'];
  $role = $_SESSION['role'];
  $sql = dbConnect("SELECT * FROM reply WHERE idx = '".$rno."' ");
  $reply = $sql->fetch_array();

  //게시판번호
  $bno = $_POST['b_no'];
  $sql2 = dbConnect("SELECT * FROM board WHERE idx = '".$bno."' ");
  $board = $sql2->fetch_array();

  $pwk = $_POST['pw']; //모달창에서 입력한 비밀번호
  $rpw = $reply['pw']; //reply 테이블에 저장된 해쉬값

  if ($role == "USER") {
      //모달비번과 db해쉬값 비교, 세션id와 댓글name비교
      if((password_verify($pwk, $rpw)) && ($userid == $reply['name'])) {
        $delete = dbConnect("DELETE FROM reply WHERE idx='".$rno."' ");
?>
      <script>
        alert("댓글이 삭제 되었습니다.");
      </script>
      <meta http-equiv="refresh" content="0; url=/board/read.php?idx=<?=$bno?>">

<?php
      } else {
?>
  <script>
    alert('본인의 댓글이 아니거나 비밀번호가 틀립니다.');
    history.back();
  </script>
<?php
      }
?>
<?php
  } else if($role == "ADMIN") {
    $delete = dbConnect("DELETE FROM reply WHERE idx='".$rno."' ");
?>
    <script>
        alert("댓글이 삭제 되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0; url=/board/read.php?idx=<?$bno?>">
<?php
  }
?>