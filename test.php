<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午2:28
 * Explain:
 */
// require_once ('response.php');
//$operation = $_POST['operation'];
//$data = json_decode($_POST['data'],true);
// $response = new response();

// $operation = "adhot";
//$data = array(
//    'get_type' => "advert",
//    'get_num' => '4'
//    'ad_type_id' => 'a'
//);
//print_r(json_encode($data));
// switch ($operation){
//     case 'login':
//         $response->fnDoLogin($data);
//         break;
//     case 'register':
//         $response->fnDoReg($data);
//         break;
//     case 'edit':
//         $response->fnDoEdit($data);
//         break;
//     case 'feedback':
//         $response->fnDoFB($data);
//         break;
//     case 'userinfo':
//         $response->fnDoUS($data);
//         break;
//     case 'rolling':
//         $response->fnDoRL($data);
//         break;
//     case 'news':
//         $response->fnDoNew($data);
//         break;
//     case 'adhot':
//         $response->fnDoAdHot($data);
//         break;
//     case 'videoroom':
//         $response->fnDoVHot($data);
//         break;
//     case 'userlike':
//         $response->fnDoUL($data);
//         break;
//     case 'adlist':
//         $response->fnDoADL($data);
//         break;
//     case 'videolist':
//         $response->fnDoVideoL($data);
//         break;
//     default:
//         break;
// }

require_once ('include.php');

//update
//$data=array("ad_name"=>"cola","ad_type_id"=>1);
//$cond=array("ad_type_id"=>2);
//$test = new clMongoOperation("advert_info",$cond,null,$data);
//$result = $test->fnInsert();
//echo $result;

//findOne
$data=array("name","type");
$cond=array("name"=>"大鱼海棠");
$test = new clMongoOperation("advert_info",null,null,null);
$result = $test->fnGetOne();
echo json_encode($result);


//findAll
//$data=array("ad_name","ad_type_id");
//$cond=array("ad_type_id"=>2);
//$test = new clMongoOperation("advert_info",$cond,null,$data);
//$result = $test->fnGetAll();
//echo $result;

//delete

//$cond=array("ad_type_id"=>2);
//$test = new clMongoOperation("advert_info",$cond,null,null);
//$result = $test->fnDelete();
//echo $result;


//phpinfo();