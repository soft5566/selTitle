<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>选题管理</title>

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
        function chkNull() {
            var tnum = document.getElementById("Titlenum").value;
            var tname = document.getElementById("Titlename").value;
            var tnum = tnum.replace(/\s+/g, "");
            var tname = tname.replace(/\s+/g, "");
            if (tname == "" && tnum == "") {
                alert("请输入【题目名称】 或 【导师姓名】!\n\n学号、姓名不能为空白字符！");
                return false;
            }
            return true;
        }

        function checkAll() {
            var tem = "";
            var quanxuan = document.getElementById("selAll");
            var zixiang = document.getElementsByName("selItem");
            var text = document.getElementById('arrayid');

            for (var i = 0; i < zixiang.length; i++) {
                tem += zixiang[i].value + ",";
                zixiang[i].checked = quanxuan.checked;
            }
            if (quanxuan.checked)
                text.value = tem.substr(0, tem.length - 1);
            else
                text.value = "";
            itemClk();
        }

        function itemClk() {
            var quanxuan = document.getElementById("selAll");
            var zixiang = document.getElementsByName("selItem");
            var text = document.getElementById('arrayid');
            var flag = false, tag = true;
            var tem = "";
            for (var i = 0; i < zixiang.length; i++) {
                if (zixiang[i].checked) {
                    flag = true;
                    tem += zixiang[i].value + ",";
                }
                else
                    tag = false;
            }
            text.value = tem.substr(0, tem.length - 1);
            if (tag)
                quanxuan.checked = true;
            else
                quanxuan.checked = false;
            if (flag)
                document.getElementById("submit1").removeAttribute("disabled");
            else
                document.getElementById("submit1").setAttribute("disabled", "disabled");
        }

        function queren() {
            if (!confirm('删除后无法恢复！\n\n确定要删除？'))
                return false;
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="page-header">
        <h1>电信分院毕业生选题系统<span class="label label-success">管理选题</span>页面
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
            <table class="table table-hover table-striped table-condensed">
                <thead>
                <tr>
                    <td colspan="2">
                        <a href="<?php echo U('Title/add');?>" class="btn btn-danger">添加选题</a>
                    </td>
                    <td colspan="8" class="text-right">
                        <form class="form-inline" method="post" action="<?php echo U('Title/search');?>" onsubmit="return chkNull()">
                            <div class="form-group">
                                <label for="Titlenum">请输入 <span class="badge">题目名称</span></label>
                                <input type="text" id="Titlenum" name="Titlenum" class="form-control" value="<?php echo ($sn); ?>"
                                       placeholder="请输入题目名称">
                            </div>
                            <div class="form-group">
                                <label for="Titlename">或 <span class="badge">导师姓名</span></label>
                                <input type="text" id="Titlename" name="Titlename" class="form-control" value="<?php echo ($snm); ?>"
                                       placeholder="请输入导师姓名">
                            </div>
                            <button class="btn btn-primary">查询</button>
                        </form>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th class="text-center">
                        <label><input type="checkbox" id="selAll" onclick="checkAll()">全选</label>
                    </th>
                    <th class="text-center">序号</th>
                    <th class="text-center">题号</th>
                    <th class="text-center">题目</th>
                    <th class="text-center">导师</th>
                    <th class="text-center">允许选题人数</th>
                    <th class="text-center">还剩选题人数</th>
                    <th class="text-center">题目类别</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-center">
                        <td><input type="checkbox" id="selItem" name="selItem" value="<?php echo ($vo["c_id"]); ?>" onclick="itemClk()">
                        </td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($vo["c_num"]); ?></td>
                        <td><?php echo ($vo["c_title"]); ?></td>
                        <td><?php echo ($vo["c_tutor"]); ?></td>
                        <td><?php echo ($vo["c_people"]); ?></td>
                        <td><?php echo ($vo["c_left"]); ?></td>
                        <td><?php echo ($vo["c_class"]); ?></td>
                        <td>
                            <a href="<?php echo U('Title/modify');?>?cid=<?php echo ($vo["c_id"]); ?>&act=<?php echo ($act); ?>&sn=<?php echo ($sn); ?>&snm=<?php echo ($snm); ?>&p=<?php echo $_GET['p'];?>">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>&nbsp;
                            <a href="<?php echo U('Title/delete');?>?cid=<?php echo ($vo["c_id"]); ?>&act=<?php echo ($act); ?>&sn=<?php echo ($sn); ?>&snm=<?php echo ($snm); ?>&p=<?php echo $_GET['p'];?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"
                                      onclick="return queren();"></span>
                            </a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        <form method="post"
                              action="<?php echo U('Title/delete');?>?cid=<?php echo ($vo["c_id"]); ?>&act=<?php echo ($act); ?>&sn=<?php echo ($sn); ?>&snm=<?php echo ($snm); ?>&p=<?php echo $_GET['p'];?>"
                              onsubmit="return queren();">
                            <input type="hidden" name="arrayid" id="arrayid"/>
                            <button id="submit1" class="btn btn-primary" disabled>批量删除未被选的题目</button>
                        </form>
                    </td>
                    <td colspan="6">
                        <div class="pagination">
                            <?php echo ($page); ?>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script src="/seltitle/js/jquery-1.11.3.min.js"></script>
<script src="/seltitle/js/bootstrap.min.js"></script>

</body>
</html>