<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/14
 * Time: 9:38
 */



function get_news_list(PDO $connect,array $class_list, $start, $count)
{
    $news_list = null;
    $sql = "select id,title,source,timestamp,view_count from news where class=:key order by timestamp desc limit $start,$count;";//PDO bug with limit statement
    foreach($class_list as $key=>$value )
    {
        $prepare = $connect->prepare($sql);
        $params = array(
            ':key'=>$key,
//            ':start'=>$start,
//            ':count'=>$count
        );
        //var_dump($params);
        $prepare->execute($params);
        $array=[];
        while($temp = $prepare->fetch(PDO::FETCH_ASSOC))
        {
            $array[] = $temp;
        }
        //var_dump($array);
        $news_list[$key] = $array;
    }
    return $news_list;
}

function get_news_list_str(array $news_list,$class,$privilege)
{
    $option_th = "";
    if($privilege>1)
    {
        $option_th = <<<EOT
        <th>
        操作
        </th>
EOT;
    }
    $news_list_str = <<<EOT
    <table class="table table-hover">
      <thead>
        <tr>
          <th>新闻标题</th>
          <th>发布时间</th>
          <th>新闻来源</th>
          <th>浏览量</th>
          {$option_th}
        </tr>
      </thead>
      <tbody>
EOT;
    if(count($news_list[$class])>0)
    {
        foreach ($news_list[$class] as $index=>$news_arr)
        {
            $option_td = "";
            if($privilege>1)
            {
                $option_td = <<<EOT
    <td>
        <a href="publish.php?id={$news_arr['id']}" class="btn btn-warning">编辑</a>
        <a href="news_delete.php?id={$news_arr['id']}" class="btn btn-danger">删除</a>
    </td>
EOT;
            }


            $news_list_str.=<<<EOT
    <tr>
      <th scope="row">
        <a href="news_detail.php?id={$news_arr['id']}">{$news_arr['title']}</a>
      </th>
      <td>{$news_arr['timestamp']}</td>
      <td>{$news_arr['source']}</td>
      <td>{$news_arr['view_count']}</td>
      {$option_td}
    </tr>
EOT;
        }

    }

    $news_list_str.=<<<EOT
      </tbody>
    </table>
EOT;

    return $news_list_str;
}





