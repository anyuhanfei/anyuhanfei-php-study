<?php
/**
 * 获取url的html内容
 *
 * 可设置header，cookie，解压格式，header头输出，有https处理
 *
 * @param string $url 网址
 * @param string $cookie cookie
 * @param array $header header头
 * @param string $method 数据提交方式，为GET时数据在url中，为post时数据在$data中
 * @param array $data 需要提交的数据
 * @param boolean/string $setEncoding  解压格式，没有则为false
 * @param boolean $setHeader 是否输出header
 * @return void html内容
 */
function anHttpRequest($url, $cookie, $header, $method = 'GET', $data = array(), $setEncoding = false, $setHeader = false){
    $ch = curl_init();
    //url
    curl_setopt($ch, CURLOPT_URL, $url);
    //输出html内容
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //解压
    if($setEncoding != false){
        curl_setopt($ch, CURLOPT_ENCODING, $setEncoding);
    }

    //判断是否是https
    $ssl = preg_match('/^https:\/\//i',$url) ? TRUE : FALSE;
    if($ssl){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
    }
    //是否需要使用post方式提交数据
    if($method != 'GET'){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    //header
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //cookie
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('cookie:'.$cookie));
    //输出header
    if($setHeader != false){
        curl_setopt($ch, CURLOPT_HEADER, $setHeader);
    }

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}