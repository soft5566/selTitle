<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>跳转提示</title>

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

    <style>
        a:hover{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h2>
                <?php if(isset($message)) {?>
                    <?php echo($message); ?>
                <?php }else{?>
                    <?php echo($error); ?>
                <?php }?>
            </h2>
            <br />
            <br />
            <?php if(isset($message)) {?>
                <p>如果你的浏览器没有自动跳转，<a id="href" href="<?php echo($jumpUrl); ?>">
                    <span class="label label-success">请点击这里</span></a>
                </p>
            <?php }else{?>
                <p>如果你的浏览器没有自动跳转，<a id="href" href="<?php echo($jumpUrl); ?>">
                    <span class="label label-warning">请点击这里</span></a>
                </p>
            <?php }?>
            <br />
            <p>等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
        </div>
    </div>

    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>