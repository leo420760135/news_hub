<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 19:48
 */
include_once "session.php";
include_once "redirect.php";
include_once "get_news_list.php";
include_once "connect.php";
include_once "class.php";
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
elseif($_SESSION['privilege'] <1)
{
    redirect("about.php","alert('您的权限不足，请联系管理员！')");
}
else
{
    $connect = connect();
    $news_list = get_news_list($connect,$class_list,0,20,$_SESSION["user_name"]);

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
</div>
EOT;
    }

//激活的页签
    $active_tab = array_keys($class_list)[0];

    $news_table = <<<EOT
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        {$tabs}
    </ul>
    <div id="myTabContent" class="tab-content">
        {$tab_content_list}
    </div>
EOT;


    $ext_info = <<< EOT
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          我的新闻
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        {$news_table}
      </div>
    </div>
  </div>
EOT;

    $script = <<<EOT
        $("#{$active_tab}-li").attr("class","active");
        $("#{$active_tab}-tab").attr("aria-expanded","true");
        $("#{$active_tab}").attr("class","tab-pane fade in active");
EOT;
}

