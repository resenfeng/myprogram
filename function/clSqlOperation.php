<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-14
 * Time: 下午1:53
 */
require_once('./config.php');
class clSqlOperation
{
    private $text;          //从数据库获取的预期结果,更新操作时的键值数组
    private $table;         //操作的表名
    private $cond;          //获取记录的条件
    private $spSql;         //特殊情况sql查询语句
    private $backVal;

    function __construct($text,$table,$cond,$spsql)
    {
        $this->text = $text;
        $this->table = $table;
        $this->cond = $cond;
        $this->spSql = $spsql;
        $this->backVal = null;
    }

    /**
     * @return bool
     *function:向数据库插入一条记录
     *parament:$strKey 插入操作的数据库字段名组合
     *         $strVal 插入操作的数据值组合
     *         $isAr   判断传入的值中是否有数组
     *         $arTemp 用于储存数据中的数组
     */
    function fnInsert(){
        $strKey = null;
        $strVal = null;
        $isAr = null;
        $arTemp = null;
        foreach ($this->text as $key=>$value){
            if($strKey == null && $strVal == null){
                $sep = "";
            }else{
                $sep = ",";
            }
            $strKey .= $sep.$key;
//            if(is_array($value)){
//                foreach ($value as $val){
//                    $strVal .= $sep."'".$val."'";
//                }
//
//            }
            if(is_array($value)){
                $isAr = true;
                $arTemp[] = $value;
            }
            else
                $strVal .= $sep."'".$value."'";
        }
        if($isAr){
            $strVal = null;
            $tempNum = count($arTemp);
            $dataNum = count($arTemp[0]);
            for($i = 0;$i < $dataNum;$i++){
                $strVal .="(";
                for($j = 0;$j < $tempNum;$j++){
                    if($j == $tempNum-1){
                        $sep = "";
                    }else{
                        $sep = ",";
                    }
                    $strVal .= "'".$arTemp[$j][$i]."'".$sep;
                }
                if($i == $dataNum-1){
                    $sep1 = "";
                }else{
                    $sep1 = ",";
                }
                $strVal .= ")".$sep1;
            }
        }else
            $strVal = "("."$strVal".")";

        $sql = "insert into "."$this->table"." ("."$strKey".") "."values "."$strVal";
        $result = mysql_query("$sql");
        if($result != null)
            $this->backVal = true;
        else
            $this->backVal = false;
        return $this->backVal;
    }

    /**
     * @return bool
     *function:更新数据库的记录
     *parament:
     */
    function fnUpdate(){
        $str = null;
        foreach ($this->text as $key=>$value){
            if($str == null){
                $sep = "";
            }else{
                $sep = ",";
            }
            $str .=$sep.$key."=".$value."";
        }
        $where = ($this->cond == null) ? null:' where '.$this->cond;
        $sql = "update "."$this->table"." set ".$str.$where;
        $result = mysql_query("$sql");
        if($result != null)
            $this->backVal = true;
        else
            $this->backVal = false;
        return $this->backVal;
    }

    /**
     * @return bool
     *function:删除数据库中的记录
     *parament:
     */
    function fnDelete()
    {
        $where = ($this->cond == null) ? null:' where '.$this->cond;
        $spsql = ($this->spSql == null) ? null:' '.$this->spSql;
//        $sql = 'select '."$this->text".' from '."$this->table".' where '."$this->cond";
        $sql = 'delete '."$this->text".' from '."$this->table".$where.$spsql;
        $query = mysql_query("$sql");
        $result = mysql_fetch_array($query,MYSQL_ASSOC);
        if($result != null)
            $this->backVal = true;
        else
            $this->backVal = false;
        return $this->backVal;
    }

    /**
     * @return array
     *function:执行有特殊条件的查询语句，并返回结果
     *parament:
     */
    function fnOther(){
//        $sql = $this->spSql;
//        $query = mysql_query("$sql");
//        $result = array();
//        while(@$record=mysql_fetch_array($query,MYSQL_ASSOC))
//        {
//            $result[] = $record;
//        }
//        return $result;

        $result = array();
//        $sql = 'select '."$this->text".' from '."$this->table"." $this->spSql";
//        $query = mysql_query("$sql");
//        $query = mysql_fetch_row($query);
        $query = mysql_query("$this->spSql");
        while(@$record = mysql_fetch_row($query))
        {
            $result[] = $record;
        }
        return $result;
    }

    /**
     * @return array
     *function:从数据库中获得符合条件的一条记录
     *parament:
     */
    function fnGetOne(){
        $where = ($this->cond == null) ? null:' where '.$this->cond;
        $spsql = ($this->spSql == null) ? null:' '.$this->spSql;
//        $sql = 'select '."$this->text".' from '."$this->table".' where '."$this->cond";
        $sql = 'select '."$this->text".' from '."$this->table".$where.$spsql;
        $query = mysql_query("$sql");
        $result = mysql_fetch_array($query,MYSQL_ASSOC);
        return $result;
    }

    /**
     * @return array
     *function:从数据库中获得符合条件的所有记录
     *parament:
     */
    function fnGetAll($index){
        //得到所有数据库记录
        $result = array();
        $where = ($this->cond == null) ? null:' where '.$this->cond;
        $spsql = ($this->spSql == null) ? null:' '.$this->spSql;
//        $sql = 'select '."$this->text".' from '."$this->table".' where '."$this->cond";
        $sql = 'select '."$this->text".' from '."$this->table".$where.$spsql;

        $query = mysql_query("$sql");
        while(@$record = mysql_fetch_array($query,$index))
        {
            $result[] = $record;
        }
        return $result;
    }
}