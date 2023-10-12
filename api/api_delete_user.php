<?php

    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD']== "DELETE"){
        $data = file_get_contents('php://input');
        parse_str($data,$param);
        $id = $param['id'];
        $rec = $config->getSingleRecord($id);
        if(mysqli_num_rows($rec)>0){            
            $userData = mysqli_fetch_assoc($rec);
            $userPhotoPath = $userData['photoPath'];

            if($config->deleteUser($id)){
                if($userPhotoPath!=""){
                    unlink($userPhotoPath);
                }
                $res['msg'] = "'$id' user deleted successfully.";
                http_response_code(200);
            } else {
                $res['msg'] = "'$id' user deletion not performed. Please try again later...";
                http_response_code(400);
            }
        } else {
            $res['msg'] = "'$id' user not found.";
            http_response_code(204);
        }
        echo json_encode($res);
    }

?>