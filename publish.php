<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/21
 * Time: 21:03
 */
include_once "connect.php";

$active_page = "publish_page";
if(isset($_GET["id"]))
{
    $connect = connect();
    $sql = "select * from news where id={$_GET["id"]};";
    $result = $connect->query($sql);
    $array = $result->fetch(PDO::FETCH_ASSOC);
    if($array)
    {
        $text_to_edit = $array["detail"];
        $title = $array["title"];
    }

}
include "news_edit.php";