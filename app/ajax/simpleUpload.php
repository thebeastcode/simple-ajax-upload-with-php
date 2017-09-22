<?php
$fileUpload = '../../uploads/'.basename($_FILES['myImagen']['name']);
$response = array('status' => FALSE, 'msg' => '');
if(move_uploaded_file($_FILES['myImagen']['tmp_name'], $fileUpload)){
    $response['msg'] = 'Archivo subido con exito';
    $response['status'] = TRUE;
} else {
    $response['msg'] = 'No se a podido subir el archivo';
}

header('Content-Type: application/json');
echo json_encode($response);

