<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/18
 * Time: 23:46
 */
include_once "session.php";
include_once "connect.php";
include_once "class.php";
$connect = connect();
$news_title = $_POST["news_title"];
$news_class = $_POST["news_class"];
$news_content = $_POST["news_content"];

$sql = "insert into news(title,detail,source,publisher,class,timestamp) values(:news_title,:news_content,'本站',:user_name,:news_class,now());";
//echo $sql."<br>";
$prepare = $connect->prepare($sql) ;

$prepare->execute(array(
    ':news_title'=>$news_title,
    ':news_content'=>$news_content,
    ':user_name'=>$_SESSION["user_name"],
    ':news_class'=>$news_class
    ));
//$connect->exec($sql);