<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2015/10/28
 * Time: 23:28
 */



function send_email($to,$title,$content,$from = 'news_hub@sina.com',$pwd = 'news_hub07',$host = 'smtp.sina.com',$port = 25)
{
    $mail = new SaeMail();
    $ret = $mail->quickSend( $to , $title , $content, $from ,$pwd , $host, $port);    //发送失败时输出错误码和错误信息
    if ($ret === false)
    {
        echo $mail->errno().";".$mail->errmsg();
    }

    return $ret;
}

