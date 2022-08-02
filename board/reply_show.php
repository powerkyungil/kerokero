<?php

/*try {
  include "./db_con.php";
  $rno = $_POST['rno'];
  $insert_pw = $_POST['pw'];
  $sql = dbConnect("SELECT * FROM reply WHERE idx = '" . $rno . "' ");
  $result = $sql->fetch_array();


  if ($insert_pw == $result['pw']) {

    $return['code'] = 1;
    $row['code'] = $return['code'];
    $row['data']= "testokok";
    return $row;
  } else {

    $return['code'] = 0;
    $row['code'] = $return['code'];
    $row['data'] = "testnono";
    echo json_encode($row);
    return json_encode($row);
  }
} catch (Exception $e) {
  $return["code"] = $e->getCode();
  $return["msg"] = $e->getMessage();
}*/



include "./db_con.php";

$rno = $_POST['rno'];
$insert_pw = $_POST['pw'];
$sql = dbConnect("SELECT * FROM reply WHERE idx = '".$rno."' ");
$result = $sql->fetch_array();

if ($insert_pw == $result['pw']) {
    return 1;
} else {
    return 0;
}

?>
