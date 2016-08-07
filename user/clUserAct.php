<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-20
 * Time: 下午1:53
 * Explain:
 */
class clUserAct
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = array();
    }

    /**
     *function:
     *parament:
     */
    function fnCheck(){
        $data = (object)$this->data;
        $sqlQuery = new clSqlOperation("user_phone,user_passwd,user_name","user_info","user_phone = '$data->user_phone' and user_passwd = '$data->user_passwd'",null);
        $result = $sqlQuery->fnGetOne();
        if($data->user_phone == $result['user_phone'] && $data->user_passwd == $result['user_passwd']){
            $this->backVal = toArray(201,"登录成功",$result['user_name']);
        }
        else
            $this->backVal = toArray(202,"用户名或密码错误，请重新输入！");
        return $this->backVal;
    }

    /**
     * @return bool|null
     *function:实现用户的注册功能
     *parament:
     */
    function fnRegist(){
        $data = (object)$this->data;
        if (is_numeric($this->data['user_phone'])){
            if(preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $data->user_phone) ? true : false){
                $userInfo = array(
                    'user_name' => $this->data['user_name'],
                    'user_passwd' => $this->data['user_passwd'],
                    'user_phone' => $this->data['user_phone']
                );
                $sqlQueryPh = new clSqlOperation('user_phone',"user_info","user_phone = $data->user_phone",null);
                if ($sqlQueryPh->fnGetOne() == null){
                    $sqlQuery = new clSqlOperation($userInfo,"user_info",null,null);
                    $result = $sqlQuery->fnInsert();
                    if ($result == true)
                        $this->backVal = toArray(203,"用户注册成功！");
                    else
                        $this->backVal = toArray(101,"用户注册失败！");
                }else{
                    $this->backVal = toArray(205,"该手机号注册的用户已存在，请重新输入！");
                }
            }else
                $this->backVal = toArray(204,"输入的手机号错误，请重新输入！");
        }else
            $this->backVal = toArray(204,"输入的手机号错误，请重新输入！");
        return $this->backVal;
    }

    function fnEditPw(){
        //实现用户的修改密码功能;
        $verify = $this->fnCheck();
        if($verify['code'] == 201){
            $data = (object)$this->data;
            $userInfo = array(
//                'user_name' => $this->data['user_name'],
                'user_passwd' => $this->data['user_new_passwd'],
                'user_phone' => $this->data['user_phone']
            );
            $sqlQuery = new clSqlOperation($userInfo,"user_info","user_passwd = '$data->user_passwd' and user_phone = '$data->user_phone'",null);
            $result = $sqlQuery->fnUpdate();
            if($result == true)
                $this->backVal = toArray(206,"修改密码成功");
            else
                $this->backVal = toArray(101,"修改密码失败");
        }else
            $this->backVal = toArray(207,"账号和密码不匹配，请重新输入！");
        return $this->backVal;
    }
}