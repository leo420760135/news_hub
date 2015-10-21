<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/18
 * Time: 23:09
 */
include_once "connect.php";
include_once "class.php";
$connect = connect();
$news_id = $_GET["id"];
$sql = "SELECT * FROM news WHERE id = {$news_id};";
$result = $connect->query($sql);
$array = $result->fetch(PDO::FETCH_ASSOC);
if($array)
{

    $content = <<<EOT
<div class="page-header">
   <h1 class="text-center">
       <div class="row">
           {$array["title"]}
       </div>
       <div class="row">
           <small><small>
           分类:{$class_list[$array["class"]]}
           来源:{$array["source"]}
           作者:{$array["publisher"]}
           时间:{$array["timestamp"]}
           </small></small>
       </div>
   </h1>
</div>
{$array["detail"]}
EOT;

    include "layout.php";
}
else
{
    echo <<<EOT
<script>
    alert("该内容不存在！");
    window.location.href="index.php";
</script>
EOT;

}

