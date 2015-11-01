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
$content = <<<EOT
<address>
  <strong>组长</strong><br>
  杨韬 |邮箱:<a href="mailto:420760135@qq.com">420760135@qq.com</a>
</address>
<address>
  <strong>小组成员</strong><br>
  张文林、巴合江、潘永鹏、高士奇、王元博、王艺帆、姚灏远
</address>
EOT;

include "layout.php";