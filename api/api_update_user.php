<?php
    header("Access-Control-Allow-Methods: PUT, PATCH");
    header("Access-Control-Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "PUT" || $_SERVER['REQUEST_METHOD'] == "PATCH"){

        $data = file_get_contents("php://input");

        $record = array();

        parse_str($data, $record);

        $id = $record['id'];
        $name = $record['name'];
        $email = $record['email'];
        $pass = $record['pass'];
        $contact = $record['contact'];
        $about = $record['about'];
        
        $res['msg'] = $config->updateUser($id,$name,$email,$pass,$contact,$about);
        
        http_response_code(200);
    } else {
        $res = ["msg" => "Only PUT or PATCH method is allowed !!"];
        http_response_code(403);
    }

    echo json_encode($res);
?>