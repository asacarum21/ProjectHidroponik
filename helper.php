<?php
    function data_get($name){
        return $_GET[$name] ?? NULL;
    }

    function data_post($name){
        return $_POST[$name] ?? NULL;
    }
    function output($status='ok',$message='',$data=NULL){
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
            ]);
        exit();
    }
?>