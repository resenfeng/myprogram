<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-23
 * Time: 上午9:29
 * Explain:利用ad_id查询数据库返回广告功能的所有信息
 */
require_once 'include.php';

function fnGetFn($adId){
    $query = new clSqlOperation("ad_topic_url","advert_info","ad_id = $adId",null);
    $result = $query->fnGetOne();
    $topicStr = $result['ad_topic_url'];
    echo $topicStr."</br>";

    $str = null;
    for ($i = 1;$i < 9;$i++){
        if ($i == 8)
            $sep = "";
        else
            $sep = ",";
        $str .= "ad_fn".$i."_id".$sep;
    }

    $query1 = new clSqlOperation($str,"advert_info","ad_id = $adId",null);
    $result1 = $query1->fnGetOne();

    foreach ($result1 as $key=>$value)
    {
        if ($value == 0)
            unset($result1[$key]);
    }

    $str1 = null;
    foreach ($result1 as $key=>$val){
        if ($str1 == null)
            $sep = "";
        else
            $sep = " or ";
        $str1 .= $sep."advert_info.".$key." = advert_fn.fn_id";

    }

    $getText = "advert_fn_type.ad_fn_type_name,advert_fn.fn_url";
    $table = "advert_info,advert_type,advert_fn,advert_fn_type";
    $spSql =  "where advert_info.ad_type_id=advert_type.ad_type_id and ($str1) and advert_fn.fn_type_id=advert_fn_type.ad_fn_type_id and ad_id=$adId";
    $query2 = new clSqlOperation($getText,$table,null,$spSql);
    $result2 = $query2->fnGetAll(MYSQL_NUM);
//    print_r($result2);
    print_r(getStr($result2));

    if (array_key_exists("ad_fn5_id",$result1)){
        $getText = "cp_detail_url";
        $table = "advert_info,coupon_info";
        $spSql1 = "where advert_info.ad_id = coupon_info.cp_ad_id";
        $query3 = new clSqlOperation($getText,$table,null,$spSql1);
        $result3 = $query3->fnGetOne();
        print_r($result3);
    }
}

fnGetFn(1);