<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 9:58
 */
include_once "session.php";
include_once "redirect.php";
include_once "get_comment_list.php";
include_once "connect.php";
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
else
{
    $connect = connect();
    $comment_list = get_comment_list($connect,0,$_SESSION["user_name"]);
    $comment_list_str = get_comment_list_str($comment_list,$_SESSION["privilege"]);

    $sql = "select * from user where name='{$_SESSION["user_name"]}';";
    $result = $connect->query($sql);
    $user_info_array = $result->fetch(PDO::FETCH_ASSOC);

    $update_info = <<<EOT
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          个人信息
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <form action="update_user_info.php" method = "post" class="col-md-8 col-md-offset-2">
          <input type = "hidden" name = "user_name" value="{$_SESSION["user_name"]}">
          <div class="form-group">
            <label for="user_name">用户名：</label>
            <input type = "text" class="form-control" id="user_name" value="{$_SESSION["user_name"]}" disabled>
          </div>
          <div class="form-group">
            <label for="email">Email 地址</label>
            <input type="email" class="form-control" name="email" id="email" value="{$user_info_array["email"]}">
          </div>
          <div class="form-group">
            <label for="old_password"></label>
            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="密码">
          </div>

            <div class="collapse" id="update_pwd">
              <div class="well">
                  <div class="form-group">
                    <label for="new_password"></label>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="新密码">
                  </div>
                  <div class="form-group">
                    <label for="new_password_ag"></label>
                    <input type="password" class="form-control" name="new_password_ag" id="new_password_ag" placeholder="确认新密码">
                  </div>
              </div>
            </div>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#update_pwd" aria-expanded="false" aria-controls="collapseExample">
            修改密码
          </button>
          <button type="submit" class="btn btn-success col-md-2 col-md-offset-10">确认修改</button>
        </form>
      </div>
    </div>
  </div>
EOT;

    $comment_info = <<<EOT
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          评论管理
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        {$comment_list_str}
      </div>
    </div>
  </div>
EOT;

    $ext_info = "";

    if($_SESSION['privilege'] == 1)
    {
        include "editor_user.php";
    }
    if($_SESSION['privilege'] == 2)
    {
        include "admin.php";
    }
}

$header = <<<EOT
    <div class="jumbotron masthead">
        <div class="container">
            <h1>你好，{$_SESSION["user_name"]}</h1>
            <p>在这里管理你的个人信息</p>
        </div>
    </div>
EOT;

$content = <<<EOT
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
{$update_info}
{$comment_info}
{$ext_info}
</div>
EOT;

$active_page = "user_info_page";
include "layout.php";
