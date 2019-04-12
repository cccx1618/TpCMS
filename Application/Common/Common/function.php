<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-15
 * Time: 上午11:46
 * Des:功能函数
 */

//无限级父子级循环
function setTree($data,$pid=0,$count=1) {
    $arr=array();
    foreach ($data as $key => $value){
        if($value['pid']==$pid){
            $value['count'] = $count;
            unset($data[$key]);
            $arr[]=$value;
            $arr=array_merge($arr, setTree($data,$value['auth_id'],$count+1));
        }
    }
    return $arr ;
}

//父子级数据带---格式
function setTreeNew($data,$field){
    foreach($data as $k=>$v){
        if($v['auth_level']!=0){
            $v[$field]=str_repeat('　　',$v['auth_level'])."|---".$v[$field];
        }
        $data[$k]=$v;
    }
    return $data;
}



//调用远程链接获取信息函数--get方式
function get_curl_contents($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $info = curl_exec($ch);
    curl_close($ch);
    return $info;
}

//调用远程链接获取信息函数--post方式
function post_curl_contents($url,$post_data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $info = curl_exec($ch);
    curl_close($ch);
    return $info;
}