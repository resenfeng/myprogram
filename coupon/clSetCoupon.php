<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-22
 * Time: 下午2:31
 */
require_once ("./function/clSqlOperation.php");
require_once ("./function/toArray.php");

class clSetCoupon
{
    private  $backVal;
    private  $data;
    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = toArray(0,"返回失败");
    }

    /**
     * 通过user_phone获取user_id
     */
    function getUserId(){
        $backVal = null;
        $userPhone = $this->data['user_phone'];
        $getText = "user_id";
        $table = "user_info";
        $where = "user_phone = $userPhone";
        $query = new clSqlOperation($getText,$table,$where,null);
        $result = $query->fnGetOne();
        if($result)
            $backVal = $result;
        else
            $backVal = "";
        return $backVal['user_id'];
    }

    /**
     * 通过cp_ad_id得到cp_id,cp_endtime
     */
    function getCpId(){
        $backVal = null;
        $cpAdId = $this->data['cp_ad_id'];
        $getText = "cp_id";
        $table = "coupon_info";
        $where = "cp_ad_id = \"".$cpAdId."\"";
        $query = new clSqlOperation($getText,$table,$where,null);
        $result = $query->fnGetOne();
        if($result){
            $backVal = $result;
        }
        else{
            $backVal = "";
        }
        return $backVal['cp_id'];
    }

   /**
    * 判断用户是否可以领取优惠券
    */
   function userGetCoupon(){
       if ($this->getCpId() != null && $this->getUserId() != null){
           $getText = "cp_id";
           $table = "user_coupon";
           $userId = $this->getUserId();
           $where = "user_id = \"".$userId."\"";
           $query = new clSqlOperation($getText,$table,$where,null);
           $result = $query->fnGetOne();
           if ($result == null){
               $data1 = array(
                   'user_id' => $userId,
                   'cp_id' => $this->getCpId(),
                   'user_cp_state_id' => 3
               );
               $query1 = new clSqlOperation($data1,"user_coupon",null,null);
               $back = $query1->fnInsert();
               if ($back)
                   $this->backVal = toArray(400,"优惠券领取成功！");
               else
                   $this->backVal = toArray(401,"数据库操作失败！");
           }else{
               $this->backVal = toArray(401,"该用户已经领取该优惠券，优惠券领取失败！");
           }
       }else{
           $this->backVal = toArray(401,"数据库操作失败！");
       }
       return $this->backVal;
   }
}