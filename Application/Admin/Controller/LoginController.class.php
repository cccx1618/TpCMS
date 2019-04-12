<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-1
 * Time: 下午3:31
 * Des:后台管理系统登录控制器
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    public function index(){
        if(empty($_POST)){
            $this->display();
        }else{
            $mg_name=$_POST['mg_name'];
            $mg_pwd=$_POST['mg_pwd'];
            if($mg_name=="" || $mg_pwd==""){
                echo -1;
            }else{
                $where['mg_name']=$mg_name;
                $where['mg_status']=1;
                $info=M('Manager')->where($where)->find();
                if($info){
                    $pwd=$info['mg_pwd'];
                    if(md5($mg_pwd)!=$pwd){
                        echo -2;
                    }else{
                        session('adminuser.mg_id',$info['mg_id']);
                        session('adminuser.mg_name',$info['mg_name']);
                        session('adminuser.mg_role_id',$info['mg_role_id']);
                        echo 1;
                    }
                }else{
                    echo 0;
                }
            }
        }
    }

    public function logout(){
        session('adminuser.mg_id',null);
        session('adminuser.mg_name',null);
        session('adminuser.mg_role_id',null);
        $this->display('index');
    }
}