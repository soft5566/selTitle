<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>时间管理页面</title>

    <link rel="stylesheet" type="text/css" href="/seltitle/DateTimePicker/jquery.datetimepicker.css"/>
    <!--<script src="/seltitle/DateTimePicker/jquery.js"></script>-->

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
</head>
<body>
<div class="container-fluid">
    <div class="page-header">
        <h1>电信分院毕业生选题系统<span class="label label-success">选题时间设置</span>页面
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
                <p>

                <form class="form-inline" method="post" action="<?php echo U('timeSave');?>" onsubmit="return chkdate()">
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" for="startTime">选题时间</label>
                        <input id="startTime" name="startTime" type="text" class="form-control"
                               value="<?php echo ($result[0][t_starttime]); ?>"
                               aria-describedby="startTimeStatus" readonly>
                        <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
                        <span id="startTimeStatus" class="sr-only">(startTime)</span>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" for="endTime">至</label>
                        <input id="endTime" name="endTime" type="text" class="form-control"
                               value="<?php echo ($result[0][t_endtime]); ?>"
                               aria-describedby="endTimeStatus" readonly>
                        <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
                        <span id="endTimeStatus" class="sr-only">(endTime)</span>
                    </div>
                    <input type="hidden" name="tid" value="<?php echo ($result[0][t_Id]); ?>">
                    <button type="submit" class="btn btn-primary">保存设置</button>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="/seltitle/js/jquery-1.11.3.min.js"></script>
<script src="/seltitle/js/bootstrap.min.js"></script>

<script src="/seltitle/DateTimePicker/jquery.datetimepicker.js"></script>
<script>
    $('#startTime').datetimepicker({
        lang: 'ch',           //语言选择中文
        yearStart: 2015,     //设置最小年份
        yearEnd: 2050        //设置最大年份
    });
    $('#endTime').datetimepicker({
        lang: 'ch',          //语言选择中文
        yearStart: 2015,     //设置最小年份
        yearEnd: 2050        //设置最大年份
    });
</script>
<script>
    function chkdate() {
        //得到日期值并转化成日期格式，replace(//-/g, "//")是根据验证表达式把日期转化成长日期格式，这样
        //再进行判断就好判断了
        var sDate = new Date(document.getElementById("startTime").value);
        var eDate = new Date(document.getElementById("endTime").value);
        if (sDate >= eDate) {
            alert("【开始日期】不能大于或等于【结束日期】");
            return false;
        }
        return true;
    }
</script>
</body>
</html>