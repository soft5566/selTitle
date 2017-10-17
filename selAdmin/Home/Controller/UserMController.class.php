<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class UserMController extends Controller
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
        $this->display();
    }

    function addAction()
    {
        if (IS_POST) {
            $data['uname'] = $_POST['username'];
            $userT = M('umanager');
            $chkUser = $userT->where('uname="' . $data['uname'] . '"')->find();
            if ($chkUser) {
                $url = 'javascript:history.go(-1);';
                $this->error('用户已经被注册！请修改用户名后重新添加！', $url, 5);
            } else {
                $data['upwd'] = md5($_POST['Pwd']);
                $data['uright'] = 0;
                try {
                    $userT->add($data);
                    $url = 'select';
                    $this->success('用户添加成功！', $url, 1);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $url = 'javascript:history.go(-1);';
                    $this->error('用户添加失败！', $url, 5);
                }
            }
        }
    }

    //显示所有用户
    function select()
    {
        $um = M('umanager');
        $result = $um->order('uright,uname')->select();
        $this->assign('result', $result);
        $this->assign('currentUser', session('uloginName'));
        $this->display();
    }

    //删除用户
    function delete()
    {
        if (IS_GET) {
            $uid = $_GET['uid'];

            $um = M('umanager');
            $current = $um->where('uid=' . $uid)->find();

            if ($current['uid'] == session('uid') && $current['uname'] == session('uloginName')) {
                $url = 'javascript:history.go(-1);';
                $this->error('当前登陆用户，不能删除！', $url, 5);
            } else {
                try {
                    $um->delete($uid);
                    $url = 'select';
                    $this->success('用户删除成功！', $url, 1);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $url = 'javascript:history.go(-1);';
                    $this->error('用户删除失败！', $url, 5);
                }
            }
        }
    }

    //读取要修改的用户信息
    function modify()
    {
        if (IS_GET) {
            $uid = $_GET['uid'];
            try {
                $um = M('umanager');
                $result = $um->where('uid=' . $uid)->find();
                $this->assign('result', $result);
                $this->assign('uid', $uid);
                $this->display();
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.go(-1);';
                $this->error('用户读取失败！', $url, 5);
            }
        }
    }

    //修改的用户信息
    function modifyAction()
    {
        if (IS_POST) {
            $data['uid'] = $_POST['uid'];
            $data['uname'] = $_POST['username'];
            $data['upwd'] = md5($_POST['Pwd']);
            $data['uright'] = 0;

            $userT = M('umanager');
            try {
                $userT->save($data);
                $url = 'select';
                $this->success('用户修改成功！', $url, 1);
            } catch (Exception $e) {
                echo $e->getMessage();
                $url = 'javascript:history.go(-1);';
                $this->error('用户修改失败！', $url, 5);
            }
        }
    }

    //显示选题结果
    function viewTitle()
    {
        $title = M();
        $sql = 'SELECT * FROM selt_result AS r,selt_sinfo AS s,selt_ctitle AS c,selt_specility AS sp '
            . 'WHERE r.s_id=s.s_id AND r.c_id=c.c_id AND sp_id=s.s_sc ORDER BY r.s_id,r_order';
        $result = $title->query($sql);

        $this->assign('result', $result);
        $this->assign('empty', '<tr class="text-center"><td colspan="10">当前无选题记录</td></tr>');
        $this->display();
    }

    //删除单个选题结果，同时对应的原题库中对应的题目所剩人数增加1
    function deleteTitle()
    {
        if (IS_GET) {
            $rid = $_GET['rid'];

            $this->deleteT($rid, true);
        }
    }

    function deleteAllTitle()
    {
        if (IS_POST) {
            $str = $_POST['arrayid'];
            $ridarr = explode(',', $str);
            $tf = false;
            foreach ($ridarr as $key => $val) {
                $tf = $this->deleteT($val, false);
                if (!$tf) {
                    break;
                }
            }
            if ($tf) {
                $url = U('UserM/viewTitle');
                $this->success('批量删除成功！', $url, 1);
            } else {
                $url = U('UserM/viewTitle');
                $this->error('批量删除失败！', $url, 1);
            }
        }
    }

    function deleteT($rid, $tf)
    {
        $rmodel = M('result');
        $selcid = $rmodel->where('r_Id=' . $rid)->find();
        $cid = $selcid['c_id'];
        $cmodel = M('ctitle');
        //启动事务
        $rmodel->startTrans();

        $deltitle = $rmodel->lock(true)->delete($rid);
        $cmodel->lock(true)->where('c_Id=' . $cid)->setInc('c_Left');
        if ($deltitle && $cmodel) {
            $rmodel->commit();
            if ($tf) {
                $url = U('UserM/viewTitle');
                $this->success('删除成功！', $url, 1);
            } else {
                return true;
            }
        } else {
            $rmodel->rollback();
            if ($tf) {
                $url = U('UserM/viewTitle');
                $this->success('删除失败！', $url, 1);
            } else {
                return false;
            }
        }
    }

}