<?php

require_once './config/Connection.php';
require_once './module/Get.php';
require_once './module/Post.php';
require_once './module/Put.php';
require_once './module/Delete.php';
require_once './module/Global.php';


$db = new Connection();
$pdo = $db->connect();

$get = new Get($pdo);
$post = new Post($pdo);
$put = new Put($pdo);
$del = new Delete($pdo);

if (isset($_REQUEST['request'])) {
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    http_response_code(404);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        switch ($req[0]) {
            case 'student':
                if (count($req) > 1) {
                    echo json_encode($get->get_students($req[1]));
                } else {
                    echo json_encode($get->get_students());
                }
                break;
            case 'class':
                if (count($req) > 1) {
                    echo json_encode($get->get_classes($req[1]));
                } else {
                    echo json_encode($get->get_classes());
                }
                break;
            case 'enrolled':
                if (count($req) > 1) {
                    echo json_encode($get->get_enrolled($req[1]));
                } else {
                    echo json_encode($get->get_enrolled());
                }
                break;
            case 'stud_subj':
                if (count($req) > 1) {
                    echo json_encode($get->get_stud_subj($req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            default:
                http_response_code(403);
                break;
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        switch ($req[0]) {
            case 'student':
                echo json_encode($post->add_student($data));
                break;
            case 'class':
                echo json_encode($post->add_classes($data));
                break;
            case 'enrolled':
                echo json_encode($post->add_enrollment($data));
                break;
            default:
                http_response_code(403);
                break;
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        switch ($req[0]) {
            case 'student':
                if (count($req) > 1) {
                    echo json_encode($put->update_student($data, $req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            case 'class':
                if (count($req) > 1) {
                    echo json_encode($put->update_class($data, $req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            case 'enrolled':
                if (count($req) > 1) {
                    echo json_encode($put->update_enrollment($data, $req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            default:
                http_response_code(403);
                break;
        }
        break;

    case 'DELETE':
        switch ($req[0]) {
            case 'student':
                if (count($req) > 1) {
                    echo json_encode($del->delete_student($req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            case 'class':
                if (count($req) > 1) {
                    echo json_encode($del->delete_class($req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            case 'enrolled':
                if (count($req) > 1) {
                    echo json_encode($del->delete_enrollment($req[1]));
                } else {
                    http_response_code(403);
                }
                break;
            default:
                http_response_code(403);
                break;
        }
        break;
    default:
        http_response_code(403);
        break;
}
