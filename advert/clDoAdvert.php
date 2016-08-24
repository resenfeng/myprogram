<?php

/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-22
 * Time: 下午3:45
 * Explain:
 */
require_once ('./function/clGetDataStr.php');
class clDoAdvert
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    function fnGetRoll(){
        $getData = new clGetDataStr($this->data);
        $result = $getData->fnGetRolling();
        if ($result != null) {
            $data = array(
                'pic_str' => $result[0],
                'detail_str' => $result[1]
            );
            $this->backVal = toArray(301,"信息获取成功",$data);
        }else{
            $this->backVal = toArray(302,"信息获取失败");
        }

        return $this->backVal;
    }

    function fnGetHot(){
        $getData = new clGetDataStr($this->data);
        if ($this->data['get_type'] == 'advert'){
            $idStr = $getData->fnGetAdId();
            $picStr = $getData->fnGetAdT();
            if ($idStr != null & $picStr != null) {
                $data = array(
                    'id_str' => $idStr,
                    'ad_str' => $picStr
                );
                $this->backVal = toArray(305,"信息获取成功",$data);
            }else{
                $this->backVal = toArray(306,"信息获取失败");
            }

        }else{
            $idStr = $getData->fnGetVId();
            $videoStr = $getData->fnGetVThum();
            if ($idStr != null & $videoStr != null){
                $data = array(
                    'id_str' => $idStr,
                    'video_str' => $videoStr
                );
                $this->backVal = toArray(307,"信息获取成功",$data);
            }else{
                $this->backVal = toArray(308,"信息获取成功");
            }

        }

        return $this->backVal;
    }

    function fnGetLike(){
        $getData = new clGetDataStr($this->data);
        if ($this->data['get_type'] == 'advert'){
            $idStr = $getData->fnGetAdId();
            $picStr = $getData->fnGetAdT();
            if ($idStr != null & $picStr != null) {
                $data = array(
                    'id_str' => $idStr,
                    'ad_str' => $picStr
                );
                $this->backVal = toArray(309,"信息获取成功",$data);
            }else{
                $this->backVal = toArray(310,"信息获取失败");
            }
        }else{
            $idStr = $getData->fnGetVId();
            $videoStr = $getData->fnGetVideo();
            if ($idStr != null & $videoStr != null){
                $data = array(
                    'id_str' => $idStr,
                    'video_str' => $videoStr
                );
                $this->backVal = toArray(309,"信息获取成功",$data);
            }else{
                $this->backVal = toArray(310,"信息获取成功");
            }

        }
        return $this->backVal;
    }

    function fnGetList()
    {
        $getData = new clGetDataStr($this->data);
        if ($this->data['get_type'] == 'advert'){
            $idStr = $getData->fnGetAdId();
            $picStr = $getData->fnGetAdT();
            $picTitle = $this->fnGetTitle();
            $adCount = $this->fnGetCount();
            $data = array(
                'id_str' => $idStr,
                'ad_str' => $picStr,
                'ad_title' => $picTitle,
                'ad_count' => $adCount
            );
            $this->backVal = toArray(303,"信息获取成功",$data);
        }else{
            $idStr = $getData->fnGetVId();
            $videoStr = $getData->fnGetVThum();
            $videoTitle = $this->fnGetTitle();
            $videoCount = $this->fnGetCount();
            $data = array(
                'id_str' => $idStr,
                'video_str' => $videoStr,
                'video_title' => $videoTitle,
                'video_count' => $videoCount
            );
            $this->backVal = toArray(303,"信息获取成功",$data);
        }
        return $this->backVal;
    }

    function fnGetTitle(){
        $getData = new clGetDataStr($this->data);
        if ($this->data['get_type'] == 'advert'){
            $picTitle = $getData->fnGetAdTitle();
        }else{
            $picTitle = $getData->fnGetVTitle();
        }

        return $picTitle;
    }

    function fnGetCount(){
        $getData = new clGetDataStr($this->data);
        if ($this->data['get_type'] == 'advert'){
            $picCount = $getData->fnGetAdCount();
        }else{
            $picCount = $getData->fnGetVCount();
        }

        return $picCount;
    }
}