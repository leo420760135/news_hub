<?php
if(!isset($_SESSION))
{
    session_start();
}
$_SESSION['user_name']="news_hub_anonymous_user";
$_SESSION['privilege']=-1;

$content = <<<EOT

<div class="row text-center" style = "margin-top:20px">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#signinModal">
  登录News Hub
</button>

<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#signupModal">
  注册News Hub
</button>

</div>


<!-- Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="signinModallLabel">
  <div class="modal-dialog" role="document">
    <form action="sign_handler.php" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="signinModalLabel">登录News Hub</h4>
          </div>
          <div class="modal-body">
            <h2></h2>
            <input type="hidden" name="type" value="in">
            <div class="form-group">
                <label for="signin_name">用户名</label>
                <input class="form-control" id="signin_name" type="text" name="user_name" placeholder="用户名" >
            </div>
            <div class="form-group">
                <label for="signin_pwd">密码</label>
                <input class="form-control" id="signin_pwd" type="password" name="password" placeholder="密码" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" value=" 登录 " class="btn btn-primary">
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel">
  <div class="modal-dialog" role="document">
    <form action="sign_handler.php" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="signupModalLabel">注册News Hub</h4>
          </div>
          <div class="modal-body">

            <h2></h2>
            <input type="hidden" name="type" value="up">
            <div class="form-group">
                <label for="signup_name">用户名</label>
                <input class="form-control" id="signup_name" type="text" name="user_name" placeholder="用户名" >
            </div>
            <div class="form-group">
                <label for="signup_pwd">密码</label>
                <input class="form-control" id="signup_pwd" type="password" name="password" placeholder="密码" >
            </div>
            <div class="form-group">
                <label for="signup_pwd_ag">确认密码</label>
                <input class="form-control" id="signup_pwd_ag" type="password" name="password_ag" placeholder="确认密码" >
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" value=" 注册 " class="btn btn-success">
          </div>
        </div>
    </form>
  </div>
</div>
EOT;
$active_page = "sign_page";

include "header.php";


include "layout.php";