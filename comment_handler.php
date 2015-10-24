<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/23
 * Time: 23:32
 */

include_once "session.php";
include_once "class.php";
include_once "redirect.php";
include_once "connect.php";
//var_dump($_SESSION);
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}

$news_id = $_GET["news_id"];
$user_name = $_GET["user_name"];
$detail = $_POST["detail"];

$sql ="select max(com_id) as m_id from comment where news_id={$news_id} group by news_id;";
$connect = connect();
$result = $connect->query($sql);
$array = $result->fetch(PDO::FETCH_ASSOC);
$com_id = 1;
if(!$array)
{
    $com_id = $array["m_id"]+1;
}

$sql = "insert into comment(news_id,user_name,detail,timestamp,com_id) values({$news_id},'{$user_name}','{$detail}',now(),{$com_id});";
$result = $connect->exec($sql);
var_dump($sql);