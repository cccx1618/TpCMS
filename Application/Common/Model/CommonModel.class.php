<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-14
 * Time: 下午5:11
 * Des:公共模型文件
 */
namespace Common\Model;
use Think\Model;
class CommonModel extends Model{
    public function _initialize() {
        parent::_initialize();
    }

    //处理查询条件
    public function setOptions($options){
        foreach($options as $key => $val){
            if($val == ''){
                unset($options[$key]);
            }
        }
        return $options;
    }

    //处理插入数据
    public function setAddData($data){
        return $data;
    }

    //处理编辑数据
    public function setEditData($data){
        return $data;
    }

    //设置查询缓存
    /**
     *@param   int  $status   是否启用查询缓存  0不启用  1启用  默认为0
     *@param   int  $time    缓存有效期   默认一个小时
     *本系统查询缓存默认都为file方式
     **/
    public function setCache(){
        $cache=array();
        $cache['status']=0;
        $cache['time']=3600;
        return $cache;
    }

    //获取所有数据--这种查询加缓存，是否采用缓存在模型中自定义,系统默认查询缓存为file形式
    public function getAllList($options){
        $options=$this->setOptions($options);
        $cache=$this->setCache();
        if($cache['status']==1){
            $alllist=M($this->d)->cache(true,$cache['time'],'File')->select($options);
        }else{
            $alllist=M($this->d)->select($options);
        }

        if(empty($alllist)){
            return '';
        }else{
            return $alllist;
        }
    }

    //获取单条数据
    public function getOneList($options){
        $options=$this->setOptions($options);
        $onelist=M($this->d)->find($options);
        if(empty($onelist)){
            return '';
        }else{
            return $onelist;
        }

    }

    //删除数据
    public function deleteData($options){
        $options=$this->setOptions($options);
        $result=M($this->d)->delete($options);
        if($result==1){
            return 1;
        }else{
            return 0;
        }
    }

    //更新数据-组织参数更新
    public function saveData($data){
        $data=$this->setEditData($data);
        $result=M($this->d)->save($data);
        if($result==1){
            return 1;
        }else{
            return 0;
        }
    }

    //更新数据-直接根据表单数据创建更新，表单中必须有隐藏的主键
    public function saveCreateData(){
        M($this->d)->create();
        $result=M($this->d)->save();
        if($result==1){
            return 1;
        }else{
            return 0;
        }
    }

    //创建数据-组织数据创建
    public function addData($data){
        $data=$this->setAddData($data);
        $result=M($this->d)->add($data);
        if($result>0){
            return $result;
        }else{
            return 0;
        }
    }

    //创建数据-直接根据表单数据创建对象
    public function addCreateData(){
        D($this->d)->create();
        $result=D($this->d)->add();
        if($result>0){
            return $result;
        }else{
            return 0;
        }
    }

    //计算记录数
    public function getCount($options){
        $count=M($this->d)->where($options['where'])->count();
        return $count;
    }

    //数据获取并分页处理
    /**
     * @param array $options    查询的条件数组
     * @param int   $pageshow   一页显示几条信息
     **/
    public function getPageList($options,$pageshow){
        $count=$this->getCount($options);
        $page = new \Think\Page($count,$pageshow);  //$pageshow一页显示几条
        $show = $page->show();
        $options['limit']=$page->firstRow.','.$page->listRows;
        $list=D($this->d)->getAllList($options);
        $arr=array();
        $arr['list']=$list;
        $arr['page']=$show;
        return $arr;
    }

    //根据ID获取所有子级ID
    /***
     *$id表示根据哪个值来求,以,结合的字符串类型;$field表示要组装返回的值;$pid表示父级ID标识；$options表示其他的相关条件
     ***/
    public function getCategoryIds($id,$field,$pid,$options=array()){
        do{
            $ids='';
            $options['where']=$options['where'].' and '.$pid.' In ('.$id.')';
            $temp=D($this->d)->getAllList($options);
            foreach ($temp as $v)
            {
                $arr[] = $v[$field];
                $ids .= ',' . $v[$field];
            }
            $ids = substr($ids, 1, strlen($ids));
            $id = $ids;

        }while(!empty($temp));
        $ids = implode(',', $arr);
        return $ids;
    }

}