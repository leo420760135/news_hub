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

define("NEWS_PER_PAGE",10); //每页显示的新闻数量
$class = $_GET["class"]; //新闻类别

//分页
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
$next_page = min($page+1,$page_count);
$pre_page = max($page -1,1);


//获取新闻列表
$news_list = get_news_list($connect,$class_list,$begin,NEWS_PER_PAGE);
$news_list_str = get_news_list_str($news_list,$class,$_SESSION["privilege"]);

//订阅选项
$subscribe_option = "";
if($_SESSION["privilege"]>0)
{
    $sql = "select * from subscribe where user_name='{$_SESSION["user_name"]}' and news_class='{$class}';";
    $result = $connect->query($sql);
    $array = $result->fetch(PDO::FETCH_ASSOC);
    if($array)
    {
        $subscribe_option = <<<EOT
<input type="hidden" name="type" value="unsubscribe">
<button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-star"></span>取消订阅</button>
EOT;
    }
    else
    {
        $subscribe_option = <<<EOT
<input type="hidden" name="type" value="subscribe">
<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-star-empty"></span>订阅</button>
EOT;
    }
}



$content = <<<EOT
<div class="page-header">
  <div class="row">
      <h1 class="col-md-2">{$class_list[$class]} <small>新闻</small></h1>

      <form action="subscribe_handler.php" method="post">
          <input type="hidden" name="class" value="{$class}">
          <input type="hidden" name="user_name" value="{$_SESSION["user_name"]}">
          {$subscribe_option}
      </form>
  </div>
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
