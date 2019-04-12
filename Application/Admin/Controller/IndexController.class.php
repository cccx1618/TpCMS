<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
        $this->display();
    }

    public function top(){
        $mg_name=session('adminuser.mg_name');
        $this->assign('mg_name',$mg_name);
        $this->display();
    }

    public function main(){
        $this->display();
    }

    public function left(){
        $mg_role_id= session('adminuser.mg_role_id');
        $authids=getAuthIds($mg_role_id);
        $options=array();
        $options['where']="auth_level < 2 and auth_status=1 and auth_id in ($authids)";
        $authlist=D('Auth')->getAllList($options);
        $this->assign('authlist',$authlist);
        $this->display();
    }
}