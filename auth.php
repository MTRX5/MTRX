<?php

include_once('config.php');
$mysqli = new mysqli(HOST , USER , PASS , DB , PORT);
if ($mysqli->connect_errno) { // Проверка на ошибку подключения
    exit();
}

$login = $mysqli->real_escape_string(trim($_POST['login']));
$password = $mysqli->real_escape_string(trim($_POST['password']));

if (empty($login) or empty($password)){
    $data = [
        'response' => false
    ];
    $json = json_encode($data);
    echo $json;
} else {
    // Password Hash
    $key = "bE2N95mg8nsR";
    $iv = "aV6NXZPBeBkmmty5";
    $password = openssl_encrypt($password, 'AES256', $key, 0, $iv);
    $sql = "SELECT * FROM `user` WHERE `login` = '$login' and `password` = '$password'";
    $query = $mysqli->query($sql);
    if ($query->num_rows == 1){
        $response = $query->fetch_object();
        $access_token = $response->access_token;
        setcookie('access_token', $access_token, time()+60*60*24*30, '/');
        $data = [
            'response' => true
        ];
        $json = json_encode($data);
        echo $json;
    } else {
        $data = [
            'response' => false
        ];
        $json = json_encode($data);
        echo $json;
    }
}