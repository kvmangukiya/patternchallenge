<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $data = $_FILES;
        
        //print_r($id."      ");
        //print_r($data);
        
        $photoName = $data['photo']['name'];
        $photoTmpPath = $data['photo']['tmp_name'];

        $photoPath = "user_profile_photos/".$id."-".uniqid().$photoName;
                
        $res['msg'] = $config->updatePhoto($id,$photoTmpPath,$photoPath);
        http_response_code(201);  
    } else {
        $res = ["msg" => "Only POST method is allowed !!"];
        http_response_code(403);
    }
    echo json_encode($res);
?>