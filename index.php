<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/14
 * Time: 9:23
 */

include "header.php";
include_once "get_news_list.php";
include_once "connect.php";
include_once "class.php";
include_once "session.php";

$active_page = "index_page";
$connect = connect();
//获取新闻列表array
$news_list = get_news_list($connect,$class_list,0,10);
//var_dump($news_list);
$tabs = "";
$tab_content_list = "";


foreach ($class_list as $key=>$value)
{
    //生成页签
    $tabs.=<<<EOT
<li role="presentation" id="{$key}-li" class=""><a href="#{$key}" id="{$key}-tab" role="tab" data-toggle="tab" aria-controls="{$key}">{$value}</a></li>
EOT;
    //生成用于显示的新闻列表
    $news_list_str = get_news_list_str($news_list,$key,$_SESSION["privilege"]);

    //生成页签内容
    $tab_content_list.=<<<EOT
<div role="tabpanel" class="tab-pane fade" id="{$key}" aria-labelledBy="{$key}-tab">
    {$news_list_str}
    <div class="">
        <a href="more_news.php?class={$key}" class="btn btn-success col-md-offset-10">更多 <span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
    </div>
</div>
EOT;
}

//激活的页签
$active_tab = array_keys($class_list)[0];

$content = <<<EOT
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        {$tabs}
    </ul>
    <div id="myTabContent" class="tab-content">
        {$tab_content_list}
    </div>
EOT;

$script = <<<EOT
        $("#{$active_tab}-li").attr("class","active");
        $("#{$active_tab}-tab").attr("aria-expanded","true");
        $("#{$active_tab}").attr("class","tab-pane fade in active");
EOT;

$style = <<<EOT
#news_hub {
  background: #020031; /* Old browsers */
  background: -moz-linear-gradient(45deg,  #020031 0%, #6d3353 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#020031), color-stop(100%,#6d3353)); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(45deg,  #020031 0%,#6d3353 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(45deg,  #020031 0%,#6d3353 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(45deg,  #020031 0%,#6d3353 100%); /* IE10+ */
  background: linear-gradient(45deg,  #020031 0%,#6d3353 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#020031', endColorstr='#6d3353',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
  -webkit-box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
     -moz-box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
          box-shadow: inset 0 3px 7px rgba(0,0,0,.2), inset 0 -3px 7px rgba(0,0,0,.2);
}
EOT;


include "layout.php";