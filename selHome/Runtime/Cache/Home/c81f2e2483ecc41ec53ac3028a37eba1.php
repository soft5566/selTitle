<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>开始选题</title>

    <link href="/selTitle/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function setid() {
            var getid = document.getElementById('titid');
            var tm = document.getElementsByName('tm');
            for (var i = 0; i < tm.length; i++) {
                if (tm[i].checked) {
                    getid.value = tm[i].value;
                    break;
                }
            }
        }

        function chksel() {
            var tm = document.getElementsByName("tm");
            var seltf = false;
            for (var i = 0; i < tm.length; i++) {
                if (tm[i].checked) {
                    seltf = true;
                }
            }
            if (!seltf) {
                alert("请选择一个题目，然后再提交！");
                return false;
            } else {
                return true;
            }
        }

        function queren() {
            if (!confirm('只有一次机会，提交后将不能再选题哦？！\n\n确定提交？！'))
                return false;
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10">
            <form method="post" action="<?php echo U('Manager/selTitleAction');?>" onsubmit="return queren()">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                    <tr>
                        <td colspan="8" class="text-center">
                            <span class="form-inline">
                                <button type="button" class="btn btn-danger" disabled>→</button>
                                <div class="form-group">
                                    <label class="sr-only" for="stuNum">学号</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">学号</div>
                                        <input type="text" class="form-control" id="stuNum" name="stuNum"
                                               value="<?php echo ($studata['s_num']); ?>" disabled placeholder="学号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="stuName">姓名</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">姓名</div>
                                        <input type="text" class="form-control" id="stuName"
                                               value="<?php echo ($studata['s_name']); ?>" disabled placeholder="姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="stuPhone">电话</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">电话</div>
                                        <input type="text" class="form-control" id="stuPhone"
                                               value="<?php echo ($studata['s_phone']); ?>" disabled placeholder="电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="stuEmail">邮箱</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">邮箱</div>
                                        <input type="text" class="form-control" id="stuEmail"
                                               value="<?php echo ($studata['s_email']); ?>" disabled placeholder="邮箱">
                                    </div>
                                </div>
                            </span>
                        </td>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <th class="text-center">选择</th>
                        <th class="text-center">序号</th>
                        <th class="text-center">题号</th>
                        <th class="text-center">题目</th>
                        <th class="text-center">导师</th>
                        <th class="text-center">允许选题人数</th>
                        <th class="text-center">还可选题人数</th>
                        <th class="text-center">题目类别</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($titledata)): $i = 0; $__LIST__ = $titledata;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-center">
                            <td>
                                <input type="radio" id="tm<?php echo ($i); ?>" name="tm" value="<?php echo ($vo["c_id"]); ?>" onclick="setid()">
                            </td>
                            <td><?php echo ($i); ?></td>
                            <td><?php echo ($vo["c_num"]); ?></td>
                            <td><?php echo ($vo["c_title"]); ?></td>
                            <td>*****</td>
                            <td><?php echo ($vo["c_people"]); ?></td>
                            <td><?php echo ($vo["c_left"]); ?></td>
                            <td><?php echo ($vo["c_class"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-center" colspan="8">
                            <input type="hidden" id="titid" name="titid">
                            <button type="submit" onclick="return chksel()" class="btn btn-danger">确定提交选题</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>

</body>
</html>