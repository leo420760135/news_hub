<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/23
 * Time: 9:57
 */

function get_comment_list(PDO $connect, $id)
{
    $sql = "select * from comment where news_id={$id} order by com_id desc;";
    $result = $connect->query($sql);
    $array = [];
    while($temp = $result->fetch(PDO::FETCH_ASSOC))
    {
        $array[] = $temp;
    }

    return $array;
}


function get_comment_list_str(array $comment_list, $privilege,$news_id)
{
    $comment_list_str = "";
    if(!$comment_list)
    {
        $comment_list_str =<<<EOT
    <div class="panel panel-default">
      <div class="panel-heading">暂无评论</div>
      <div class="panel-body text-center lead">
        暂无评论
      </div>
    </div>
EOT;
    }
    else
    {

        foreach ($comment_list as $index=>$comment)
        {
            $delete_option = "";
            if($privilege>1)
            {
                $delete_option = <<<EOT
            <a href="comment_delete.php?news_id={$news_id}&com_id={$comment["com_id"]}" class="btn btn-danger btn-sm">删除</a>
EOT;
            }
            $comment_list_str.=<<<EOT
    <div class="panel panel-default">
      <div class="panel-heading">
        <span class="">{$comment["com_id"]}# <span>
        {$comment["user_name"]}
        {$delete_option}
      </div>
      <div class="panel-body">
        {$comment["detail"]}
      </div>
    </div>
EOT;
        }

    }

    return $comment_list_str;
}