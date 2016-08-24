<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-27
 * Time: 上午10:59
 * Explain:用户在啪啪圈发布消息
 */
function fnPushMsg($data = array()){
    $text = array(
        'mom_msg_user_id' => $data['user_id'],
        'mom_msg_text' => $data['msg_text'],
        'mom_msg_pic_url' => $data['pic_url'],
        'mom_msg_time' => $data['send_time']
    );
    $table = "moments_msg";
    $query = new clSqlOperation($text,$table,null,null);
    $result = $query->fnInsert();
    if ($result)
        return toArray(100,"消息发送成功");
    else
        return toArray(101,"消息发送失败");
}