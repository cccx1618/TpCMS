<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-9-8
 * Time: 上午11:00
 */
//根据角色ID获取角色名称
function getRoleName($roleid){
    $options=array();
    $options['where']='role_id='.$roleid;
    $roleinfo=D('Role')->getOneList($options);
    $rolename=$roleinfo['role_name'];
    echo $rolename;
}

//根据角色ID获取角色对应的权限操作名信息
function getAuthCa($roleid){
    $options=array();
    $options['where']='role_id='.$roleid;
    $roleinfo=D('Role')->getOneList($options);
    $auth_ca=$roleinfo['role_auth_ca'];
    return $auth_ca;
}

//根据角色ID获取角色对应的权限id信息
function getAuthIds($roleid){
    $options=array();
    $options['where']='role_id='.$roleid;
    $roleinfo=D('Role')->getOneList($options);
    $auth_ids=$roleinfo['role_auth_ids'];
    return $auth_ids;
}