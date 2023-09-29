<?php

    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();

    $res = array();
    $res['data'] = array();

    if($_SERVER['REQUEST_METHOD']=="GET"){
        $limit = $_GET['limit'];
        $data = $config->usersList($limit);
        while($rs = mysqli_fetch_assoc($data)){
            array_push($res['data'],$rs);
        }
        $res['count'] = count($res['data']);
        $res['limit'] = $limit;
    } else {
        $res["msg"] = "Allows 'GET' request methods only...";
        http_response_code(403);
    }
    echo json_encode($res);

?>