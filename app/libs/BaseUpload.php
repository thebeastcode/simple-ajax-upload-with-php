<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseUpload
 *
 * @author nayosx
 */

namespace File\Util;

abstract class BaseUpload {

    //put your code here
    const NAME = 'name';
    const ERROR = 'error';
    const TYPE = 'type';
    const EXTENSION = 'ext';
    const SIZE = 'size';
    const TMP_NAME = 'tmp_name';

    protected $msgDoUpload;
    protected $isErrorExist;
    protected $file;
    public $ext;
    public $name;
    public $type;
    protected $typeAccepted;
    protected $fileInputName;
    protected $size;
    public $fileInfo;
    protected $errorInformation;
    protected $dirUpload;
    protected $DEFAULT_MAX_FILE_SIZE = 5 * 1024 * 1024; //5Mb
    protected $MAX_FILE_SIZE = 0;

    public function __construct($fileInputName, $dirUpload = '') {
        $this->isErrorExist = FALSE;
        $this->msgDoUpload = '';
        $this->file = $_FILES;
        $this->typeAccepted = array();
        $this->fileInputName = $fileInputName;
        $this->fileInfo;
        $this->dirUpload = $dirUpload;
        $this->size = 0;
    }

    public function setDirToUpload($dirname) {
        $this->dirUpload = $dirname;
    }

    public function isExistFileToUpload() {
        return (isset($this->file[$this->fileInputName][self::NAME]) && !empty($this->file[$this->fileInputName][self::NAME])) ? TRUE : FALSE;
    }

    public function preprocess() {
        $this->name = $this->sanitarizeFileName($this->file[$this->fileInputName][self::NAME]);
        $this->type = $this->file[$this->fileInputName][self::TYPE];
        $this->ext = pathinfo($this->name, PATHINFO_EXTENSION);
        $this->size = $this->file[$this->fileInputName][self::SIZE];
        $this->fileInfo = array(
            self::NAME => $this->name,
            self::EXTENSION => $this->ext,
            self::TYPE => $this->type,
            self::SIZE => $this->size,
            'dirUpload' => $this->dirUpload
        );
    }

    public function getFileInformation() {
        return $this->fileInfo;
    }

    public function isErrorOnUpload() {
        //most info http://php.net/manual/en/features.file-upload.errors.php
        switch ($this->file[$this->fileInputName][self::ERROR]) {
            case UPLOAD_ERR_OK:
                $this->msgDoUpload = 'No hay error, fichero subido con éxito.';
                $this->isErrorExist = FALSE;
                break;
            case UPLOAD_ERR_INI_SIZE:
                $this->msgDoUpload = 'El fichero subido excede la directiva upload_max_filesize de php.ini.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->msgDoUpload = 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->msgDoUpload = 'El fichero fue sólo parcialmente subido.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->msgDoUpload = 'No se subió ningún fichero.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->msgDoUpload = 'Falta la carpeta temporal.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->msgDoUpload = 'No se pudo escribir el fichero en el disco.';
                $this->isErrorExist = TRUE;
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->msgDoUpload = 'Una extensión de PHP detuvo la subida de ficheros.';
                $this->isErrorExist = TRUE;
                break;
            default:
                $this->msgDoUpload = 'Fallo al subir archivo';
                $this->isErrorExist = TRUE;
                throw new RuntimeException('Failed to move uploaded file.');
        }

        return $this->isErrorExist;
    }

    public function getMsgDoUpload() {
        return $this->msgDoUpload;
    }

    protected function sanitarizeFileName($name) {
        return preg_replace(
                array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($name)
        );
    }

    public function isSave() {
        return move_uploaded_file($this->file[$this->fileInputName][self::TMP_NAME], $this->dirUpload . DIRECTORY_SEPARATOR . $this->name);
    }
    
    public function isValidFileName($fileName) {
        $isName = NULL;
        if(preg_match("`^[-0-9A-Z_\.]+$`i", $fileName)) {
            $this->msgDoUpload = 'Nombre de archivo valido';
            $isName = TRUE;
        } else {
            $this->msgDoUpload = 'Nombre de archivo no valido para subir';
            $isName = FALSE;
        }
        return $isName;
    }

    public function isDirectoryExist($dirname) {
        $isDir = NULL;
        if(is_dir($dirname)) {
            $this->msgDoUpload = 'Directorio valido';
            $isDir = TRUE;
        } else {
            $this->msgDoUpload = 'El directorio no existe';
            $isDir = FALSE;
        }
        return $isDir;
    }
    
    //http://php.net/manual/es/function.file-exists.php
    public function isFileExist($dir,$file) {
        $isExist = NULL;
        if(file_exists($dir.$file)){
            $this->msgDoUpload = 'El archivo existe en el directorio';
            $isExist = TRUE;
        } else {
            $this->msgDoUpload = 'El archivo no existe en el directorio';
            $isExist = FALSE;
        }
    }
}
