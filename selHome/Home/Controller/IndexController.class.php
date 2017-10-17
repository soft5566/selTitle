<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class IndexController extends Controller
{
    public function index()
    {
        $model = M('time');
        $sel = $model->limit(1)->select();
        $starttime = $sel[0]['t_starttime'];
        $endtime = $sel[0]['t_endtime'];

        $nowtime = date("Y-m-d H:i:s");

        if (strtotime($nowtime) > strtotime($starttime) && strtotime($nowtime) < strtotime($endtime)) {
            $this->display();
        } else {
            if (strtotime($nowtime) < strtotime($starttime)) {
                $this->startdatetime = "选题未开始！请耐心等待！";
                $this->starttime = $starttime;
                $this->endtime = $endtime;
                $this->display('timego');
            } else {
                $this->enddatetime = "选题结束，系统已关闭！";
                $this->starttime = $starttime;
                $this->endtime = $endtime;
                $this->display('timego');
            }
        }
    }

    function inst()
    {
        $model = M('config');
        $phone = $model->where('con_key="cfg_qq" or con_key="cfg_phone"')->select();
        $info = $model->where('con_key="cfg_info"')->find();

        $info["con_inst"] = nl2br($info["con_inst"], true);

        $this->assign('phone', $phone);
        $this->assign('info', $info);
        $this->display();
    }

    //生产验证码
    function verify()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 14;
        $Verify->length = 4;
        $Verify->imageH = 34;
        $Verify->codeSet = '0123456789';
        $Verify->useCurve = false;
        $Verify->useNoise = false;
        $Verify->fontttf = '4.ttf';
        $Verify->bg = array(253, 253, 253);
        $Verify->entry(1);
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    function login()
    {
        if (IS_POST) {
            $unum = trim($_POST['UserNum']);
            $upwd = md5(trim($_POST['UserPwd']));
            $verifyCode = trim($_POST['UVerifyCode']);

            if ($unum == '' || $upwd == '' || $verifyCode == '') {
                $url = 'javascript:history.go(-1);';
                $this->error('学号、密码或验证码为空！', $url, 3);
            }

            $model = M();
            $sql = 'SELECT * FROM selt_result AS r,selt_sinfo AS s WHERE s.s_Num=' . $unum . ' AND s.s_Id=r.s_ID AND r.c_Id<>""';
            $sel = $model->query($sql);
            $model = M('sinfo');
            $select = $model->where('s_Num="' . $unum . '"')->find();
            if ($sel) {
                session('uid', $select['s_id']);
                session('stuNum', $unum);
                $info = '<span class="badge"><h4>该生已经选题！</h4></span>，请不要重复登录选题！';
                $url = U('Manager/selresult');
                $this->error($info, $url, 5);
            } else {
                if ($verifyCode) {
                    try {
                        if ($select) {
                            if ($select['s_pwd'] == $upwd) {
                                session('uid', $select['s_id']);
                                session('stuNum', $unum);
                                $url = U('Manager/index');
                                $this->success('登陆成功！', $url, 1);
                            } else {
                                $url = 'javascript:history.go(-1);';
                                $this->error('密码不正确！', $url, 3);
                            }
                        } else {
                            $url = 'javascript:history.go(-1);';
                            $this->error('学号不存在！', $url, 3);
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    $url = 'javascript:history.go(-1);';
                    $this->error('验证码不正确！', $url, 3);
                }
            }
        }
    }

    function reg()
    {
        if (IS_GET) {
            $model = M('specility');
            $select = $model->field('sp_Id,sp_Name')->order('sp_Name')->select();

            $this->assign('data', $select);
            $this->display();
        }
    }

    function insertAction()
    {
        if (IS_POST) {
            $snum = $_POST['InputNum'];
            $sname = $_POST['InputName'];
            $spwd = $_POST['InputPwd'];
            $ssex = $_POST['InputSex'];
            $sphone = $_POST['InputPhone'];
            $semail = $_POST['InputEmail'];
            $ssc = $_POST['InputSC'];

            $data['s_Num'] = $snum;
            $data['s_Name'] = $sname;

            if (strlen($sphone) < 11) {
                $info = '手机号长度不正确！';
                $url = 'javascript:history.go(-1);';
                $this->error($info, $url, 5);
            }

            $model = M('sinfo');
            $find = $model->where($data)->find();
            if (!$find) {
                $info = '<span class="badge"><h4>无此学生信息！</h4></span><br><br><span class="label label-danger">1.学号或姓名有误，请检查！</span>'
                    . '<br><span class="label label-danger">2.不要求在此系统选题的同学，如：软件班的同学！</span>';
                $url = 'javascript:history.go(-1);';
                $this->error($info, $url, 15);
            } else {
                if (!$find['s_pwd']) {
                    $data['s_Id'] = $find['s_id'];
                    $data['s_Pwd'] = md5($spwd);
                    $data['s_Sex'] = $ssex;
                    $data['s_SC'] = $ssc;
                    $data['s_Phone'] = $sphone;
                    $data['s_Email'] = $semail;
                    $data['s_Datetime'] = gmdate('Y-m-d H:i:s', time() + 3600 * 8);

                    $update = $model->save($data);
                    if ($update) {
                        session('uid', $find['s_id']);
                        session('stuNum', $snum);
                        $info = '信息录入成功！';
                        $url = U('Index/index');
                        $this->success($info, $url, 0);
                    } else {
                        $info = '信息录入失败！';
                        $url = 'javascript:history.go(-1);';
                        $this->error($info, $url, 5);
                    }
                } else {
                    $info = '你已经登记过信息，请不要重复登记信息！';
                    $url = U('Index/index');
                    $this->error($info, $url, 5);
                }
            }
        }
    }

}