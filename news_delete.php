<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 19:10
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
else
{
    $id = $_GET["id"];
    if(delete_news($id))
    {
        echo <<<EOT
<meta charset="utf-8">
<script>
    alert("删除成功");
    history.go(-1);
</script>
EOT;
    }
    else
    {
        echo <<<EOT
<meta charset="utf-8">
<script>
    alert("删除失败");
    history.go(-1);
</script>
EOT;
    }
}

function delete_news($id)
{
    $connect = connect();
    $sql = "delete from news where id={$id};";
    return $connect->exec($sql);
}