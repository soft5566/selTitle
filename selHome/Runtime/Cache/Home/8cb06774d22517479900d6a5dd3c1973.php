<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电信分院毕业生选题系统</title>

    <link href="/seltitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="page-header">
    <div class="container">
        <h2>电信分院毕业生选题系统<a href="<?php echo U('Index/inst');?>" target="_blank" class="btn btn-link"><span class="label label-danger">点击查看系统操作说明</span></a></h2>
    </div>
</div>
<div class="jumbotron">
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="alert alert-danger" role="alert">
                <div class="text-center">
                    <h1><b><?php echo ($startdatetime); echo ($enddatetime); ?></b></h1><br>
                    选题时间为：
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    <span class="sr-only">Time:</span>
                    <?php echo ($starttime); ?>&nbsp;&nbsp; ——&nbsp;&nbsp;<?php echo ($endtime); ?>
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    <span class="sr-only">Time:</span>
                    <br>
                    <h2>
                        <div id="timer"></div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var time_now_server, time_now_client, time_end, time_server_client, timerID;

    time_end = new Date("<?php echo ($starttime); ?>" + ":00");//结束的时间
    time_end = time_end.getTime();

    var dateTime = new Date();
    var hh = dateTime.getHours();
    var mm = dateTime.getMinutes();
    var ss = dateTime.getSeconds();

    var yy = dateTime.getFullYear();
    var MM = dateTime.getMonth() + 1;  //因为1月这个方法返回为0，所以加1
    var dd = dateTime.getDate();

    time_now_server = new Date(yy + "/" + MM + "/" + dd + " " + hh + ":" + mm + ":" + ss);//开始的时间
    time_now_server = time_now_server.getTime();

    time_now_client = new Date();
    time_now_client = time_now_client.getTime();

    time_server_client = time_now_server - time_now_client;

    setTimeout("show_time()", 1000);

    function show_time() {
        var timer = document.getElementById("timer");
        if (!timer) {
            return;
        }
        timer.innerHTML = time_server_client;

        var time_now, time_distance, str_time;
        var int_day, int_hour, int_minute, int_second;
        var time_now = new Date();
        time_now = time_now.getTime() + time_server_client;
        time_distance = time_end - time_now;
        if (time_distance > 0) {
            int_day = Math.floor(time_distance / 86400000)
            time_distance -= int_day * 86400000;
            int_hour = Math.floor(time_distance / 3600000)
            time_distance -= int_hour * 3600000;
            int_minute = Math.floor(time_distance / 60000)
            time_distance -= int_minute * 60000;
            int_second = Math.floor(time_distance / 1000)

            if (int_hour < 10)
                int_hour = "0" + int_hour;
            if (int_minute < 10)
                int_minute = "0" + int_minute;
            if (int_second < 10)
                int_second = "0" + int_second;
            str_time = int_day + "天" + int_hour + "小时" + int_minute + "分钟" + int_second + "秒";
            timer.innerHTML = str_time;
            setTimeout("show_time()", 1000);
        }
        else {
            timer.innerHTML = "";
            //window.location.href = "<?php echo U('Index/index');?>";
            clearTimeout(timerID);
        }
    }
</script>
</body>
</html>