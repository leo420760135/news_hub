<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/25
 * Time: 14:59
 */

include_once "connect.php";
include_once "session.php";
if($_SESSION['privilege'] <2)
{
    redirect("about.php","alert('您的权限不足，请联系管理员！')");
}

if(isset($_GET["tid"]))
{
    $connect = connect();
    $sql = "select * from template where id={$_GET["tid"]};";
    $result = $connect->query($sql);
    $array = $result->fetch(PDO::FETCH_ASSOC);
    if($array)
    {
        $text_to_edit = $array["detail"];
        $title = $array["name"];

    }
}

$handler = "template_handler.php";
include "news_edit.php";
