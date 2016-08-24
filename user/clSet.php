<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-15
 * Time: 上午11:21
 */
class clSet
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    /**
     * @return bool|null|string
     *function:验证用户并提供修改密码服务
     *parament:
     */
    function fnEditPw(){
        //实现用户的修改密码功能
        $data = array(
            'user_name' => $this->data['user_name'],
            'user_passwd' => $this->data['user_passwd'],
            'user_phone' => null
        );
        $check = new clInReg($data);
        $verify = $check->fnCheck();
        if($verify == 'true'){
            $userInfo = array(
                'user_name' => $this->data['user_name'],
                'user_passwd' => $this->data['user_new_passwd'],
            );
            $sqlQuery = new clSqlOperation($userInfo,"user_info","user_name = $this->data['user_name']",null);
            $result = $sqlQuery->fnUpdate();
            if($result == 'true')
                $this->backVal = 'true';
            else
                $this->backVal = $result;
        }else
            $this->backVal = "账号和密码不匹配，请重新输入！";
        return $this->backVal;
    }
}