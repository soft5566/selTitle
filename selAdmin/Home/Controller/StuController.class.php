<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class StuController extends Controller
{
    function _initialize()
    {
        if (!session('?uloginName'))
            $this->redirect("index/index");
    }

    public function index()
    {

    }

    function add()
    {
        $spT = M('specility');
        $spname = $spT->distinct(true)->order('sp_Name')->select();

//        $spclass = $spT->distinct(true)->select();
        $this->assign('spname', $spname);
//        $this->assign('spclass', $spclass);
        $this->display();
    }

    function insertAllAction()
    {
        $allStu = $_POST['allStu'];
        $allRecord = explode("\r\n", $allStu);
        $stuTable = M('sinfo');
        foreach ($allRecord as $item) {
            if (strlen(trim($item)) != 0) {
                $Record = explode("\t", $item);

                if (sizeof($Record) == 3) {
                    $condition['s_Num'] = $Record[0];
                    $condition['s_Name'] = $Record[1];
                    $condition['s_SC'] = $Record[2];

                    $stuTable->add($condition);
                } else {
                    $info = '数据没有按照格式：<br><br>&nbsp;&nbsp;&nbsp;&nbsp;【学号 姓名 专业号】<br><br>的要求输入，不能批量导入！';
                    $url = 'javascript:history.back(-1);';
                    $this->error($info, $url, 5);
                }
            }
        }
        $url = U('Stu/addAll');
        $this->success('学生添加成功！', $url, 0);
    }

    function insertAction()
    {
        $stuNum = $_POST['InputNum'];
        $stuName = $_POST['InputName'];
        $condition['s_Num'] = $stuNum;
        $condition['s_Name'] = $stuName;
        $condition['s_Pwd'] = $_POST['InputPwd'];
        $condition['s_Sex'] = $_POST['InputSex'];
        $condition['s_Phone'] = $_POST['InputPhone'];
        $condition['s_Email'] = $_POST['InputEmail'];
        $condition['s_SC'] = $_POST['InputSC'];
        $condition['s_Datetime'] = date("Y-m-d H:i:s", time());

        $stuTable = M('sinfo');
        $result = $stuTable->where(array('s_Num' => $stuNum, 's_Name' => $stuName))->find();
        if ($result) {
            $info = '学号：' . $stuNum . '<br/>姓名：' . $stuName . '<br/>已经存在！';
            $url = 'javascript:history.back(-1);';
            $this->error($info, $url, 5);
        } else {
            try {
                $stuTable->add($condition);
                $url = U('Stu/add');
                $this->success('添加成功！', $url, 0);
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.back(-1);';
                $this->error('添加失败', $url, 5);
            }
        }
    }

    function select()
    {
        $action = $_GET['act'];
        $sn = $_GET['sn'];
        $snm = $_GET['snm'];
        $p = $_GET['p'];

        $cfg = M('config');
        $data = $cfg->where('con_key="cfg_numofpage"')->select();
        if (is_numeric($data[0]['con_value']))
            $NumOfPage = $data[0]['con_value'];
        else
            $NumOfPage = 10;
        $stuTable = M('sinfo');
        if ($action == 'all') {
            $count = $stuTable->field("selt_sinfo.*,selt_specility.sp_name")
                ->join("selt_specility on selt_sinfo.s_sc=selt_specility.sp_id")
                ->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count, $NumOfPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->setConfig('header', '第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('first', '第一页');
            $Page->setConfig('last', '最后一页');
            $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $result = $stuTable->field("selt_sinfo.*,selt_specility.sp_name")
                ->join("selt_specility on selt_sinfo.s_sc=selt_specility.sp_id")
                ->limit($Page->firstRow . "," . $Page->listRows)
                ->order('s_SC,s_num')
                ->select();
            $this->assign('result', $result);
            $this->assign('empty', '<tr class="text-center"><td colspan="10">当前无任何数据</td></tr>');
            $this->assign('page', $show);// 赋值分页输出
            $this->assign('act', 'all');
            $this->display();
        } elseif ($action == 'srh') {
            if ($sn != "")
                $str = " AND s_num like '%" . $sn . "%'";
            if ($snm != "")
                $str = $str . " AND s_Name like '%" . $snm . "%'";
            $count = $stuTable->field("selt_sinfo.*,selt_specility.sp_name")
                ->join("selt_specility ON selt_sinfo.s_sc=selt_specility.sp_id " . $str)
                ->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count, $NumOfPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->setConfig('header', '第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('first', '第一页');
            $Page->setConfig('last', '最后一页');
            $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $result = $stuTable->field("selt_sinfo.*,selt_specility.sp_name")
                ->join("selt_specility ON selt_sinfo.s_sc=selt_specility.sp_id " . $str)
                ->limit($Page->firstRow . "," . $Page->listRows)
                ->order('s_num')
                ->select();
            $this->assign('result', $result);
            $this->assign('empty', '<tr class="text-center"><td colspan="10">查询没有符合条件的数据</td></tr>');
            $this->assign('page', $show);// 赋值分页输出
            $this->assign('sn', $sn);
            $this->assign('snm', $snm);
            $this->assign('p', $p);
            $this->assign('act', 'srh');
            $this->display();
        } else {
            $url = 'javascript:history.back(-1);';
            $this->error('非法操作！', $url, 10);
        }
    }

    function modify()
    {
        if (IS_GET) {
            $act = $_GET['act'];
            $sn = $_GET['sn'];
            $snm = $_GET['snm'];
            $sid = $_GET['sid'];
            $p = $_GET['p'];

            $stuTable = M('sinfo');
            $info = $stuTable->where('s_id=' . $sid)->find();

            $spT = M('specility');
            $sp = $spT->distinct(true)->order('sp_Name')->select();

            $this->assign('sn', $sn);
            $this->assign('snm', $snm);
            $this->assign('act', $act);
            $this->assign('sid', $sid);
            $this->assign('info', $info);
            $this->assign('sp', $sp);
            $this->assign('p', $p);

            $this->display();
        }
    }

    function modifyAction()
    {
        if (IS_POST) {
            $sid = $_POST['sid'];
            $act = $_POST['act'];
            $sn = $_POST['sn'];
            $snm = $_POST['snm'];
            $p = $_POST['p'];

            $condition['s_Num'] = $_POST['InputNum'];
            $condition['s_Name'] = $_POST['InputName'];
            $condition['s_Pwd'] = $_POST['InputPwd'];
            $condition['s_Sex'] = $_POST['InputSex'];
            $condition['s_Phone'] = $_POST['InputPhone'];
            $condition['s_Email'] = $_POST['InputEmail'];
            $condition['s_SC'] = $_POST['InputSC'];
            $condition['s_Datetime'] = date("Y-m-d H:i:s", time());

            try {
                $stuTable = M('sinfo');
                $stuTable->where('s_id=' . $sid)->save($condition);
                $url = U('select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p);
                $this->success('修改成功！', $url, 0);
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.back(-1);';
                $this->error('修改失败', $url, 5);
            }
        }
    }

    //删除选题，可以批量删除，但只能删除未选题的学生
    function delete()
    {
        $act = $_GET['act'];
        $sn = $_GET['sn'];
        $snm = $_GET['snm'];
        $sid = $_GET['sid'];
        $p = $_GET['p'];

        $stuTable = M('sinfo');

        if (IS_POST) {
            $rs = M('result');
            $rsdata = $rs->getField('s_id', true);

            $str = $_POST['arrayid'];
            $sidarr = explode(',', $str);
            if ($rsdata) {
                $res = array_diff($rsdata, $sidarr);
                if ($res) {
                    $where['s_Id'] = array('in', $res);
                    $result = $stuTable->where($where)->delete();
                    if ($result > 0) {
                        $this->success('未选题的学生，全部删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                    }
                } else {
                    $url = 'javascript:history.back(-1);';
                    $this->error('学生已选题，此处不能删除！请删除选题结果后，方可删除对应的学生！', $url, 8);
                }
            } else {
                $where['s_Id'] = array('in', $sidarr);
                $result = $stuTable->where($where)->delete();
                if ($result > 0) {
                    $this->success('未选题的学生，全部删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                }
            }
        } elseif (IS_GET) {
            $rs = M('result');
            $rsdata = $rs->where('s_Id=' . $sid)->find();
            if (!$rsdata) {
                $result = $stuTable->where('s_id=' . $sid)->delete();
                if ($result > 0) {
                    $this->success('删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                }
            } else {
                $url = 'javascript:history.back(-1);';
                $this->error('此学生已经选题，不能删除！', $url, 5);
            }
        } else {
            $url = 'javascript:history.back(-1);';
            $this->error('非法请求', $url, 5);
        }
    }

    function search()
    {
        if (IS_POST) {
            $snum = trim($_POST['stunum']);
            $sname = trim($_POST['stuname']);
            $arr = array();

            if ($snum != null && $snum != '') {
                $arr['sn'] = $snum;
            }
            if ($sname != null && $sname != '') {
                $arr['snm'] = $sname;
            }

            if (!empty($arr)) {
                $arr['act'] = 'srh';
                //重定向到New模块的Category操作
                $this->redirect('Stu/select', $arr, 0, '页面跳转中...');
            }
        }
    }

    function addAll()
    {
        $this->display();
    }

}