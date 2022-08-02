<?php
include_once "./config.php";
include "./db_con.php";
include_once "./login_check.php";

$idx = $_GET['idx'];

$hit = mysqli_fetch_array(dbConnect("SELECT * FROM board WHERE idx= '" . $idx . "' "));
$hit = $hit['hit'] + 1;
dbConnect("UPDATE board SET hit = '" . $hit . "' WHERE idx = '" . $idx . "' ");

$selectOne = dbConnect("SELECT * FROM board WHERE idx= $idx");
//$result = mysqli_fetch_array($selectOne);
$result = $selectOne->fetch_array();

/*$num = mysqli_num_rows($selectOne);
while ($result = mysqli_fetch_assoc($selectOne)) {
    $title = $result['content'];
    $name = $result['content'];
    $date = $result['content'];
    $content = $result['content'];
}*/


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
    <link rel="stylesheet" href="/board/reply.css">
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
      <?php if (!$userid) { ?>
          <ul class="nav navbar-navbar-right">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                      aria-haspopup="true" aria-expanded="false">접속하기<span class="caret"></span></a>
                  <ul class="dropdwon-menu">
                      <li class="active"><a href="login.php">로그인</a></li>
                      <li><a href="join.php">회원가입</a></li>
                  </ul>
              </li>
          </ul>
      <?php } else {
        $logged = $username . "(" . $userid . ")";
        ?>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                     aria-haspopup="true" aria-expanded="false"><b><?= $logged ?></b>님의 회원관리<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="logout.php">로그아웃</a></li>
                  </ul>
              </li>
          </ul>
      <?php } ?>
    </div>
</nav>
<div class="container">
    <div id="board_read">
        <table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
            <thead>
            <tr>
                <th colspan="2" style="background-color: #eeeeee; text-align: center;">
                    <h3>게시판 글읽기</h3>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>글 제목</td>
                <td colspan="2"><?= $result['title'] ?></td>
            </tr>
            <tr>
                <td>작성자</td>
                <td colspan="2"><?= $result['name'] ?></td>
            </tr>
            <tr>
                <td>작성일자</td>
                <td colspan="2"><?= $result['date'] ?></td>
            </tr>
            <tr>
                <td>내용</td>
                <td colspan="2" style="min-height: 200px; text-align: left;"><?= $result['content'] ?></td>
            </tr>
            </tbody>
        </table>
        <a href="list.php" class="btn btn-primary">목록</a>
      <?php
      if ($userid == $result['name'] || $role == "ADMIN") {
        ?>
          <a href="update.php?idx=<?= $result['idx'] ?>" class="btn btn-primary">수정</a>
          <a href="delete.php?idx=<?= $result['idx'] ?>" class="btn btn-primary">삭제</a>
      <?php } ?>
    </div>
