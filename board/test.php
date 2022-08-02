<?php
    global $abc;

    $ttt = 111;
    $sss = "sss";
    //echo $ttt;
    //echo is_numeric($ttt);
    echo is_numeric($sss);

    if(!is_numeric($ttt)) {
        echo "숫자가 아니다";
    } else {
        echo $ttt;
    }

    echo $abc["a"];
    print_r($abc["a"]);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <title>Document</title>
</head>
<body>
<div id="bbb" style="display: none">bbbbbbbbb</div>
<div id="aaa">aaaaaaaaaaa</div>
<button type="button" onclick="button()">숨기기</button>
<button type="button" onclick="show()">보이기</button>
<script>
    function button() {
        $("#aaa").hide();
    }

    function show() {
        $("#aaa").show();
        $("#bbb").show();
    }
    console.log(<?=$abc["a"]?>);
</script>
</body>

</html>
