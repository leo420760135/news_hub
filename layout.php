<?php
include_once "session.php";
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>News Hub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <style>
        <?php
        if(isset($style))
        {
            echo $style;
        }

        ?>

    </style>
    <?php
    if(isset($script_head))
    {
        echo $script_head;
    }

    ?>
    <?php
    if(isset($link))
    {
        echo $link;
    }

    ?>
</head>


<body>
    <!-- =========================	Navbar	========================= -->
    <!-- Docs master nav -->
      <header class="navbar navbar-inverse navbar-static-top" style="margin-bottom: 0" >
    <!--                <header class="navbar navbar-static-top bs-docs-nav">-->
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">News Hub</a>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="index_page" class="">
                        <a href="index.php">首页</a>
                    </li>
                    <li id="admin_page" class="">
                        <a href="admin.php">Admin</a>
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
            </nav>
        </div>
    </header>

<!-- =========================	Header	========================= -->
<?php
if(isset($header))
{
    echo $header;
}
?>
<!-- =========================	Content	========================= -->
<div class="container">
    <div class="row-fluid">

        <?php echo $content;?>

    </div>
</div>

<!-- =========================	Script	========================= -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $(document).ready(function()
    {
        $("#<?php echo $active_page;?>").attr("class","active");
        <?php
        if(isset($script))
        {
            echo $script;
        }

         ?>
    });
</script>
</body>
</html>

