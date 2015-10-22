<ul class="nav navbar-nav">
    <li id="index_page" class="">
        <a href="index.php">首页</a>
    </li>
    <li id="publish_page" class="">
        <a href="publish.php">发布新闻</a>
    </li>
    <li id="about_page" class="">
        <a href="about.php">关于我们</a>
    </li>

</ul>
<ul class="nav navbar-nav navbar-right">
    <?php
    if($_SESSION['user_name']=="news_hub_anonymous_user")
    {
        echo <<<EOT
				  <li id="sign_page" class="">
					<a href="./sign.php">登录/注册</a>
				  </li>
EOT;
    }
    else
    {
        echo <<<EOT
				  <li id="user_info_page" class="">
					<a href="./user_info.php">{$_SESSION['user_name']}</a>
				  </li>
				  <li id="logout_page" class="">
					<a href="./sign.php">退出</a>
				  </li>
EOT;
    }
    ?>
</ul>