<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-14
 * Time: 上午10:58
 */
define("SERVER_NAME","180.153.51.180:13003");
define("USER_NAME","yyz");
define("DB_NAME","papacamera");
define("PASSWORD","njyyzr312mysql");
define("DB_CHARSET","utf8");

$connect = mysql_connect(SERVER_NAME,USER_NAME,PASSWORD);

if(!$connect){
    die("connect error".mysql_error());
}
mysql_select_db(DB_NAME,$connect);
mysql_set_charset(DB_CHARSET);
