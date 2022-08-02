<?php
  include_once "./db_con.php";

   $id = $_POST['id'];
   $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
   $name = $_POST['name'];
   $gender = $_POST['gender'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];

    dbConnect("
    INSERT
      user
    SET
      id= '$id',
      pass= '$pass',
      name= '$name',
      gender= '$gender',
      phone= '$phone',
      email= '$email'
   ");

   echo "
      <script>
          alert('회원가입이 완료 되었습니다.');
          location.href = 'main.php';
      </script>
 ";