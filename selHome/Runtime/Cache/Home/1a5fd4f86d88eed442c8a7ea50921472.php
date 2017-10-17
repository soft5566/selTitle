<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电信分院毕业生选题系统学生登陆页面</title>

    <link href="/seltitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">


    <script language="JavaScript">
        function chkform() {
            var username = document.getElementById("UserNum").value;
            var patrn = /^[0-9]{14}$/;
            if (!patrn.exec(username)) {
                alert('学号只能14数字！');
                return false;
            }
            var userpwd = document.getElementById("UserPwd").value;
            patrn = /^[a-zA-Z0-9]{6,16}$/;
            if (!patrn.exec(userpwd)) {
                alert('密码是6-16位，由字母、数字组成！');
                return false;
            }

            var Code = document.getElementById("UVerifyCode").value.replace(/\s+/g, "");
            if (Code == "") {
                alert('请输入验证码！');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div class="page-header">
    <div class="container">
        <h2>电信分院毕业生选题系统<a href="<?php echo U('Index/inst');?>" target="_blank" class="btn btn-link"><span class="label label-danger">点击查看系统操作说明</span></a></h2>
    </div>
</div>
<div class="jumbotron">
    <div class="container">
        <form method="post" action="<?php echo U('Index/login');?>" onsubmit="return chkform()">
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="form-group">
                        <label for="UserNum" class="control-label">学号</label>
                        <input type="text" name="UserNum" title="学号只能14数字！" maxlength="14"
                               class="form-control" id="UserNum" value="<?php echo (session('stuNum')); ?>"
                               placeholder="请输入14位学号">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="form-group">
                        <label for="UserPwd" class="control-label">密码</label>
                        <input type="password" title="密码是6-16位，由字母、数字组成！" maxlength="16"
                               name="UserPwd" class="form-control" id="UserPwd"
                               placeholder="密码是6-16位，由字母、数字组成！">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="form-group">
                        <label for="UVerifyCode" class="control-label">验证码</label>
                        <input type="text" name="UVerifyCode" title="输入验证码" class="form-control" id="UVerifyCode"
                               maxlength="8" placeholder="请输入下面显示的验证码">
                        <img id="verifyImg" src="/seltitle/index.php/Home/Index/verify" onClick="changeVerify()" title="点击刷新验证码"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">登陆开始选题</button>
                    </div>
                </div>
                <?php if(($_SESSION['stuNum']) == ""): ?><div class="col-sm-2">
                        <div class="form-group">
                            <a href="<?php echo U('Index/reg');?>" class="btn btn-danger">登记基本信息</a>
                        </div>
                    </div><?php endif; ?>
            </div>
        </form>
    </div>
</div>

<script language="JavaScript">
    function changeVerify() {
        var timenow = new Date().getTime();
        document.getElementById('verifyImg').src = '/seltitle/index.php/Home/Index/verify/' + timenow;
    }
</script>
</body>
</html>