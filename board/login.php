<?php

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-sacle="1">
    <title>PHP 웹 사이트</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="login.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="main.php">PHP 게시판 웹 사이트</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="main.php">메인</a></li>
          <li><a href="list.php">게시판</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">접속하기<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="active"><a href="login.php">로그인</a></li>
              <li><a href="join.php">회원가입</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <div class="jumbotron" style="padding-top: 20px;">
          <form name="loginSbmt" id="loginSbmt" method="post" action="login_ok.php">
            <h3 style="text-align: center">로그인 화면</h3>
            <div class="col-lg-4"></div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="아이디" name="id" maxlength="15">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="비밀번호" name="pass" maxlength="20">
            </div>
            <a href="#"><span class="btn btn-primary form-control" onclick="check_input()">로그인</span></a>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>


