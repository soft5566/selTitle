<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class ManagerController extends Controller
{
    function _initialize()
    {
        if (!session('?uid') || !session('?stuNum'))
            $this->redirect("index/index");
    }

    //显示选题页面，开始选题
    public function index()
    {
        $sid = session('uid');

        $model = M();
        $sql = 'SELECT sp_Classes FROM selt_specility,selt_sinfo WHERE s_Id=' . $sid . ' AND sp_id=s_sc';
        $select = $model->query($sql);

        $data['s_Id'] = $sid;
        $data['s_Num'] = session('stuNum');
        $stumodel = M('sinfo');
        $stufind = $stumodel->where($data)->find();

        $titlemodel = M('ctitle');
        $titledata = $titlemodel->where('c_Class="' . $select[0]['sp_classes'] . '" AND c_Left<>0')
            ->order('c_Title desc')->select();

        $this->assign('studata', $stufind);   //该生基本信息显示
        $this->assign('titledata', $titledata);    //该生所属的全部题目（未被选的）显示
        $this->display();
    }

    //保存选题结果
    function selTitleAction()
    {
        if (IS_POST) {
            $sid = session('uid');
            $cid = $_POST['titid'];

            $data['s_Id'] = $sid;

            $resultmodel = M('result');
            $chksel = $resultmodel->where($data)->find();
            if ($chksel) {
                $info = '该生的选题<span class="badge"><h4>已经提交</h4></span>！请不要重复提交！';
//                $info = iconv("GB2312", "UTF-8", $info);
                $url = U('Manager/selresult');
                $this->error($info, $url, 5);
            } else {
                $data['c_Id'] = $cid;
                $data['r_Order'] = gmdate('Y-m-d H:i:s', time() + 3600 * 8);

                $titmodel = M('ctitle');
                //开始事务
                $resultmodel->startTrans();
                //查询所剩人数是否为0
                $titleft = $titmodel->lock(true)->field('c_Left')->where('c_Id="' . $cid . '"')->find();
                if ($titleft['c_left'] > 0) {
                    //该题所剩人数减1
                    $titmin = $titmodel->lock(true)->where('c_Id="' . $cid . '"')->setDec('c_Left');
                    //将该生和题目放入结果表中
                    $resultadd = $resultmodel->add($data);
                    if ($titmin && $resultadd) {
                        $resultmodel->commit();   //事务提交
                        $info = '<span class="badge"><h4>抢到啦！耶！！^_^</h4></span>';
//                        $info = iconv("GB2312", "UTF-8", $info);
                        $url = U('Manager/selresult');
                        $this->success($info, $url, 0);
                    } else {
                        $resultmodel->rollback();   //事务回滚
                        $info = '选题失败！';
//                        $info = iconv("GB2312", "UTF-8", $info);
                        $url = 'javascript:history.go(-1);';
                        $this->error($info, $url, 5);
                    }
                } else {
                    $info = '该题已被别的同学抢走！请继续选题！';
//                    $info = iconv("GB2312", "UTF-8", $info);
                    $url = U('Manager/index');
                    $this->error($info, $url, 5);
                }
            }
        }
    }

    function selresult()
    {
		$sid = session('uid');
        $model = M();
        $sql = "SELECT * FROM selt_sinfo AS s,selt_result AS r,selt_ctitle AS c,selt_specility AS sp "
            . " WHERE s.s_Id=r.s_Id AND c.c_Id=r.c_Id AND sp.sp_Id=s.s_SC AND s.s_Id=" . $sid;
        $MyResultdata = $model->query($sql);
		
		$sql = "SELECT * FROM selt_sinfo AS s,selt_result AS r,selt_ctitle AS c,selt_specility AS sp "
            . " WHERE s.s_Id=r.s_Id AND c.c_Id=r.c_Id AND sp.sp_Id=s.s_SC AND s.s_Id<>" . $sid
            . " ORDER BY c_Title DESC";
        $resultdata = $model->query($sql);

        $info = '<tr class="text-center"><td colspan="10">没有查询到符合条件的记录</td></tr>';
//        $info = iconv("GB2312", "UTF-8", $info);
        $this->assign('empty', $info);
        $this->assign('MyResultdata', $MyResultdata);
		$this->assign('resultdata', $resultdata);
        $this->display();
    }

}