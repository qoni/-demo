<?php
//如果出现乱码加一个header
header("content-type:text/html;charset=utf-8");
//公共部分
function p($data){
    echo "<pre/>";
    var_dump($data);
}
//常量
define("IS_POST",$_SERVER["REQUEST_METHOD"]=="POST"?true:false);
//判断ajax请求如果存在HTTP_X_REQUESTED_WITH并且它的值为XMLHttpRequest；
define("IS_AJAX",isset($_SERVER["HTTP_X_REQUESTED_WITH"])&&$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest"?true:false);
//魔术函数
function __autoload($classname){
    $classPath="./{$classname}.class.php";
    if(file_exists($classPath)){
        include_once "$classPath";
    }else{
        echo "{$classname}类不存在";
        die;
    }
}
//成功提示和跳转
function success($msg,$url){
    $str=<<<str
    <script>
    alert("$msg");
    window.location.href="$url";
    </script>
str;
    die($str);
}
//失败提示和跳转
function error($msg,$url){
    $str=<<<str
    <script>
    alert("$msg");
    window.location.href="$url";
    </script>
str;
    die($str);
}

function M(){
    $model=new ModelController;
    return $model;
}
function ajax_return($code,$message,$data){
    if(!is_numeric($code)){
        return "";
    }
    $result=array(
        "code"=>$code,
        "message"=>$message,
        "data"=>$data
    );
    die(json_encode($result));
}