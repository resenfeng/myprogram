<?php

/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午2:29
 * Explain:
 */
include "include.php";
require_once ('./coupon/clSetCoupon.php');
class response
{
    private $back;

    function __construct()
    {
        $this->back = new backJson();
    }

    /**
     * @param array $data   含uesr_phone user_passwd键名
     *function:处理用户的登录操作
     *parament:
     */
    public function fnDoLogin($data = array())
    {
        $login = new clUserAct($data);
        $result = $login->fnCheck();
        
        $this->back->response($result);
    }

    /**
     * @param array $data   含user_name user_phone user_passwd键名
     *function:处理用户的注册操作
     *parament:
     */
    public function fnDoReg($data = array())
    {
        $register = new clUserAct($data);
        $result = $register->fnRegist();
        $this->back->response($result);
    }

    /**
     * @param array $data   含user_phone user_passwd user_new_passwd键名
     *function:处理用户修改密码操作
     *parament:
     */
    public function fnDoEdit($data = array())
    {
        $edit = new clUserAct($data);
        $result = $edit->fnEditPw();
        $this->back->response($result);
    }

    /**
     * @param array $data   含fb_user_phone fb_content键名
     *function:处理用户的反馈操作
     *parament:
     */
    public function fnDoFB($data = array())
    {
        $fBack = new clFeedBack($data);
        $result = $fBack->fnSaveFeedBack();
        $this->back->response($result);
    }

    /**
     * @param array $data   含user_name user_phone user_qq_id(选填) user_wechat_id(选填)键名
     *function:用于处理用户信息
     *parament:
     */
    public function fnDoUS($data = array())
    {
        $myInfo = new clMyInfo($data);
        $result = $myInfo->fnGetInfo();
        $this->back->response($result);
    }

    /**
     * @param array $data   含ad_get_num键名
     *function:处理轮播功能
     *parament:
     */
    public function fnDoRL($data = array())
    {
        $getUrl = new clDoAdvert($data);
        $result = $getUrl->fnGetRoll();
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_type ad_get_num/video_get_num键名
     *function:处理啪啪热门
     *parament:
     */
    public function fnDoAdHot($data = array())
    {
        $getUrl = new clDoAdvert($data);
        $result = $getUrl->fnGetHot();
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_type ad_get_num ad_topic_id键名
     *function:处理广告列表
     *parament:
     */
    public function fnDoADL($data = array())
    {
        $myInfo = new clDoAdvert($data);
        $result = $myInfo->fnGetList();
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_type video_get_num键名
     *function:处理体验间
     *parament:
     */
    public function fnDoVHot($data = array())
    {
        $myInfo = new clDoAdvert($data);
        $result = $myInfo->fnGetHot();
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_type video_get_num键名
     *function:处理视频列表
     *parament:
     */
    public function fnDoVideoL($data = array())
    {
        $myInfo = new clDoAdvert($data);
        $result = $myInfo->fnGetList();
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_num键名
     *function:处理啪啪头条
     *parament:
     */
    public function fnDoNew($data = array()){
        $result = fnGetNews($data['get_num']);
        $this->back->response($result);
    }

    /**
     * @param array $data   含get_num键名
     *function:处理猜你喜欢
     *parament:
     */
    public function fnDoUL($data = array()){
        $myInfo = new clDoAdvert($data);
        $result = $myInfo->fnGetLike();
        $this->back->response($result);
    }

    public function fnDoCoupon($data = array())
    {
        
       
        $myCoupon = new clSetCoupon($data);
        $result = $myCoupon->userGetCoupon();
        $this->back->response($result);
    }
}
