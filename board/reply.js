$(function () {

    $("#rep_btn").click(function () {
        var lockcheck = $("[name='dat_lock']").is(":checked");

        if (lockcheck){
            lockcheck = 1; //1이면 비밀글
        }else {
            lockcheck = 0;
        }
        console.log(lockcheck);
        $.ajax({
            url: "reply_ok.php",
            type: "post",
            data: {
                "bno" : $(".bno").val(),
                "dat_user" : $(".dat_user").val(),
                "dat_pw" : $(".dat_pw").val(),
                "dat_lock" : lockcheck,
                "rep_con" : $(".rep_con").val()
            },
            success: function (data) {
                alert("댓글이 작성되었습니다.");
                location.reload();
            }
        });
    });

    $(".dat_del_btn").click(function () {
        $("#rep_modal_del").modal();
    })

    $(".dat_show_btn").click(function () {
        $("#rep_modal_show").modal();
    })


});
