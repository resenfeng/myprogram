<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午2:28
 * Explain:
 */
require_once ('response.php');
$operation = $_POST['operation'];
$data = json_decode($_POST['data'],true);
$response = new response();

switch ($operation){
    case 'login':
        $response->fnDoLogin($data);
        break;
    case 'register':
        $response->fnDoReg($data);
        break;
    case 'edit':
        $response->fnDoEdit($data);
        break;
    case 'feedback':
        $response->fnDoFB($data);
        break;
    case 'userinfo':
        $response->fnDoUS($data);
        break;
    case 'rolling':
        $response->fnDoRL($data);
        break;
    case 'news':
        $response->fnDoNew($data);
        break;
    case 'adhot':
        $response->fnDoAdHot($data);
        break;
    case 'videoroom':
        $response->fnDoVHot($data);
        break;
    case 'userlike':
        $response->fnDoUL($data);
        break;
    case 'adlist':
        $response->fnDoADL($data);
        break;
    case 'videolist':
        $response->fnDoVideoL($data);
        break;
    default:
        break;
}