<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/22
 * Time: 9:16
 */

function redirect($url, $script="")
{
    echo <<<EOT
<meta charset="utf-8">
<script>
    {$script}
    window.location.href="{$url}";
</script>
EOT;
}