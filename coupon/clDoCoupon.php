<?php

/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-26
 * Time: 下午2:55
 * Explain:
 */
require_once ('./include.php');
class clDoCoupon
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @param $adId
     *function:获取某一广告的优惠券列表的所有信息
     *parament:
     */
    function fnGetCp(){
        $data = (object)$this->data;
        $getText = "coupon_info.cp_name,cp_pic_url,cp_detail_url,coupon_type.cp_type_value";
        $table = "advert_info,coupon_info,coupon_type";
        $spSql = "where advert_info.ad_id = coupon_info.cp_ad_id and coupon_info.cp_type_id = coupon_type.cp_type_id and advert_info.ad_id = $data->ad_id";
        $query = new clSqlOperation($getText,$table,null,$spSql);
        $result = getStr($query->fnGetAll(MYSQL_NUM));
        return toArray(100,"广告优惠券获取成功",$result);
    }

    /**
     * @param $userId
     * @return array|mixed
     *function:获取某一用户的优惠券列表
     *parament:
     */
    function fnGetUserCoupon()
    {
        $data = (object)$this->data;
        $text = "coupon_info.cp_name,coupon_info.cp_price, coupon_info.cp_content,coupon_info.cp_usetype,
                coupon_info.cp_uselimit, coupon_info.cp_endtime,user_coupon_state.cp_state_value,user_coupon.user_coupon_code ";
        $cond = "user_coupon.cp_id=coupon_info.cp_id and user_coupon.user_cp_state_id=user_coupon_state.user_cp_state_id 
                and user_coupon.user_id = $data->user_id";
        $query = new clSqlOperation($text,"coupon_info,user_coupon,user_coupon_state",$cond,null);
        $result = getStr($query->fnGetAll(MYSQL_NUM));
        return toArray(100,"用户优惠券获取成功",$result);
    }
    /**
     * @return array
     *function:返回所有可用的优惠券及对应用户列表
     *parament:
     */
    function fnGetAllUsersCoupon()
    {
        $text = "user_coupon.user_id,coupon_info.cp_name,coupon_info.cp_price, coupon_info.cp_content,coupon_info.cp_usetype,
                coupon_info.cp_uselimit, coupon_info.cp_endtime,user_coupon.user_coupon_code";
        $tables ="coupon_info,user_coupon,user_coupon_state";
        $cond = "user_coupon.cp_id=coupon_info.cp_id and user_coupon.user_cp_state_id=3 
                and user_coupon.user_cp_state_id=user_coupon_state.user_cp_state_id";
        $query = new clSqlOperation($text,$tables,$cond,null);
        $this->backVal = $query->fnGetAll(MYSQL_ASSOC);
        empty($this->backVal)?"获取列表失败":$this->backVal;
        return $this->backVal;
    }

    /**
     * @return array
     *function:返回所有可用的优惠券列表
     *parament:
     */
    function fnGetAllCoupon()
    {
        $text = "cp_name,cp_content,cp_price,cp_uselimit,cp_endtime,cp_provider ,coupon_type.cp_type_value ";
        $table = "coupon_info JOIN coupon_type ON coupon_info.cp_type_id=coupon_type.cp_type_id";
        $cond = " coupon_info.cp_endtime>=now()";
        $query = new clSqlOperation($text,$table,$cond,null);
        $this->backVal = $query->fnGetAll(MYSQL_ASSOC);
        empty($this->backVal)?"获取列表失败":$this->backVal;
        return $this->backVal;
    }
}