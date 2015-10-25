<?php
//$header = <<<EOT
//    <div class="jumbotron masthead">
//        <div class="container">
//            <h1>News Hub</h1>
//            <p>新闻发布平台。</p>
//        </div>
//    </div>
//EOT;

$header = <<< EOT
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
    <div class="jumbotron" id="news_hub">
        <div class="container" style="color:#FFFFFF">
            <h1>News Hub</h1>
            <p>发现更大的世界</p>
        </div>
    </div>
    </div>
    <div class="item">
    <div class="jumbotron" style="background-image:url(img/1.jpg);background-size:cover">
        <div class="container" style="color:#FFFFFF">
            <h1>科技新闻</h1>
            <p>IT资讯</p>
        </div>
    </div>
    </div>
    <div class="item">
    <div class="jumbotron" style="background-image:url(img/2.jpg);background-size:cover">
        <div class="container" style="color:#FFFFFF">
            <h1>娱乐新闻</h1>
            <p>娱乐八卦</p>
        </div>
    </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
EOT;
