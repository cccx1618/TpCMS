<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-14
 * Time: 下午4:32
 * Des:权限控制器
 */
namespace Admin\Controller;
use Common\Controller\CommonController;
class AuthController extends CommonController{
    public function index(){
       $authlist=$this->getAuthList();
       $authlist=setTree($authlist);
       $authlist=setTreeNew($authlist,'auth_name');
       $this->assign('authlist',$authlist);
       $this->display();
    }

    public function add(){
      if(empty($_POST)){
          $authlist=$this->getAuthList();
          $authlist=setTree($authlist);
          $authlist=setTreeNew($authlist,'auth_name');
          $this->assign('authlist',$authlist);
          $this->display();
      }else{
          $data=array();
          $data['auth_name']=$_POST['auth_name'];
          $data['auth_controller']=$_POST['auth_controller'];
          $data['auth_action']=$_POST['auth_action'];
          $data['pid']=$_POST['pid'];
          $auth_id=D('Auth')->addData($data);
          if($auth_id>0){
              echo 1;
          }else{
              echo 0;
          }
      }
    }

    //假删除
    public function del(){
        $id=$_POST['id'];
        $options['where']='auth_status=1 and pid='.$id;
        $list=D('Auth')->getAllList($options);
        if(!empty($list)){
            echo 2;
        }else{
            $data=array();
            $data['auth_id']=$id;
            $data['auth_status']=0;
            $result=D('Auth')->saveData($data);
            echo $result;
        }
    }

    //原始条件获取所有权限
    public function getAuthList(){
        $options=array();
        $options['where']='auth_status=1';
        $authlist=D('Auth')->getAllList($options);
        return $authlist;
    }

}