<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
        integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!-- <script src="js/index.js"></script> -->

    <title>首頁</title>
</head>

<body>
    <!-- 登入登出 -->
    <div>
        <div style="padding: 10px;">
            <?php session_start();
            if (!isset($_SESSION['member']))
                echo '
                    <h3>Guest</h3>
                    <a class="btn btn-info" style="position: absolute; right: 5%; top: 1%;" href="member.php">登入</a>
                ';
            else echo '
                
                    <h3>' . $_SESSION["member"] . '</h3>
                    <a class="btn btn-info" style="position: absolute; right: 1%; top: 1%;" id="logout" >登出</a>' ?>
        </div>

    </div>

    <br>

    <div>
        <div>
            <div>
                <main role="main" class="container bootdey.com">
                    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-blue rounded box-shadow">
                        <img class="mr-3" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" width="48" height="48">
                        <h1 style="padding-left:35%; font-size:5rem;">MessageBoard</h1>
                        <!-- <div class="lh-100">
                            <h5>範例</h5>
                            <h6 class="mb-0 text-white lh-100">John Doe</h6>
                            <small>Messages</small>
                        </div> -->
                    </div>

                    <div class="my-3 p-3 bg-white rounded box-shadow">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
                        <div id="msg">
                        </div>
                    </div>
                </main>
                <div>
                    <?php if (isset($_SESSION['member']))
                        echo '
                <form style="
                margin-top:5%;
                margin-left: 30%;
                margin-right: 30%;
                ">
                    <table style=" border:0; width: 800; align-content: center; margin-left: 150px;margin-right: 100px;margin-top: 50px;">
                        <tr style="background-color: cornflowerblue; align-content: center;">
                            <td colspan="2">
                                <font style="color: #FFFFFF;">輸入新留言</font>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">主題</td>
                            <td style="width: 85%;"><input type="text" id="subject" size="50" required></td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">內容</td>
                            <td style="width: 85%;"><textarea style="resize: none;" id="content" cols="51" rows="6" required></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input class="btn btn-info btn-primary"id="message" type="button" value="留言" onclick="">
                                <input class="btn btn-info btn-primary" type="reset" value="重新輸入">
                            </td>
                        </tr>
                    </table>
                </form>
                ';
                    ?>
                </div>
            </div>
            <style>
                body {
                    background: #f5f5f5
                }

                .text-white-50 {
                    color: rgba(255, 255, 255, .5);
                }

                .bg-blue {
                    background-color: #00b5ec;
                }

                .border-bottom {
                    border-bottom: 1px solid #e5e5e5;
                }

                .box-shadow {
                    box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
                }
            </style>



        </div>
    </div>
    <!-- 登出script -->
    <script>
        $(document).ready(function() {
            // get Session
            var memberId;
            $.ajax({
                type: "post",
                url: "getSession.php",
               success:function(res){
                // console.log(res);
                   memberId = res;
               } 
            })

            $.ajax({
                type: "post",
                url: "showMsg.php",
                data: {
                    msg: "1",
                },
                success: function(e) {
                    let total = JSON.parse(e);
                    console.log(total);
                    $.each(total, function(index, value) {
                        console.log(memberId);
                        if (value["memberId"] == memberId) {
                            // console.log(memberId);
                            $("#msg").append(`
                                <div class="media text-muted pt-3">
                                    <h5 class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                       <h4><strong class="d-block text-gray-dark">發文者:${value["author"]}</strong></h4>
                                       <h5>主題:${value["subject"]}</h5>
                                       <small style="margin-right=0;">${value["date"]}</small>
                                       <h5>內容:${value["content"]}</h5>
                                    </h5>
                                    <button type="button" onclick='upd(${value["id"]})'  class="btn btn-secondary">修改</button>
                                    <button type="button" onclick='del(${value["id"]})' class="btn btn-danger">刪除</button>
                                    </div>
                                    `)

                        } else {
                            // console.log(memberId);
                            $("#msg").append(`
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                       <h4><strong class="d-block text-gray-dark">發文者:${value["author"]}</strong></h4>
                                       <h5>主題:${value["subject"]}</h5>
                                       <small style="margin-right=0;">${value["date"]}</small>
                                       <h5>內容:${value["content"]}</h5>
                                    </p>
                                    </div>
                                    `)
                        }
                    })
                }
            })
        })
        function del(e){
            // console.log(e);
            $.ajax({
                type: "post",
                url: "delete.php",
                data: {
                   del: e,
                },
                success:function(e){
                    if(e=="success"){
                        swal.fire({
								type: 'success',
                                title: '留言已刪除',
                                timer:1000,
							}).then(
								function () {
									window.location.href = "index.php"
								}
							)
                    }
                }
            })
        }
        function upd(e){
            $.ajax({
                type: "post",
                url: "update.php",
                data: {
                   del: e,
                },
                success:function(e){
                    if(e=="success"){
                        swal.fire({
								type: 'success',
                                title: '留言已修改',
                                timer:1000,
							}).then(
								function () {
									window.location.href = "index.php"
								}
							)
                    }
                }
            })
        }
        $("#logout").click(function() {
            Swal.fire({
                type: 'success',
                title: '登出成功',
                text: '2秒後跳轉',
                timer: 2000
            }).then(function() {
                $.ajax({
                    type: "post",
                    url: "logout.php",
                    data: {
                        logout: "1"
                    },
                    success: function(e) {
                        if (e == "2") {
                            window.location.href = "member.php"
                        }
                    }
                })
            })
        })
        $("#message").click(function() {
            $.ajax({
                type: "post",
                url: "message.php",
                data: {
                    subject: $("#subject").val(),
                    content: $("#content").val(),
                },
                success: function(c) {
                    if (c == "success") {
                        swal.fire({
                            type: "success",
                            title: "留言成功",
                            text: "2秒後回首頁",
                            timer: 2000
                        }).then(function() {
                            window.location.href = "index.php"
                        })
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: '留言失敗',
                        }).then(function() {
                            window.location.href = "index.php"
                        })
                    }
                }
            })
        })
    </script>
</body>

</html>