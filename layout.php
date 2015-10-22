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
                <?php include "nav.php" ?>
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

