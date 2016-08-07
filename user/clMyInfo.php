<?php
/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-7-14
 * Time: 下午6:14
 *
 */
//引入数据库及其操作
require_once ('./function/toArray.php');
class clMyInfo
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    /**
     * @return array
     *function:获取用户信息
     *parament:
     */
    function fnGetInfo()
    {
        $data = (object)$this->data;
        if ($this->data['user_phone'] != null) {
            $query = new clSqlOperation("*", "user_info", "user_phone = $data->user_phone", null);
//            $this->backVal = $query->fnGetOne();
            if ($query->fnGetOne()){
                $this->backVal = toArray(208,"获取用户信息成功",$query->fnGetOne());
            }else{
                $this->backVal = toArray(208,"获取用户信息失败");
            }
        } elseif ($this->data['user_qq_id'] != null) {
            $query = new clSqlOperation("*", "user_info", "user_qq_id = $data->user_qq_id", null);
            if ($query->fnGetOne()){
                $this->backVal = toArray(208,"获取用户信息成功",$query->fnGetOne());
            }else{
                $this->backVal = toArray(208,"获取用户信息失败");
            }
        } elseif ($this->data['user_wechat_id'] != null) {
            $query = new clSqlOperation("*", "user_info", "user_wechat_id = $data->user_wechat_id", null);
            if ($query->fnGetOne()){
                $this->backVal = toArray(208,"获取用户信息成功",$query->fnGetOne());
            }else{
                $this->backVal = toArray(208,"获取用户信息失败");
            }
        } else {
            $this->backVal = toArray(209,"获取用户信息失败");
        }
        return $this->backVal;
    }
}