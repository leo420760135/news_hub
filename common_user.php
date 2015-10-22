<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 19:48
 */

include_once "session.php";
include_once "redirect.php";
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
$content = __FILE__;