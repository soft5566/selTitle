<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电信分院毕业生选题系统后台管理页面</title>

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
            var cfg_numofpage_value = document.getElementById('cfg_numofpage_value').value;
            var patrn = /^[1-9]\d*$/;
            if (!patrn.exec(cfg_numofpage_value)) {
                alert('每页显示记录数，只能为正整数！');
                document.getElementById('cfg_numofpage_value').focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="page-header">
        <h1>电信分院毕业生选题系统<span class="label label-success">系统参数设置</span>页面
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
                <form class="form-horizontal" method="post" action="<?php echo U('Manager/modifyAction');?>"
                      onsubmit="return chkfrm();">
                    <div class="form-group">
                        <label class="col-sm-3 text-center">参数名</label>
                        <label class="col-sm-2 text-center">参数值</label>
                        <label class="col-sm-7 text-center">参数功能说明</label>
                    </div>
                    <?php if(is_array($datacfg)): $i = 0; $__LIST__ = $datacfg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
                            <div class="col-sm-3">
                                <input type="hidden" name="<?php echo ($vo["con_key"]); ?>_id" value="<?php echo ($vo["con_id"]); ?>">
                                <input type="text" class="form-control" name="<?php echo ($vo["con_key"]); ?>_key"
                                       maxlength="16" readonly
                                       id="<?php echo ($vo["con_key"]); ?>_key" value="<?php echo ($vo["con_key"]); ?>"
                                       placeholder="参数名，不能为空">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="<?php echo ($vo["con_key"]); ?>_value"
                                       maxlength="16" placeholder="参数值，不能为空" value="<?php echo ($vo["con_value"]); ?>">
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="<?php echo ($vo["con_key"]); ?>_inst" rows="3"
                                      placeholder="参数说明，不能为空"><?php echo ($vo["con_inst"]); ?></textarea>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-danger">确定修改配置</button>
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