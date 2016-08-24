<?php

/**
 * Created by PhpStorm.
 * User: baiyang
 * Date: 16-8-3
 * Time: 上午11:44
 */

header("Content-type:text/html;charset=utf-8");
define("MONGOSERVER","mongodb://yyz:nj_yyz_312_mongo@180.153.51.180:28001/papacamera");
//$mongoDb =new MongoClient();//SERVER


class clMongoOperation
{

    protected $collection;         //操作的集合
    protected $arCond;          //获取,更新，删除记录的条件
    protected $arShow;        //显示的字段array('field1','field2'),或者是update,insert的值
    protected $backVal;      //返回值
    protected $mongoDB;      //连接mongodb

    function __construct($collection,$arCond,$arShow=array())
    {
        $this->mongoDB = new MongoClient(MONGOSERVER);
        $this->arShow=$arShow;
        $this->collection=$this->mongoDB->papacamera->$collection;
        $this->arCond= $arCond;

    }

    /**
     * 从数据库中获得一条记录
     * @return array|null
     */
    function fnGetOne()
    {
        $query=null;

        if($this->arCond == null)
        {

            $query=empty($this->arShow)?$this->collection->findOne()
            :$this->collection->findOne(array(),$this->arShow);

        }

        else
        {

            $query =  empty($this->arShow)?$this->collection->findOne($this->arCond)
               :$this->collection->findOne($this->arCond,$this->arShow);


        }
        $this->backVal=$query;
       return $this->backVal;
    }

    /**
     * 从数据库中获得多条记录
     * @return array
     */
    function fnGetAll()
    {

        if($this->arCond == null)
        {

            $query= empty($this->arShow)? $this->collection->find()
                :$this->collection->find(array(),$this->arShow);

        }

        else
        {

            $query =  empty($this->arShow)?$this->collection->find($this->arCond):
                $this->collection->find($this->arCond,$this->arShow);


        }
        $temp=array();
        foreach ($query as $key=>$value)
        {
            $temp[]=$value;
        }
        $this->backVal=$temp;
        return $this->backVal;
    }

    /**更新collection
     * @param array $options
     * @return string
     */
    function fnUpdate($options=array() )//更新的附加属性array("p1"=>true)，详见官方文档
    {
        $query= empty($options)? $this->collection->update($this->arCond,array('$set'=>$this->arShow))
        :$this->collection->update($this->arCond,array('$set'=>$this->arShow),$options);
         if($query)
             $this->backVal="更新成功";
        else
            $this->backVal="更新失败";
        return $this->backVal;
    }

    /**
     * 向collection中插入记录
     * @param array $options
     * @return string
     */
    function fnInsert($options=array('safe'=>false))//附加属性详见官方文档
    {
      $query= empty($options)? $this->collection->insert($this->arShow)
       :$this->collection->insert($this->arShow,$options);
        if(!is_array($query))
        {
            if($query==1)
                $this->backVal="插入成功";
            else
                $this->backVal="插入失败";
        }
        else
        {
            if($query['ok']==1)
                $this->backVal="插入成功";
            else
                $this->backVal="插入失败";
        }
        return $this->backVal;
    }

    /**从collection中删除记录
     * @param array $retVal
     * @return string
     */
    function fnDelete($retVal=array())
    {
        $query=$this->collection->remove($this->arCond,$retVal);

       if($query['ok']==1)
           $query['n']>0?$this->backVal="删除成功":$this->backVal="记录不存在";
        else
            $this->backVal="删除失败";
       return $this->backVal;
    }



    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->mongoDB->close();
    }


}