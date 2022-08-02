<?php
  $id = $_POST['id'];
  $pass = $_POST['pass'];

  $con = mysqli_connect("localhost", "root", "", "bbs");
  $sql = "SELECT * FROM user WHERE id='$id'";

  //$con은 왜 담지?
  $result = mysqli_query($con, $sql);

  $num_match = mysqli_num_rows($result);

  if(!$num_match) {
    echo("
      <script>
        window.alert('등록되지 않은 아이디입니다!');
        //이번페이지로 이동
        history.go(-1);
      </script>
    ");
  } else {
    $row = mysqli_fetch_array($result);
    $db_pass = $row['pass'];

    mysqli_close($con);
    //post전송된 pw와 db 저장된 hash값 비교
    if(!password_verify($pass, $db_pass)) {
      echo("
        <script>
            window.alert('비밀번호가 틀립니다!');
            history.go(-1);
        </script>
      ");
      exit;
    } else {
      session_start();
      $_SESSION["userid"] = $row["id"];
      $_SESSION["username"] = $row["name"];
      $_SESSION["role"] = $row["role"];
      echo("
        <script>
            location.href = 'main.php';
        </script>
      ");
    }
  }
?>
