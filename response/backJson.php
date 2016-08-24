<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 上午10:39
 * Explain:返回的数据格式为Json格式
 */
require_once ('Api.php');
class backJson extends Api
{
    public function response($code, $message = '', $data = array())
    {
        if (!(is_numeric($code))) {
            return '';
        }

        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        exit(json_encode($result,JSON_UNESCAPED_UNICODE));
    }
}