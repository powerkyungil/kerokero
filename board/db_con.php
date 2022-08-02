<?php
  $db_id = "root";
  $db_pw = "";
  $db_name = "bbs";
  $db_domain = "localhost";
  $db = mysqli_connect($db_domain, $db_id, $db_pw, $db_name);

  function dbConnect($result) {
    global $db;
    return $db->query($result);
  }
?>