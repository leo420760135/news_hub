<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/25
 * Time: 17:27
 */

include_once "session.php";
include_once "redirect.php";
include_once "connect.php";
//var_dump($_SESSION);
if($_SESSION['privilege'] <0)
{
    redirect("sign.php","alert('请先登录！');");

}

$user_name = $_POST["user_name"];
$email = $_POST["email"];
$old_pwd = $_POST["old_password"];
$new_pwd =$_POST["new_password"];
$new_pwd_ag = $_POST["new_password_ag"];


$connect = connect();
$sql = "select psw from user where name='{$user_name}' and psw='{$old_pwd}';";
$result = $connect->query($sql);
$array = $result->fetch(PDO::FETCH_ASSOC);
if($array)
{
    if($new_pwd === $new_pwd_ag)
    {
        if($new_pwd == "")
        {
            $new_pwd = $old_pwd;
        }
        $sql ="update user set email='{$email}',psw='{$new_pwd}' where name='{$user_name}';";
        $affect_row = $connect->exec($sql);
        if($affect_row == 1)
        {
            redirect("user_info.php","alert('修改成功');");
        }
        else
        {
            redirect("user_info.php","alert('修改失败');");
        }
    }
    else
    {
        redirect("user_info.php","alert('两次输入的密码不一致');");
    }
}
else
{
    redirect("user_info.php","alert('密码错误');");
}




