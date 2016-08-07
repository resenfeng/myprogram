<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-22
 * Time: 下午2:31
 */
require_once ("./function/clSqlOperation.php");
class clSetCoupon
{
    private  $backVal;
    private  $userId;
    private  $cpId;
    function __construct($data = array())
    {
        $this->userId = $data['user_id'];
        $this->cpId = $data['cp_id'];
    }

    /**
     * 判断能否领取优惠券
     * @return bool
     */
    private  function isGet($cpId)
    {
        $isGet = false;
        $query  = new clSqlOperation("cp_pub_time","coupon_info","cp_id=$cpId and cp_pub_time>=now()",null);
        $result = $query->fnGetOne();
        if($result != null)
            $isGet = true;

        return $isGet;
    }

    /**
     * 判断能否使用优惠券
     * @param $cpId
     * @return bool
     */
    private function isUse($cpId)
    {
        $isUse = false;
        $query  = new clSqlOperation("cp_endtime","coupon_info","cp_id=$cpId and cp_endtime>=now() ",null);
        $result = $query->fnGetOne();
        if($result != null)
            $isUse = true;

        return $isUse;
    }
    /**
     * 用户获得优惠券
     * @return null|string
     */
    function fnInsertCoupon()
    {
        if($this->userId == null)
            return ($this->backVal = "插入失败，无法获取用户信息") ;

        if($this->cpId == null)
            return($this->backVal = "插入失败，优惠券不正确") ;
        $query = new clSqlOperation("user_cp_id","user_coupon","not(user_cp_state_id in (0,2,4) )and 
        user_id =$this->userId and cp_id=$this->cpId",null);
        $result = $query->fnGetOne();
        if(empty($result))
        {
            if($this->isGet($this->cpId)){
                $text = array("user_id"=>$this->userId,"cp_id"=>$this->cpId,"user_cp_state_id"=>3);
                $table = "user_coupon";
                $query = new clSqlOperation($text,$table,null,null);
                if($query->fnInsert())
                    $this->backVal = "插入成功";
                else
                    $this->backVal = "插入失败";
            }else{
                $this->backVal = "超过领取期限或不存在";
            }
        }else {
            $this->backVal = "用户已经拥有该优惠券";
        }
        return $this->backVal;
    }

    /**
     * 用户使用优惠券
     * @return null|string
     */
    function fnUseCoupon()
    {
        if($this->isUse($this->cpId))
        {
            $text = "user_cp_id";
            $table = "user_coupon";
            $cond = "user_cp_state_id in (3,7) and user_id = $this->userId and cp_id = $this->cpId ";
            $query = new clSqlOperation($text,$table,$cond,null);
            $result = $query->fnGetOne();
            if(empty($result))
            {
                $this->backVal = "无法使用优惠券";

            }
            else{
                $text = array("user_cp_state_id"=>5);
                $table = "user_coupon";
                $cond = "user_id = $this->userId and cp_id = $this->cpId ";
                $query = new clSqlOperation($text,$table,$cond,null);
                $result = $query->fnUpdate();
                if($result)
                    $this->backVal = "成功使用优惠券";
                else
                    $this->backVal = "使用优惠券失败";
            }
        }
        else
        {
            $this->backVal = "优惠券过期或不存在";
        }
        return $this->backVal;
    }
}