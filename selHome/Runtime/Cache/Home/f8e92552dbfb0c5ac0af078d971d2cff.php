<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电信分院毕业生选题系统操作说明页面</title>

    <link href="/selTitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .popover {
            max-width: 580px; /*取消原版的宽度限制*/
        }
    </style>
</head>
<body>
<div class="jumbotron">
    <div class="container">
        <span style="font-size: 30px;">电信分院毕业生选题系统操作说明</span>
        <span id="pop" type="button" class="btn btn-success" data-container="body" data-toggle="popover"
              data-placement="right" data-html="true"
              data-content="<span style='font-size:9px'><b><?php echo ($info['con_value']); ?>：</b><br><?php echo ($info['con_inst']); ?></span>">
            <?php if(is_array($phone)): $i = 0; $__LIST__ = $phone;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['con_inst']); ?>：<?php echo ($vo['con_value']); ?><br /><?php endforeach; endif; else: echo "" ;endif; ?>
            </span>
        <br>

        <br>
        <h4><b>第一步：</b>点击<span class="badge">登记基本信息</span>按钮。</h4>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                    <img src="/selTitle/selHome/Home/View/Index/images/1.png" alt="">
                </a>
            </div>
        </div>
        <h4><b>第二步：</b>登记基本信息，并设置密码，点击<span class="badge">确定录入</span>按钮。</h4>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                    <img src="/selTitle/selHome/Home/View/Index/images/2.png" alt="">
                </a>
            </div>
        </div>
        <h4><b>第三步：</b>输入学号和刚设置的密码，点击<span class="badge">登陆开始选题</span>按钮。</h4>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                    <img src="/selTitle/selHome/Home/View/Index/images/3.png" alt="">
                </a>
            </div>
        </div>
        <h4><b>第四步：</b>选择一个合心意的题目，点击<span class="badge">确定提交选题</span>按钮确认。</h4>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                    <img src="/selTitle/selHome/Home/View/Index/images/4.png" alt="">
                </a>
            </div>
        </div>
        <h4><b>第五步：</b>选题结束，可查看选题结果。<span class="badge">如果提示没有抢到，可以刷新选题页面，重新选题，否则不能再选！</span>。</h4>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                    <img src="/selTitle/selHome/Home/View/Index/images/5.png" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
<script src="/selTitle/js/jquery-1.11.3.min.js"></script>
<script src="/selTitle/js/bootstrap.min.js"></script>
<script>$('#pop').popover('show')</script>
</body>
</html>