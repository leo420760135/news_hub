<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/14
 * Time: 9:38
 */
include_once "connect.php";
include_once "class.php";
$connect = connect();
$news_list = get_news_list($connect,$class_list,0,10);
//var_dump($news_list);


function get_news_list(PDO $connect,array $class_list, $start, $count)
{
    $news_list = null;
    $sql = "select id,title,source,timestamp from news where class=:key order by timestamp desc limit $start,$count;";//PDO bug with limit statement
    foreach($class_list as $key=>$value )
    {
        $prepare = $connect->prepare($sql);
        $params = array(
            ':key'=>$key,
//            ':start'=>$start,
//            ':count'=>$count
        );
        //var_dump($params);
        $prepare->execute($params);
        $array=[];
        while($temp = $prepare->fetch(PDO::FETCH_ASSOC))
        {
            $array[] = $temp;
        }
        //var_dump($array);
        $news_list[$key] = $array;
    }
    return $news_list;
}





