<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/19
 * Time: 8:19
 */

$header = <<<EOT
    <div class="jumbotron masthead">
        <div class="container">
            <h1>关于 News Hub</h1>
            <p>我们的简介</p>
        </div>
    </div>
EOT;
$active_page = "about_page";
$content = __FILE__;
include "layout.php";