</div>
<div class="container">
    <div class="reply_view">
        <h3 style="padding: 10px 0 15px 0; border-bottom: 1px solid gray;">댓글목록</h3>
      <?php
      $sql3 = dbConnect("SELECT * FROM reply WHERE con_num = '" . $idx . "' ORDER BY idx DESC");
      $reply = $sql3;


      //object -> array 다른방법
      $rere = (array)$sql3;
      //                print_r($rere);
      //                print($rere);
      //                echo $rere;
      //                var_dump($rere);

      while ($reply = $sql3->fetch_array()) {
        ?>
          <div class="dat_view">
            <?php
            if ($reply['lock'] == 1) {
              ?>
                <div id="idx"><?= $reply['idx'] ?></div>
                <div><b><?= $reply['name'] ?></b></div>
                <!-- nl2br -> 문자열 중 "\n" 을 "<br>" 로 변환한다. -->
                <div class="dap_to1 comt_edit">비밀 댓글입니다.</div>
                <div class="dap_to2 comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
                <div class="rep_me dap_to"><?= $reply['date'] ?></div>
                <div class="rep_me rep_menu">
                    <a class="dat_show_btn" href="#">댓글보기</a>
                </div>

              <?php
            } else {
              ?>
                <div id="idx"><?= $reply['idx'] ?></div>
                <div><b><?= $reply['name'] ?></b></div>
                <!-- nl2br -> 문자열 중 "\n" 을 "<br>" 로 변환한다. -->
                <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
                <div class="rep_me dap_to"><?= $reply['date'] ?></div>
                <div class="rep_me rep_menu">
                    <a class="dat_del_btn" href="#">삭제</a>
                </div>
              <?php
            }
            ?>
          </div>
          <div class="modal fade" id="rep_modal_del">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"></button>
                          <h4 class="modal-title"><b>댓글 삭제</b></h4>
                      </div>
                      <div class="modal-body">
                        <?php
                        if ($role == "USER") {
                          ?>
                            <form method="post" id="modal_form" action="reply_delete.php">
                                <input type="hidden" name="rno" value="<?= $reply['idx']; ?>"/>
                                <input type="hidden" name="b_no" value="<?= $idx; ?>">
                                <p>비밀번호
                                    <input type="password" name="pw"/>
                                    <input type="submit" class="btn btn-primary" value="확인"/>
                                </p>
                            </form>
                          <?php
                        } else if ($role == "ADMIN" || $reply['name'] == $_SESSION['id']) {
                          ?>
                            <form method="post" id="modal_form2" action="reply_delete.php">
                                <input type="hidden" name="rno" value="<?= $reply['idx']; ?>"/>
                                <input type="hidden" name="b_no" value="<?= $idx; ?>">
                                <input type="hidden" name="pw" value="">
                                <p>삭제하시겠습니까?<input type="submit" class="btn btn-primary" value="확인"/></p>
                            </form>
                          <?php
                        }
                        ?>
                      </div>
                  </div>
              </div>
          </div>
      <?php } ?>

        <div class="dat_ins">
            <h3 style="border-bottom: 1px solid gray; padding: 10px 0 15px 0;">댓글작성</h3>
            <input type="hidden" name="bno" class="bno" value=<?= $idx ?>>
            <input type="hidden" name="dat_user" id="dat_user" class="dat_user" value=<?= $userid ?>>
            <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
            <!--1이면 잠금-->
            <input type="checkbox" name="dat_lock" id="dat_lock" class="dat_lock">
            <div style="margin-top: 10px;">
                <textarea name="content" class="rep_con" id="rep_con"></textarea>
                <button id="rep_btn" class="rep_btn">댓글</button>
            </div>
        </div>

        <div class="modal fade" id="rep_modal_show">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"></button>
                        <h4 class="modal-title"><b>댓글 보기</b></h4>
                    </div>
                    <div class="modal-body">

                        <!--                                      <form method="post" id="modal_form" onsubmit="datShow()">-->
                        <p>비밀번호
                            <input type="hidden" name="rno" id="rno" value="<?= $reply['idx']; ?>"/>
                            <input type="password" name="pw" id="datpw" class="dat_pw"/>
                            <input type="submit" class="btn btn-primary" id="sub_btn" value="확인"/>
                        </p>
                        <!--                                      </form>-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".dat_show_btn").click(function () {
        var idx = $("#idx").text();
        $("#rno").val(idx);
    })

    $("#sub_btn").click(function () {
        $.ajax({
            url: "./reply_show.php",
            type: "post",
            dataType : "json",
            data: {
                "rno": $("#rno").val(),
                "pw": $("#datpw").val()
            },
            success: function (data) {
                console.log(data);

// if (data.code==0){
//     console.log("test1");
// }else if (data.code==1) {
//     console.log("test2");
// } else {
//     console.log("test3");
// }
                // if (data == "true") {
                //     alert("123123");
                //     // $(".dap_to2").show();
                //     // $(".dap_to1").hide();
                // } else if(data == "false") {
                //     alert("비밀번호가 틀립니다.");
                // }

            }
        })
    })


/*    function datShow() {
        $.ajax({
            url: "./reply_show.php",
            type: "post",
            data: {
                "rno": $("#rno").val(),
                "pw": $("#datpw").val()
            },
            success: function (data) {
                console.log(data)
                // if (data == "true") {
                //     alert("123123");
                //     // $(".dap_to2").show();
                //     // $(".dap_to1").hide();
                // } else if(data == "false") {
                //     alert("비밀번호가 틀립니다.");
                // }

            }
        })

    }*/


</script>

<script src="./login.js"></script>
<script src="./reply.js"></script>
</body>
</html>