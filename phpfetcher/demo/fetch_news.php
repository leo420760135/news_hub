<?php
//下面两行使得这个项目被下载下来后本文件能直接运行
$demo_include_path = dirname(__FILE__) . '/../';
set_include_path(get_include_path() . PATH_SEPARATOR . $demo_include_path);

require_once('phpfetcher.php');
require_once('connect.php');

class myclass{
    public  static  $class = "tech";
}


if(isset($_GET["class"]))
{
    myclass::$class = $_GET["class"];
}

class mycrawler extends Phpfetcher_Crawler_Default {
    public function handlePage($page) {
        //打印处当前页面的第1个h1标题内荣（下标从0开始）
        $title = trim($page->sel('//h1', 0)->plaintext);
        if (!empty($title)) {

            if(!$this->news_exist($title))
            {
                echo $title."<br>";
                $detail = "";
                $res = $page->sel('//p');
                for ($i = 0; $i < count($res); ++$i) {
                    $detail .="<p>". $res[$i]->plaintext."</p>";
                }
                $this->insert_news($title,$detail,myclass::$class);
            }
        }
    }

    private function news_exist($title)
    {
        $sql = "select title from news where title='{$title}';";
        $connect = connect();
        $result = $connect->query($sql);
        $array = $result->fetch(PDO::FETCH_ASSOC);
        if($array)
        {
            return true;
        }
        return false;
    }

    private function insert_news($title,$detail,$class)
    {
        $connect = connect();
        $sql = "insert into news(title,detail,source,publisher,class,timestamp) values(:news_title,:news_content,'腾讯新闻','腾讯新闻',:news_class,now());";
        $prepare = $connect->prepare($sql) ;

        $prepare->execute(array(
            ':news_title'=>$title,
            ':news_content'=>$detail,
            ':news_class'=>$class
        ));
    }


}

$crawler = new mycrawler();
$arrJobs = array(
    //任务的名字随便起，这里把名字叫qqnews
    //the key is the name of a job, here names it qqnews
    'news' => array(
        'start_page' => 'http://'.myclass::$class.'.qq.com/', //起始网页
        'link_rules' => array(
            /*
             * 所有在这里列出的正则规则，只要能匹配到超链接，那么那条爬虫就会爬到那条超链接
             * Regex rules are listed here, the crawler will follow any hyperlinks once the regex matches
             */
            '#'.myclass::$class.'\.qq\.com/a/\d+/\d+\.htm$#',
        ),
        //爬虫从开始页面算起，最多爬取的深度，设置为2表示爬取深度为1
        //Crawler's max following depth, 1 stands for only crawl the start page
        'max_depth' => 2,

    ) ,

);

$crawler->setFetchJobs($arrJobs)->run(); //这一行的效果和下面两行的效果一样
//$crawler->setFetchJobs($arrJobs);
//$crawler->run();
