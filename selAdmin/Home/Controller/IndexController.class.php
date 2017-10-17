<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    function login(){
        $map['uname'] = $_POST['UserName'];
        $map['upwd'] = md5($_POST['UserPwd']);

        $user = M('umanager');
        $result = $user->where($map)->find();

        if($result){
            session('uid', $result['uid']);
            session('uloginName', $result['uname']);
            $url = U('Manager/index');
            $this->success('登陆成功！', $url, 1);
        }else{
            $this->error('用户名或密码错误！','javascript:history.back(-1);' ,3);
        }
    }
}