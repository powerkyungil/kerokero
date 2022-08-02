<?php
    include "./config.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once "./head.php";?>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <?php include_once "./header.php"; ?>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <h1>웹 사이트 소개</h1>
                <p>이 웹 사이트는 PHP를 이용해 간단하게 구현한 게시판 입니다.</p>
                <p><a class="btn btn-primary btn-pull" href="list.php" role="button">게시판 바로가기</a></p>
            </div>
        </div>
    </div>
    <!--이미지 슬라이드-->
    <div class="container" style="padding-left: 0">
        <div id="carousel-example-generic" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="" width="1200" height="400" alt="First slide">
                </div>
                <div class="item">
                    <img src="" width="1200" height="400" alt="Second slide">
                </div>
                <div class="item">
                    <img src="" width="1200" height="400" alt="Third slide">
                </div>
            </div>

            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>
    </div>

    <script src="./login.js"></script>
    <script>
        /*$(function () {
            $("carousel").carousel() {
                interval: 1000;
            }
        })*/
    </script>
  </body>
</html>

