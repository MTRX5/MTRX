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
    $sql = "SELECT * FROM `user` WHERE `login` = '$login'";
    $query = $mysqli->query($sql);
    if ($query->num_rows == 1){
        $data = [
            'response' => false
        ];
        $json = json_encode($data);
        echo $json;
    } else {
        // Token Generate
        $key = openssl_random_pseudo_bytes(12);
        $iv = openssl_random_pseudo_bytes(16);
        $data = openssl_random_pseudo_bytes(25);
        $access_token = openssl_encrypt($data, 'AES256', $key, 0, $iv);
        // Token Generate

        // Password Hash
        $key = "bE2N95mg8nsR";
        $iv = "aV6NXZPBeBkmmty5";
        $password = openssl_encrypt($password, 'AES256', $key, 0, $iv);
        $sql = "INSERT INTO `user` (`login`, `password`, `access_token`, `status`) VALUES ('$login', '$password', '$access_token', 0)";
        // Password Hash

        if ($mysqli->query($sql)){
            // Cookie
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
}