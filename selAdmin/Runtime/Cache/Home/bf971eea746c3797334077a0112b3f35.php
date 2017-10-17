<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加选题</title>

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
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function chkfrm() {
            var titleid = document.getElementById("titleid").value.replace(/\s+/g, "");
            var ctitle = document.getElementById("ctitle").value.replace(/\s+/g, "");
            var ctutor = document.getElementById("ctutor").value.replace(/\s+/g, "");
            var patrn = /^[a-zA-Z0-9_]{5,16}$/;
            if (titleid == "" && titleid == null) {
                alert('题目编号不能为空！');
                return false;
            }
            patrn = /^[a-zA-Z0-9_\u4e00-\u9fa5]{6,50}$/;
            if (!patrn.exec(ctitle)) {
                alert('选题题目为6-50个字符！');
                return false;
            }
            var patrn = /^[\u4e00-\u9fa5]{2,8}$/;
            if (!patrn.exec(ctutor)) {
                alert("导师姓名为2-8个汉字！");
                return false;
            }
            var cclass = document.getElementById("cclass").value;
            if (cclass == "cclassNull") {
                alert('专业类别必选！');
                document.getElementById("cclass").focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="page-header">
        <h1>电信分院毕业生选题系统<span class="label label-success">批量添加选题</span>页面
            <small>欢迎管理员 <span class="badge"><?php echo session('uloginName');?></span></small>
            <small><span class="label label-danger"><a href="<?php echo U('Manager/logout');?>" style="color: #ffffff; text-decoration: none;"
                                                       onclick="if(!confirm('确定登出？')) return false;">退出</a>
            </small>
        </h1>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="heading3">
        <h4 class="panel-title text-right">
                            <span class="collapsed" role="button" data-toggle="collapse" href="#collapse3"
                                  aria-expanded="false" aria-controls="collapse3">
                                系统管理
                            </span>
        </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse in" role="tabpane3" aria-labelledby="heading3">
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo U('Manager/index');?>">系统参数设置</a></li>
            <li class="list-group-item"><a href="<?php echo U('Manager/time');?>">选题时间设置</a></li>
            <li class="list-group-item"><a href="<?php echo U('Specility/index');?>">管理专业</a></li>
            <li class="list-group-item"><a href="<?php echo U('UserM/select');?>">管理用户</a></li>
            <li class="list-group-item"><a href="<?php echo U('UserM/viewTitle');?>">查看选题结果</a></li>
        </ul>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="heading1">
        <h4 class="panel-title text-right">
                            <span class="collapsed" role="button" data-toggle="collapse" href="#collapse1"
                                  aria-expanded="false" aria-controls="collapse1">
                                学生信息管理
                            </span>
        </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in" role="tabpane1" aria-labelledby="heading1">
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo U('Stu/select');?>?act=all">管理学生信息</a></li>
            <li class="list-group-item"><a href="<?php echo U('Stu/addAll');?>">导入学生</a>
                <a href="<?php echo U('Manager/clrspc');?>">&nbsp;&nbsp;清除空格</a>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="heading2">
        <h4 class="panel-title text-right">
                            <span role="button" data-toggle="collapse" href="#collapse2" aria-expanded="true"
                                  aria-controls="collapse2">
                                题库管理
                            </span>
        </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse in" role="tabpane2" aria-labelledby="heading2">
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo U('Title/select');?>?act=all">管理选题</a></li>
            <li class="list-group-item"><a href="<?php echo U('Title/addAll');?>">导入选题</a></li>
        </ul>
    </div>
</div>

        </div>

        <div class="col-sm-10">
            <div class="jumbotron">
                <form class="form-horizontal" method="post" action="<?php echo U('Title/insertAllAction');?>"
                      onsubmit="return chkfrm();">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" name="viewText" disabled
                                   value="题号		导师姓名		题目名称		允许人数		所剩人数		题目类别(计算机类/电子类)【说明：Excel表数据直接粘贴，不需要任何编辑！】"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="20" name="allTitle"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">批量添加</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/seltitle/js/jquery-1.11.3.min.js"></script>
<script src="/seltitle/js/bootstrap.min.js"></script>

</body>
</html>