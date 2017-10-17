<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>查看选题结果</title>

    <link href="/selTitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="page-header">
    <div class="container">
        <h2>电信分院毕业生选题系统<a href="<?php echo U('Index/inst');?>" target="_blank" class="btn btn-link"><span class="label label-danger">点击查看系统操作说明</span></a></h2>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-striped table-condensed">
                <thead>
                <tr>
                    <th class="text-center">序号</th>
                    <th class="text-center">学号</th>
                    <th class="text-center">姓名</th>
                    <th class="text-center">专业</th>
                    <th class="text-center">联系方式</th>
                    <th class="text-center">邮箱</th>
                    <th class="text-center">题号</th>
                    <th class="text-center">题目</th>
                    <th class="text-center">导师</th>
                    <th class="text-center">选题时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($resultdata)): $i = 0; $__LIST__ = $resultdata;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-center">
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($vo["s_num"]); ?></td>
                        <td><?php echo ($vo["s_name"]); ?></td>
                        <td><?php echo ($vo["sp_name"]); ?></td>
                        <td><?php echo ($vo["s_phone"]); ?></td>
                        <td><?php echo ($vo["s_email"]); ?></td>
                        <td><?php echo ($vo["c_num"]); ?></td>
                        <td><?php echo ($vo["c_title"]); ?></td>
                        <td>*****</td>
                        <td><?php echo ($vo["s_datetime"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>