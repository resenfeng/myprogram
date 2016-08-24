<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 上午10:39
 * Explain:返回的数据格式为Json格式
 */
class backJson
{
    public function response($value = array())
    {
        if (!(is_numeric($value['code']))) {
            return '';
        }

        $result = array(
            'code' => $value['code'],
            'message' => $value['message'],
            'data' => $value['data']
        );
        exit(json_encode($result,JSON_UNESCAPED_UNICODE));
    }
}