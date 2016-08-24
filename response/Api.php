<?php
/**
 * Project Name: papacamera
 * User: fengsen
 * Date: 16-7-16
 * Time: 下午2:03
 * Explain:
 */
abstract class Api{
    const JSON = 'backJson';
    const XML = "backXml";
    const ARR = "Array";

    public static function factory($type = self::JSON) {
        $type = isset($_GET['format']) ? $_GET['format'] : $type;
        $resultClass = ucwords($type);
        require_once($type . '.php');
        return new $resultClass();
    }

    abstract function response($code, $message, $data);
}