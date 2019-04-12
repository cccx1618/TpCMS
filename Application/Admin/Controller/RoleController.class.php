<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-28
 * Time: 上午9:39
 */
namespace Admin\Controller;
use Common\Controller\CommonController;
class RoleController extends CommonController{
    public function index(){
        $options=array();
        $options['order']="role_status desc";
        $rolelist=D('Role')->getPageList($options,10);
        $this->assign('rolelist',$rolelist['list']);
        $this->assign('page',$rolelist['page']);
        $this->display();
    }
    public function add(){
        if(empty($_POST)){
            $authlist=A('Auth')->getAuthList();
            $authlist=setTree($authlist);
            $this->assign('authlist',$authlist);
            $this->display();
        }else{
            $data['role_name']=$_POST['role_name'];
            $data['role_info']=$_POST['role_info'];
            $data['role_auth_ids']=$_POST['role_auth_ids'];
            $data['role_auth_ca']=$_POST['role_auth_ca'];
            $result=D('Role')->addData($data);
            if($result>0){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    public function edi(){
        if(empty($_POST)){
            $options=array();
            $options['where']='role_id ='.$_GET['role_id'];
            $roleinfo=D('Role')->getOneList($options);
            $authlist=A('Auth')->getAuthList();
            $authlist=setTree($authlist);
            $this->assign('authlist',$authlist);
            $this->assign('roleinfo',$roleinfo);
            $this->display();
        }else{
            $data['role_id']=$_POST['role_id'];
            $data['role_name']=$_POST['role_name'];
            $data['role_info']=$_POST['role_info'];
            $data['role_auth_ids']=$_POST['role_auth_ids'];
            $data['role_auth_ca']=$_POST['role_auth_ca'];
            $result=D('Role')->saveData($data);
            if($result>0){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    public function checkaction(){
        $auth_id=$_POST['auth_id'];
        $authlist=A('Auth')->getAuthList();
        $authlist=setTree($authlist,$auth_id);
        $ids='';
        foreach($authlist as $k=>$v){
            $ids.=','.$v['auth_id'];
        }
        $ids = substr($ids, 1, strlen($ids));
        echo $ids;
    }

    public  function changestatus(){
        $data=array();
        $data['role_id']=$_POST['role_id'];
        $role_status=$_POST['role_status'];
        if($role_status==1){
            $data['role_status']=0;
        }elseif($role_status==0){
            $data['role_status']=1;
        }
        $res=D('Role')->saveData($data);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function getAllRole(){
        $options=array();
        $options['where']='role_status=1';
        $rolelist=D('Role')->getAllList($options);
        return $rolelist;
    }


}