<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-26
 * Time: 下午3:18
 * Explain:
 */
function fnGetNews($newNum){
    $getText = "news_title,news_url";
    $table = "news_info";
    $spSql = "order by news_count limit $newNum";
    $query = new clSqlOperation($getText, $table, null, $spSql);
    $result = getStr($query->fnGetAll(MYSQL_NUM));
    $data = array(
        'news_title' => $result[0],
        'news_url' => $result[1]
    );
    if ($result != null) {
    	return toArray(303,"新闻信息获取成功",$data);
    }else{
    	return toArray(304,"新闻信息获取失败");
    }
}