<?php
/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-7-26
 * Time: 下午5:16
 */
require_once ('./function/getStr.php');
require_once ('./function/clSqlOperation.php');

/**
 * Class clSetMoment
 *点赞和评论的操作
 */
class clSetMoment
{
    private $userId;
    private $msgId;
    private $backVal;
    private $comment;
    private $date;
    function __construct($data )
    {
        $this->msgId = $data['msg_id'];
        $this->userId = $data['user_id'];
        $this->comment = $data['comment'];
        $this->date = $data['time'];
        $this->backVal = null;
    }

    /**
     * 用户点赞和取消点赞
     * @return null|string
     */
    function fnClick(){
        $text = "mom_like_id";
        $table ="moments_like";
        $cond = "mom_like_user_id = $this->userId and mom_like_msg_id = $this->msgId";
        $query = new clSqlOperation($text,$table,$cond,null);
        $result = $query->fnGetOne();
        if(empty($result)) {
            $data = array(
                "mom_like_user_id" => $this->userId,
                "mom_like_msg_id " => $this->msgId
            );
            $table = "moments_like";
            $query = new clSqlOperation($data,$table,null,null);
            $result = $query->fnInsert();
            if($result){
                $data1 = array('mom_like_num' => 'mom_msg_num + 1');
                $query1 = new clSqlOperation($data1,"moments_msg","mom_msd_id = $this->msgId",null);
                $result = $query1->fnUpdate();
                $this->backVal = toArray(100,"您成功点赞了该消息");
            }
            else
                $this->backVal = toArray(101,"点赞失败");
        }else {
            $table = "moments_like";
            $cond = "mom_like_user_id = $this->userId and mom_like_msg_id = $this->msgId";
            $query = new clSqlOperation(null,$table,$cond,null);
            $result = $query->fnDelete();
            if($result){
                $this->backVal = toArray(100,"您取消了对该条消息的点赞");
            }
            else
                $this->backVal = toArray(100,"取消点赞失败");
        }
        return $this->backVal;
    }

    /***
     * 用户评论
     * @return null|string
     */
    function fnComment(){
        $data = array(
            "mom_com_user_id" => $this->userId,
            "mom_com_msg_id " => $this->msgId,
            "mom_com_content" => $this->comment,
            "mom_com_time" => $this->date
        );
        $table = "moments_comment";
        $query = new clSqlOperation($data,$table,null,null);
        $result = $query->fnInsert();
        if($result)
            $this->backVal = toArray(100,"您成功评论了该条消息");
        else
            $this->backVal = toArray(101,"评论消息失败");
        return $this->backVal;
    }
}