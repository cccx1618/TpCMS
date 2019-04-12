<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-8-29
 * Time: 下午2:44
 */
namespace Admin\Controller;
use Common\Controller\CommonController;
class AdminuserController extends CommonController{
    public function index(){
        $options=array();
        $adminuserlist=D('Manager')->getPageList($options,15);
        $this->assign('adminuserlist',$adminuserlist['list']);
        $this->assign('page',$adminuserlist['page']);
        $this->display();
    }

    public function add(){
        if(empty($_POST)){
            $rolelist=A('Role')->getAllRole();
            $this->assign('rolelist',$rolelist);
            $this->display();
        }else{
            $data=array();
            $data['mg_name']=$_POST['mg_name'];
            $data['mg_role_id']=$_POST['mg_role_id'];
            $data['mg_status']=$_POST['mg_status'];
            $data['mg_addtime']=time();
            $data['mg_pwd']=md5('123456');
            $result=D('Manager')->addData($data);
            if($result>0){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    public function edi(){
        if(empty($_POST)){
            $rolelist=A('Role')->getAllRole();
            $options[]=array();
            $options['where']="mg_id=".$_GET['mg_id'];
            $mginfo=D('Manager')->getOneList($options);
            $this->assign('rolelist',$rolelist);
            $this->assign('mginfo',$mginfo);
            $this->display();
        }else{
            $data['mg_id']=$_POST['mg_id'];
            $data['mg_name']=$_POST['mg_name'];
            $data['mg_status']=$_POST['mg_status'];
            $data['mg_role_id']=$_POST['mg_role_id'];
            if($_POST['mg_pwd']!=""){
                $data['mg_pwd']=md5($_POST['mg_pwd']);
            }
            $result=D('Manager')->saveData($data);
            if($result>0){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    public  function changestatus(){
        $data=array();
        $data['mg_id']=$_POST['mg_id'];
        $mg_status=$_POST['mg_status'];
        if($mg_status==1){
            $data['mg_status']=0;
        }elseif($mg_status==0){
            $data['mg_status']=1;
        }
        $res=D('Manager')->saveData($data);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

}
?>