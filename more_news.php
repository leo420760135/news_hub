<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 18:20
 */

include_once "get_news_list.php";
include_once "connect.php";
include_once "class.php";
include_once "session.php";

$class = $_GET["class"];
$class_list[] = $class;
//var_dump($class_list);
$connect = connect();
$news_list = get_news_list($connect,$class_list,0,10);
$news_list_str = get_news_list_str($news_list,$class,$_SESSION["privilege"]);

$content = <<<EOT
<div class="page-header">
  <h1>{$class_list[$class]} <small>新闻</small></h1>
</div>
{$news_list_str}
EOT;


include "layout.php";
