<?php
  //비어있지않으면 $id = $_POST['id'] 비어있으면 $id=""
  !empty($_POST['id']) ? $id = $_POST['id'] : $id="";

  $ret['check'] = false;
  if($id != "") {
    $con = mysqli_connect("localhost", "root", "", "bbs");
    $sql = "SELECT id FROM user WHERE id= '{$id}'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0) {
      $ret['check'] = true;
    }
  }
  echo json_encode($ret);
?>
