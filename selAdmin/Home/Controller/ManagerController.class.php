<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class ManagerController extends Controller
{
    function _initialize()
    {
        if (!session('?uloginName'))
            $this->redirect("index/index");
    }

    public function index()
    {
        $config = M('config');
        $datacfg = $config->select();

        $this->assign('datacfg', $datacfg);
        $this->display();
    }

    public function logout()
    {
        session('[destroy]');
        $this->redirect("index/index");
    }

    function time()
    {
        $time = M('time');
        $result = $time->select();

        $this->assign('result', $result);
        $this->display();
    }

    function timeSave()
    {
        if (IS_POST) {
            $tid = $_POST['tid'];
            $data['t_startTime'] = $_POST['startTime'];
            $data['t_endTime'] = $_POST['endTime'];

            $sdate = strtotime($_POST['startTime']);
            $edate = strtotime($_POST['endTime']);
            if ($sdate >= $edate) {
                $url = U('time');
                $this->error('【开始时间】不能大于或等于【结束时间】！', $url, 3);
            } else {
                $time = M('time');
                $update = $time->where($tid)->save($data);
                if ($update) {
                    $url = U('time');
                    $this->success('时间设置成功！', $url, 1);
                } else {
                    $url = U('time');
                    $this->error('时间设置未修改！', $url, 3);
                }
            }
        }
    }

    function modifyAction()
    {
        if (IS_POST) {
            $pagedata['con_id'] = $_POST['cfg_numofpage_id'];
            $pagedata['con_key'] = $_POST['cfg_numofpage_key'];
            $pagedata['con_value'] = $_POST['cfg_numofpage_value'];
            $pagedata['con_inst'] = $_POST['cfg_numofpage_inst'];

            $qqdata['con_id'] = $_POST['cfg_qq_id'];
            $qqdata['con_key'] = $_POST['cfg_qq_key'];
            $qqdata['con_value'] = $_POST['cfg_qq_value'];
            $qqdata['con_inst'] = $_POST['cfg_qq_inst'];

            $phonedata['con_id'] = $_POST['cfg_phone_id'];
            $phonedata['con_key'] = $_POST['cfg_phone_key'];
            $phonedata['con_value'] = $_POST['cfg_phone_value'];
            $phonedata['con_inst'] = $_POST['cfg_phone_inst'];

            $infodata['con_id'] = $_POST['cfg_info_id'];
            $infodata['con_key'] = $_POST['cfg_info_key'];
            $infodata['con_value'] = $_POST['cfg_info_value'];
            $infodata['con_inst'] = $_POST['cfg_info_inst'];

            $config = M('config');
            try {
                $page = $config->save($pagedata);
                $phone = $config->save($phonedata);
                $qq = $config->save($qqdata);
                $info = $config->save($infodata);
                if ($page || $phone || $qq || $info) {
                    $url = U('Manager/index');
                    $this->success('系统参数设置成功！', $url, 1);
                } else {
                    $url = U('Manager/index');
                    $this->error('系统参数设置未修改！', $url, 3);
                }
            } catch (Exception $e) {
                $e->getMessage();
                $url = U('Manager/index');
                $this->error('SQL语句出错，系统参数设置未修改！', $url, 3);
            }
        }
    }

    function clrspc()
    {
        $model = M();
        $sql0 = "UPDATE `selt_sinfo` SET s_Num=REPLACE(s_Num,' ' ,''),s_Name=REPLACE(s_Name,' ' ,'')";
        $sql1 = "UPDATE `selt_sinfo` SET s_Num=REPLACE(s_Num,' ' ,''),s_Name=REPLACE(s_Name,' ' ,'')";
        $sql3 = "UPDATE `selt_ctitle` SET c_Tutor=REPLACE(c_Tutor,' ' ,''),c_Title=REPLACE(c_Title,' ' ,''),c_Class=REPLACE(c_Class,' ' ,'')";
        $sql2 = "UPDATE `selt_ctitle` SET c_Tutor=REPLACE(c_Tutor,' ' ,''),c_Title=REPLACE(c_Title,' ' ,''),c_Class=REPLACE(c_Class,' ' ,'')";
        $model->execute($sql0);
        $model->execute($sql1);
        $model->execute($sql2);
        $model->execute($sql3);
        $url = 'javascript:history.go(-1);';
        $this->success('清除空格成功！', $url, 1);
    }

}