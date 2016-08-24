<?php

/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-8-4
 * Time: 上午11:12
 */
require_once ('function/clMongoOperation.php');
require_once ('response/backJson.php');
class clAdvertInfo
{
    private $adName;//需要获得信息的广告名
    private $backVal;//返回值
    private $arShow;//需要获得的信息，默认为全部
   function __construct($adName,$arShow=array())
   {
       $this->adName=$adName;
       $this->arShow=$arShow;
   }

   function fnGetInfo()
   {

       $query=new clMongoOperation("advert_info",array("name"=>$this->adName),null,$this->arShow);
       $result=$query->fnGetAll();
       $resJson=new backJson();
       if(empty($result))
            $this->backVal=$resJson->response(100,"信息获取失败");
       else
           $this->backVal=$resJson->response(102,"获得信息",$result);

       return $this->backVal;
   }
}

