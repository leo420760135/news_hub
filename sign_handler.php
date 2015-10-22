<?php
include_once "connect.php";
include_once "redirect.php";
$connect = connect();
$name = $_POST["user_name"];
$password = $_POST["password"];
$type = trim($_POST["type"]);
if($type=="in")
{
	sign_in($connect,$name,$password);
}
else
{
    $password_ag = $_POST["password_ag"];
	sign_up($connect,$name,$password,$password_ag);
}

function sign_in(PDO $connect,$name,$password)
{
    $sql = "select * from user where name='{$name}' and psw='{$password}';";
    $result = $connect->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $array = $result->fetch();
    if($array) {
        $user_name = $array["name"];
        session_start();
        $_SESSION['user_name'] = $user_name;
        $_SESSION['privilege'] = (int)$array["privilege"];
        redirect("index.php");
    }
    else
    {
        redirect("sign.php","alert('用户名或密码错误');");
    }
}

function sign_up(PDO $connect,$name,$password,$password_ag)
{
    if($password != $password_ag)
    {
        redirect("sign.php","alert('两次输入的密码不一致');");
    }
    $sql = "insert into user(name,psw) values ('{$name}','{$password}');";
    $result = $connect->exec($sql);
    if($result == true)
    {
        sign_in($connect,$name,$password);
    }
    else
    {
        redirect("sign.php","alert('注册失败')");
    }
}

?>