<?php
///**
// * Created by PhpStorm.
// * User: fengsen
// * Date: 16-7-15
// * Time: 下午1:02
// */
//class clRolling
//{
//    private $backVal;
//    private $adNum;
//    
//    function __construct($requestJson)
//    {
//        parent::__construct($requestJson);
//        $this->backVal = null;
//        $this->adNum = parent::fnGetJson()['ad_num'];
//    }
//
//    /**
//     * @return array|null
//     *function:获取轮播所需的主题图片url
//     *parament:
//     */
//    function fnGetPic(){
//        //获取广告主题图片
//        $query = new clSqlOperation("ad_pic_url","advert_info",null,"order by ad_count desc limit $this->adNum");
//        $this->backVal = $query->fnOther();
//        return $this->backVal;
//    }
//}