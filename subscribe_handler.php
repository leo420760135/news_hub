<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/11/1
 * Time: 15:32
 */

include_once "session.php";
include_once "redirect.php";
include_once "connect.php";
//var_dump($_SESSION);
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
else
{
    $connect =connect();
    $user_name = $_POST["user_name"];
    $class = $_POST["class"];
    $type = $_POST["type"];
    if($type == "subscribe")
    {
        $sql = "insert into subscribe(user_name,news_class) values('{$user_name}','{$class}');";
    }
    elseif($type == "unsubscribe")
    {
        $sql = "delete from subscribe where user_name='{$user_name}' and news_class='{$class}';";
    }
    $affact_row = $connect->exec($sql);
    if($affact_row == 1)
    {
        redirect("more_news.php?class={$class}","alert('操作成功');");
    }
    else
    {
        redirect("more_news.php?class={$class}","alert('操作失败');");
    }
}