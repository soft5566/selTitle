<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class TitleController extends Controller
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
        $spT = M('ctitle');
        $cnumMax = $spT->max('c_Num');
        $spT = M('specility');
        $spclass = $spT->distinct(true)->field('sp_Classes')->select();

        $this->assign('spclass', $spclass);
        $this->assign('cnumMax', $cnumMax + 1);
        $this->display();
    }

    function insertAllAction()
    {
        $allTitle = $_POST['allTitle'];
        $allRecord = explode("\r\n", $allTitle);
        $stuTable = M('ctitle');
        foreach ($allRecord as $item) {
            if (strlen(trim($item)) != 0) {
                $Record = explode("\t", $item);

                if (sizeof($Record) == 6) {
                    $condition['c_Num'] = $Record[0];
                    $condition['c_Tutor'] = $Record[1];
                    $condition['c_Title'] = $Record[2];
                    $condition['c_People'] = $Record[3];
                    $condition['c_Left'] = $Record[4];
                    $condition['c_Class'] = $Record[5];

                    $stuTable->add($condition);
                } else {
                    $info = '数据没有按照格式：<br><br>&nbsp;&nbsp;&nbsp;&nbsp;【序号 题号 题目 导师 允许选题人数 还剩选题人数 题目类别】<br><br>的要求输入，不能批量导入！';
                    $url = 'javascript:history.back(-1);';
                    $this->error($info, $url, 5);
                }

//                如需要检查重复记录，启用下面代码
//                $result = $stuTable->where('c_Title="' . $Record[2] . '"')->find();
//                if ($result) {
//                    $info = '此题目，数据库中已经存在！';
//                    $url = 'javascript:history.back(-1);';
//                    $this->error($info, $url, 5);
//                } else {
//                    try {
//                        $stuTable->add($condition);
//                    } catch (Exception $e) {
//                        echo $e->getMessage();
////                        $url = 'javascript:history.back(-1);';
////                        $this->error('题目添加失败', $url, 50);
//                    }
//                }
            }
        }
        $url = U('Title/addAll');
        $this->success('题目添加成功！', $url, 0);
    }

    function insertAction()
    {
        $titleid = $_POST['titleid'];
        $titlename = $_POST['ctitle'];
        $ctutor = $_POST['ctutor'];
        $cpeople = $_POST['cpeople'];
        $cclass = $_POST['cclass'];

        $condition['c_Num'] = $titleid;
        $condition['c_Title'] = $titlename;
        $condition['c_Tutor'] = $ctutor;
        $condition['c_People'] = $cpeople;
        $condition['c_Left'] = $cpeople;
        $condition['c_Class'] = $cclass;

        $stuTable = M('ctitle');
        $result = $stuTable->where('c_Title="' . $titlename . '"')->find();
        if ($result) {
            $info = '此题目，数据库中已经存在！';
            $url = 'javascript:history.back(-1);';
            $this->error($info, $url, 5);
        } else {
            try {
                $stuTable->add($condition);
                $url = U('Title/add');
                $this->success('题目添加成功！', $url, 0);
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.back(-1);';
                $this->error('题目添加失败', $url, 50);
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
        $cTable = M('ctitle');
        if ($action == 'all') {
            $count = $cTable->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count, $NumOfPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->setConfig('header', '第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('first', '第一页');
            $Page->setConfig('last', '最后一页');
            $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $result = $cTable->limit($Page->firstRow . "," . $Page->listRows)
                ->order('c_num')
                ->select();
            $this->assign('result', $result);
            $this->assign('empty', '<tr class="text-center"><td colspan="10">当前无任何数据</td></tr>');
            $this->assign('page', $show);// 赋值分页输出
            $this->assign('act', 'all');
            $this->display();
        } elseif ($action == 'srh') {
            if ($sn != "")
                $str = "c_Title like '%" . $sn . "%' AND ";
            if ($snm != "")
                $str = $str . "c_Tutor like '%" . $snm . "%' AND ";
            $str = substr($str, 0, strlen($str) - 5);
            $count = $cTable->where($str)->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count, $NumOfPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->setConfig('header', '第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('first', '第一页');
            $Page->setConfig('last', '最后一页');
            $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $result = $cTable->where($str)
                ->limit($Page->firstRow . "," . $Page->listRows)
                ->order('c_num')
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
            $cid = $_GET['cid'];
            $act = $_GET['act'];
            $sn = $_GET['sn'];
            $snm = $_GET['snm'];
            $p = $_GET['p'];

            $ctitle = M('ctitle');
            $info = $ctitle->where('c_Id=' . $cid)->find();

            $spT = M('specility');
            $sp = $spT->distinct(true)->order('sp_Name')->select();

            $this->assign('sn', $sn);
            $this->assign('snm', $snm);
            $this->assign('act', $act);
            $this->assign('cid', $cid);
            $this->assign('info', $info);
            $this->assign('sp', $sp);
            $this->assign('p', $p);

            $this->display();
        }
    }

    function modifyAction()
    {
        if (IS_POST) {
            $condition['c_Id'] = $_POST['cid'];
            $condition['c_Num'] = $_POST['titleid'];
            $condition['c_Tutor'] = $_POST['ctutor'];
            $condition['c_Title'] = $_POST['ctitle'];
            $condition['c_People'] = $_POST['cpeople'];
//            $condition['c_Left'] = $_POST['cpeople'];
            $condition['c_Class'] = $_POST['cclass'];

            $act = $_POST['act'];
            $sn = $_POST['sn'];
            $snm = $_POST['snm'];
            $p = $_POST['p'];

            try {
                $ctitleTable = M('ctitle');
                $result = $ctitleTable->save($condition);

                if ($result) {
                    $url = U('select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p);
                    $this->success('题目修改成功！', $url, 0);
                } else {
                    $url = 'javascript:history.back(-1);';
                    $this->error('题目修改失败', $url, 5);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.back(-1);';
                $this->error('语句出错，题目修改失败', $url, 5);
            }
        }
    }

    function delete()
    {
        $cid = $_GET['cid'];
        $act = $_GET['act'];
        $sn = $_GET['sn'];
        $snm = $_GET['snm'];
        $p = $_GET['p'];

        $ctitleTable = M('ctitle');
        if (IS_POST) {
            $rs = M('result');
            $rsdata = $rs->getField('c_id', true);

            $str = $_POST['arrayid'];
            $cidarr = explode(',', $str);
            if ($rsdata) {
                $res = array_diff($cidarr, $rsdata);
                if ($res) {
                    $where['c_Id'] = array('in', $res);
                    $result = $ctitleTable->where($where)->delete();
                    if ($result > 0) {
                        $this->success('未被选的题目，全部删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                    }
                } else {
                    $url = 'javascript:history.back(-1);';
                    $this->error('题目已被选，此处不能删除！请删除选题结果后，方可删除对应的题目！', $url, 8);
                }
            } else {
                $where['c_Id'] = array('in', $cidarr);
                $result = $ctitleTable->where($where)->delete();
                if ($result > 0) {
                    $this->success('未被选的题目，全部删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                }
            }
        } elseif (IS_GET) {
            $rs = M('result');
            $rsdata = $rs->where('c_Id=' . $cid)->find();
            if (!$rsdata) {
                $result = $ctitleTable->where('c_Id=' . $cid)->delete();
                if ($result > 0) {
                    $this->success('删除成功', 'select?act=' . $act . '&sn=' . $sn . '&snm=' . $snm . '&p=' . $p, 1);
                }
            } else {
                $url = 'javascript:history.back(-1);';
                $this->error('此题已经被选，不能删除！', $url, 5);
            }
        } else {
            $url = 'javascript:history.back(-1);';
            $this->error('非法请求', $url, 5);
        }
    }

    function search()
    {
        if (IS_POST) {
            $snum = trim($_POST['Titlenum']);
            $sname = trim($_POST['Titlename']);
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
                $this->redirect('Title/select', $arr, 0, '页面跳转中...');
            }
        }
    }

    function import()
    {
        $this->display();
    }

    function importExcel()
    {

    }

}