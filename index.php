<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/14
 * Time: 9:23
 */

include "header.php";
$active_page = "index_page";
include_once "news_list.php";
include_once "class.php";
$tabs = "";
$tab_content_list = "";
foreach ($class_list as $key=>$value) {
    $tabs.=<<<EOT
<li role="presentation" id="{$key}-li" class=""><a href="#{$key}" id="{$key}-tab" role="tab" data-toggle="tab" aria-controls="{$key}">{$value}</a></li>
EOT;
    $news_list_str = "";
    if(count($news_list[$key])>0)
    {
        foreach ($news_list[$key] as $index=>$news_arr) {
            $news_list_str.=<<<EOT
<tr>
  <th scope="row">
    <a href="news_detail.php?id={$news_arr['id']}">{$news_arr['title']}[{$news_arr['timestamp']}]</a><br>
  </th>
  <td>{$news_arr['timestamp']}</td>
  <td>{$news_arr['source']}</td>
</tr>
EOT;
        }

    }
    $tab_content_list.=<<<EOT
<div role="tabpanel" class="tab-pane fade" id="{$key}" aria-labelledBy="{$key}-tab">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>新闻标题</th>
          <th>发布时间</th>
          <th>新闻来源</th>
        </tr>
      </thead>
      <tbody>
      {$news_list_str}
      </tbody>
    </table>
</div>
EOT;
}

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