<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        $result = $config->verifyUser($email,$pass);

        if($result==1){
            $res = ["msg" => "User verified successfully !!"];
        } else {
            if($result==2){
                $res = ["msg" => "Wrong password !!"];
            } else {
            $res = ["msg" => "User does not exist !!"];
            }
        }
        http_response_code(200);
    } else {
        $res = ["msg" => "Only POST method is allowed !!"];
        http_response_code(403);
    }

    echo json_encode($res);
?>