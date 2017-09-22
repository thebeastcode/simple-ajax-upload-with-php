<?php
//require_once '../libs/ImagenUpload.php';
//use File\Util\ImagenUpload;
//$uploadImage = new ImagenUpload('myImagen');
//
//if($uploadImage->isExistFileToUpload()) {
//    $uploadImage->preprocess();
//    if(!$uploadImage->isErrorOnUpload()){
//        $uploadImage->setDirToUpload('../../uploads');
//        if($uploadImage->isSave()){
//            echo $uploadImage->getMsgDoUpload();
//            echo print_r($uploadImage->getFileInformation());
//        } else {
//            echo $uploadImage->getMsgDoUpload();
//        }
//    } else{
//        echo $uploadImage->getMsgDoUpload();
//    }
//} else {
//    echo 'No hay nada que ver';
//}

echo print_r($_FILES);