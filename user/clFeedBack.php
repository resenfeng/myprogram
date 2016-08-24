<?php
/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-7-15
 * Time: 下午1:25
 * 储存和读取反馈信息
 */
require_once ('./function/toArray.php');
class clFeedBack
{
    private $data;          //操作所需数据
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    /**
     * @return bool
     *function:实现用户的反馈
     *parament:
     */
    function fnSaveFeedBack()
    {
        $query=new clSqlOperation($this->data,'app_feedback',null,null);
        if (preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->data['fb_user_phone']) ? true : false){
            if ($query->fnInsert() == true){
                $this->backVal = toArray(210,"谢谢您的反馈，我们会认真考虑您的意见！");
            }else
                $this->backVal = toArray(101,"反馈失败！");
        }else{
            $this->backVal = toArray(101,"输入的手机号错误，反馈失败！");
        }
        return $this->backVal;
    }
}