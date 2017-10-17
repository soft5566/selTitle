<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电信分院毕业设计选题系统后台登陆页面</title>

    <link href="/seltitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">
<style>
    a:hover {
        text-decoration: none;
    }

    .pagination {
        display: block;
        margin: 3px;
        text-align: center;
    }

    .pagination a {
        text-decoration: none;
    }

    .pagination a:hover {
        text-decoration: none;
        background-color: #337AB7;
        color: #ffffff;
    }

    .num,
    .current {
        padding: 5px 10px;
        border: 1px solid #337AB7;
        margin: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
    }

    .current {
        color: #ffffff;
        font-weight: bold;
        font-size: 16px;
        background-color: #337AB7;
    }

    .first,
    .end,
    .prev,
    .next {
        display: inline-block;
        padding: 3px;
        border: 1px solid #337AB7;
        -webkit-border-radius: 3px;
        border-radius: 3px;
    }
</style>
    <script>
        function chkform(){
            var username = document.getElementById("inputUserName").value;
            var patrn = /^[a-zA-Z0-9_]{5,16}$/;
            if(!patrn.exec(username)){
                alert('用户名只能是5-16位，由字母、数字或下划线组成！');
                return false;
            }
            var userpwd = document.getElementById("inputPassword").value;
            patrn = /^[a-zA-Z0-9_]{6,16}$/;
            if(!patrn.exec(userpwd)){
                alert('密码只能是6-16位，由字母、数字或下划线组成！');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div class="page-header">
    <div class="container">
        <h3>电信分院毕业设计选题系统<span class="badge">后台管理登陆界面</span></h3>
    </div>
</div>
<div class="jumbotron">
    <div class="container">
        <form class="form-horizontal" method="post" action="<?php echo U('login');?>" onsubmit="return chkform();">
            <div class="form-group">
                <label for="inputUserName" class="col-sm-2 col-sm-offset-2 control-label">用户名</label>
                <div class="col-sm-3">
                    <input type="text" name="UserName" title="用户名只能是5-16位，由字母、数字或下划线组成！"
                           class="form-control" id="inputUserName" placeholder="请输入用户名">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 col-sm-offset-2 control-label">密&nbsp;&nbsp;&nbsp;码</label>
                <div class="col-sm-3">
                    <input type="password" title="密码只能是6-16位，由字母、数字或下划线组成！"
                           name="UserPwd" class="form-control" id="inputPassword" placeholder="请输入密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-2">
                    <button type="submit" class="btn btn-primary"> 登&nbsp;&nbsp;陆 </button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>