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

define("NEWS_PER_PAGE",10);
$class = $_GET["class"];
$page = 1;
if(isset($_GET["page"]))
{
    $page = $_GET["page"];
}
if($page<1)
{
    go_back("已经是第一页");
}
$begin = NEWS_PER_PAGE * ($page-1);
$class_list[] = $class;
//var_dump($class_list);
$connect = connect();
$sql = "select count(*) from news where class='{$class}';";
$result = $connect->query($sql);
$array = $result->fetch(PDO::FETCH_NUM);
$news_count = $array[0];
$page_count = (int)($news_count/NEWS_PER_PAGE)+1;
if($page>$page_count)
{
    go_back("已经是最后一页");
}
$news_list = get_news_list($connect,$class_list,$begin,NEWS_PER_PAGE);
$news_list_str = get_news_list_str($news_list,$class,$_SESSION["privilege"]);
$next_page = min($page+1,$page_count);
$pre_page = max($page -1,1);
$content = <<<EOT
<div class="page-header">
  <h1>{$class_list[$class]} <small>新闻</small></h1>
</div>
{$news_list_str}

<div class="row">
    <nav>
      <ul class="pager">
        <li>第{$page}页 共{$page_count}页</li>
        <li><a href="more_news.php?class={$class}&page={$pre_page}">上一页</a></li>
        <li><a href="more_news.php?class={$class}&page={$next_page}">下一页</a></li>
      </ul>
    </nav>
</div>
EOT;

function go_back($msg)
{
    echo <<<EOT
<meta charset="utf-8">
<script>
alert('{$msg}');
history.go(-1);
</script>
EOT;

}



include "layout.php";
