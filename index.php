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

include "layout.php";