<?php

/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-20
 * Time: 下午2:53
 * Explain:
 *$data为键值数组
 *get_num:所需广告数量
 *ad_type_id:获得的广告的类型
 *get_num:所需视频数量
 *
 */
require_once ('getStr.php');
class clGetDataStr
{
    private $data;
    private $backVal;

    function __construct($data = array())
    {
        $this->data = $data;
        $this->backVal = null;
    }

    /**
     * @return array|null
     *function:获取图片的id
     *parament:
     */
    public function fnGetAdId(){
        if (array_key_exists('get_num',$this->data)){
            $adNum = $this->data['get_num'];
            $query = new clSqlOperation("ad_id","advert_info",null,"order by ad_count desc limit $adNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("ad_id","advert_info",null,"order by ad_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|mixed|null
     *function:获取图片的点击次数
     *parament:
     */
    public function fnGetAdCount(){
        if (array_key_exists('get_num',$this->data)){
            $adNum = $this->data['get_num'];
            $query = new clSqlOperation("ad_count","advert_info",null,"order by ad_count desc limit $adNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("ad_count","advert_info",null,"order by ad_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|null
     *function:获取图片的标题
     *parament:
     */
    public function fnGetAdTitle(){
        if (array_key_exists('get_num',$this->data)){
            $adNum = $this->data['get_num'];
            $query = new clSqlOperation("ad_name","advert_info",null,"order by ad_count desc limit $adNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("ad_name","advert_info",null,"order by ad_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|null
     *function:获取广告主题图片的url
     *parament:
     */
    public function fnGetAdT(){
        if (array_key_exists('get_num',$this->data)){
            $adNum = $this->data['get_num'];
            $query = new clSqlOperation("ad_topic_url","advert_info",null,"order by ad_count desc limit $adNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            if (array_key_exists('ad_type_id',$this->data)){
                switch ($this->data['ad_type_id']){
                    case 'a':
                        $query = new clSqlOperation("ad_topic_url","advert_info",null,"order by ad_count desc");
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    case '1':
                        $query = new clSqlOperation("ad_topic_url","advert_info","ad_type_id = 1",null);
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    case '2':
                        $query = new clSqlOperation("ad_topic_url","advert_info","ad_type_id = 2",null);
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    case '3':
                        $query = new clSqlOperation("ad_topic_url","advert_info","ad_type_id = 3",null);
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    case '4':
                        $query = new clSqlOperation("ad_topic_url","advert_info","ad_type_id = 4",null);
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    case '5':
                        $query = new clSqlOperation("ad_topic_url","advert_info","ad_type_id = 5",null);
                        $result = $query->fnGetAll(MYSQL_NUM);
                        $this->backVal = getStr($result);
                        break;
                    default:
                        $this->backVal = "广告列表图片获取失败";
                        break;
                }
            }else{
                $query = new clSqlOperation("ad_topic_url","advert_info",null,"order by ad_count desc");
                $result = $query->fnGetAll(MYSQL_NUM);
                $this->backVal = getStr($result);
            }

        }
        return $this->backVal;
    }

    /**
     * @return array|null
     *function:获取视频的id
     *parament:
     */
    public function fnGetVId(){
        if (array_key_exists('get_num',$this->data)){
            $videoNum = $this->data['get_num'];
            $query = new clSqlOperation("video_id","video_info",null,"order by video_count desc limit $videoNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("video_id","video_info",null,"order by video_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|null
     *function:获取视频的标题
     *parament:
     */
    public function fnGetVTitle(){
        if (array_key_exists('get_num',$this->data)){
            $videoNum = $this->data['get_num'];
            $query = new clSqlOperation("video_title","video_info",null,"order by video_count desc limit $videoNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("video_title","video_info",null,"order by video_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     *function:获取视频缩略图的url
     *parament:
     */
    public function fnGetVThum(){
        if (array_key_exists('get_num',$this->data)){
            $videoNum = $this->data['get_num'];
            $query = new clSqlOperation("video_thumbnail_url","video_info",null,"order by video_count desc limit $videoNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("video_thumbnail_url","video_info",null,"order by video_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     *function:获取视频播放路径的url
     *parament:
     */
    public function fnGetVideo(){
        if (array_key_exists('get_num',$this->data)){
            $videoNum = $this->data['get_num'];
            $query = new clSqlOperation("video_content_url","video_info",null,"order by video_count desc limit $videoNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("video_content_url","video_info",null,"order by video_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|mixed|null
     *function:获取视频的点击次数
     *parament:
     */
    public function fnGetVCount(){
        if (array_key_exists('get_num',$this->data)){
            $videoNum = $this->data['get_num'];
            $query = new clSqlOperation("video_count","video_info",null,"order by video_count desc limit $videoNum");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }else{
            $query = new clSqlOperation("video_count","video_info",null,"order by video_count desc");
            $result = $query->fnGetAll(MYSQL_NUM);
            $this->backVal = getStr($result);
        }
        return $this->backVal;
    }

    /**
     * @return array|null
     *function:获取轮播的图片和url
     *parament:
     */
    public function fnGetRolling(){
        $adNum = $this->data['get_num'];
        $query = new clSqlOperation("cl_pic_url,cl_detail_url","app_circular",null,"limit $adNum");
        $result = $query->fnGetAll(MYSQL_NUM);
        $this->backVal = getStr($result);
        return $this->backVal;
    }
}