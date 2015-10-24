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
    $news_id = $_GET["news_id"];
    $com_id = $_GET["com_id"];
    if(delete_comment($news_id,$com_id))
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

function delete_comment($news_id, $com_id)
{
    $connect = connect();
    $sql = "delete from comment where news_id={$news_id} and com_id={$com_id};";
    return $connect->exec($sql);
}