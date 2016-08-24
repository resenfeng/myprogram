<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午4:44
 * Explain:
 */
define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT."/function".PATH_SEPARATOR.ROOT."/user".PATH_SEPARATOR.ROOT."/advert");

require_once ('clSqlOperation.php');
require_once ('clMyInfo.php');
require_once ("clFeedBack.php");
require_once ('backJson.php');
require_once ('response.php');
require_once ('clUserAct.php');
require_once ('clGetUrl.php');
require_once ('config.php');
require_once ('getStr.php');
require_once ('getNews.php');
require_once ('clDoAdvert.php');
require_once ('clMongoOperation.php');