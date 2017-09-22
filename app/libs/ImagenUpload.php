<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenUpload
 *
 * @author nayosx
 */
namespace File\Util;
require_once 'BaseUpload.php';
class ImagenUpload extends BaseUpload{
    
    public function __construct($fileInputName) {
        parent::__construct($fileInputName);
        $this->typeAccepted = array('jpeg', 'jpg', 'gif', 'png');
    }
}
