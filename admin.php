<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/18
 * Time: 23:22
 */
include_once "session.php";
include_once "redirect.php";
include_once "connect.php";
include_once "get_template_list.php";

if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
elseif($_SESSION['privilege'] <2)
{
    redirect("about.php","alert('您的权限不足，请联系管理员！')");
}

$template_list = get_template_list();
$template_list_str = get_template_list_str($template_list,"template_edit.php");

$ext_info = <<< EOT
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          模板管理
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
      <div class="col-md-8 col-md-offset-2">
        {$template_list_str}
        <a href="template_edit.php" class="btn btn-primary">新建模板</a>
      </div>
      </div>
    </div>
  </div>
EOT;
