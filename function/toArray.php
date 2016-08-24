<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-20
 * Time: 上午10:01
 * Explain:
 */
function toArray($code,$message,$data = null){
    $arBack = array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );
    return $arBack;
}