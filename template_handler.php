<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/25
 * Time: 14:55
 */

include_once "session.php";
include_once "connect.php";
include_once "redirect.php";
//var_dump($_SESSION);
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！')");

}
elseif($_SESSION['privilege'] <1)
{
    redirect("about.php","alert('您的权限不足，请联系管理员！')");
}

$connect = connect();
$template_name=$_POST["news_title"];
$template_detail = $_POST["news_content"];

$sql = "insert into template(name,detail) values(:name,:detail);";

$prepare = $connect->prepare($sql) ;

$prepare->execute(array(
    ':name'=>$template_name,
    ':detail'=>$template_detail
));

redirect("user_info.php");