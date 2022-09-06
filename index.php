<?php

    require_once './config/Connection.php';
    require_once './module/Get.php';
    require_once './module/Post.php';
    require_once './module/Global.php';

    
    $db = new Connection();
    $pdo = $db->connect();

    $get = new Get($pdo);
    $post = new Post($pdo);
    
    if(isset($_REQUEST['request'])){
        $req = explode('/', rtrim($_REQUEST['request'],'/'));
    }else{
        http_response_code(404);
    }

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            switch($req[0]){
                case 'student':
                    if(count($req)>1){
                        echo json_encode($get->get_students($req[1]));
                    }else{
                        echo json_encode($get->get_students());
                    }
                    break;
                case 'class':
                    if(count($req)>1){
                        echo json_encode($get->get_classes($req[1]));
                    }else{
                        echo json_encode($get->get_classes());
                    }
                    break;
                case 'enrolled':
                    if(count($req)>1){
                        echo json_encode($get->get_enrolled($req[1]));
                    }else{
                        echo json_encode($get->get_enrolled());
                    }
                    break;
            }
            break;
        
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            switch($req[0]){
                case 'addstudent':
                    $post->add_student($data);
                    break;
            }
            break;

        case 'PUT':
            break;

        case 'DELETE':
            break;
    }
