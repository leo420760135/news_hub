<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/18
 * Time: 23:07
 */

include_once "session.php";
include_once "class.php";
include_once "redirect.php";
include_once "connect.php";
include_once "get_template_list.php";
//var_dump($_SESSION);
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
elseif($_SESSION['privilege'] <1)
{
    redirect("about.php","alert('您的权限不足，请联系管理员！')");
}


if(!isset($text_to_edit))
{
    $text_to_edit = "在这里输入新闻内容";
    $title = "";
}

//是否第二次编辑
$is_edit = "";
if(isset($_GET["id"]))
{
    $is_edit = <<<EOT
    <input type = "hidden" name = "edit" value="{$_GET["id"]}">
EOT;
}

//分类选项
$class_options = "";
foreach($class_list as $key=>$value)
{
    $class_options.=<<<EOT
<option value="{$key}">{$value}</option>
EOT;
}

$template_list = get_template_list();
$template_list_str = get_template_list_str($template_list,"publish.php");

$content = <<<EOT
    <form class=" form-horizontal" action="{$handler}" method="post" style="margin-top:50px">

        <input type="hidden" id="content">
        {$is_edit}
        <div class="row">
            <div class="col-md-7 form-group">
                <label for="news_title" class="col-md-2 control-label">标题</label>
                <div class=" col-md-10">
                <input type="text" class="form-control" name="news_title" id="news_title" placeholder="标题" value="{$title}">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="news_class" class="col-md-5 control-label">分类</label>
                <div class=" col-md-7">
                <select class="form-control" name="news_class" id="news_class">
                {$class_options}
                </select>
                </div>
            </div>
            <div class="col-md-2">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              选择模板
            </a>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1 collapse" id="collapseExample">
          <div class="well">
            {$template_list_str}
          </div>
        </div>

        <div class="row">
        <!-- 加载编辑器的容器 -->
        <script id="container" name="news_content" type="text/plain" class="col-md-10 col-md-offset-1" style="margin-top:20px">
            {$text_to_edit}
        </script>
        </div>
        <div class="row">
        <input type="submit" value="提交" class="btn btn-success col-md-1 col-md-offset-10" style="margin-top:20px">
        </div>
    </form>
    <!-- 配置文件 -->
    <script type="text/javascript" src="uediter/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="uediter/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var editor = UE.getEditor('container');
    </script>
EOT;




include "layout.php";

