<?php
/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-7-26
 * Time: 下午2:24
 */

/**
 * Class clGetMoments
 * 获得评论和点赞的有关信息
 */
require_once ('./function/getStr.php');
require_once ('./function/clSqlOperation.php');

 class clGetMoments
 {
     private $backVal=null;
     private $msgId;
     function __construct($data = array("msg_id"=>0))
     {
           $this->msgId = $data['msg_id'];
          
     }

     /**
      * @return array|mixed|null
      *function:获得消息内容，评论和点赞数量
      *parament:
      */
     function fnGetMoments()
     {
         $text = "moments_msg.mom_msg_text,mom_msg_pic_url,mom_msg_time,mom_msg_like_num,mom_msg_comment_num,user_info.user_name";
         $tables="moments_msg,user_info";
         $cond = "moments_msg.mom_msg_user_id = user_info.user_id";
         $spSql = "order by mom_msg_like_num,mom_msg_time desc";
         $query = new clSqlOperation($text,$tables,$cond,$spSql);
         $result = $query->fnGetAll(MYSQL_NUM);
         $this->backVal = toArray(100,"啪啪所有消息获取成功",getStr($result));
         return $this->backVal;
     }

     /**
      * @return array|mixed|null
      *function:获得评论内容及对应用户
      *parament:
      */
     function fnGetComments()
     {
         $text = "moments_comment.mom_com_text,mom_com_time,user_info.user_name";
         $table = "moments_comment,user_info";
         $cond = "mom_com_msg_id = $this->msgId and moments_comment.mom_com_user_id = user_info.user_id";
         $spSql = "order by mom_com_time desc";
         $query = new clSqlOperation($text,$table,$cond,$spSql);
         $result = $query->fnGetAll(MYSQL_NUM);
         $this->backVal = toArray(100,"该条消息的所有评论获取成功",getStr($result));
         return $this->backVal;
     }
 }