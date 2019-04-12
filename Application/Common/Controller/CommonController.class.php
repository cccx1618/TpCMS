<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-6-29
 * Time: 下午4:21
 * Des:通用函数控制器
 */
namespace Common\Controller;
use Think\Controller;
class CommonController extends Controller{

    //空操作
    public function _empty(){
        $this->error("页面错误");
    }

    public function _initialize(){
        if(session('adminuser.mg_id')=="" || session('adminuser.mg_name')==""){
            $this->error('请登录！', U('/Login/index'));
        }else{
            $mg_role_id=session('adminuser.mg_role_id');
            $auth_ca=getAuthCa($mg_role_id);
            $auth_ca=$auth_ca.',Index-index,Index-top,Index-left,Index-main';
            $current_controller=CONTROLLER_NAME;
            $current_action=ACTION_NAME;
            $ca=$current_controller.'-'.$current_action;
            if(strpos($auth_ca,$ca)===false){
                $this->error('对不起，您没有此操作权限');
            }
        }
    }
}