<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class SpecilityController extends Controller
{
    function _initialize()
    {
        if (!session('?uloginName'))
            $this->redirect("index/index");
    }

    public function index()
    {
        $model = M('Specility');
        $select = $model->order('sp_Name')->select();

        $this->assign('data', $select);
        $this->assign('empty', '<tr class="text-center"><td colspan="4">当前无任何数据</td></tr>');
        $this->display();
    }

    function add()
    {
        if (IS_POST) {
            $spname = $_POST['spname'];
            $spclass = $_POST['spclass'];
            $data['sp_Name'] = $spname;
            $data['sp_Classes'] = $spclass;

            $model = M('specility');
            $select = $model->where('sp_Name="' . $spname . '"')->find();
            if ($select) {
                $info = '专业：<span class="label label-danger">' . $spname . '</span>已经存在！';
                $url = U('Specility/index');
                $this->error($info, $url, 5);
            } else {
                try {
                    $create = $model->add($data);
                    if ($create) {
                        $url = U('Specility/index');
                        $this->success('专业添加成功！', $url, 1);
                    } else {
                        $url = U('Specility/index');
                        $this->error('专业添加失败！', $url, 5);
                    }
                } catch (Exception $e) {
                    echo '<script>javascript:alert("' . $e->getMessage() . '");</script>';
                }
            }
        }
    }

    function modify()
    {
        if (IS_GET) {
            $spid = $_GET['spid'];

            $model = M('specility');
            $find = $model->where('sp_Id="' . $spid . '"')->find();

            $this->assign('find', $find);
            $this->assign('spid', $spid);
            $this->display();
        }
    }

    function modifyAction()
    {
        if (IS_POST) {
            $data['sp_Id'] = $_POST['spid'];
            $data['sp_Name'] = $_POST['spname'];
            $data['sp_Classes'] = $_POST['spclass'];

            $model = M('specility');
            $select = $model
                ->where('sp_Name="' . $data['sp_Name'] . '" AND sp_Classes="' . $data['sp_Classes'] . '"')
                ->find();
            if ($select) {
                $info = '专业：<span class="label label-danger">' . $data['sp_Name'] . '</span>';
                $info = $info . ' 专业类别：<span class="label label-danger">' . $data['sp_Classes'] . '</span>已经存在！<br><br>';
                $url = 'javascript:history.back(-1);';
                $this->error($info, $url, 5);
            } else {
                try {
                    $result = $model->save($data);
                    if ($result) {
                        $url = U('Specility/index');
                        $this->success('专业修改成功！', $url, 1);
                    } else {
                        $url = 'javascript:history.back(-1);';
                        $this->error('数据没有修改，数据库拒绝更新操作！', $url, 5);
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    function delete()
    {
        if (IS_GET) {
            $spid = $_GET['spid'];

            $model = M();
            $sql = 'SELECT * FROM selt_specility,selt_sinfo WHERE sp_Id="' . $spid . '" AND sp_id=s_sc';
            $select = $model->query($sql);
            if ($select) {
                $info = '<span class="badge"><h4>此专业下有学生</h4></span>，不能做删除操作！'
                    . '<br><br>请先删除此专业下的所有学生，才可删除此专业！';
                $url = U('Specility/index');
                $this->error($info, $url, 5);
            } else {
                $spy = M('specility');
                $result = $spy->delete($spid);
                if ($result) {
                    $url = U('Specility/index');
                    $this->success('删除成功！', $url, 0);
                } else {
                    $url = U('Specility/index');
                    $this->error('删除失败！', $url, 5);
                }
            }
        }
    }

}