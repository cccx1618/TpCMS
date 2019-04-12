<?php
namespace Home\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController{
    public function index(){
          $sitename=$_GET['sitename'];
          echo $sitename;
    }

}