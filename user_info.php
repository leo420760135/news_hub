<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 9:58
 */
include_once "session.php";
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
else
{
    include "common_user.php";
    if($_SESSION['privilege'] == 1)
    {
        include "editor_user.php";
    }
    if($_SESSION['privilege'] == 2)
    {
        include "admin.php";
    }
}

$active_page = "user_info_page";
include "layout.php";
