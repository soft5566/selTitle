<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生登记信息页面</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/selTitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function chkfrm() {
            var snum = document.getElementById("InputNum").value;
            var patrn = /^[0-9]{14}$/;
            if (!patrn.exec(snum)) {
                alert('学号14位，由数字组成！');
                document.getElementById("InputNum").focus();
                return false;
            }

            var sname = document.getElementById("InputName").value;
            var patrn = /^[\u4e00-\u9fa5]{2,10}$/;
            if (!patrn.exec(sname)) {
                alert('姓名只能是汉字，2-10个！');
                document.getElementById("InputName").focus();
                return false;
            }

            var spwd = document.getElementById("InputPwd").value;
            var patrn = /^[A-Za-z0-9]{6,16}$/;
            if (!patrn.exec(spwd)) {
                alert('密码只能是字母、数字、下划线，2-16个！');
                document.getElementById("InputPwd").focus();
                return false;
            }

            var sconpwd = document.getElementById("InputConPwd").value;
            if (spwd != sconpwd) {
                alert('密码和确认密码不一致！');
                document.getElementById("InputConPwd").focus();
                return false;
            }

            var sphone = document.getElementById("InputPhone").value;
            var sphone = sphone.replace(/\s+/g, "");
            if (sphone == "") {
                alert('电话不能为空！');
                document.getElementById("InputPhone").focus();
                return false;
            }

            var semail = document.getElementById("InputEmail").value;
            var patrn = /^[\w!#$%&'*+/=?^_`{|}~-]+(?:.[w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/;
            if (!patrn.exec(semail)) {
                alert('邮箱格式不正确！');
                document.getElementById("InputEmail").focus();
                return false;
            }

            var sspecility = document.getElementById("InputSC").value;
            if (sspecility == "SpecilityNull") {
                alert('专业必选！');
                document.getElementById("InputSC").focus();
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
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <form class="form-horizontal" method="post" action="<?php echo U('Index/insertAction');?>" onsubmit="return chkfrm()">
                <div class="form-group">
                    <label for="InputNum" class="col-sm-2 control-label">学号</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="InputNum" maxlength="14"
                               id="InputNum" value="<?php echo (session('stuNum')); ?>" placeholder="必填项，学号由14位数字组成">
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName" class="col-sm-2 control-label">姓名</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="InputName" maxlength="10"
                               id="InputName" placeholder="必填项，姓名只能是汉字，2-10个">
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputPwd" class="col-sm-2 control-label">密码</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="InputPwd" maxlength="16"
                               id="InputPwd" placeholder="必填项，设置选题登陆密码，最多16个字母和数字">
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputConPwd" class="col-sm-2 control-label">确认密码</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="InputConPwd" maxlength="16"
                               id="InputConPwd" placeholder="必填项，确认登陆密码">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">性别</label>

                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input type="radio" name="InputSex" value="男" checked>男&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                <input type="radio" name="InputSex" value="女">女
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputPhone" class="col-sm-2 control-label">电话</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="25" name="InputPhone"
                               id="InputPhone" placeholder="必填项，手机/固话都行，如：13988888888/0791-88888888">
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail" class="col-sm-2 control-label">邮箱</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" maxlength="30" name="InputEmail"
                               id="InputEmail" placeholder="必填项，填写常用邮箱">
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputSC" class="col-sm-2 control-label">专业</label>

                    <div class="col-sm-9">
                        <select class="form-control" id="InputSC" name="InputSC">
                            <option value="SpecilityNull">— 请选择 —</option>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["sp_id"]); ?>"><?php echo ($vo["sp_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                        <button type="submit" class="btn btn-primary">确定录入</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>