<?php

if(!isset($_GET)){
    echo ajax_echo(
        "Error", 
        "You didn't specify GET parameters", 
        true, 
        "Detected", 
        null 
    );
    exit();
}

if(!isset($_GET['token'])){
    echo ajax_echo(
        "Error", 
        "You didn't specify GET parameter token", 
        true, 
        "Detected", 
        null 
    );
    exit();
}

define('TOKEN', $_GET['token']);

if(!preg_match_all("/^[A-z0-9_]{32}$/iu", TOKEN)){
    echo ajax_echo(
        "Error", 
        "Token error", 
        true, 
        "Detected", 
        null 
    );
    exit();
}

$query = "SELECT COUNT(`id`) > 0 AS 'RESULT' FROM `admin_api` WHERE `token` = '" . TOKEN . "' AND `ban` = FALSE";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Error",
        "Error in request with admin_api, token or ban.", 
        true, 
        "Detected", 
        null 
    );
    exit();
}

$res = mysqli_fetch_assoc($res_query);

if(!$res){
    echo ajax_echo(
        "Error", 
        "Error in request2.", 
        true, 
        "Detected", 
        null 
    );
    exit();
}

if($res['RESULT'] == '0'){
    echo ajax_echo(
        "Error", 
        "Token error2!", 
        true, 
        "Detected",
        null 
    );
    exit();
}