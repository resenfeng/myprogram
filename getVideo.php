<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-20
 * Time: 下午4:09
 * Explain:
 */
//require_once('./function/clGetUrl.php');
require_once "include.php";
function fnGetVideo($data = array())
{
    if (array_key_exists('video_get_num', $data)) {
        //
    } else {
        $query = new clSqlOperation("video_title,video_thumbnail_url,video_content_url","video_info",null,null);
        $result = $query->fnGetAll(MYSQL_NUM);
//        print_r($result);
//        print_r(getUrlStr($result));
        $data = array(
            'video_title' => getUrlStr($result)[0],
            'video_thumbnail_url' => 'http://180.153.57.193:8010/picture/vThumbnail/'.'&'.getUrlStr($result)[1],
            'video_content_url' => 'http://180.153.57.193:8010/video/'.'&'.getUrlStr($result)[2]
        );
        print_r(toArray(303, "视频缩略图获取成功",$data));
    }
}

function getUrlStr($arRes)
{
    $strVal = null;
    $isAr = null;
    $arTemp = null;
    $result = array();
    foreach ($arRes as $value){
        if($strVal == null){
            $sep = "";
        }else{
            $sep = "@";
        }
        if(is_array($value)){
            $isAr = true;
            $arTemp[] = $value;
        }
        else
            $strVal .= $value.$sep;
    }
    if($isAr){
        $strVal = null;
        $tempNum = count($arTemp);
        $dataNum = count($arTemp[0]);
        for($i = 0;$i < $dataNum;$i++){
            $strVal = null;
            for($j = 0;$j < $tempNum;$j++){
                if($j == $tempNum-1){
                    $sep = "";
                }else{
                    $sep = "@";
                }
                $strVal .= $arTemp[$j][$i].$sep;
                if($j == $tempNum-1)
                    $result[] = $strVal;
            }
        }
    }

    if (count($result) == 1)
        return $result[0];
    else
        return $result;
}

fnGetVideo();