<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/23
 * Time: 9:16
 */
include_once "session.php";
include_once "get_comment_list.php";
include_once "connect.php";
$comment_disabled = " disabled";
$comment_place_holder = "请先登录再发表评论";
if($_SESSION["privilege"]>0)
{
    $comment_disabled = "";
    $comment_place_holder = "在这里输入评论";
}
$submit_comment = <<<EOT
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">发表评论 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></h3>
  </div>
  <div class="panel-body">
    <form action="comment_handler.php?news_id={$news_id}&user_name={$_SESSION['user_name']}" method = "post">
        <div class="form-group">
            <textarea name="detail" class="form-control" rows="3"{$comment_disabled} placeholder="{$comment_place_holder}"></textarea>
        </div>
        <div class="form-group">
            <input type = "submit" value = "发表" class = "col-md-1 col-md-offset-11 btn btn-success"{$comment_disabled}>
        </div>
    </form>
  </div>
</div>
EOT;

$comment_list = get_comment_list($connect,$news_id);
$comment_list_str = get_comment_list_str($comment_list,$_SESSION["privilege"]);

$comment = <<<EOT
<div class="page-header">
  <h1>评论区 <small>News Hub</small></h1>
</div>
{$submit_comment}
{$comment_list_str}
EOT;
