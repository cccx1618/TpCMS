<?php
/**
 * Created by PhpStorm.
 * User: wuyimin
 * Date: 16-7-28
 * Time: 上午9:33
 */
namespace Admin\Model;
use Common\Model\CommonModel;
class RoleModel extends CommonModel{
    protected $d='Role';
    public function _initialize() {
        parent::_initialize();
    }
}