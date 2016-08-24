<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午2:28
 * Explain:
 */


require_once ('include.php');
//require_once ('function/clMongoOperation.php');
//require_once ('function/clGetDataStr.php');
//$test=new clMongoOperation("advert_info",null,null);
//$result = $test->fnGetOne();
//print_r($result);

//Insert
//$data=array("ad_name"=>"cola","ad_type_id"=>1);
//$cond=array("ad_type_id"=>1);
//$test = new clMongoOperation("advert_info",null,$data);
//$result = $test->fnInsert();
//echo $result;

//findOne
//$data=array("name","type");
//$cond=array("name"=>"大鱼海棠");
//$test = new clMongoOperation("advert_info",$cond,$data);
//$result = $test->fnGetOne();
//echo json_encode($result);


//findAll

//$test=new clMongoOperation("advert_info",null,null);
////$test = new clMongoOperation("advert_info",$cond,$data);
//$result = $test->fnGetAll();
//echo json_encode($result);
//update
//$data=array("ad_name"=>"可口可乐");
//$cond=array("ad_name"=>"cola");
//$test=new clMongoOperation("advert_info",$cond,$data);
//
//$result=$test->fnUpdate();
//echo $result;


//delete
//$cond=array("ad_name"=>"可口可乐");
//$test = new clMongoOperation("advert_info",$cond,null,null);
//$result = $test->fnDelete();
//echo $result;



//$test = new clDoCoupon($data);
//$result=$test->fnGetCp();
//print_r($result);

//$text="user_id";
//$table="user_info";
//$cond="user_phone='17751781352'";
//$query=new clSqlOperation($text,$table,$cond,null);
//$result=$query->fnGetOne();
//print_r($result);

//$data=array("user_phone"=>13934567890,"cp_id"=>1);
//$test=new clSetCoupon($data);
//$result=$test->fnUseCoupon();
//echo $result;

//测试fnGetAdId
//$data = array("arShow"=>array("_id"),"get_num"=>5);
////$data = array("arShow"=>array("_id"));
//$test = new clGetDataStr($data);
//$result = $test->fnGetAdId();
// echo $result;


//测试fnGetAdTitle
//$data = array("arShow"=>array("name"=>true,"_id"=>false),"get_num"=>5);
////$data = array("arShow"=>array("name"=>true,"_id"=>false));
//$test = new clGetDataStr($data);
//$result = $test->fnGetAdTitle();
//echo $result;

//测试fnGetAdT
//$data = array("arShow"=>array("theme_url"=>true,"_id"=>false),"get_num"=>5);
////$data = array("arShow"=>array("name"=>true,"_id"=>false));
//$test = new clGetDataStr($data);
//$result = $test->fnGetAdT();
//echo $result;

$data = array("user_phone"=>"17751781352","cp_ad_id"=>1);
$test = new clSetCoupon($data);
$result = $test->fnInsertCoupon();
print_r($result);