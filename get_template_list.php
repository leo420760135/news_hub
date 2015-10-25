<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/25
 * Time: 15:07
 */

function get_template_list()
{
    $template_list = [];
    $connect = connect();
    $sql = "select id,name from template order by id;";
    $result = $connect->query($sql);
    while($temp = $result->fetch(PDO::FETCH_ASSOC))
    {
        $template_list[] = $temp;
    }
    return $template_list;
}

function get_template_list_str(array $template_list,$page)
{
    if(count($template_list) == 0)
    {
        return "暂无模板";
    }
    $template_list_str = '<div class="list-group">';
    foreach ($template_list as $index => $template)
    {
        $template_list_str .=<<<EOT
<a href="{$page}?tid={$template["id"]}" class="list-group-item">{$template["name"]}</a><br>
EOT;

    }
    $template_list_str .="</div>";
    return $template_list_str;
}
