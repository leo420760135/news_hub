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
include_once "redirect.php";
$connect = connect();
$news_title = $_POST["news_title"];
$news_class = $_POST["news_class"];
$news_content = $_POST["news_content"];

$sql = "insert into news(title,detail,source,publisher,class,timestamp) values(:news_title,:news_content,'本站',:user_name,:news_class,now());";

if(isset($_POST["edit"]))
{
    $sql = "update news set title=:news_title, detail=:news_content, source='本站',publisher=:user_name,class=:news_class,timestamp=now() where id={$_POST["edit"]};";
}

//echo $sql."<br>";
$prepare = $connect->prepare($sql) ;

$prepare->execute(array(
    ':news_title'=>$news_title,
    ':news_content'=>$news_content,
    ':user_name'=>$_SESSION["user_name"],
    ':news_class'=>$news_class
    ));
//$connect->exec($sql);

$sql = "select id from news where publisher='{$_SESSION["user_name"]}' order by timestamp desc;";
$result = $connect->query($sql);
$id = $result->fetch(PDO::FETCH_NUM)[0];

redirect("news_detail.php?id={$id}");