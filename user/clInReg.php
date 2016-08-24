<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-15
 * Time: 上午11:15
 */
class clInReg
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    /**
     *function:
     *parament:
     */
    function fnCheck(){
        $sqlQuery = new clSqlOperation("user_name,user_passwd","user_info","user_name = $this->data['user_name']",null);
        $result = $sqlQuery->fnGetOne();
        if($this->data['user_name'] == $result['user_name'] && $this->data['user_passwd'] == $result['user_passwd']){
            $this->backVal = 'true';
        }
        else
            $this->backVal = "用户名或密码错误，请重新登录！";
        return $this->backVal;
    }

    /**
     * @return bool|null
     *function:实现用户的注册功能
     *parament:
     */
    function fnRegist(){
        if (!is_numeric($this->data['user_phone'])) {
            $this->backVal = "输入的手机号错误，请重新输入";
        }else if(preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->data['user_phone']) ? true : false){
            $userInfo = array(
                'user_name' => $this->data['user_name'],
                'user_passwd' => $this->data['user_passwd'],
                'user_phone' => $this->data['user_phone']
            );
            $sqlQueryPh = new clSqlOperation('user_phone',"user_info","user_phone = $this->data['user_phone']",null);
            if ($sqlQueryPh->fnGetOne()){
                $sqlQuery = new clSqlOperation($userInfo,"user_info",null,null);
                $result = $sqlQuery->fnInsert();
                $this->backVal = "true";
            }else{
                $this->backVal = "用户以存在，请重新输入";
            }
        }else
            $this->backVal = "输入的手机号错误，请重新输入";
        return $this->backVal;
    }
}