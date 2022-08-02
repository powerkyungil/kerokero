<?php
include_once "./config.php";
include_once "./db_con.php";

if(isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}

$category = $_GET['category'];
$search = $_GET['search'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-sacle="1">
    <title>PHP 웹 사이트</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      <?php if(!$userid) { ?>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                      aria-haspopup="true" aria-expanded="false">접속하기<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li class="active"><a href="login.php">로그인</a></li>
                      <li><a href="join.php">회원가입</a></li>
                  </ul>
              </li>
          </ul>
      <?php } else {
        $logged = $username."(".$userid.")";
        ?>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                     aria-haspopup="true" aria-expanded="false"><b><?=$logged ?></b>님의 회원관리<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="logout.php">로그아웃</a></li>
                  </ul>
              </li>
          </ul>
      <?php } ?>
    </div>
</nav>
<div class="container">
    <div id="board_area">
      <?php
      if($category == 'title') {
        $keyword = '제목';
      } else if($category == 'name') {
        $keyword = '글쓴이';
      } else {
        $keyword = '내용';
      }
      ?>
        <h1><b>'<?=$keyword?>'</b><b>'<?=$search?>'</b> 검색결과</h1><br>
        <h4>는 다음과 같습니다.</h4><br>
        <table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
            <tr>
                <th style="background-color: #eeeeee; text-align: center;">번호</th>
                <th style="background-color: #eeeeee; text-align: center;">제목</th>
                <th style="background-color: #eeeeee; text-align: center;">작성자</th>
                <th style="background-color: #eeeeee; text-align: center;">작성일</th>
                <th style="background-color: #eeeeee; text-align: center;">조회수</th>
            </tr>
          <?php
          $sql2 = dbConnect("SELECT * FROM board WHERE $category like '%{$search}%' ORDER BY idx DESC");
          $total_record = mysqli_num_rows($sql2);

          //한 페이지 보여줄 갯수
          $list = 5;

          //블록당 보여줄 페이지의 개수
          $block_cnt = 5;

          //1~5, 6~10, ... 구간을 블록으로 보는듯. ceil 인자 값을 무조건 올림처리한다. $page는 현재페이지
          $block_num = ceil($page / $block_cnt);

          //블록의 시작번호
          $block_start = (($block_num - 1) * $block_cnt) + 1;
          //블록의 마지막 번호
          $block_end = $block_start + $block_cnt - 1;

          $total_page = ceil($total_record / $list);
          if($block_end > $total_page) {
            $block_end = $total_page;
          }
          $total_block = ceil($total_page / $block_cnt);

          //현재페이지의 게시물 첫번호
          $page_start = ($page - 1) * $list;

          /*게시글 정보 가져오기, LIMIT $page_start 부터 $list(한페이지 보여줄갯수) 까지만 select*/
          $sql2 = dbConnect("SELECT * FROM board WHERE $category like '%{$search}%' ORDER BY idx DESC LIMIT $page_start, $list");

          while ($board = $sql2->fetch_array()) {
            $title = $board["title"];
            if(strlen($title)>30) {
              $title = str_replace($board["title"], mb_substr($board["title"],
                      0, 30, "utf8")."...", $board["title"]);
            }

            $sql3 = dbConnect("SELECT * FROM reply WHERE con_num='".$board['idx']."' ");
            $rep_count = mysqli_num_rows($sql3);

            ?>
              <tbody>
              <tr>
                  <td width="70"><?=$board['idx']; ?></td>
                  <td width="500">
                      <!--비밀 글 가져오기-->
                    <?php
                    $lockimg="<img src='' alt='lock' title='lock' width='18' height='18'>";
                    if($board['lock_post'] == "1") {
                      //lock_post 값이 1이면 잠금
                      ?>
                        <span class="lock_check" style="cursor:pointer; background-color: yellow;" data-idx="<?=$board['idx']?>">
                          <?=$title?><?=$lockimg?>
                        </span>
                      <?php
                    } else {
                      ?>
                        <span class="read_check" style="cursor:pointer; background-color: orange;" data-action="./read.php?idx=<?=$board['idx']?>">
                          <?=$title?>
                        </span>
                        <span style="color: blue;">[<?=$rep_count?>]</span>
                    <?php } ?>
                  </td>
                  <td width="120"><?=$board['name']; ?></td>
                  <td width="100"><?=$board['date']; ?></td>
                  <td width="100"><?=$board['hit']; ?></td>
              </tr>
              </tbody>
          <?php } ?>
        </table>
        <div id="page_num" style="text-align: center;">
          <?php
          if($page <= 1) {
            //빈값
          } else {
            echo "<a href='search_result.php?category=$category&search=$search&page=1'>처음</a>";
          }

          if($page <= 1) {
            //빈값
          } else {
            $pre = $page - 1;
            echo "<a href='search_result.php?category=$category&search=$search&page=$pre'>◀ 이전</a>";
          }

          for($i = $block_start; $i <= $block_end; $i++) {
            if($page == $i) {
              echo "<b style='font-size: 20px;'>$i</b>";
            } else {
              echo "<a href='search_result.php?category=$category&search=$search&page=$i' style='font-size: 20px;'>$i</a>";
            }
          }

          if($page >= $total_page) {
            //빈값
          } else {
            $next = $page + 1;
            echo "<a href='search_result.php?category=$category&search=$search&page=$next'>다음 ▶</a>";
          }

          if($page >= $total_page) {
            //빈값
          } else {
            echo "<a href='search_result.php?category=$category&search=$search&page=$total_page'>마지막</a>";
          }
          ?>
        </div>
        <div id="write_btn">
            <a href="write.php"><button class="btn btn-primary pull-right">글쓰기</button></a>
        </div>
        <br><br><br>
        <div id="search_box" style="text-align: center; padding-top: 50px;">
            <form action="search_result.php" method="get">
                <select name="category" style="height: 26px;>
                    <option value="title">제목</option>
                    <option value="title">제목</option>
                    <option value="name">이름</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required">
                <button class="btn btn-primary">검색</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_div">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>
                <h4 class="modal-title"><b>비밀글 입니다.</b></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="modal_form" action="./ck_read.php?idx=" data-action="./ck_read.php?idx=">
                    <p>비밀번호<input type="password" name="pw_chk" /><input type="submit" class="btn btn-primary" value="확인" /></p>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function (){
        $(".read_check").click(function (){
            var action_url = $(this).attr("data-action");
            $(location).attr("href", action_url);
        });
    });

    $(function() {
        $(".lock_check").click(function() {
            $("#modal_div").modal();
            var action_url = $("#modal_form").attr("data-action")+$(this).attr("data-idx")
            $("#modal_form").attr("action", action_url);
        });
    });

    $(function () {
        $(".read_check").click(function() {
            var action_url = $(this).attr("data-action");
            $(location).attr("href", action_url);
        });
    });
</script>
</body>
</html>


