<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'controllers/EventController.php';

$controller = new EventController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        $controller->edit($id);
        break;

    case 'delete':
        $id = $_GET['id'] ?? null;
        $controller->delete($id);
        break;

    case 'upload_participants':
        $controller->upload_participants();
        break;

    case 'process_upload':
        $controller->process_upload();
        break;

    case 'index':
    default:
        $controller->index();
        break;
}
?>