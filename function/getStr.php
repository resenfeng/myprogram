<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-21
 * Time: 上午11:37
 * Explain:
 */
/**
 * @param $arRes
 * @return array|mixed
 *function:
 *parament:获取数据库指定列的所有值的字符串
 */
function getStr($arRes)
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
    if($isAr) {
        $strVal = null;
        $tempNum = count($arTemp);
        $dataNum = count($arTemp[0]);
        for ($i = 0; $i < $dataNum; $i++) {
            $strVal = null;
            for ($j = 0; $j < $tempNum; $j++) {
                if ($j == $tempNum - 1) {
                    $sep = "";
                } else {
                    $sep = "@";
                }
                if ($arTemp[$j][$i] == null){
                    $arTemp[$j][$i] = ' ';
                }
                $strVal .= $arTemp[$j][$i] . $sep;
                if ($j == $tempNum - 1)
                    $result[] = $strVal;
            }
        }
    }
    if (count($result) == 1)
        return $result[0];
    else
        return $result;
}