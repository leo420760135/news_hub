<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/18
 * Time: 23:07
 */

include_once "session.php";
include_once "class.php";
if($_SESSION["user_name"] == "news_hub_anonymous_user")
{
//    echo <<<EOT
//    <script type='text/javascript'>window.location.href="sign.php";
//        alert('请先登录!');
//    </script>"
//EOT;

}

if(!isset($text_to_edit))
{
    $text_to_edit = "在这里输入新闻内容";
}

$class_options = "";
foreach($class_list as $key=>$value)
{
    $class_options.=<<<EOT
<option value="{$key}">{$value}</option>
EOT;
}

$content = <<<EOT
    <form class=" form-horizontal" action="news_handler.php" method="post" style="margin-top:50px">

        <input type="hidden" id="content">
        <div class="row">
            <div class="col-md-7 form-group">
                <label for="news_title" class="col-md-2 control-label">标题</label>
                <div class=" col-md-10">
                <input type="text" class="form-control" name="news_title" id="news_title" placeholder="标题">
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="news_class" class="col-md-5 control-label">分类</label>
                <div class=" col-md-7">
                <select class="form-control" name="news_class" id="news_class">
                {$class_options}
                </select>
                </div>
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

