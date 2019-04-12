<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-19
 * Time: 下午2:38
 */
namespace Admin\Model;
use Common\Model\CommonModel;
class AuthModel extends CommonModel{
    protected $d='Auth';
    public function _initialize() {
        parent::_initialize();
    }

    public function addData($data){
       $data=$this->setAddData($data);
       $result=M($this->d)->add($data);
       if($result>0){
           $newdata=array();
           $newdata['auth_id']=$result;
           if($data['pid']==0){
               $newdata['auth_id_path']=$result;
               $newdata['auth_level']=0;
           }else{
               $options=array();
               $options['where']="auth_id=".$_POST['pid'];
               $parentinfo=D('Auth')->getOneList($options);
               $newdata['auth_id_path']=$parentinfo['auth_id_path'].'-'.$result;
               $newdata['auth_level']=$parentinfo['auth_level']+1;
           }
           D('Auth')->saveData($newdata);
           return $result;
       }else{
           return 0;
       }
   }

    public function setCache(){
        $cache=array();
        $cache['status']=0;
        $cache['time']=3600;
        return $cache;
    }
}